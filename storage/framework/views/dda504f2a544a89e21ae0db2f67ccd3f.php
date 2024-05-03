<?php
    $setting = App\Models\Setting::orderBy('created_at', 'desc')
        ->select('site', 'image', 'logo', 'favicon', 'description')
        ->first();
?>
<?php
    $genres = App\Models\Genre::orderBy('created_at', 'desc')->pluck('title');
?>


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
                <h1 class="mb-0 site-logo"><a href="/"><img src="<?php echo e(asset("storage/$setting->logo")); ?>"
                            alt="" class="img-fluid" style="width:150px;" /><span class="text-primary">.</span>
                    </a></h1>

            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li><a href="/" class="nav-link">Home</a></li>
                        <li><a href="<?php echo e(url('beatz')); ?>" class="nav-link">Beatz</a></li>

                        <li class="has-children">
                            <a href="#account" class="nav-link">Categories</a>
                            <ul class="dropdown">
                                <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a class="nav-link"
                                            href="<?php echo e(route('songs-by-genre', urlencode($genre))); ?>"><?php echo e($genre); ?>

                                        </a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>

                        <li class="has-children">
                            <?php if(Auth::check()): ?>
                                <a href="#account" class="nav-link"><?php echo e(Auth::user()->name); ?></a>
                            <?php else: ?>
                                <a href="#account" class="nav-link">Account</a>
                            <?php endif; ?>
                            <ul class="dropdown">
                                <?php if(Auth::check()): ?>

                                    <?php if(Auth::user()->upload_status == 1): ?>
                                        <li><a class="nav-link" href="<?php echo e(url('/admin/music/create')); ?>"><i
                                                    class="icon-upload"></i> Upload Music</a></li>
                                        <li><a class="nav-link" href="<?php echo e(url('/admin/beats/create')); ?>"><i
                                                    class="icon-upload"></i> Upload Beat</a></li>
                                        <!---->
                                    <?php endif; ?>
                                    <li><a class="nav-link" href="<?php echo e(url('/purchased-musics')); ?>"><i
                                                class="icon-download"></i> Downloads</a></li>
                                    <li><a class="nav-link" href="<?php echo e(url('/top-up')); ?>"><i class="fa fa-cart-plus"></i>
                                            Account <span
                                                class="badge bg-success">R<?php echo e(Auth::user()->balance); ?></span></a></li>

                                    <li><a class="nav-link" href="<?php echo e(url('edit-profile')); ?>"><i class="icon-user"></i>
                                            Profile</a></li>
                                    <li><a class="nav-link" href="<?php echo e(route('log')); ?>"><i class="icon-paypal"></i>
                                            Paypal History</a></li>
                                    <li><a class="nav-link" href="<?php echo e(url('/admin')); ?>"><i class="icon-dashboard"></i>
                                            Dashboard</a></li>
                                <?php else: ?>
                                <li><a href="" data-toggle="modal" data-target="#exampleModal">Login</a></li>
                                <li><a href="<?php echo e(route('register')); ?>" >Register</a></li>

                                <?php endif; ?>
                                
                            </ul>
                        </li>
                        <?php if(auth()->guard()->check()): ?>

                            <li><a href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>


                        <?php endif; ?>

                        <li><a href="<?php echo e(route('getdownloads')); ?>" class="nav-link">Downloads</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="nav-link">About Us</a></li>
                        <li class="social"><a href="#" class="nav-link" onclick="toggleMode(); return false;">
                                <span id="iconMode" class="icon-brightness_high"></span></a></li>

                        <li class="social"><a href="https://www.facebook.com/elliot.gog" target="_blank"
                                class="nav-link"><span class="icon-facebook"></span></a></li>
                        <li class="social"><a href="https://twitter.com/Molefi18186414" target="_blank"
                                class="nav-link"><span class="icon-twitter"></span></a></li>
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
    <div class="search">

        <div class="">
            <div class="d-flex justify-content-between">
                <?php if(Auth::check()): ?>
                    <div class="mb-8 align-items-center text-center">
                        <button class="btn btn-outline-light btn-sm">Wallet R<?php echo e(Auth::user()->balance); ?></button>
                    </div>
                <?php endif; ?>
                &nbsp; &nbsp;&nbsp;
                <div class="mb-8 align-items-center text-center"> <!-- Center space -->
                    <i class="icon-search" id="searchIcon" style="cursor: pointer; color:whitesmoke;" ></i>

                </div>
                &nbsp; &nbsp;&nbsp;
                <div class="mb-8 align-items-center text-center">
                    <div id="iconMode" class="icon-container" onclick="toggleMode2();">
                        <span id="icon" class="icon-brightness_high" style="cursor: pointer; color:whitesmoke;"></span>
                    </div>
                </div>

                &nbsp;&nbsp;&nbsp;
                <?php if(Auth::check()): ?>
                    <div class="mb-8 align-items-center text-center">
                        <a class="btn btn-outline-light btn-sm" href="<?php echo e(url('/admin/music/create')); ?>"> <i
                                class="icon-cloud-upload"></i>Upload</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Modal for displaying search results -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
            aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- Adjust the size as needed -->
                <div class="modal-content">
                    <div class="modal-header">

                        <input class="form-control" type="text" id="search" placeholder="Type to search"
                            autocomplete="off">
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group bg-transparent text-primary" id="results"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/front/components/menu.blade.php ENDPATH**/ ?>