<?php

namespace App\Http\Controllers;

use App\Models\AccountLedger;
use App\Models\AccountGroup;
use Illuminate\Http\Request;
use DataTables;

class AccountLedgerController extends Controller
{
    // Display a list of all account ledgers
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accountLedgers = AccountLedger::with(['accountGroup'])
                ->where('user_id', auth()->id()) // Filter by logged-in user
                ->get();

            return DataTables::of($accountLedgers)
                ->addIndexColumn()
                ->addColumn('account_group_name', function ($accountLedger) {
                    return $accountLedger->accountGroup->name ?? 'N/A'; // Display Account Group name
                })
                ->addColumn('actions', function ($accountLedger) {
                    return '
                        <a href="' . route('account_ledgers.edit', ['account_ledger' => $accountLedger->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('account_ledgers.destroy', ['account_ledger' => $accountLedger->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.account_ledgers.index');
    }

    // Show the form to create a new account ledger
    public function create()
    {
        $accountGroups = AccountGroup::all(); // Get all account groups for the dropdown
        return view('admin.account_ledgers.create', compact('accountGroups'));
    }

    // Store a new account ledger
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'account_group_id' => 'required|exists:account_groups,id',
            'phone_number' => 'required',
            'email' => 'required|email',
            'opening_balance' => 'required|numeric',
            'debit_credit' => 'required|in:debit,credit',
            'status' => 'required|in:active,deactivate',
            'address' => 'required',
        ]);

        $accountLedger = new AccountLedger();
        $accountLedger->name = $request->name;
        $accountLedger->account_group_id = $request->account_group_id;
        $accountLedger->phone_number = $request->phone_number;
        $accountLedger->email = $request->email;
        $accountLedger->opening_balance = $request->opening_balance;
        $accountLedger->debit_credit = $request->debit_credit;
        $accountLedger->status = $request->status;
        $accountLedger->address = $request->address;
        $accountLedger->user_id = auth()->id(); // Assign the logged-in user ID
        $accountLedger->save();

        return redirect()->route('account_ledgers.index', ['user_id' => auth()->id()])->with('success', 'Account Ledger created successfully!');
    }

    // Show the form to edit an existing account ledger
    public function edit($id)
    {
        $accountLedger = AccountLedger::findOrFail($id);

        // Ensure the account ledger belongs to the current user
        if ($accountLedger->user_id !== auth()->id()) {
            return redirect()->route('account_ledgers.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $accountGroups = AccountGroup::all();
        return view('admin.account_ledgers.edit', compact('accountLedger', 'accountGroups'));
    }

    // Update an existing account ledger
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'account_group_id' => 'required|exists:account_groups,id',
            'phone_number' => 'required',
            'email' => 'required|email',
            'opening_balance' => 'required|numeric',
            'debit_credit' => 'required|in:debit,credit',
            'status' => 'required|in:active,deactivate',
            'address' => 'required',
        ]);

        $accountLedger = AccountLedger::findOrFail($id);

        // Ensure the logged-in user owns this account ledger
        if ($accountLedger->user_id !== auth()->id()) {
            return redirect()->route('account_ledgers.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $accountLedger->update([
            'name' => $request->name,
            'account_group_id' => $request->account_group_id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'opening_balance' => $request->opening_balance,
            'debit_credit' => $request->debit_credit,
            'status' => $request->status,
            'address' => $request->address,
        ]);

        return redirect()->route('account_ledgers.index', ['user_id' => auth()->id()])->with('success', 'Account Ledger updated successfully!');
    }

    // Delete an account ledger
    public function destroy($id)
    {
        $accountLedger = AccountLedger::findOrFail($id);

        // Ensure the logged-in user owns this account ledger
        if ($accountLedger->user_id !== auth()->id()) {
            return redirect()->route('account_ledgers.index')->with('error', 'Unauthorized');
        }

        $accountLedger->delete();

        return redirect()->route('account_ledgers.index', ['user_id' => auth()->id()])->with('success', 'Account Ledger deleted successfully!');
    }
}
