

@extends('admin.layout')
@section('content')

<style>
     label.required:after {
      content:" *";
      color: red;
    }
    footer{
        position: relative !important;
        bottom: -84px !important;
    }
</style>
    <div class="content-wrapper d-flex flex-column justify-content-center align-items-center  py-0">
        <h2 class="my-5">Update Product</h2>
        <div class="container category-container d-flex justify-content-center align-items-center">

            <form action="{{route('admin.updateProduct', $product->id)}}" method="POST" enctype="multipart/form-data" class="w-100">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="title" class="required">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$product->product_title}}" {{old('title')}} placeholder="Enter Product Title">
                            <small class="text-warning">@error('title') {{$message}} @enderror</small>
                          </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="quantity" class="required">Quantity</label>
                           <input type="number" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}" {{old('quantity')}}placeholder="Enter Product Quantity" >
                           <small class="text-warning">@error('quantity') {{$message}} @enderror</small>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="price" class="required">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" {{old('price')}} placeholder="Enter Product Price" >
                            <small class="text-warning">@error('price') {{$message}} @enderror</small>
                          </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="discount">Discount <span style="font-weight: 400 !important;">(optional)</span></label>
                           <input type="number" class="form-control" id="discount" name="discount" value="{{$product->discount_price}}" {{old('discount')}} placeholder="Enter Product Discount" >
                           <small class="text-warning">@error('discount') {{$message}} @enderror</small>
                          </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="category" class="required">Category</label>
                            <select class="form-control" id="category" name="category">
                                @foreach($category_names as $category)
                                @if($category->category_id === $product->category_id )
                                    {{$selected = "selected"}};

                                    @else
                                    {{$selected = ""}};

                                @endif
                                <option value="{{$category->id}}" $selected >{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <small class="text-warning">@error('category') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="image" class="required">Image</label>
                            <br>

                            <input type="file" id="new-product-image" name="image" class="form-control" onchange="previewNewImage(event)" {{old('image')}}>

                            <img id="product-image-preview"
                                src="{{ file_exists(public_path('upload_product_images/' . $product->product_image))
                                    ? asset('upload_product_images/' . $product->product_image)
                                    : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjf8KEchalHXDschnJIH0wZGSC9iM5BuSLZQ&s' }}"
                            alt="Product Image"
                            style="height:100px; width:150px; margin-top:15px;" >

                            <small class="text-warning">@error('image') {{$message}} @enderror</small>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description" class="required">Description</label>
                            {{-- <textarea class="form-control" id="description" name="description" rows="3">{{$product->product_description}}</textarea> --}}
                            <textarea class="summernote" name="description">{{$product->product_description}}</textarea>
                            {{-- <textarea name="content" id="editor">
                                &lt;p&gt;This is some sample content.&lt;/p&gt;
                            </textarea> --}}
                            <small class="text-warning">@error('description') {{$message}} @enderror</small>
                          </div>
                    </div>
                </div>
                <div class="btn-box d-flex justify-content-end">

                    <input type="submit" value="Update" name="Add-Product" class="" style=" border: 1px solid #ced4da; display: block; margin: 10px 0;background: #343a40; color:#fff; border-radius: 4px; padding: 10px 30px; font-size: 1.1rem; font-weight:700;">
                </div>
              </form>
        </div>
    </div>

@endsection

<script>
    function previewNewImage(event) {
        const file = event.target.files[0];
        if (file) {
            // Create a temporary URL for the selected file and update the image preview
            document.getElementById('product-image-preview').src = URL.createObjectURL(file);
        }
    }
</script>
<script>
   ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
