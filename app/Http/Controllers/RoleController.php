<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Edit Role', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete-Role', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles = Role::latest()->get();
        return view('admin.pages.role-permissions.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.role-permissions.role.add-role');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ],
        ]);

        Role::create([
            'name' => $request->name,
        ]);
        toastr()->success('Role Added Successfully!', ['timeOut'=>6000]);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::find($id);
        return view('admin.pages.role-permissions.role.edit-role', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $id
            ],
        ]);

        $role = Role::where('id', $id)->update(['name' => $request->name]);
        toastr()->success('Role Updated Successfully!', ['timeOut'=>6000]);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        toastr()->success('Role Deleted Successfully!', ['timeOut'=>6000]);
        return redirect()->route('roles.index');


    }

    // givePermissionToRole

    public function givePermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::find($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                        ->where('role_has_permissions.role_id', $roleId)
                        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                        ->all();
        return view('admin.pages.role-permissions.role.add-permission', 
                compact(
                    'role', 
                    'permissions',
                    'rolePermissions'
                ));

    }
    // AddPermissionToRole

    public function addPermissionToRole(Request $request, $roleId)
    {

        // dd($request->all());
        $request->validate([
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        toastr()->success('Permissions Added to role.', ['timeOut'=>6000]);
        return redirect()->route('roles.index');

    }
}
