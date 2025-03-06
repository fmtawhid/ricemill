<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    //         'permission:user_view' => ['index'],
    //         'permission:user_add' => ['create', 'store'],
    //         'permission:user_edit' => ['edit', 'update'],
    //         'permission:user_delete' => ['destroy'],
    //     ];
    // }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles')->latest()->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('roles', function ($row) {
                    // ইউজারের রোলের নাম গুলো কমা (,) দিয়ে দেখানো হবে
                    return $row->roles->pluck('name')->implode(', ');
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('users.destroy', $row);
                    $edit_api = route('users.edit', $row);
                    $csrf = csrf_token();
                    return <<<HTML
                    <form method='POST' action='$delete_api' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>
                        <a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit user details'>
                            <i class="ri-edit-box-fill"></i>
                        </a>
                        <button type='submit' class='btn delete btn-danger btn-sm m-1'>
                            <i class="ri-delete-bin-fill"></i>
                        </button>
                    </form>
                    HTML;
                })
                ->rawColumns(['created_at_read', 'roles', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }



    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a new user with roles.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        // 'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
    ]);

    if ($validator->fails()) {
        return redirect()->route('users.create')->withErrors($validator)->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Convert role IDs to role names
    $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

    // Assign roles to user
    $user->syncRoles($roleNames);

    return redirect()->route('users.index')->with('success', 'User created successfully with roles.');
}


    /**
     * Show the form to edit an existing user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update an existing user with roles.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            // 'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Convert role IDs to role names
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Assign roles to user
        $user->syncRoles($roleNames);

        return redirect()->route('users.index')->with('success', 'User updated successfully with new roles!');
    }


    /**
     * Delete an existing user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
