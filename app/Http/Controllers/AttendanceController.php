<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\attendance;
use App\Models\attendance_type;
use App\Models\Bibag;
use App\Models\Sreni;
use App\Models\Student;
use Carbon\Carbon;

use App\Exports\AttendanceExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB; // Correctly import the DB facade

class AttendanceController extends Controller
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
            'permission:student_attendance_view' => ['report'],
            'permission:student_attendance_add' => ['create', 'store','index'],
        ];
    }



    public function index()
    {
        $attendanceTypes = attendance_type::all();
        $bibags = Bibag::all();
        $srenis = Sreni::all();
        $students = Student::all();

        return view('admin.attendance.index', compact('attendanceTypes', 'bibags', 'srenis', 'students'));
    }

    public function filter(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'bibag_id' => 'nullable|integer|exists:bibags,id',
            'sreni_id' => 'nullable|integer|exists:srenis,id',
        ]);

        // Fetch students based on filters
        $query = Student::query();

        if (!empty($data['bibag_id'])) {
            $query->where('bibag_id', $data['bibag_id']);
        }

        if (!empty($data['sreni_id'])) {
            $query->where('sreni_id', $data['sreni_id']);
        }

        // Fetch the filtered students
        $students = $query->get(['id', 'student_name', 'roll_number']);

        // Return students as JSON
        return response()->json($students);
    }



    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            ($request->all());
            $data = $request->validate([
                'date' => 'required|date_format:d-m-Y',
                'attendance' => 'required|array',
                'attendance.*' => 'integer|exists:attendance_types,id',
                'bibag_id' => 'required|integer|exists:bibags,id',
                'sreni_id' => 'required|integer|exists:srenis,id',
                'remark' => 'nullable|array',
            ]);

            $formattedDate = Carbon::createFromFormat('d-m-Y', $data['date'])->format('Y-m-d');

            foreach ($data['attendance'] as $student_id => $attendance_type_id) {
                $remark = $request->remark[$student_id] ?? null;

                logger()->info('Saving Attendance:', [
                    'student_id' => $student_id,
                    'date' => $formattedDate,
                    'attendance_type_id' => $attendance_type_id,
                    'bibag_id' => $data['bibag_id'],
                    'sreni_id' => $data['sreni_id'],
                ]);

                Attendance::updateOrCreate(
                    [
                        'student_id' => $student_id,
                        'date' => $formattedDate,
                    ],
                    [
                        'attendance_type_id' => $attendance_type_id,
                        'bibag_id' => $data['bibag_id'],
                        'sreni_id' => $data['sreni_id'],
                        'remark' => $remark,
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with('success', 'Attendance saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error Saving Attendance:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to save attendance.');
        }
    }


    public function report(Request $request)
    {
        $data = $request->validate([
            'date' => 'nullable|date_format:d-m-Y',
            'bibag_id' => 'nullable|integer|exists:bibags,id',
            'sreni_id' => 'nullable|integer|exists:srenis,id',
        ]);

        $query = attendance::query();

        // Apply filters
        if (!empty($data['date'])) {
            $formattedDate = Carbon::createFromFormat('d-m-Y', $data['date'])->format('Y-m-d');
            $query->where('date', $formattedDate);
        }

        if (!empty($data['bibag_id'])) {
            $query->whereHas('student.bibag', function ($q) use ($data) {
                $q->where('id', $data['bibag_id']);
            });
        }

        if (!empty($data['sreni_id'])) {
            $query->whereHas('student.sreni', function ($q) use ($data) {
                $q->where('id', $data['sreni_id']);
            });
        }

        if ($request->ajax()) {
            $attendances = $query->with(['student.sreni', 'student.bibag', 'attendanceType'])->get();

            return datatables()->of($attendances)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return \Carbon\Carbon::parse($row->date)->format('d-m-Y');
                })
                ->addColumn('student_name', function ($row) {
                    return $row->student->student_name;
                })
                ->addColumn('roll_number', function ($row) {
                    return $row->student->roll_number;
                })
                ->addColumn('class', function ($row) {
                    return $row->student->sreni->name ?? 'No Class Found';
                })
                ->addColumn('bibhag', function ($row) {
                    return $row->student->bibag->name ?? 'No Bibhag Found';
                })
                ->addColumn('attendance_type', function ($row) {
                    return '<span style="color:' . $row->attendanceType->color . ';">' . $row->attendanceType->name . '</span>';
                })
                ->addColumn('remark', function ($row) {
                    return $row->remark;
                })
                ->rawColumns(['attendance_type'])
                ->make(true);
        }

        $bibags = Bibag::all();
        $srenis = Sreni::all();

        return view('admin.attendance.report', compact('bibags', 'srenis'));
    }


    public function exportExcel(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'filter_date' => 'nullable|date_format:d-m-Y',
            'filter_bibag_id' => 'nullable|integer|exists:bibags,id',
            'filter_sreni_id' => 'nullable|integer|exists:srenis,id',
        ]);

        // Fetch the filtered data
        $filter_date = $request->filter_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->filter_date)->format('Y-m-d') : null;
        $filter_bibag_id = $request->filter_bibag_id;
        $filter_sreni_id = $request->filter_sreni_id;

        // Pass the filters to the AttendanceExport class
        return Excel::download(
            new AttendanceExport($filter_date, $filter_bibag_id, $filter_sreni_id),
            'attendance_report.xlsx'
        );
    }


    public function exportPdf(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'filter_date' => 'nullable|date_format:d-m-Y',
            'filter_bibag_id' => 'nullable|integer|exists:bibags,id',
            'filter_sreni_id' => 'nullable|integer|exists:srenis,id',
        ]);

        // Fetch the filtered data
        $query = Attendance::query();

        if ($request->filter_date) {
            $query->whereDate('date', \Carbon\Carbon::createFromFormat('d-m-Y', $request->filter_date)->format('Y-m-d'));
        }

        if ($request->filter_bibag_id) {
            $query->where('bibag_id', $request->filter_bibag_id);
        }

        if ($request->filter_sreni_id) {
            $query->where('sreni_id', $request->filter_sreni_id);
        }

        $attendances = $query->get();

        // Generate PDF
        $pdf = PDF::loadView('admin.attendance.export_pdf', compact('attendances'));

        return $pdf->download('attendance_report.pdf');
    }
}