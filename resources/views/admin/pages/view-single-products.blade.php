@extends('admin.layout')
<style>
    footer.main-footer{
        position: fixed !important;
    }
    h5 span{
        font-size: 16px !important;
        font-weight: 400;
    }
</style>

@section('content')


    <div class="content-wrapper d-flex flex-column justify-content-center align-items-center" style="top: 100px;
    position: relative;">
        <h2 class="mt-3 mb-5">Product Details</h2>
        <div class="container category-container d-flex justify-content-center align-items-center">

            <form class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"  @disabled(true) value="{{$product->product_title}}">
                          </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                           <input type="number" class="form-control" id="quantity" name="quantity" @disabled(true) value="{{$product->quantity}}">
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" @disabled(true) value="{{$product->price}}">
                          </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="discount">Discount <span style="font-weight: 400 !important;">(optional)</span></label>
                           <input class="form-control" id="discount" name="discount" @disabled(true) value="{{$product->discount_price ? $product->discount_price.'%' : "No Discount"}}">
                          </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" @disabled(true) value="{{$product->category->category_name}}">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <br>
                            <img src="{{ file_exists(public_path('upload_product_images/'.$product->product_image)) ? asset('upload_product_images/' . $product->product_image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjf8KEchalHXDschnJIH0wZGSC9iM5BuSLZQ&s'}}" alt="" width="150px">
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" @disabled(true) rows="7" cols="10" style="margin-bottom: 4rem;">{!! $product->product_description !!}</textarea>
                          </div>
                    </div>
                </div>
              </form>
        </div>
    </div>

@endsection
