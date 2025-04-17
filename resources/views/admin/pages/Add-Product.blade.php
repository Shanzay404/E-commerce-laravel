@extends('admin.layout')
@section('content')

<style>
    label.required:after {
      content:" *";
      color: red;
    }
    #image-preview img{
        height: 100px !important;
    }
  </style>
<!-- jQuery -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<!-- Bootstrap Bundle JS (includes Popper.js) -->
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}

<!-- Summernote JS -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script> --}}

<!-- Summernote CSS -->
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet"> --}}

<!-- Bootstrap CSS -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}


<div class="content-wrapper d-flex flex-column justify-content-center align-items-center">
    <h2 class="my-5">Add a Product</h2>
    <div class="container category-container d-flex justify-content-center align-items-center">
        <form action="{{ route('admin.addProduct') }}" method="POST" enctype="multipart/form-data" class="w-100">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="title" class="required">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter Product Title">
                        <small class="text-danger">@error('title') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="quantity" class="required">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Enter Product Quantity">
                        <small class="text-danger">@error('quantity') {{ $message }} @enderror</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="price" class="required">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Enter Product Price">
                        <small class="text-danger">@error('price') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="discount">Discount (Optional)</label>
                        <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}" placeholder="Enter Product Discount">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="category" class="required">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="0" disabled selected>Select Category</option>
                            @foreach($category_names as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('category') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="image" class="required">Image</label>
                        <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                        <div id="image-preview" class="mt-2"></div>
                        <small class="text-danger">@error('image') {{ $message }} @enderror</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    {{-- <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea class="form-control summernote" id="description" name="description">{{ old('description') }}</textarea>
                        <small class="text-danger">@error('description') {{ $message }} @enderror</small>
                    </div> --}}
                    <div class="form-group">

                        <label class="required"><strong>Description</strong></label>

                        <textarea class="summernote" name="description">{{ old('description') }}</textarea>
                        <small class="text-danger">@error('description') {{ $message }} @enderror</small>
                    </div>
                </div>
            </div>

            <div class="btn-box d-flex justify-content-end">
                <input type="submit" value="Create" name="Add-Product" class="btn btn-dark" style=" border: 1px solid #ced4da; display: block; margin: 10px 0;background: #343a40; color:#fff; border-radius: 4px; padding: 10px 30px; font-size: 1.1rem; font-weight:700;">
            </div>
        </form>
    </div>
</div>


<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.innerHTML = ''; // Clear previous image

        const file = event.target.files[0];
        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = 'Selected Image Preview';
            img.style.maxWidth = '100px';
            img.style.height = '100px';
            img.style.marginTop = '10px';
            imagePreview.appendChild(img);
        }
    }
</script>

@endsection
