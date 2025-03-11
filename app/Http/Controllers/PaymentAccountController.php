<?php

namespace App\Http\Controllers;

use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use DataTables;

class PaymentAccountController extends Controller
{
    // Display a list of all payment accounts
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accounts = PaymentAccount::select(['id', 'name', 'account_number', 'phone_number', 'balance', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by logged-in user

            return DataTables::of($accounts)
                ->addIndexColumn()
                ->addColumn('actions', function ($account) {
                    return '
                        <a href="' . route('payment_accounts.edit', ['payment_account' => $account->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('payment_accounts.destroy', ['payment_account' => $account->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.payment_accounts.index');
    }

    // Show the form to create a new payment account
    public function create()
    {
        return view('admin.payment_accounts.create');
    }

    // Store a new payment account
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'account_number' => 'required|unique:payment_accounts,account_number',
            'phone_number' => 'required|max:20',
            'email' => 'nullable|email',
            'balance' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        // Create the payment account
        PaymentAccount::create([
            'name' => $request->name,
            'account_number' => $request->account_number,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'balance' => $request->balance,
            'note' => $request->note,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('payment_accounts.index', ['user_id' => auth()->id()])->with('success', 'Payment Account created successfully!');
    }

    // Show the form to edit an existing payment account
    public function edit($user_id, $id)
    {
        $account = PaymentAccount::findOrFail($id);

        // Ensure the logged-in user owns this account
        if ($account->user_id !== auth()->id()) {
            return redirect()->route('payment_accounts.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.payment_accounts.edit', compact('account'));
    }

    // Update an existing payment account
    public function update(Request $request, $user_id, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'account_number' => 'required|unique:payment_accounts,account_number,' . $id,
            'phone_number' => 'required|max:20',
            'email' => 'nullable|email',
            'balance' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        $account = PaymentAccount::findOrFail($id);

        // Ensure the logged-in user owns this account
        if ($account->user_id !== auth()->id()) {
            return redirect()->route('payment_accounts.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $account->update([
            'name' => $request->name,
            'account_number' => $request->account_number,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'balance' => $request->balance,
            'note' => $request->note,
        ]);

        return redirect()->route('payment_accounts.index', ['user_id' => auth()->id()])->with('success', 'Payment Account updated successfully!');
    }

    // Delete a payment account
    public function destroy($id)
    {
        $account = PaymentAccount::findOrFail($id);

        // Ensure the logged-in user owns this account
        if ($account->user_id !== auth()->id()) {
            return redirect()->route('payment_accounts.index')->with('error', 'Unauthorized');
        }

        $account->delete();

        return redirect()->route('payment_accounts.index', ['user_id' => auth()->id()])->with('success', 'Payment Account deleted successfully!');
    }
}
