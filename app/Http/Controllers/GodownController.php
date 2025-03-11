<?php

namespace App\Http\Controllers;

use App\Models\Godown;
use Illuminate\Http\Request;
use DataTables;
class GodownController extends Controller
{
    // Display a list of all godowns
    // Display a list of all godowns
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $godowns = Godown::select(['id', 'godown_name', 'description', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by user_id

            return DataTables::of($godowns)
                ->addIndexColumn()
                ->addColumn('actions', function ($godown) {
                    return '
                        <a href="' . route('godowns.edit', ['godown' => $godown->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('godowns.destroy', ['godown' => $godown->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions']) // Enable raw HTML rendering for the actions column
                ->make(true);
        }

        return view('admin.godowns.index');
    }


    // Show the form to create a new godown
    public function create()
    {
        return view('admin.godowns.create');
    }

    // Store a new godown
    public function store(Request $request)
    {
        $request->validate([
            'godown_name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new godown
        $godown = new Godown();
        $godown->godown_name = $request->godown_name;
        $godown->description = $request->description;
        $godown->user_id = auth()->id(); // Assign the logged-in user ID
        $godown->save();

        return redirect()->route('godowns.index', ['user_id' => auth()->id()])->with('success', 'Godown created successfully!');
    }

    // Show the form to edit an existing godown
    public function edit($user_id, $id)
    {
        $godown = Godown::findOrFail($id);

        // Ensure the godown belongs to the current user
        if ($godown->user_id !== auth()->id()) {
            return redirect()->route('godowns.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.godowns.edit', compact('godown'));
    }

    // Update an existing godown
    public function update(Request $request, $id)
    {
        $request->validate([
            'godown_name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $godown = Godown::findOrFail($id);

        // Ensure the logged-in user owns this godown
        if ($godown->user_id !== auth()->id()) {
            return redirect()->route('godowns.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $godown->update([
            'godown_name' => $request->godown_name,
            'description' => $request->description,
        ]);

        return redirect()->route('godowns.index',['user_id' => auth()->id()])->with('success', 'Godown updated successfully!');
    }

    // Delete a godown
    public function destroy($user_id, $id)
    {
        $godown = Godown::findOrFail($id);

        // Ensure the logged-in user owns this godown
        if ($godown->user_id !== auth()->id()) {
            return redirect()->route('godowns.index')->with('error', 'Unauthorized');
        }

        $godown->delete();

        return redirect()->route('godowns.index', ['user_id' => auth()->id()])->with('success', 'Godown deleted successfully!');
    }
}
