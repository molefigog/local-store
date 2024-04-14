<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <?php
    $setting = App\Models\Setting::orderBy('created_at', 'desc')
    ->select('site', 'image', 'logo', 'favicon', 'description')
    ->first();
    ?>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <meta name="author" content="gog">
    <meta name="MobileOptimized" content="320">
    <meta property="og:site_name" content="gw-ent" />
    <?php echo $__env->yieldContent('head'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <script type="application/ld+json">
        {
        "@context" : "http://schema.org",
        "@type" : "WebSite",
        "name" : "GW ENT",
        "alternateName" : "Genius Works Ent",
        "url" : "https://www.gw-ent.co.za"
        }
    </script>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/fontello.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/font/icomoon/style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" id="cssTheme" href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.css')); ?>">
    <?php if($setting && $setting->favicon): ?>
    <link rel="icon" type="image/png" href="<?php echo e(\Storage::url($setting->favicon)); ?>">
    <?php endif; ?>
    <?php if($setting && $setting->favicon): ?>
    <link rel="apple-touch-icon" href="<?php echo e(\Storage::url($setting->favicon)); ?>">
    <?php endif; ?>
    <?php if($setting && $setting->favicon): ?>
    <meta name="msapplication-TileImage" content="<?php echo e(\Storage::url($setting->favicon)); ?>">
    <?php endif; ?>
    <?php if($setting && $setting->favicon): ?>
    <link rel="shortcut icon" href="<?php echo e(\Storage::url($setting->favicon)); ?>">
    <?php endif; ?>


    <?php echo $__env->yieldPushContent('tellcss'); ?>
    <?php echo $__env->yieldPushContent('aplayer'); ?>
    <?php echo $__env->yieldPushContent('pondcss'); ?>
    <style>
        @media (max-width: 767.98px) {
            .card {
                width: 100%;
                margin-bottom: 15px;
            }

            .card-img-top {
                max-height: 150px;
                object-fit: cover;
            }

            .card-img-top:hover {
                transform: scale(1.1);
            }

            .row-cols-2>* {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        .card-img-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50%;
            overflow: hidden;
        }

        .card-img-wrapper img {
            transition: 1.5s ease;
        }

        .card:hover .card-img-wrapper img {
            transform: scale(1.15);
        }

        .card-details {
            display: flex;
            position: absolute;
            top: 211px;
            left: 0px;
            width: 100%;
            /* height: 100%; */
            /* background-color: rgb(255 255 255 / 1%); */
            transition: opacity 1.5s ease;
            overflow: hidden;
            flex-wrap: wrap;
            align-content: flex-start;
            justify-content: space-evenly;
            align-items: center;
        }

        .card:hover .card-details {
            transition: 1.5s ease;
            transform: scale(1.15);
            /* Show and fade in the card details */
        }

        .card-hide {
            display: flex;
            opacity: 1;
            position: absolute;
            top: 130px;
            left: 0px;
            width: 100%;
            transition: opacity 1.5s ease;
            overflow: hidden;
            flex-wrap: wrap;
            align-content: flex-start;
            justify-content: space-evenly;
            align-items: center;
        }

        .card:hover .card-hide {
            opacity: 0;
            background-color: rgb(255, 255, 255, 0);
        }

        /* .social-button {
            display: inline-flex;
            flex-wrap: wrap;
            align-content: stretch;
            justify-content: space-around;
            align-items: flex-start;
            padding: inherit;
            gap: 0px 4px;
            font-size: x-large;
            color: #199945;
        } */

        .map-responsive {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-responsive iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
        .carousel-wrap {
    width: 1000px;
    margin: auto;
    position: relative;
  }
  .owl-carousel .owl-nav{
    overflow: hidden;
    height: 0px;
  }

  .owl-theme .owl-dots .owl-dot.active span,
  .owl-theme .owl-dots .owl-dot:hover span {
      background: #2caae1;
  }


  .owl-carousel .item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .owl-carousel .item img {
        max-width: 100%;
        height: auto;
    }
  .owl-carousel .nav-btn{
      height: 47px;
      position: absolute;
      width: 26px;
      cursor: pointer;
      top: 100px !important;
  }

  .owl-carousel .owl-prev.disabled,
  .owl-carousel .owl-next.disabled{
    pointer-events: none;
    opacity: 0.2;
  }

  .owl-carousel .prev-slide{
    content: "\f190";
      /* background: url(nav-icon.png) no-repeat scroll 0 0; */
      left: 33px;
  }
  .owl-carousel .next-slide{
      /* background: url(nav-icon.png) no-repeat scroll -24px 0px; */
      content: "\f18e";
      right: 33px;
  }
  .owl-carousel .prev-slide:hover{
     background-position: 0px -53px;
  }
  .owl-carousel .next-slide:hover{
    background-position: -24px -53px;
  }

  span.img-text {
    text-decoration: none;
    outline: none;
    transition: all 0.4s ease;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    cursor: pointer;
    width: 100%;
    font-size: 23px;
    display: block;
    text-transform: capitalize;
  }
  span.img-text:hover {
    color: #2caae1;
  }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">


</head>

<body>
    <?php echo $__env->yieldPushContent('gbody'); ?>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/front/components/head.blade.php ENDPATH**/ ?>