

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
        <h2 class="mb-4">Add Category</h2>
        <div class="container category-container d-flex justify-content-center align-items-center">
            <form action="{{route('admin.addCategory')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="category_name" id="category_name" placeholder="Category Name" value="{{old('category_name')}}">
                <small class="text-danger">@error('category_name') {{$message}} @enderror</small>
                <br>
                <input type="file" class="mt-2" name="category_image" id="category-image" onchange="previewImage(event)">
                <div id="image-preview" class="mt-2"></div>

                <small class="text-danger">@error('category_image') {{$message}} @enderror</small>
                <input type="submit" value="Create">
            </form>
        </div>
    </div>

@endsection



<script>
    function previewImage(event) {
        // Clear any previous preview
        document.getElementById('image-preview').innerHTML = '';

        // Get the selected file
        const file = event.target.files[0];
        if (file) {
            // Create an image element
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);  // Create a temporary URL for the image
            img.alt = "Selected Image Preview";
            img.style.maxWidth = "100px";  
            img.style.maxHeight = "100px";  
            img.style.marginTop = "10px";  

            // Append the image to the preview div
            document.getElementById('image-preview').appendChild(img);
        }
    }
</script>
