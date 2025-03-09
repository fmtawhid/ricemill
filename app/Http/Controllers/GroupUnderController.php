<?php

namespace App\Http\Controllers;

use App\Models\GroupUnder;
use Illuminate\Http\Request;
use DataTables;

class GroupUnderController extends Controller
{
    // Display a list of all group unders
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $groupUnders = GroupUnder::select(['id', 'name', 'note', 'created_at'])
                ->where('user_id', auth()->id()) // Filter by logged-in user
                ->get();

            return DataTables::of($groupUnders)
                ->addIndexColumn()
                ->addColumn('actions', function ($groupUnder) {
                    return '
                        <a href="' . route('group_unders.edit', ['group_under' => $groupUnder->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('group_unders.destroy', ['group_under' => $groupUnder->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.group_unders.index');
    }

    // Show the form to create a new group under
    public function create()
    {
        return view('admin.group_unders.create');
    }

    // Store a new group under
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        // Create a new group under
        $groupUnder = new GroupUnder();
        $groupUnder->name = $request->name;
        $groupUnder->note = $request->note;
        $groupUnder->user_id = auth()->id(); // Assign the logged-in user ID
        $groupUnder->save();

        return redirect()->route('group_unders.index', ['user_id' => auth()->id()])->with('success', 'Group Under created successfully!');
    }

    // Show the form to edit an existing group under
    public function edit($id)
    {
        $groupUnder = GroupUnder::findOrFail($id);

        // Ensure the group under belongs to the current user
        if ($groupUnder->user_id !== auth()->id()) {
            return redirect()->route('group_unders.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.group_unders.edit', compact('groupUnder'));
    }

    // Update an existing group under
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        $groupUnder = GroupUnder::findOrFail($id);

        // Ensure the logged-in user owns this group under
        if ($groupUnder->user_id !== auth()->id()) {
            return redirect()->route('group_unders.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $groupUnder->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);

        return redirect()->route('group_unders.index', ['user_id' => auth()->id()])->with('success', 'Group Under updated successfully!');
    }

    // Delete a group under
    public function destroy($id)
    {
        $groupUnder = GroupUnder::findOrFail($id);

        // Ensure the logged-in user owns this group under
        if ($groupUnder->user_id !== auth()->id()) {
            return redirect()->route('group_unders.index')->with('error', 'Unauthorized');
        }

        $groupUnder->delete();

        return redirect()->route('group_unders.index', ['user_id' => auth()->id()])->with('success', 'Group Under deleted successfully!');
    }
}
