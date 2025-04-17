<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Update Permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Permission', ['only' => ['destroy']]);
    }
 
    public function index()
    {
        $permissions = Permission::latest()->get();
        return view('admin.pages.role-permissions.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.role-permissions.permission.add-permission');
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
                'unique:permissions,name'
            ],
        ]);

        Permission::create([
            'name' => $request->name,
        ]);
        toastr()->success('Permission Added Successfully!', ['timeOut'=>6000]);
        return redirect()->route('permissions.index');
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
        $permission=Permission::find($id);
        return view('admin.pages.role-permissions.permission.edit-permission', compact('permission'));
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
                'unique:permissions,name,' . $id
            ],
        ]);

        $permission = Permission::where('id', $id)->update(['name' => $request->name]);
        toastr()->success('Permission Updated Successfully!', ['timeOut'=>6000]);
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        toastr()->success('Permission Deleted Successfully!', ['timeOut'=>6000]);
        return redirect()->route('permissions.index');


    }
}
