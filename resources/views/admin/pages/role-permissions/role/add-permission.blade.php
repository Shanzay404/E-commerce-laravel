

@extends('admin.layout')
@section('content')
<style>
    div.category-container input{
    padding: 9px 25px !important;
    border: 2px #a9a9a9 transparent;
    background: #454d55;
    /* background: #808080 transparent; */
    color: #ffff;
    box-shadow: none;
    outline: none;
    font-size: 1.2rem;
    font-weight: 700;
}
div.category-container input[type=submit]{
    border: none;
    text-align: center;
    /* display: block; */
    padding: 8px !important;
    background: #000000;
    border-radius: 1px;
    width: 20%;
    margin-top: 25px;
    margin-left: auto;
}
</style>

    <div class="content-wrapper d-flex flex-column justify-content-center align-items-center">
        <h2 class="mb-4">Role: {{ $role->name }}</h2>
        <div class="container category-container d-flex justify-content-center align-items-center px-3" style="width:70%;">
            <form action="{{url('roles/'.$role->id.'/add-permission-to-role')}}" method="POST">
                @method("PUT")
                @csrf
                <h3 class="mb-3">Permissions</h3>
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="form-check col-md-3 col-sm-6 col-12">
                            <input 
                            id="flexCheckDefault"
                            class="form-check-input" 
                            name="permission[]" 
                            type="checkbox" 
                            value="{{ $permission->name }}" 
                            {{ in_array($permission->id, $rolePermissions) ? "checked" : ""}}
                            >
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $permission->name }}
                            </label>
                        </div>
                        <small class="text-danger">@error('permission') {{$message}} @enderror</small>
                        @endforeach
                <input type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>

@endsection




