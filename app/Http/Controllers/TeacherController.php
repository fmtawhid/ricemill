<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use DataTables;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
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
            'permission:teacher_view' => ['index'],
            'permission:teacher_add' => ['create', 'store'],
            'permission:teacher_edit' => ['edit', 'update'],
            'permission:teacher_delete' => ['destroy'],
        ];
    }
    
    public function index()
    {
        $teachers = Teacher::latest()->get();

        if (request()->ajax()) {
            return DataTables::of($teachers)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('teacher.destroy', $row);
                    $edit_api = route('teacher.edit', $row);
                    $csrf = csrf_token();
                    $action = <<<CODE
                    <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>
                        <a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit teacher details'>
                            <i class="ri-edit-box-fill"></i>
                        </a>
                        <button type='submit' class='btn delete btn-danger btn-sm m-1'>
                            <i class="ri-delete-bin-fill"></i>
                        </button>
                    </form>
                    CODE;

                    return $action;
                })
                ->addColumn('phone_number', function($row) {
                    return $row->phone_number;
                })
                ->addColumn('email', function($row) {
                    return $row->email;
                })
                ->addColumn('address', function($row) {
                    return $row->address;
                })
                ->addColumn('facebook_link', function($row) {
                    return $row->facebook_link;
                })
                ->addColumn('date_of_joining', function($row) {
                    return $row->date_of_joining;
                })
                ->addColumn('salary', function($row) {
                    return $row->salary;
                })
                ->addColumn('qualification', function($row) {
                    return $row->qualification;
                })
                ->addColumn('status', function($row) {
                    return $row->status;
                })
                ->addColumn('years_of_experience', function($row) {
                    return $row->years_of_experience;
                })
                ->addColumn('department', function($row) {
                    return $row->department;
                })
                ->rawColumns(['created_at_read', 'actions'])
                ->make(true);
        }

        return view('admin.teachers.index', compact('teachers'));
    }


    // Show the form to create a new teacher
    public function create()
    {
        return view('admin.teachers.create');
    }

    // // Store a new teacher
    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'designation' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     // Handle the image upload if any
    //     $imageName = null;
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path('img/teachers'), $imageName); // Save image to public path
    //     }

    //     // Create a new teacher
    //     $teacher = new Teacher();
    //     $teacher->name = $request->name;
    //     $teacher->designation = $request->designation;
    //     $teacher->image = $imageName;
    //     $teacher->save();

    //     // Redirect with success message
    //     return redirect()->route('teacher.list')->with('success', 'Teacher added successfully!');
    // }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'facebook_link' => 'nullable|url',
            'date_of_joining' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'qualification' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'years_of_experience' => 'nullable|integer',
            'department' => 'nullable|string|max:255',
        ]);

        // Handle the image upload if any
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/teachers'), $imageName);
        }

        // Create a new teacher
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->designation = $request->designation;
        $teacher->image = $imageName;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
        $teacher->address = $request->address;
        $teacher->facebook_link = $request->facebook_link;
        $teacher->date_of_joining = $request->date_of_joining;
        $teacher->salary = $request->salary;
        $teacher->qualification = $request->qualification;
        $teacher->status = $request->status;
        $teacher->years_of_experience = $request->years_of_experience;
        $teacher->department = $request->department;
        $teacher->save();

        // Redirect with success message
        return redirect()->route('teacher.list')->with('success', 'Teacher added successfully!');
    }


    // Show the form to edit an existing teacher
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    // // Update an existing teacher
    // public function update(Request $request, $id)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'designation' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $teacher = Teacher::findOrFail($id);

    //     // Handle image update (if a new image is uploaded)
    //     $imageName = $teacher->image; // Keep existing image
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path('img/teachers'), $imageName); // Save the new image
    //     }

    //     // Update teacher data
    //     $teacher->name = $request->name;
    //     $teacher->designation = $request->designation;
    //     $teacher->image = $imageName;
    //     $teacher->save();

    //     // Redirect with success message
    //     return redirect()->route('teacher.list')->with('success', 'Teacher updated successfully!');
    // }
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'facebook_link' => 'nullable|url',
            'date_of_joining' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'qualification' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'years_of_experience' => 'nullable|integer',
            'department' => 'nullable|string|max:255',
        ]);

        $teacher = Teacher::findOrFail($id);

        // Handle image update (if a new image is uploaded)
        $imageName = $teacher->image; // Keep existing image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/teachers'), $imageName);
        }

        // Update teacher data
        $teacher->name = $request->name;
        $teacher->designation = $request->designation;
        $teacher->image = $imageName;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
        $teacher->address = $request->address;
        $teacher->facebook_link = $request->facebook_link;
        $teacher->date_of_joining = $request->date_of_joining;
        $teacher->salary = $request->salary;
        $teacher->qualification = $request->qualification;
        $teacher->status = $request->status;
        $teacher->years_of_experience = $request->years_of_experience;
        $teacher->department = $request->department;
        $teacher->save();

        // Redirect with success message
        return redirect()->route('teacher.list')->with('success', 'Teacher updated successfully!');
    }


    // Delete an existing teacher
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        // Delete the image if it exists
        if ($teacher->image) {
            Storage::delete(public_path('img/teachers/' . $teacher->image));  // Delete the image from storage
        }

        // Delete the teacher from the database
        $teacher->delete();

        return redirect()->route('teacher.list')->with('success', 'Teacher deleted successfully!');
    }
}
