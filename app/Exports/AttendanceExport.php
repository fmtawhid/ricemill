<?php
// namespace App\Exports;

// use App\Models\Attendance;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

// class AttendanceExport implements FromCollection, WithHeadings, WithStrictNullComparison
// {
//     protected $date;
//     protected $bibagId;
//     protected $sreniId;

//     public function __construct($date, $bibagId, $sreniId)
//     {
//         $this->date = $date;
//         $this->bibagId = $bibagId;
//         $this->sreniId = $sreniId;
//     }

//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         // Build the query with necessary joins and filters
//         $query = Attendance::with('student', 'attendanceType')
//             ->join('students', 'students.id', '=', 'attendances.student_id')
//             ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
//             ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
//             ->select('attendances.*', 'students.student_name', 'students.roll_number', 'srenis.name as sreni_name', 'bibags.name as bibag_name')
//             ->latest();

//         // Apply date filter
//         if ($this->date) {
//             $query->whereDate('attendances.date', '=', $this->date);
//         }

//         // Apply other filters
//         if ($this->bibagId) {
//             $query->where('bibags.id', $this->bibagId);
//         }

//         if ($this->sreniId) {
//             $query->where('srenis.id', $this->sreniId);
//         }

//         // Fetch the data
//         $attendances = $query->get();

//         // Return the data in a format suitable for Excel (array of arrays)
//         return $attendances->map(function ($attendance) {
//             return [
//                 'ID' => $attendance->id,
//                 'Date' => $attendance->date,
//                 'Student Name' => $attendance->student_name,
//                 'Roll Number' => $attendance->roll_number,
//                 'Class' => $attendance->sreni_name,
//                 'Bibhag' => $attendance->bibag_name,
//                 'Attendance Type' => $attendance->attendanceType->name,
//                 'Remark' => $attendance->remark,
//             ];
//         });
//     }

//     /**
//      * Define the headings for the exported Excel file.
//      *
//      * @return array
//      */
//     public function headings(): array
//     {
//         return [
//             'ID',
//             'Date',
//             'Student Name',
//             'Roll Number',
//             'Class',
//             'Bibhag',
//             'Attendance Type',
//             'Remark',
//         ];
//     }
// }


namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
    protected $date;
    protected $bibagId;
    protected $sreniId;

    public function __construct($date, $bibagId, $sreniId)
    {
        $this->date = $date;
        $this->bibagId = $bibagId;
        $this->sreniId = $sreniId;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        // Build the query for attendance records
        $query = Attendance::with('student', 'attendanceType')
            ->join('students', 'students.id', '=', 'attendances.student_id')
            ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select(
                'attendances.*',
                'students.student_name',
                'students.roll_number',
                'srenis.name as sreni_name',
                'bibags.name as bibag_name'
            )
            ->latest();

        // Apply filters
        if ($this->date) {
            $query->whereDate('attendances.date', $this->date);
        }

        if ($this->bibagId) {
            $query->where('bibags.id', $this->bibagId);
        }

        if ($this->sreniId) {
            $query->where('srenis.id', $this->sreniId);
        }

        $attendances = $query->get();

        // Return the filtered data to the view
        return view('admin.attendance.export_pdf', [
            'attendances' => $attendances
        ]);
    }
}