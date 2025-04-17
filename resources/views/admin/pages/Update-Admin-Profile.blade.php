

@extends('admin.layout')
@section('content')
<style>
    label.required:after {
      content:" *";
      color: red;
    }
</style>

    <div class="content-wrapper d-flex flex-column justify-content-start align-items-center  py-0">
        <h2 class="my-5 mb-4">Edit Profile</h2>
        <div class="container category-container d-flex justify-content-center align-items-center">

            <form action="{{route('admin.UpdateAdmin', $user->id)}}" method="POST" enctype="multipart/form-data" class="w-100">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="name" class="required">Name</label>
                            <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                            <small class="text-warning">@error('name') {{$message}} @enderror</small>
                          </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="email" class="required">Email</label>
                           <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email">
                           <small class="text-warning">@error('email') {{$message}} @enderror</small>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="phone" class="required">Phone Number</label>
                            <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" value="{{$user->phone}}">
                            <small class="text-warning">@error('phoneNumber'){{$message}} @enderror</small>
                          </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="address" class="required">Address</label>
                           <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
                           <small class="text-warning">@error('address') {{$message}} @enderror</small>
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
