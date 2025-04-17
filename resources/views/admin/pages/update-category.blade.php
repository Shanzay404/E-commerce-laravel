

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
    display: block;
    margin: 10px auto;
    background: #000000;
    border-radius: 1px;
}
</style>

<div class="content-wrapper d-flex flex-column justify-content-center align-items-center">
    <h2 class="mb-4">Update Category</h2>
        <div class="container category-container d-flex justify-content-center align-items-center">
            <form action="{{route('admin.updateCategory', $category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="category_name" id="category_name" placeholder="Category Name" value="{{$category->category_name}}">
                <small class="text-danger">@error('category_name') {{$message}} @enderror</small>
                <br>
                <input type="file" class="mt-2" name="update_category_image" id="category-image"
                onchange="previewNewImage(event)" {{old('image')}}>

                <img id="category-image-preview" class="my-3"
                src="{{ file_exists(public_path('upload_category_images/' . $category->category_image))
                    ? asset('upload_category_images/' . $category->category_image)
                    : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjf8KEchalHXDschnJIH0wZGSC9iM5BuSLZQ&s' }}"
                alt="Category Image"
                style="height:100px; width:150px; margin-top:15px;">

                <small class="text-danger">@error('category_image') {{$message}} @enderror</small>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>

@endsection

<script>
    function previewNewImage(event) {
        const file = event.target.files[0];
        if (file) {
            // Create a temporary URL for the selected file and update the image preview
            document.getElementById('category-image-preview').src = URL.createObjectURL(file);
        }
    }
</script>
