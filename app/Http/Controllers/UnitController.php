<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
class UnitController extends Controller
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
    //         'permission:unit_view' => ['index'],
    //         'permission:unit_add' => ['create', 'store'],
    //         'permission:unit_edit' => ['edit', 'update'],
    //         'permission:unit_delete' => ['destroy'],
    //     ];
    // }

    // Display a list of all units
    public function index(Request $request)
{
    if ($request->ajax()) {
        // Include the 'created_at' column
        $units = Unit::select(['id', 'name', 'note', 'user_id', 'created_at'])
            ->where('user_id', auth()->id()); // Filter by user_id

        return DataTables::of($units)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '
                    <a href="' . route('units.edit', ['unit' => $row->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                    <form action="' . route('units.destroy', ['unit' => $row->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['actions']) // Enable raw HTML rendering for the actions column
            ->make(true);
    }

    return view('admin.units.index');
}


    // Show the form to create a new unit
    public function create()
    {
        $categories = Category::all(); // If you need categories or other related data
        return view('admin.units.create', compact('categories'));
    }

    // Store a new unit
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        // Create a new unit
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->note = $request->note;
        $unit->user_id = auth()->id(); // Assign the logged-in user ID
        $unit->save();

        return redirect()->route('units.index', ['user_id' => auth()->id()] )->with('success', 'Unit created successfully!');
    }

    // Show the form to edit an existing unit
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        
        if ($unit->user_id !== auth()->id()) {
            return redirect()->route('units.index')->with('error', 'Unauthorized');
        }

        return view('admin.units.edit', compact('unit'));
    }

    // Update an existing unit
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        $unit = Unit::findOrFail($id);

        // Ensure the logged-in user owns this unit
        if ($unit->user_id !== auth()->id()) {
            return redirect()->route('units.index')->with('error', 'Unauthorized');
        }

        $unit->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    // Delete a unit
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);

        // Ensure the logged-in user owns this unit
        if ($unit->user_id !== auth()->id()) {
            return redirect()->route('units.index')->with('error', 'Unauthorized');
        }

        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }
}
