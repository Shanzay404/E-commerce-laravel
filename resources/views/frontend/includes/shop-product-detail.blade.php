   <section class="shop-details product-details">
        <div class="product__details__pic">
            <div class="container">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="text-dark">Success! {{session()->get('success')}}.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif


                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="/upload_product_images/{{$product->product_image}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-2.png">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-3.png">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-4.png">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="/upload_product_images/{{$product->product_image}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$product->product_title}}  <span class="text-info" style="font-weight: 700; font-size: 15px;">
                                @if($product->discount_price != NULL)
                                    {{$product->discount_price}}% discount
                                @endif
                            </span>

                            </h4>


                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>${{$product->price - (($product->discount_price * $product->price)/100)}} <span> {{$product->discount_price ? "$".$product->price : ""}} </span></h3>
                            <p>{{$product->product_description}}</p>

                            <div class="product__details__cart__option">

                            <form action="{{route('home.add_cart', encrypt($product->id))}}" method="post">
                                @csrf
                                    <div class="quantity">
                                        <input type="number" value="1" min="1" name="quantity"  max="{{$product->quantity}}"  class="px-3 py-2">
                                    </div>
                                    <input type="submit"  value="add to cart" class="primary-btn" >
                            </form>



                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>Product Id:</span> {{Hash::make($product->id)}}</li>
                                    <li><span>Categories:</span> {{$product->category->category_name}}</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
