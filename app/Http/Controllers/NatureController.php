<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;
use DataTables;

class NatureController extends Controller
{
    // Display a list of all natures
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $natures = Nature::select(['id', 'name', 'note', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by logged-in user

            return DataTables::of($natures)
                ->addIndexColumn()
                ->addColumn('actions', function ($nature) {
                    return '
                        <a href="' . route('natures.edit', ['nature' => $nature->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('natures.destroy', ['nature' => $nature->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.natures.index');
    }

    // Show the form to create a new nature
    public function create()
    {
        return view('admin.natures.create');
    }

    // Store a new nature
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        // Create a new nature
        $nature = new Nature();
        $nature->name = $request->name;
        $nature->note = $request->note;
        $nature->user_id = auth()->id();
        $nature->save();

        return redirect()->route('natures.index', ['user_id' => auth()->id()])->with('success', 'Nature created successfully!');
    }

    // Show the form to edit an existing nature
    public function edit($id)
    {
        $nature = Nature::findOrFail($id);

        // Ensure the nature belongs to the current user
        if ($nature->user_id !== auth()->id()) {
            return redirect()->route('natures.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.natures.edit', compact('nature'));
    }

    // Update an existing nature
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        $nature = Nature::findOrFail($id);

        // Ensure the logged-in user owns this nature
        if ($nature->user_id !== auth()->id()) {
            return redirect()->route('natures.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $nature->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);

        return redirect()->route('natures.index', ['user_id' => auth()->id()])->with('success', 'Nature updated successfully!');
    }

    // Delete a nature
    public function destroy($id)
    {
        $nature = Nature::findOrFail($id);

        // Ensure the logged-in user owns this nature
        if ($nature->user_id !== auth()->id()) {
            return redirect()->route('natures.index')->with('error', 'Unauthorized');
        }

        $nature->delete();

        return redirect()->route('natures.index', ['user_id' => auth()->id()])->with('success', 'Nature deleted successfully!');
    }
}
