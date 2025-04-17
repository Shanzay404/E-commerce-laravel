<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/style.css" type="text/css">
</head>

<body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>


        <!-- Header Section Begin -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="header__logo">
                            <a href="{{route('homePage')}}"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="{{route('homePage')}}">Home</a></li>
                                <li><a href="{{route('home.shop')}}">Shop</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="./about.html">About Us</a></li>
                                        <li><a href="./shop-details.html">Shop Details</a></li>
                                        <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                        <li><a href="./checkout.html">Check Out</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./contact.html">Contacts</a></li>
                                @if (Route::has('login'))
                                    @auth
                                    {{-- <li> <a href="{{ route('logout') }}" class="text-sm text-gray-700 underline">Log Out</a> </li> --}}
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline text-danger">
                                        @csrf
                                        <input type="submit" value="Logout" class="text-danger" style="border: none; background: none; font-size: 1.2rem; font-weight: bold;">
                                    </form>
                                    @else
                                    <li> <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a> </li>
                                    <li><a href="{{ route('register') }}" class=" text-sm text-gray-700 underline">Register</a> </li>
                                    @endauth
                            @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="header__nav__option">
                            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                            <a href="#"><img src="img/icon/heart.png" alt=""></a>
                            <a href="{{route('home.show_cart')}}"><img src="img/icon/cart.png" alt=""> <span>$</span> &nbsp;&nbsp;&nbsp;<span class="price">Cart</span></a>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </header>
        <!-- Header Section End -->

