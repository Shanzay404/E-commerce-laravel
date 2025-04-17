

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
    width: 100%;
}
div.category-container input[type=submit]{
    border: none;
    text-align: center;
    /* display: block; */
    padding: 10px !important;
    background: #000000;
    border-radius: 1px;
}
</style>

    <div class="content-wrapper d-flex flex-column justify-content-center align-items-center">
        <h2 class="mb-4">Add</h2>
        <div class="container category-container d-flex justify-content-center align-items-center">
            <form action="{{url('permissions')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9 col-sm-6 col-12">
                        <input type="text" name="name" id="name" placeholder="Permission Name">
                        <small class="text-danger">@error('name') {{$message}} @enderror</small>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <input type="submit" value="Create">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection




