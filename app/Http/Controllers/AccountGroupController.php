<?php

namespace App\Http\Controllers;

use App\Models\AccountGroup;
use App\Models\Nature;
use App\Models\GroupUnder;
use Illuminate\Http\Request;
use DataTables;

class AccountGroupController extends Controller
{
    // Display a list of all account groups
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch account groups with the related nature and group_under data
            $accountGroups = AccountGroup::with(['nature', 'groupUnder'])
                ->where('user_id', auth()->id()) // Filter by logged-in user
                ->get();

            return DataTables::of($accountGroups)
                ->addIndexColumn()
                ->addColumn('nature_name', function ($accountGroup) {
                    return $accountGroup->nature->name ?? 'N/A'; // Access the related nature name
                })
                ->addColumn('group_under_name', function ($accountGroup) {
                    return $accountGroup->groupUnder->name ?? 'N/A'; // Access the related group under name
                })
                ->addColumn('actions', function ($accountGroup) {
                    return '
                        <a href="' . route('account_groups.edit', ['account_group' => $accountGroup->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('account_groups.destroy', ['account_group' => $accountGroup->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.account_groups.index');
    }


    // Show the form to create a new account group
    public function create()
    {
        $natures = Nature::all();
        $groupUnders = GroupUnder::all();
        return view('admin.account_groups.create', compact('natures', 'groupUnders'));
    }

    // Store a new account group
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nature_id' => 'required|exists:natures,id',
            'group_under_id' => 'required|exists:group_unders,id',
            'description' => 'nullable|string',
        ]);

        $accountGroup = new AccountGroup();
        $accountGroup->name = $request->name;
        $accountGroup->nature_id = $request->nature_id;
        $accountGroup->group_under_id = $request->group_under_id;
        $accountGroup->description = $request->description;
        $accountGroup->user_id = auth()->id(); // Assign the logged-in user ID
        $accountGroup->save();

        return redirect()->route('account_groups.index', ['user_id' => auth()->id()])->with('success', 'Account Group created successfully!');
    }

    // Show the form to edit an existing account group
    public function edit($user_id, $id)
    {
        $accountGroup = AccountGroup::findOrFail($id);

        if ($accountGroup->user_id !== auth()->id()) {
            return redirect()->route('account_groups.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $natures = Nature::all();
        $groupUnders = GroupUnder::all();

        return view('admin.account_groups.edit', compact('accountGroup', 'natures', 'groupUnders'));
    }

    // Update an existing account group
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nature_id' => 'required|exists:natures,id',
            'group_under_id' => 'required|exists:group_unders,id',
            'description' => 'nullable|string',
        ]);

        $accountGroup = AccountGroup::findOrFail($id);

        if ($accountGroup->user_id !== auth()->id()) {
            return redirect()->route('account_groups.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $accountGroup->update([
            'name' => $request->name,
            'nature_id' => $request->nature_id,
            'group_under_id' => $request->group_under_id,
            'description' => $request->description,
        ]);

        return redirect()->route('account_groups.index', ['user_id' => auth()->id()])->with('success', 'Account Group updated successfully!');
    }

    // Delete an account group
    public function destroy($user_id, $id)
    {
        $accountGroup = AccountGroup::findOrFail($id);

        if ($accountGroup->user_id !== auth()->id()) {
            return redirect()->route('account_groups.index')->with('error', 'Unauthorized');
        }

        $accountGroup->delete();

        return redirect()->route('account_groups.index', ['user_id' => auth()->id()])->with('success', 'Account Group deleted successfully!');
    }
}
