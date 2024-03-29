@php
    $setting = App\Models\Setting::orderBy('created_at', 'desc')
        ->select('site', 'image', 'logo', 'favicon', 'description')
        ->first();
@endphp
@php
    $genres = App\Models\Genre::orderBy('created_at', 'desc')->pluck('title');
@endphp


  <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-xl-2">
                    <h1 class="mb-0 site-logo"><a href="/"><img src="{{ asset("storage/$setting->logo") }}" alt="" class="img-fluid"
                        style="width:150px;" /><span class="text-primary">.</span> </a></h1>

                </div>

                <div class="col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li><a href="/" class="nav-link">Home</a></li>
                            <li><a href="{{ url('beatz') }}" class="nav-link">Beatz</a></li>
                            
                            <li class="has-children">
                                <a href="#account" class="nav-link">Categories</a>
                                <ul class="dropdown">
                                    @foreach ($genres as $genre)
                                    <li><a class="nav-link" href="{{ route('songs-by-genre', urlencode($genre)) }}">{{ $genre }}
                                    </a></li>
                                @endforeach
                                </ul>
                            </li>
                      
                            <li class="has-children">
                                @if (Auth::check())
                                <a href="#account" class="nav-link">{{ Auth::user()->name }}</a>
                               @else
                                <a href="#account" class="nav-link">Account</a>
                                @endif
                                <ul class="dropdown">
                                    @if (Auth::check())
                                  
                                      @if(Auth::user()->upload_status == 1)
                                       <li><a class="nav-link" href="{{ url('/admin/music/create') }}"><i class="icon-upload"></i> Upload Music</a></li>
                                       <li><a class="nav-link" href="{{ url('/admin/beats/create') }}"><i class="icon-upload"></i> Upload Beat</a></li>
                                       <!--{{-- <li><a class="nav-link" href="{{ url('/sales') }}"><i class="icon-account_balance_wallet"></i> Wallet</a></li> --}}-->
                                       @endif
                                       <li><a class="nav-link" href="{{ url('/purchased-musics') }}"><i class="icon-download"></i> Downloads</a></li>
                                       <li><a class="nav-link" href="{{ url('/top-up') }}"><i class="fa fa-cart-plus"></i> Account <span class="badge bg-danger">!</span></a></li>
  
                                       <li><a class="nav-link" href="{{ url('edit-profile') }}"><i class="icon-user"></i> Profile</a></li>
                                       <li><a class="nav-link" href="{{ route('log') }}"><i class="icon-paypal"></i> Paypal History</a></li>
                                       <li><a class="nav-link" href="{{ url('/admin') }}"><i class="icon-dashboard"></i> Dashboard</a></li>
                                    @else
                                    <li><a href="" data-toggle="modal" data-target="#exampleModal">Login</a></li>
                                    @endif
                                    {{-- <li class="has-children">
                                        <a href="#">More Links</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Menu One</a></li>
                                            <li><a href="#">Menu Two</a></li>
                                            <li><a href="#">Menu Three</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </li>
                            @auth
                           
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                        <li><a href="" data-toggle="modal" data-target="#exampleModal">Login</a></li>
                        <li><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        @endauth

                            
                            <li><a href="{{ route('about') }}" class="nav-link">About Us</a></li>
                            <li class="social"><a href="#" class="nav-link" onclick="toggleMode(); return false;">
                                <span id="iconMode" class="icon-brightness_high"></span></a></li>

                            <li class="social"><a href="https://www.facebook.com/elliot.gog" target="_blank" class="nav-link"><span
                                        class="icon-facebook"></span></a></li>
                            <li class="social"><a href="https://twitter.com/Molefi18186414" target="_blank" class="nav-link"><span
                                        class="icon-twitter"></span></a></li>
                            <li class="social"><a href="mailto:molefigw@gmail.com" target="_blank" class="nav-link"><span
                                        class="icon-mail_outline"></span></a></li>
                        </ul>
                    </nav>
                </div>


                <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a
                        href="#" class="site-menu-toggle js-menu-toggle float-right"><span
                            class="icon-menu h3"></span></a></div>

            </div>
        </div>

    </header>
    <div class="hero">
        <div class="search text-center">
            {{-- <a class="btn btn-secondary" href="#notice" id="infoIcon"><i class="icon-info-circle"></i></a> --}}
            {{-- <form action="">
                <div class="input-group">
                    <input type="text" id="indexSearch" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}

            <div class="input-group">
                {{-- <input  class="form-control" type="text" id="search" placeholder="Type to search">
                <button class="btn btn-secondary" type="submit">
                    <i class="icon-search"></i>
                </button> --}}
                <i class="icon-search" id="searchIcon" style="cursor: pointer;"></i>
            </div>
        
            <!-- Modal for displaying search results -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- Adjust the size as needed -->
                    <div class="modal-content">
                        <div class="modal-header">
                 
                            <input  class="form-control" type="text" id="search" placeholder="Type to search" autocomplete="off">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group bg-transparent text-primary" id="results"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>