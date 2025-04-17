
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 py-3 mb-2">
                <h2 class="text-center">New Products</h2>
            </div>
        </div>
        <div class="row product__filter">
        {{-- @if ($products->isNotEmpty())
            @foreach ($products as $product)


            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="/upload_product_images/{{$product->product_image}}">
                    </div>
                    <div class="product__item__text">
                        <h6>{{$product->product_title}}</h6>
                        @php
                            // $actualPrice = $product->price - (($product->discount_price*$product->price)/100);
                            $actualPrice = (float)$product->price - ((float)$product->discount_price * (float)$product->price / 100);
                        @endphp
                        <h5 class="mt-3">${{$actualPrice}}</h5>
                        <a href="{{route('home.product', encrypt($product->id))}}">More Details</a>
                        <form action="{{route('home.add_cart', encrypt($product->id))}}" method="post" class="mt-3">
                            @csrf
                                <div class="quantity d-inline-block" style="display: inline-block !important;">
                                    <input type="number" value="1" min="1" name="quantity"  max="{{$product->quantity}}"  >
                                </div>
                                <input type="submit"  value="add to cart" class="primary-btn py-1 px-2 d-inline-block" style="display: inline-block !important;">
                        </form>

                    </div>
                </div>
            </div>

             @endforeach
        @else
            <p>No Products Available</p>
        @endif --}}


        </div>
    </div>
</section>
