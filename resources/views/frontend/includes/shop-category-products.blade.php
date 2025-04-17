<div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="my-4 text-center" style="font-size: 700;">Category: {{$category->category_name}}</h3>

                    <div class="row">

                        @foreach ($products as $product)


                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="/upload_product_images/{{$product->product_image}}">
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
                                    <h5>${{$product->price - (($product->discount_price * $product->price)/100)}}</h5>

                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{$products->links()}}
                        </div>
                        <div class="col-12">
                            {{-- {{$products->currentPage()}} --}}
                        </div>
                    </div>
                </div>
