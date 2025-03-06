<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Models\Bibag;
use App\Models\Sreni;
use App\Models\Student;
use App\Models\Payment;
use App\Models\attendance;
use App\Models\StudentAttachment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;


class StudentController extends Controller
{
    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:student_view' => ['index', 'show'],
            'permission:student_add' => ['create', 'store'],
            'permission:student_edit' => ['edit', 'update'],
            'permission:student_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        // Retrieve date filters from the request
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y',$request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');


        $students = Student::with('attachments')
            ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select('students.*', 'srenis.name as sreni_name', 'bibags.name as bibag_name')
            ->latest();

        // Apply date filters if provided
        if ($fromDate && $toDate) {
            // Ensure that fromDate is before toDate
            if ($fromDate > $toDate) {
                return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
            }

            // Filter students based on created_at date
            $students->whereDate('students.created_at', '>=', $fromDate)
                ->whereDate('students.created_at', '<=', $toDate);
        } elseif ($fromDate) {
            // If only fromDate is provided
            $students->whereDate('students.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            // If only toDate is provided
            $students->whereDate('students.created_at', '<=', $toDate);
        }

        if ($bibagId) {
            $students->where('bibags.id', $bibagId);
        }

        if ($sreniId) {
            $students->where('srenis.id', $sreniId);
        }

        if (request()->ajax()) {
            return DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('dhakila_date', function ($row) {
                    $date = $row->dhakila_date ? new Carbon($row->dhakila_date) : null;
                    return $date ? $date->format("d-m-Y") : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('students.destroy', $row);
                    $edit_api = route('students.edit', $row);
                    $view_api = route('students.show', ['dhakila_number' => $row->dhakila_number]); // extra add
                    $id_generate = route('student.generateID', ['dhakila_number' => $row->dhakila_number]) ; // extra add
                    // $seo_api = route('product_seos.create', $row->id);
                    $csrf = csrf_token();
                    $action = <<<CODE
                <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>

                    <input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='$csrf'>
                    <a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='$edit_api' data-original-title='Edit product details'>
                    <i class="ri-edit-box-fill"></i>
                    </a>

                    <button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='' data-original-title='Delete product'>
                     <i class="ri-delete-bin-fill"></i>
                    </button>
                </form>

                <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                    <i class="ri-eye-fill"></i>
                </button>
                <!-- View Details Button -->
                <a href='$view_api' class='btn btn-primary btn-sm m-1' title='View Student Details'>
                    <i class="ri-eye-fill"></i> View Details
                </a>
                <!-- Generate ID Card Button -->
                <a href='$id_generate' class='btn btn-secondary btn-sm m-1' title='Generate ID Card'>
                    <i class="ri-id-card-fill"></i> Generate ID Card
                </a>



                CODE;

                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions'])
                ->make(true);
        }
        $bibags = Bibag::latest()->get();
        $srenis = Sreni::latest()->get();
        return view('admin.student.index', compact('students', 'bibags', 'srenis'));
    }

    public function create()
    {
        $srenis = Sreni::latest()->get();
        $bibags = Bibag::latest()->get();
        return view('admin.student.create', compact('srenis', 'bibags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'form_number' => 'required|string|unique:students,form_number',
            'dhakila_number' => 'required|string|unique:students,dhakila_number',
            'dhakila_date' => 'required|date_format:d-m-Y',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'district' => 'nullable|string|max:255',
            'academic_session' => 'required|string|max:50',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'roll_number' => 'required|integer',
            'gender' => 'nullable|in:male,female', // Add this validation for gender
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
        ]);
        // Use the provided slug or generate from the name
        $slug = $request->slug ?? Str::slug($request->student_name);

        // Ensure the slug is unique
        $slug = $this->generateUniqueSlug($slug);
        // Generate a SKU if not provided
        $admission_id =   $this->generateUniqueSku();

        $dhakilaDate = Carbon::createFromFormat('d-m-Y', $request->dhakila_date);


        $student = new Student();

        $student->form_number = $request->form_number;
        $student->dhakila_number = $request->dhakila_number;
        $student->dhakila_date = $dhakilaDate;
        $student->student_name = $request->student_name;
        $student->father_name = $request->father_name;
        $student->mobile = $request->mobile;
        $student->district = "Dinajpur";
        $student->academic_session = $request->academic_session;
        $student->sreni_id = $request->sreni_id;
        $student->bibag_id = $request->bibag_id;
        $student->roll_number = $request->roll_number;
        $student->type = 'admission';

        $student->gender = $request->gender; // Add this line to save gender

        $student->slug = $slug;
        $student->admission_id = $admission_id;

        $student->save();

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');

            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                StudentAttachment::create([
                    'student_id' => $student->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $fileNameToStore,
                    'file_type' => $extension, // Add this field to the database
                ]);
            }
        }

        return response()->json(['success' => "Admission Successful"]);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $srenis = Sreni::all(); // Assuming Sreni is the class model
        $bibags = Bibag::all(); // Assuming Sreni is the class model

        // Fetch existing attachments
        $attachments = $student->attachments()->get(['id', 'file_path', 'file_name', 'file_type']);

        return view('admin.student.edit', compact('student', 'srenis', 'attachments', 'bibags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // Validate the request
        $request->validate([
            'form_number' => 'required|string|unique:students,form_number,' . $student->id,
            'dhakila_number' => 'required|string|unique:students,dhakila_number,' . $student->id,
            'dhakila_date' => 'required|date_format:d-m-Y',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'district' => 'nullable|string|max:255',
            'academic_session' => 'required|string|max:50',
            'sreni_id' => 'required|exists:srenis,id',
            'bibag_id' => 'required|exists:bibags,id',
            'roll_number' => 'required|integer',

            // New Fields (nullable)
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048', // Image field
            'email' => 'nullable|email|max:255', // Email field
            'emergency_contact' => 'nullable|string|max:15', // Emergency Contact
            'date_of_birth' => 'nullable|date', // Date of Birth

            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512', // 512 KB
            'delete_attachments' => 'array', // IDs of attachments to delete
            'delete_attachments.*' => 'integer|exists:student_attachments,id',
        ]);

        // Update student data
        $student->form_number = $request->form_number;
        $student->dhakila_number = $request->dhakila_number;
        $student->dhakila_date = Carbon::createFromFormat('d-m-Y', $request->dhakila_date);
        $student->student_name = $request->student_name;
        $student->father_name = $request->father_name;
        $student->mobile = $request->mobile;
        $student->district = "Dinajpur";
        $student->academic_session = $request->academic_session;
        $student->sreni_id = $request->sreni_id;
        $student->bibag_id = $request->bibag_id;
        $student->roll_number = $request->roll_number;

        // New Fields (Updating if provided in the request)
        if ($request->has('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('img/profile'), $fileNameToStore);
            $student->image = $fileNameToStore;
        }

        if ($request->has('email')) {
            $student->email = $request->email;
        }

        if ($request->has('emergency_contact')) {
            $student->emergency_contact = $request->emergency_contact;
        }

        if ($request->has('date_of_birth')) {
            $student->date_of_birth = $request->date_of_birth;
        }

        $student->save();

        // Handle deletion of attachments
        if ($request->has('delete_attachments')) {
            $attachmentsToDelete = StudentAttachment::whereIn('id', $request->delete_attachments)->get();

            foreach ($attachmentsToDelete as $attachment) {
                // Delete the file from storage
                if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
                    unlink(public_path('assets/attachements/' . $attachment->file_path));
                }

                // Delete the record from database
                $attachment->delete();
            }
        }

        // Handle new attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                StudentAttachment::create([
                    'student_id' => $student->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $filenameWithExt,
                    'file_type' => $extension
                ]);
            }
        }

        return response()->json(['success' => "Student updated successfully"]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cateogory  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', "Student Deleted Successfully");
    }
    private function generateUniqueSku()
    {
        do {
            // Generate a random SKU in the desired format
            $sku = 'admission-' . strtoupper(Str::random(8));
        } while (Student::where('admission_id', $sku)->exists());

        return $sku;
    }

    // Generate a unique slug based on the given slug, ignoring the specified product ID if provided.
    private function generateUniqueSlug($slug, $ignoreId = null)
    {
        // Add the '-{count}' suffix only if the slug already exists in the database.
        $originalSlug = $slug;
        $count = 1;

        while (Student::where('slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                return $query->where('id', '!=', $ignoreId);
            })
            ->exists()
        ) {
            $slug = "{$originalSlug}-" . $count++;
        }

        return $slug;
    }

    public function getAttachments(Student $student)
    {
        $attachments = $student->attachments()->get(['file_path', 'file_name', 'file_type']);

        // Generate URLs for the attachments
        $attachments = $attachments->map(function ($attachment) {
            return [
                'url' => asset('assets/attachements/' . $attachment->file_path),
                'name' => $attachment->file_name,
                'file_type' => $attachment->file_type
            ];
        });

        return response()->json(['attachments' => $attachments]);
    }


    public function exportExcel(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'bibag_id' => 'nullable|integer',
            'sreni_id' => 'nullable|integer',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');

        // Format for the filename to include date range
        $filename = 'students';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.xlsx';

        return Excel::download(new StudentsExport($fromDate, $toDate, $bibagId, $sreniId), $filename);
    }

    // Export to PDF
    public function exportPDF(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'bibag_id' => 'nullable|integer',
            'sreni_id' => 'nullable|integer',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $bibagId = $request->input('bibag_id');
        $sreniId = $request->input('sreni_id');

        // Build the query with necessary joins and filters
        $query = Student::with('attachments')
            ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select('students.*', 'srenis.name as sreni_name', 'bibags.name as bibag_name')
            ->latest();

        // Apply date filters
        if ($fromDate && $toDate) {
            $query->whereDate('students.created_at', '>=', $fromDate)
                ->whereDate('students.created_at', '<=', $toDate);
        } elseif ($fromDate) {
            $query->whereDate('students.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('students.created_at', '<=', $toDate);
        }

        if ($bibagId) {
            $query->where('bibags.id', $bibagId);
        }

        if ($sreniId) {
            $query->where('srenis.id', $sreniId);
        }

        $students = $query->get();


        // Format for the filename to include date range
        $filename = 'students';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.pdf';


        $pdf = Pdf::loadView('admin.student.export_pdf', [
            'students' => $students,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }


    public function show($dhakila_number)
    {
        // Fetch the student based on dhakila_number instead of id
        $student = Student::where('dhakila_number', $dhakila_number)->firstOrFail();

        // Get the payments and attendances for this student
        $payments = $student->payments;
        $attendances = $student->attendances ?? collect([]);

        // Get the attachments for this student
        $attachments = $student->attachments;

        $activeTab = 'basic-info';
        return view('admin.student.show', compact('student', 'payments', 'activeTab', 'attendances', 'attachments'));
    }


    public function getPayments($dhakila_number)
    {
        $payments = Payment::where('dhakila_number', $dhakila_number)
            ->join('purposes', 'payments.purpose_id', '=', 'purposes.id')
            ->select('payments.id', 'payments.reciept_no', 'payments.date', 'payments.amount', 'purposes.purpose_name');

        return DataTables::of($payments)
            ->addIndexColumn()  // Adds a serial number column
            ->make(true);
    }

    public function getAttendances($dhakila_number)
    {
        $attendances = Attendance::join('students', 'attendances.student_id', '=', 'students.id')
            ->join('attendance_types', 'attendances.attendance_type_id', '=', 'attendance_types.id')
            ->where('students.dhakila_number', $dhakila_number)  // Filter using dhakila_number from students table
            ->select(
                'attendances.id',
                'attendances.date',
                'attendance_types.name as attendance_type',
                'attendance_types.color',
                'attendances.remark'
            );

        return DataTables::of($attendances)
            ->addIndexColumn()
            ->editColumn('attendance_type', function ($attendance) {
                return "<span style='color: {$attendance->color}; font-weight: bold;'>{$attendance->attendance_type}</span>";
            })
            ->rawColumns(['attendance_type'])
            ->make(true);
    }


    public function studentProfile()
    {
        return view('admin.student.profile');
    }

    public function searchStudent(Request $request)
    {
        // সার্চ কোয়েরি থেকে দাখিলা নাম্বার নিচ্ছি
        $dhakilaNumber = $request->input('dhakila_number');

        // দাখিলা নাম্বার অনুযায়ী ছাত্রের তথ্য খুঁজে পাওয়া
        $student = Student::where('dhakila_number', $dhakilaNumber)->first();

        // যদি ছাত্র না পাওয়া যায়, তবে মেসেজ সহ ফেরত পাঠানো
        if (!$student) {
            return back()->with('error', 'Student not found with this Dhakila Number.');
        }

        // ছাত্রের সম্পর্কিত তথ্য নিয়ে আসা
        $payments = $student->payments;
        $attendances = $student->attendances ?? collect([]);
        $attachments = $student->attachments;
        $activeTab = 'basic-info';

        // ফলাফল ভিউতে পাঠানো
        return view('admin.student.profile', compact('student', 'payments', 'attendances', 'attachments', 'activeTab'));
    }

        public function generateID($dhakila_number)
    {
        // Fetch the student based on dhakila_number instead of id
        $student = Student::where('dhakila_number', $dhakila_number)->firstOrFail();

        return view('admin.student.id_card', compact('student',));
    }


    // Show the search and ID card generation page
    public function searchIdCard()
    {
        return view('admin.student.search_id_card');
    }
}
