<div class="col-lg-9">
                    {{-- <div class="shop__product__option">
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
                    </div> --}}
                    <h2 class="mb-5 text-center" style="font-weight: 600;">All Products</h2>
                    <div class="row">

                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        {{-- <div class="product__item__pic set-bg" data-setbg="/upload_product_images/{{$product->product_image}}"> --}}
                                        <div class="product__item__pic set-bg" data-setbg="{{ file_exists(public_path('upload_product_images/'.$product->product_image))
                                        ? asset('upload_product_images/' . $product->product_image)
                                        : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjf8KEchalHXDschnJIH0wZGSC9iM5BuSLZQ&s' }}">
                                            <ul class="product__hover">
                                                <li><a href="{{route('home.product', Crypt::encrypt($product->id))}}"><img src="/img/icon/compare.png" alt=""> <span>Detail</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6>{{$product->product_title}}</h6>
                                            <a href="{{route('home.product', encrypt($product->id))}}">More Details</a>

                                            <form action="{{route('home.add_cart', encrypt($product->id))}}" method="post" class="mt-3">
                                                @csrf
                                                    <div class="quantity d-inline-block" style="display: inline-block !important;">
                                                        <input type="number" value="1" min="1" name="quantity"  max="{{$product->quantity}}"  >
                                                    </div>
                                                    <input type="submit"  value="add to cart" class="primary-btn py-1 px-2 d-inline-block" style="display: inline-block !important;">
                                            </form>

                                            <div class="rating">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <h5>${{(float)$product->price - (((float)$product->discount_price * (float)$product->price)/100)}}</h5>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                           <p>No Products Available</p>
                        @endif


                        {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                                    <span class="label">Sale</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>Multi-pocket Chest Bag</h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>$43.48</h5>
                                    <div class="product__color__select">
                                        <label for="pc-7">
                                            <input type="radio" id="pc-7">
                                        </label>
                                        <label class="active black" for="pc-8">
                                            <input type="radio" id="pc-8">
                                        </label>
                                        <label class="grey" for="pc-9">
                                            <input type="radio" id="pc-9">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- pagination starts --}}
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- pagination ends --}}

                    <div class="row">
                        <div class="col-12">
                            {{$products->links()}}
                        </div>

                    </div>
                </div>
