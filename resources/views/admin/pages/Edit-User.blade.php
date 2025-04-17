@extends('admin.layout')
@section('content')

<style>
    label.required:after {
      content:" *";
      color: red;
    }
  </style>

<div class="content-wrapper d-flex flex-column justify-content-center align-items-center">
    <h2 class="my-5">Edit</h2>
    <div class="container category-container d-flex justify-content-center align-items-center">
        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST" class="w-100">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name" class="required">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter Your name">
                        <small class="text-danger">@error('name') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="email" class="required">email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter Your email">
                        <small class="text-danger">@error('email') {{ $message }} @enderror</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="phone" class="required">phone Number</label>
                        <input type="number" class="form-control" id="phone" name="phoneNumber" value="{{ $user->phone }}" placeholder="Enter Contact Number">
                        <small class="text-danger">@error('phoneNumber') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="address" class="required">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" placeholder="Enter Your address">
                        <small class="text-danger">@error('address') {{ $message }} @enderror</small>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="password" class="required">Password</label>
                        <input type="text" class="form-control" id="password" name="password"  placeholder="Enter Password ">
                        <small class="text-danger">@error('password') {{ $message }} @enderror</small>
                    </div>
                </div> --}}
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="role" class="required">Roles</label>
                        <select class="form-control" id="role" name="roles[]" multiple>
                            <option value="0" disabled>Select Role</option>
                            @foreach($roles as $role)
                                <option 
                                    value="{{ $role }}"
                                    {{ in_array($role, $userRoles) ? "selected" : " " }}
                                    >
                                    {{ $role }}
                                </option>

                            @endforeach
                        </select>
                        <small class="text-danger">@error('roles') {{ $message }} @enderror</small>
                    </div>
                </div>
            </div>
            <div class="btn-box d-flex justify-content-end">
                <input type="submit" value="Update" name="createUser" class="btn btn-dark" style=" border: 1px solid #ced4da; display: block; margin: 10px 0;background: #343a40; color:#fff; border-radius: 4px; padding: 10px 30px; font-size: 1.1rem; font-weight:700;">
            </div>
        </form>
    </div>
</div>


@endsection
