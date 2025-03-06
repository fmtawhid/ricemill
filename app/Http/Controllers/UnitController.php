<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use DataTables;

class UnitController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $units = Unit::latest()->get();
            return DataTables::of($units)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $edit_api = route('units.edit', $row);
                    $delete_api = route('units.destroy', $row);
                    $csrf = csrf_token();
                    return <<<HTML
                        <form method="POST" action="$delete_api" class="d-inline-block">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="$csrf">
                            <a href="$edit_api" class="btn btn-info btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    HTML;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.units.index');
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        Unit::create($request->all());
        return response()->json(['success' => 'Unit added successfully.']);
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return response()->json(['success' => 'Unit updated successfully.']);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return response()->json(['success' => 'Unit deleted successfully.']);
    }
}
