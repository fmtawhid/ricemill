<?php

namespace App\Http\Controllers;
use App\Models\TeacherAttendance;
use App\Models\Teacher;
use App\Models\attendance_type;
use Illuminate\Http\Request;
use Carbon\Carbon; 

use App\Exports\TeacherAttendanceExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;




class TeacherAttendanceController extends Controller
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
            'permission:teacher_attendance_view' => ['report', 'filter'],
            'permission:teacher_attendance_add' => ['create', 'store'],
        ];
    }

    public function report(Request $request)
    {
        $data = $request->validate([
            'date' => 'nullable|date_format:d-m-Y',
        ]);

        $query = TeacherAttendance::query();

        // Apply filters
        if (!empty($data['date'])) {
            $formattedDate = Carbon::createFromFormat('d-m-Y', $data['date'])->format('Y-m-d');
            $query->where('date', $formattedDate);
        }

        if ($request->ajax()) {
            $attendances = $query->with(['teacher', 'attendanceType'])->get();

            return datatables()->of($attendances)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return \Carbon\Carbon::parse($row->date)->format('d-m-Y');
                })
                ->addColumn('teacher_name', function ($row) {
                    return $row->teacher->name ?? 'No Teacher Found';
                })
                ->addColumn('designation', function ($row) {
                    return $row->teacher->designation ?? 'No Designation Found';
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

        return view('admin.teacher_attendance.report');
    }




    public function create()
    {
        $teachers = Teacher::all(); // Fetch all teachers
        $attendanceTypes = attendance_type::all(); // Fetch all attendance types

        return view('admin.teacher_attendance.create', compact('teachers', 'attendanceTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:d-m-Y',
            'attendance' => 'required|array',
        ]);

        // Process attendance data and save to the database
        foreach ($request->attendance as $teacherId => $attendanceTypeId) {
            TeacherAttendance::updateOrCreate(
                [
                    'teacher_id' => $teacherId,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
                ],
                [
                    'attendance_type_id' => $attendanceTypeId,
                    'remark' => $request->remark[$teacherId] ?? null,
                ]
            );
        }

        // Flash success message
        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }


    public function filter(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:d-m-Y',
        ]);

        $teachers = Teacher::all(); // Fetch all teachers
        return response()->json($teachers);
    }
    // Export excel file
    public function exportTeacherAttendanceExcel(Request $request)
    {
        $request->validate([
            'filter_date' => 'nullable|date_format:d-m-Y',
        ]);
        $filter_date = $request->filter_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->filter_date)->format('Y-m-d') : null;
        return Excel::download(
            new TeacherAttendanceExport($filter_date),
            'teacher_attendance_report.xlsx'
        );
    }


    public function exportTeacherAttendancePDF(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'filter_date' => 'nullable|date_format:d-m-Y',
        ]);
        $query = TeacherAttendance::query();
        if ($request->filter_date) {
            $query->whereDate('date', \Carbon\Carbon::createFromFormat('d-m-Y', $request->filter_date)->format('Y-m-d'));
        }
        $attendances = $query->get();
        $pdf = PDF::loadView('admin.teacher_attendance.export_pdf', compact('attendances'));
        return $pdf->download('teacher_attendance_report.pdf');
    }



}