





        <!---Side Menu Start--->
        <div class="ms_sidemenu_wrapper">
            <div class="ms_nav_close">
                <i class="icon-menu"></i>
            </div>
            <div class="ms_sidemenu_inner">
                <div class="ms_logo_inner">
                    <div class="ms_logo">
                        @if ($setting && $setting->favicon)
                        <a href="/"><img src="{{ \Storage::url($setting->favicon) }}" alt="" class="img-fluid"
                                style="width:74px; height:74px;" /></a>
                        @endif
                    </div>
                    <div class="ms_logo_open">
                        @if ($setting && $setting->logo)
                        <a href="/"><img src="{{ \Storage::url($setting->logo) }}" alt="" class="img-fluid"
                                style="width:150px;" /></a>
                        @endif
                    </div>
                </div>
                <div class="ms_nav_wrapper">
                    <ul>
                        <li><a href="/" class="active" title="Discover">
                                <span class="nav_icon">
                                    <span class="icon icon_discover"></span>
                                </span>
                                <span class="nav_text">
                                    discover
                                </span>
                            </a>
                        </li>
                        <li><a href="{{ url('songs') }}" title="genre">
                                <span class="nav_icon">
                                    <span class="icon icon_albums"></span>
                                </span>
                                <span class="nav_text">
                                    genre
                                </span>
                            </a>
                        </li>
                        <li><a href="artist.html" title="info">
                                <span class="nav_icon">
                                    <span class="icon icon_artists"></span>
                                </span>
                                <span class="nav_text">
                                    info
                                </span>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav_downloads">
                        @if (Route::has('login'))
                        @auth
                        <div>
                            <li>
                                <a href="{{ url('/top-up') }}" title="Dashboard">
                                    <span class="nav_icon">
                                        <span class="icon icon_purchased"></span>
                                    </span>
                                    <span class="nav_text">
                                        M &nbsp; {{ Auth::user()->balance }}
                                    </span>
                                </a>
                            </li>
                            <li><a href="{{ url('/purchased-musics') }}" class="active" title="Downloads">
                                    <span class="nav_icon">
                                        <span class="icon icon_download"></span>
                                    </span>
                                    <span class="nav_text">
                                        downloads
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin') }}" title="Dashboard">
                                    <span class="nav_icon">
                                        <span><i class="icon-dashboard"></i></span>
                                    </span>
                                    <span class="nav_text">
                                        dashboard
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                    <span class="nav_icon">
                                        <span><i class="icon-logout"></i></span>
                                    </span>
                                    <span class="nav_text">
                                        Logout
                                    </span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf

                                </form>

                            </li>


                            <div>
                                @else
                                <li><a href="{{route('register') }}" class="nav_text">
                                        <span class="nav_icon">
                                            <span><i class="icon-register"></i></span>
                                        </span>
                                        <span class="nav_text">
                                            Register
                                        </span></a>
                                    @if (Route::has('register'))
                                <li> <a href="{{route('login') }}" class="nav_text"> <span class="nav_icon">
                                            <span><i class="icon-login"></i></span>
                                        </span>
                                        <span class="nav_text">
                                            Login
                                        </span></a>
                                    @endif
                                    @endauth
                            </div>
                        </div>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
        <!---Main Content Start--->
        <div class="ms_content_wrapper">
            <!---Header--->
            <div class="ms_header">
                <div class="search-container">

                    <!-- <form>
                        <div class="ms_top_search">
                            <input type="text" id="indexSearch" name="search" value="{{ $search ?? '' }}"
                                class="form-control1" placeholder="Search.." required>
                            <button type="submit" class="search_button left">
                                <img src="{{ asset('frontend/images/svg/search.svg') }}" alt="">
                            </button>
                        </div>
                    </form> -->

                    <form>
                        <label id="icon" for="name"><i class="fas fa-search"></i></label>
                        <input type="text" id="indexSearch" name="search" value="{{ $search ?? '' }}"
                            placeholder="Search.." required>

                    </form>

                </div>

            </div>
            <br>
            <br>
            
            <hr>
            {{-- <div class="ms_upload_wrapper marger_top60">
                <div class="ms_upload_box">


                    <div class="search-container">

                    </div>
                    <div class="btn-group dropright">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Category <i class="fas fa-compact-disc"></i>
                        </button>
                        <div class="dropdown-menu">


                            <ul>
                                @foreach ($genres as $genre)
                                <li>
                                    <a href="{{ route('songs-by-genre', urlencode($genre)) }}">{{ $genre }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <div class="btn-group dropright">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Account <i class="far fa-user"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if (Route::has('login'))
                            @auth

                            <ul>
                                <li>
                                    <p class="ms_color">{{ Auth::user()->name }}</p>
                                </li>
                                <li>
                                    <a href="{{ url('/admin') }}" class="ms_color">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ url('/top-up') }}" class="text-dark" title="balance">
                                        M &nbsp; {{ Auth::user()->balance }} &nbsp; Balance
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/purchased-musics') }}" class="" title="Downloads">
                                        Downloads
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">


                                        Logout

                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf

                                    </form>

                                </li>
                                @else
                                <li>
                                    <a href="{{route('register') }}" class="text-dark" title="Register">sign up <i
                                            class="icon-register"></i></a>
                                </li>
                                @if (Route::has('register'))
                                <li>
                                    <a href="{{route('login') }}" class="" title="Login">sign in <i
                                            class="icon-login"></i></a>
                                </li>
                                @endif
                                @endauth
                                </li>

                            </ul>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
            <br><br>

            <div class="">
                <!---Banner--->
                <div id="myButton"></div> --}}