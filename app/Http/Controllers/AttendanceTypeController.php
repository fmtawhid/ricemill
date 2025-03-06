<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\attendance_type;
use Illuminate\Support\Facades\Storage;
use DataTables;
class AttendanceTypeController extends Controller
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
            'permission:student_attendence_type_view' => ['index'],
            'permission:student_attendence_type_add' => ['create', 'store'],
            'permission:student_attendence_type_edit' => ['edit', 'update'],
            'permission:student_attendence_type_delete' => ['destroy'],
        ];
    }



    public function index()
    {
        $attenDanceType = attendance_type::latest()->get();

        if (request()->ajax()) {
            return DataTables::of($attenDanceType)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name; // Ensure the 'name' column exists in your database
                })
                ->addColumn('key_value', function ($row) {
                    return $row->key_value; // Ensure the 'key_value' column exists
                })
                ->addColumn('color', function ($row) {
                    return $row->color; // Ensure the 'color' column exists
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('attendance_type.destroy', $row->id);
                    $edit_api = route('attendance_type.edit', $row->id);
                    $csrf = csrf_token();

                    return <<<HTML
                        <form method='POST' action='$delete_api' class='d-inline-block'>
                            <input name='_method' type='hidden' value='DELETE'>
                            <input name='_token' type='hidden' value='$csrf'>
                            <a href='$edit_api' class='btn btn-info btn-sm'>Edit</a>
                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                    HTML;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.attendance_type.index', compact('attenDanceType'));
    }


    // Show the form to create a new teacher
    public function create()
    {
        return view('admin.attendance_type.create');
    }

    // Store a new teacher
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'key_value' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        // Create a new attendance_type
        $attendance_type = new attendance_type();
        $attendance_type->name = $request->name;
        $attendance_type->key_value = $request->key_value;
        $attendance_type->color = $request->color;
        $attendance_type->save();

        // Redirect with success message
        return redirect()->route('attendance_type.list')->with('success', 'Attendance type added successfully!');
    }

    // Show the form to edit an existing attendance type
public function edit($id)
{
    $attendance_type = attendance_type::findOrFail($id);
    return view('admin.attendance_type.edit', compact('attendance_type'));
}

// Update an existing attendance type
public function update(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'key_value' => 'required|string|max:255|unique:attendance_types,key_value,' . $id,
        'color' => 'required|string|max:255',
    ]);

    // Find the attendance type
    $attendance_type = attendance_type::findOrFail($id);

    // Update attendance type data
    $attendance_type->name = $request->name;
    $attendance_type->key_value = $request->key_value;
    $attendance_type->color = $request->color;
    $attendance_type->save();

    // Redirect with success message
    return redirect()->route('attendance_type.list')->with('success', 'Attendance type updated successfully!');
}

// Delete an existing attendance type
public function destroy($id)
{
    $attendance_type = attendance_type::findOrFail($id);

    // Delete the attendance type from the database
    $attendance_type->delete();

    return redirect()->route('attendance_type.list')->with('success', 'Attendance type deleted successfully!');
}

}