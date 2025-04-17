@extends('frontend.layout')

@section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('redirect')}}">Home</a>
                            <a href="{{route('home.shop')}}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>


                            @if(count($cart) > 0)

                                @foreach($cart as $cart_item)

                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            {{-- <img src="/upload_product_images/{{$cart_item->attributes->get('product_img')}}" alt="" class="img-fluid" style="width: 160px; height:100px;"> --}}
                                            <img src="{{file_exists(public_path('upload_product_images/'.$cart_item->attributes->get("product_img")))
                                        ? asset('upload_product_images/' . $cart_item->attributes->get("product_img"))
                                        : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjf8KEchalHXDschnJIH0wZGSC9iM5BuSLZQ&s' }}" class="img-fluid" style="width: 160px; height:100px;">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h4>{{$cart_item->name }}</h4>
                                            <h5 class="my-2">Quantity: {{$cart_item->quantity }}</h5>
                                            <h5>Price:
                                                ${{(float) $cart_item->product->price- (((float)$cart_item->product->discount_price * (float)$cart_item->product->price) / 100)}}
                                            </h5>
                                        </div>
                                    </td>

                                    <td>


                                        @php
                                            $TotalPrice = ((float)$cart_item->product->price - (((float)$cart_item->product->discount_price * (float)$cart_item->product->price) / 100)) * (float)$cart_item->quantity;
                                        @endphp

                                    <form action="{{route('home.update_cart', $cart_item->id)}}" method="post" class="mt-3">
                                        @csrf
                                        @method('PUT')
                                            <div class="quantity d-inline-block" style="display: inline-block !important;">
                                                <input type="number" value="{{$cart_item->quantity}}" min="1" name="cart_item_quantity"  max="{{ $cart_item->product->quantity}}">
                                                <input type="hidden" name="cart_item_id" value="{{$cart_item->id}}">
                                                <input type="hidden" name="cart_item_price" value="{{$cart_item->price}}">
                                                <input type="hidden" name="inp_total_price" id="" value="{{$TotalPrice}}">
                                                <input type="submit"  value="Update" name="update_cart" class="mt-2 primary-btn py-1 px-2 d-inline-block" style="display: inline-block !important; font-size:12px;">
                                            </div>
                                    </form>
                                </td>

                                {{-- @php
                                    $TotalPrice = ($cart_item->product->price- (($cart_item->product->discount_price *      $cart_item->product->price) / 100)) * $cart_item->quantity
                                @endphp --}}

                                    <td class="cart__price">${{$TotalPrice}}</td>



                                    <td>
                                        <div class="d-inline">

                                            <form id="deleteForm{{$cart_item->id}}" action="{{route('home.remove_cart', $cart_item->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="showDeleteModal({{$cart_item->id}})" style="border: none;" class="p-1 px-2"><i class='fa fa-close'></i></button>
                                            </form>
                                        </div>
                                    </td>




                                </tr>

                                @endforeach

                            @else
                                <tr>
                                    <td colspan="4">
                                        <h5>Your cart is empty.</h5>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="continue__btn">
                                <a href="{{route('home.shop')}}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Sub Total  <span>${{$subTotal}}</span></li>
                            <li>Total  <span>${{$subTotal}}</span></li>
                        </ul>
                        <a href="{{route('home.checkout')}}" class="primary-btn">Proceed to Checkout</a>
                        {{-- <a href="{{route('home.cash_order')}}" class="primary-btn">Cash On Delivery</a> --}}
                        {{-- <a href="#" class="primary-btn mt-2">Payment Through Card</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->









    @if(count($cart) > 0)



        <!-- Bootstrap Modal for delete Category Confirmation -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Are you sure you want to delete {{$cart_item->name }}? This action cannot be undone.
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
            </div>
        </div>


    <script>
    function showDeleteModal(cartId) {
        // Show the modal
        $('#deleteModal').modal('show');

        // When the delete button in the modal is clicked, submit the form
        document.getElementById('confirmDeleteButton').onclick = function () {
            document.getElementById('deleteForm' + cartId).submit();
        };
    }
    </script>


@endif
    @endsection
