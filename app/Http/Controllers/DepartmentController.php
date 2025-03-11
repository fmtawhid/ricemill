<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use DataTables;

class DepartmentController extends Controller
{
    // Display a list of all departments
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $departments = Department::select(['id', 'name', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by logged-in user

            return DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('actions', function ($department) {
                    return '
                        <a href="' . route('departments.edit', ['department' => $department->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('departments.destroy', ['department' => $department->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.departments.index');
    }

    // Show the form to create a new department
    public function create()
    {
        return view('admin.departments.create');
    }

    // Store a new department
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Create a new department
        $department = new Department();
        $department->name = $request->name;
        $department->user_id = auth()->id();
        $department->save();

        return redirect()->route('departments.index', ['user_id' => auth()->id()])->with('success', 'Department created successfully!');
    }

    // Show the form to edit an existing department
    public function edit($user_id, $id)
    {
        $department = Department::findOrFail($id);

        // Ensure the department belongs to the current user
        if ($department->user_id !== auth()->id()) {
            return redirect()->route('departments.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.departments.edit', compact('department'));
    }

    // Update an existing department
    public function update($user_id,Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $department = Department::findOrFail($id);

        // Ensure the logged-in user owns this department
        if ($department->user_id !== auth()->id()) {
            return redirect()->route('departments.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $department->update([
            'name' => $request->name,
        ]);

        return redirect()->route('departments.index', ['user_id' => auth()->id()])->with('success', 'Department updated successfully!');
    }


    // Delete a department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        // Ensure the logged-in user owns this department
        if ($department->user_id !== auth()->id()) {
            return redirect()->route('departments.index')->with('error', 'Unauthorized');
        }

        $department->delete();

        return redirect()->route('departments.index', ['user_id' => auth()->id()])->with('success', 'Department deleted successfully!');
    }
}
