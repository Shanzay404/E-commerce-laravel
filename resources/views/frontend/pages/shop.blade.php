@extends('frontend.layout')


@section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('redirect')}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">


        <div class="container">
            {{-- @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="text-dark">{{session()->get('success')}}.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif --}}

            {{-- {!! app('toastr')->render() !!} --}}
            <div class="row">
                {{-- shop sidebar starts --}}

                @include('frontend.includes.shop-sidebar')

                {{-- shop sidebar ends --}}

                {{-- shop products starts --}}
                @include('frontend.includes.shop-products')
                {{-- shop products  ends --}}



            </div>
        </div>
    </section>
    <!-- Shop Section End -->


    @endsection
