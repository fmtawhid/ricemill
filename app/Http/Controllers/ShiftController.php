<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use DataTables;

class ShiftController extends Controller
{
    // Display a list of all shifts
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $shifts = Shift::select(['id', 'name', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by logged-in user

            return DataTables::of($shifts)
                ->addIndexColumn()
                ->addColumn('actions', function ($shift) {
                    return '
                        <a href="' . route('shifts.edit', ['shift' => $shift->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('shifts.destroy', ['shift' => $shift->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.shifts.index');
    }

    // Show the form to create a new shift
    public function create()
    {
        return view('admin.shifts.create');
    }

    // Store a new shift
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Create the shift
        Shift::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('shifts.index', ['user_id' => auth()->id()])->with('success', 'Shift created successfully!');
    }

    // Show the form to edit an existing shift
    public function edit($user_id, $id)
    {
        $shift = Shift::findOrFail($id);

        // Ensure the logged-in user owns this shift
        if ($shift->user_id !== auth()->id()) {
            return redirect()->route('shifts.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.shifts.edit', compact('shift'));
    }

    // Update an existing shift
    public function update(Request $request, $user_id, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $shift = Shift::findOrFail($id);

        // Ensure the logged-in user owns this shift
        if ($shift->user_id !== auth()->id()) {
            return redirect()->route('shifts.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $shift->update([
            'name' => $request->name,
        ]);

        return redirect()->route('shifts.index', ['user_id' => auth()->id()])->with('success', 'Shift updated successfully!');
    }

    // Delete a shift
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);

        // Ensure the logged-in user owns this shift
        if ($shift->user_id !== auth()->id()) {
            return redirect()->route('shifts.index')->with('error', 'Unauthorized');
        }

        $shift->delete();

        return redirect()->route('shifts.index', ['user_id' => auth()->id()])->with('success', 'Shift deleted successfully!');
    }
}
