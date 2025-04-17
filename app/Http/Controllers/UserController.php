<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;




class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Create-User', ['only'=> ['addUser','storeUser']]);
        $this->middleware('permission:Update-User', ['only'=> ['editUser','updateUser']]);
        $this->middleware('permission:Delete-User', ['only'=> ['destroyUser']]);
    }

    // ######################################## User page coding ########################################

    
    public function viewUsers()
    {
        $users = User::get();
        return view('admin.pages.view-users', compact('users'));
    }
    public function addUser()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.pages.add-user', compact('roles'));
    }
    // store user
    public function storeUser(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|numeric|min_digits:9|max_digits:11',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:5|max:10',
            'roles' => 'required',
        ],[
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'phoneNumber.required' => 'Phone Number is Required',
            'address.required' => 'Address is Required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phoneNumber,
            // 'usertype' => $request->roles,
            'password' => Hash::make($request->password),
         ]);

        $user->syncRoles($request->roles);
        toastr()->success('User has been Added!', ['timeOut'=>6000]);
        return redirect()->route('admin.viewUsers');
    }

    // edit user 

    public function editUser($id){
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRoles=$user->roles->pluck('name','name')->all();
        return view('admin.pages.Edit-user', compact('user', 'roles','userRoles'));
    }

    public function updateUser(Request $request, $id)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email'.$id,
            'email' => [
                        'required',
                        'email',
                        Rule::unique('users', 'email')->ignore($id),
                    ],
            'phoneNumber' => 'required|numeric|min_digits:9|max_digits:11',
            'address' => 'required|string|max:255',
            'roles' => 'required',
        ],[
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'phoneNumber.required' => 'Phone Number is Required',
            'address.required' => 'Address is Required',
        ]);

        $user = User::find($id);
        $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phoneNumber,
            ]);

        $user->syncRoles($request->roles);
        toastr()->success('User has been Updated!', ['timeOut'=>6000]);
        return redirect()->route('admin.viewUsers');

    }



    public function destroyUser($id)
    {
        $user=User::findorFail($id);
        $user->delete();
        toastr()->success('User has been Deleted!', ['timeOut'=>6000]);
        return redirect()->route('admin.viewUsers');
    }

}
