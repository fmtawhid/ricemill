<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;
use Validator;

class PermissionController extends Controller
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
    //         'permission:permission_view' => ['index'],
    //         'permission:permission_add' => ['create', 'store'],
    //         'permission:permission_edit' => ['edit', 'update'],
    //         'permission:permission_delete' => ['destroy'],
    //     ];
    // }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Permission::select('id', 'name', 'created_at'))
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('permissions.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('permissions.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('auth.permissions.index');
    }

    public function create(Request $request)
    {
        return view('auth.permissions.create');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Permission::create(['name' => $request->name]);
        return response()->json(['success' => 'Permission Added Successfully']);
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('auth.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);

        return response()->json(['success' => 'Permission Updated Successfully']);
    }


    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json(['success' => 'Permission Deleted Successfully']);
    }

}
