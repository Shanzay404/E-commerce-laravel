 <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">

                @foreach ($relatedProducts as $product)


                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/upload_product_images/{{$product->product_image}}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="/img/icon/heart.png" alt=""></a></li>
                                <li><a href="{{route('home.product', Crypt::encrypt($product->id))}}"><img src="/img/icon/compare.png" alt=""> <span>Detail</span></a>
                                </li>
                                <li><a href="#"><img src="/img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product->product_title}}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>${{$product->price}}</h5>
                        </div>
                    </div>
                </div>


                @endforeach
            </div>
        </div>
    </section>
