<?php


namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use DataTables;

class DesignationController extends Controller
{
    // Display a list of all designations
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $designations = Designation::select(['id', 'name', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by logged-in user

            return DataTables::of($designations)
                ->addIndexColumn()
                ->addColumn('actions', function ($designation) {
                    return '
                        <a href="' . route('designations.edit', ['designation' => $designation->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('designations.destroy', ['designation' => $designation->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.designations.index');
    }

    // Show the form to create a new designation
    public function create()
    {
        return view('admin.designations.create');
    }

    // Store a new designation
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Create the designation
        Designation::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('designations.index', ['user_id' => auth()->id()])->with('success', 'Designation created successfully!');
    }

    // Show the form to edit an existing designation
    public function edit($user_id, $id)
    {
        $designation = Designation::findOrFail($id);

        // Ensure the logged-in user owns this designation
        if ($designation->user_id !== auth()->id()) {
            return redirect()->route('designations.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.designations.edit', compact('designation'));
    }

    // Update an existing designation
    public function update(Request $request, $user_id, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $designation = Designation::findOrFail($id);

        // Ensure the logged-in user owns this designation
        if ($designation->user_id !== auth()->id()) {
            return redirect()->route('designations.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $designation->update([
            'name' => $request->name,
        ]);

        return redirect()->route('designations.index', ['user_id' => auth()->id()])->with('success', 'Designation updated successfully!');
    }

    // Delete a designation
    public function destroy($id)
    {
        $designation = Designation::findOrFail($id);

        // Ensure the logged-in user owns this designation
        if ($designation->user_id !== auth()->id()) {
            return redirect()->route('designations.index')->with('error', 'Unauthorized');
        }

        $designation->delete();

        return redirect()->route('designations.index', ['user_id' => auth()->id()])->with('success', 'Designation deleted successfully!');
    }
}
