

@extends('admin.layout')
@section('content')

<style>
    label.required:after {
      content:" *";
      color: red;
    }
</style>
    <div class="content-wrapper d-flex flex-column justify-content-start align-items-center  py-0">
        <h2 class="my-5 mb-4">Change Password</h2>
        <div class="container category-container d-flex justify-content-center align-items-center w-50">

            <form action="{{route('admin.UpdatePassword', Auth()->user()->id)}}" method="POST" enctype="multipart/form-data" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="newPassword" class="required">New Password</label>
                           <input type="text" class="form-control" id="password" placeholder="Enter New Password" name="password" {{old('password')}}>
                           <small class="text-warning">@error('password') *{{$message}} @enderror</small>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="password_confirmation" class="required">Confirm Password</label>
                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password Again" {{old('confirm_password')}}>
                            <small class="text-warning">@error('confirm_Password') *{{$message}} @enderror</small>
                          </div>
                    </div>
                </div>

                <div class="btn-box d-flex justify-content-end">
                    <input type="submit" value="Update" name="Update" class="" style=" border: 1px solid #ced4da; display: block; margin: 10px 0;background: #343a40; color:#fff; border-radius: 4px; padding: 10px 30px; font-size: 1.1rem; font-weight:700;">
                </div>
              </form>
        </div>
    </div>

@endsection
