<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use DataTables;

class CurrencyController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $currencies = Currency::latest()->get();
            return DataTables::of($currencies)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $edit_url = route('currencies.edit', $row->id);
                    $delete_url = route('currencies.destroy', $row->id);
                    $csrf = csrf_token();
                    return "
                        <a class='btn btn-info btn-sm' href='$edit_url' title='Edit Currency'>
                            <i class='ri-edit-box-fill'></i>
                        </a>
                        <form action='$delete_url' method='POST' style='display:inline-block;'>
                            <input name='_method' type='hidden' value='DELETE'>
                            <input name='_token' type='hidden' value='$csrf'>
                            <button type='submit' class='btn btn-danger btn-sm'>
                                <i class='ri-delete-bin-fill'></i>
                            </button>
                        </form>
                    ";
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.currencies.index');
    }

    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ]);

        Currency::create($request->all());

        return response()->json(['success' => 'Currency added successfully!']);
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update($request->all());

        return response()->json(['success' => 'Currency updated successfully!']);
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();

        return response()->json(['success' => 'Currency deleted successfully!']);
    }
}
