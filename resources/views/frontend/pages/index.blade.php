

    @extends('frontend.layout')

    @section('content')



            <!-- Hero Section Begin -->
            @include('frontend.includes.home-slider')
            <!-- Hero Section End -->

            <!-- Banner Section Begin -->
            @include('frontend.includes.banner')
            <!-- Banner Section End -->

            <!-- Product Section Begin -->
            @include('frontend.includes.products')
            <!-- Product Section End -->

            <!-- Categories Section Begin -->
            @include('frontend.includes.category')
            <!-- Categories Section End -->

            <!-- Instagram promotion Section Begin -->
            @include('frontend.includes.insta-promotion')
            <!-- Instagram promotion Section End -->

            <!-- Latest news blog Section Begin -->
            @include('frontend.includes.latest-news')
            <!-- Latest news blog Section End -->


    @endsection
