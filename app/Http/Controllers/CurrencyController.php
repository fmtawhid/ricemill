<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use DataTables;
class CurrencyController extends Controller
{
    // public function __construct()
    // {
    //     foreach (self::middlewareList() as $middleware => $methods) {
    //         $this->middleware($middleware)->only($methods);
    //     }
    // }

    // public static function middlewareList(): array
    // {
    //     return [
    //         'permission:currency_view' => ['index'],
    //         'permission:currency_add' => ['create', 'store'],
    //         'permission:currency_edit' => ['edit', 'update'],
    //         'permission:currency_delete' => ['destroy'],
    //     ];
    // }

    // Display a list of currencies
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currencies = Currency::select(['id', 'name', 'icon', 'note', 'user_id', 'created_at']) // Include created_at
                ->where('user_id', auth()->id()); // Filter by user_id

            return DataTables::of($currencies)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('currencies.edit', ['currency' => $row->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('currencies.destroy', ['currency' => $row->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions']) // Enable raw HTML rendering for the actions column
                ->make(true);
        }

        return view('admin.currencies.index');
    }


    // Show the form to create a new currency
    public function create()
    {
        return view('admin.currencies.create');
    }

    // Store a new currency
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        Currency::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'note' => $request->note,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('currencies.index',['user_id' => auth()->id()])->with('success', 'Currency created successfully!');
    }

    // Show the form to edit an existing currency
    public function edit($id)
    {
        $currency = Currency::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('admin.currencies.edit', compact('currency'));
    }

    // Update an existing currency
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $currency = Currency::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $currency->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'note' => $request->note,
        ]);

        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully!');
    }

    // Delete a currency
    public function destroy($id)
    {
        $currency = Currency::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $currency->delete();

        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully!');
    }
}
