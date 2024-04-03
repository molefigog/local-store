<?php
$apiKey = '863c6f17965b59a056305e51';
$baseCurrency = 'ZAR';
$targetCurrency = 'USD';
$amount = $music->amount; // Assuming $music->amount contains the ZAR amount you want to convert

// Make API request to get the exchange rate
$apiUrl = "https://open.er-api.com/v6/latest/{$baseCurrency}?apikey={$apiKey}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if ($data && isset($data['rates'][$targetCurrency])) {
    // Perform the conversion
    $exchangeRate = $data['rates'][$targetCurrency];
    $convertedAmount = $amount * $exchangeRate;

    // Round the converted amount to 2 decimal places (you can adjust this as needed)
    $convertedAmount = round($convertedAmount, 2);

    // Assign the converted amount to $amount
    $amount = $convertedAmount;
} else {
    // Handle the case where the exchange rate data is not available
    $amount = 'Failed to retrieve exchange rate data.';
}


?>



<style>
section {
    /* background-color: hsl(228, 33%, 97%); */
    height: 100vh;
    display: flex;
    padding: 0 2%;
    flex-direction: column;
    justify-content: center;
    gap: 10px;
}

.comment-box {
    display: flex;
    background-color: rgb(255 255 255 / 7%);
    font-size: 14px;
    gap: 20px;
    padding: 8px;
    border-radius: 10px;
    background-clip: padding-box;
    box-shadow: inset 0 0 0 3px rgba(255, 255, 255, 0.13);
}
.ddd{
    background-color: rgba(255, 255, 255, 0.205);
    border-radius: 6px;
    padding: 4px;
}
.comment-reply {
  display: flex;
}

.comment-reply .vline {
  background-color: hsl(223, 19%, 93%);
  width: 5px;
  margin: 0 50px;
}

.reply-col {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.comment-count {
  background-color: hsl(228, 33%, 97%);
  color: hsl(238, 40%, 52%);
  font-weight: 500;
  padding: 10px 8px;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  gap: 13px;
  align-self: flex-start;
  align-items: center;
}
.comment {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.comment-head {
  display: flex;
  justify-content: space-between;
}


.comment-head .dname {
  font-weight: 500;
  color: hsl(212, 24%, 26%);
}

.comment-head .name {
  display: flex;
  gap: 10px;
  align-items: center;
}

.comment-head .trailing {
  display: flex;
  gap: 5px;
  align-items: center;
}

.comment-body {
    line-height: 22px;
    padding: 0px 39px;
    margin-top: -26px;
}

.comment-text {
  background-color: rgba(255, 255, 255, 0.178);
  padding: 25px 20px;
  display: flex;
  gap: 20px;
  align-items: flex-start;
  border-radius: 10px;
}

/* button {
  background-color: hsl(238, 40%, 52%);
  padding: 10px 25px;
  border: none;
  border-radius: 5px;
  color: white;
  font-weight: 500;
} */

textarea {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
}

.you {
  padding: 3px 8px;
  background-color: hsl(238, 40%, 52%);
  color: white;
  font-weight: 500;
  border-radius: 3px;
  font-size: 13px;
}

.delete {
  margin-right: 10px;
}

.reply-to {
  color: hsl(238, 40%, 52%);
  font-weight: 500;
}
</style>
<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="card-img-wrapper col-md-6 ">
            <img src="<?php echo e(asset("storage/$music->image")); ?>" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
            <h2><?php echo e($music->title ?? '-'); ?></h2>
            <p class="text-muted"><?php echo e($music->description ?? '-'); ?></p>
            <P> Size: <?php echo e($music->size ?? '-'); ?>MB Duration:
                <span><?php echo e($music->duration ?? '-'); ?></span>
            </P>
            <h3 class="text-success">Price R<?php echo e($music->amount); ?></h3>
            <p>
                <strong>Downloads <span class="text-success"><?php echo e($music->downloads); ?></span> </strong> Genre <span
                    class="text-success"><?php echo e($music->genre ? $music->genre->title : '-'); ?></span>
            </p>
            <?php if($music->amount == 0): ?>
            <div id="wrap">
                <form action="<?php echo e(route('mp3.download', ['mp3' => $music->id])); ?>" method="get">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="music_id" value="<?php echo e($music->id); ?>">
                    <button type="submit" class="btn buy-button2">
                        <span class="circle2"><i class="icon-download"></i></span>
                        <span class="title2 gee">Download</span>

                    </button>
                </form>
            </div>
            <?php else: ?>
            <nav class="text-center">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                    <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true"><img src="<?php echo e(asset('assets/vcl1.png')); ?>" alt=""
                            style="width: 24px; height: 24px;">
                        M-Pesa</a>
                    <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false"><i class="icon-account_balance_wallet"></i>
                        Wallet</a>

                    <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact" aria-selected="false"><i class="icon-paypal"></i> Paypal</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="justify-content-center">
                        <hr>
                        <div id="wrap">
                            <form id="paymentForm" class="text-center" action="<?php echo e(route('m-pesa')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Enter M-pesa Number</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"> <img src="<?php echo e(asset('assets/vcl1.png')); ?>"
                                                    alt="" style="width: 24px; height: 24px;"> </i></div>
                                        </div>
                                        <input type="text" class="form-control col-6" name="mobileNumber" value=""
                                            placeholder="Enter mpesa number" pattern="5\d{7}"
                                            title="Please enter 8 digits starting with 5" maxlength="8" required>

                                        <input type="hidden" name="amount" value="<?php echo e($music->amount); ?>">
                                        
                                        <input type="hidden" name="client_reference"
                                            value="<?php echo e($music->id); ?> <?php echo e($music->title ?? '-'); ?>">
                                        <input type="hidden" name="musicId" value="<?php echo e($music->id); ?>">

                                        &nbsp; <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <span class="circle2"><img src="<?php echo e(asset('assets/vcl1.png')); ?>" alt=""
                                                    style="width: 24px; height: 24px;"> </i></span>
                                            <span class="title2 gee">Pay M<?php echo e($music->amount); ?></span>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <br>
                    <div class="text-center">

                        


                        <div class="text-center"><a href="#information" id="showAlert">INSTRUCTIONS</a></div>
                        <form id="complete-order" action="<?php echo e(route('manual')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="text-center">
                                <div class="info"></div>
                                <div class="message"></div>
                            </div>
                            <input type="hidden" name="music_id" value="<?php echo e($music->id); ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP"
                                    aria-label="Enter OTP" aria-describedby="button-addon2" required>
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buy R<?php echo e($music->amount); ?></button>
                            </div>


                        </form>
                    </div>

                </div>


                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="text-center">
                        <h6 class="text-center"></h6>
                        <?php if($music->amount == 0): ?>
                        <p> </p>
                        <?php else: ?>
                        <div id="wrap">
                            <form id="buyNowForm" action="<?php echo e($Paypal); ?>" method="post">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="amount" value="<?php echo e($amount); ?>">
                                <input type="hidden" name="currency_code" value="<?php echo e($currency); ?>">
                                <input type="hidden" name="business" value="<?php echo e($PAYPAL_ID); ?>">

                                <input type="hidden" name="custom" value="<?php echo e($userId); ?>">

                                <input type="hidden" name="item_name" value="<?php echo e($music->title); ?>">
                                <input type="hidden" name="item_number" value="<?php echo e($music->id); ?>">
                                <input type="hidden" name="return" value="<?php echo e(route('success')); ?>">
                                <input type="hidden" name="cancel_return" value="<?php echo e(url('cancel')); ?>">
                                <input type="hidden" name="notify_url" value="<?php echo e(url('ipn')); ?>">

                                <button type="submit" class="btn buy-button2"
                                    title="secure online payment with paypal"><i class="icon-paypal"></i> Buy
                                    $<?php echo e($amount); ?></button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div id="wrapper">
                <audio preload="auto" controls>
                    <source src="<?php echo e(asset("storage/demos/$music->demo")); ?>">
                </audio>

            </div>

            <div>
                <h5>share to <i class="icon-share2"></i></h5>
                <?php echo $shareButtons; ?>

            </div>
            <hr>
        </div>
    </div>

</div>


        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('comment-section', ['musicId' => $music->id]);

$__html = app('livewire')->mount($__name, $__params, 'lw-410213722-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<br>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
<title><?php echo e($metaTags['title']); ?></title>
<meta name="description" content="<?php echo e($metaTags['description']); ?>">
<meta property="og:title" content="<?php echo e($metaTags['title']); ?>">
<meta property="og:image" content="<?php echo e($metaTags['image']); ?>">
<meta property="og:description" content="<?php echo e($metaTags['description']); ?>">
<meta property="og:url" content="<?php echo e($metaTags['url']); ?>" />
<meta name="keywords" content="<?php echo e($metaTags['keywords']); ?>">
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo e($metaTags['title']); ?>" />
<meta name="twitter:description" content="<?php echo e($metaTags['description']); ?>" />
<meta name="twitter:image" content="<?php echo e($metaTags['image']); ?>" />
<meta property="fb:app_id" content="337031642040584" />
<meta property="og:type" content="music.song">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('ghead'); ?>
<!-- Google Tag Manager -->
<script>
    (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MT3JSPQW');
</script>
<!-- End Google Tag Manager -->
<?php $__env->stopPush(); ?>

<?php $__env->startPush('gbody'); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT3JSPQW" height="0" width="0"
        style="display:none;visibility:hidden">
    </iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php $__env->stopPush(); ?>

<?php $__env->startPush('aplayer'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/audioplayer.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('player'); ?>
<script src="<?php echo e(asset('frontend/js/audioplayer.js')); ?>"></script>
<script>
    $(function() {
            $('audio').audioPlayer();
        });
</script>
<script>
    document.getElementById('buyNowForm').addEventListener('submit', function(event) {
            var userId = document.getElementsByName('custom')[0].value;

            // Check if userId is null
            if (!userId) {
                var intendedUrl = '<?php echo e(route('msingle.slug', ['slug' => urlencode($music->slug)])); ?>';
                window.sessionStorage.setItem('intended_url', intendedUrl);

                // Redirect to login page
                window.location.href = '<?php echo e(route('login')); ?>';
                event.preventDefault(); // Prevent the form from being submitted
            }
            // If userId is not null, the form will be submitted as usual
        });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('mpesa'); ?>
<script>
    $(document).ready(function() {
            $('#paymentForm').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Processing',
                    html: 'Please wait...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                });
                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('m-pesa')); ?>',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        Swal.close();

                        Swal.fire({
                            icon: response.status,
                            title: response.status.charAt(0).toUpperCase() + response
                                .status.slice(1),
                            text: response.message,
                        }).then(function() {
                            if (response.status === 'success') {
                                window.location.href = response.download_url;
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.close();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to make the API request',
                        });
                    },
                });
            });
        });
</script>
<script>
    // Add an event listener to the link
    document.getElementById('showAlert').addEventListener('click', function() {
      // Display SweetAlert2 when the link is clicked
      Swal.fire({
        title: 'INSTRUCTIONS',
        text: 'Send payment via M-Pesa to 59073443. You\'ll receive an OTP on your phone; use it to finalize the download payment.',
        icon: 'info',
        confirmButtonText: 'Dismiss'
      });
    });
</script>

<script>
    $(document).ready(function() {
            var delayTimer;

            $('#otp').on('input', function() {
                var otp = $(this).val();

                clearTimeout(delayTimer);

                delayTimer = setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo e(route('check-otp')); ?>',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            otp: otp
                        },
                        success: function(response) {
                            if (response.success) {
                                $('.info').html('Received Amount: ' + response.receivedAmount +
                                    '<br>From Number: ' + response.fromNumber);
                                $('.message').html('<p class="text-success">Success it worked</p>');
                            } else {
                                $('.info').html('Invalid OTP');
                                $('.message').html('<p class="text-danger">Enter Valid OTP</p>');
                            }
                        },
                        error: function() {
                            $('.info').html('Error checking OTP');
                        }
                    });
                }, 500);
            });
        });
</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/msingle.blade.php ENDPATH**/ ?>