<?php
$apiKey = '863c6f17965b59a056305e51';
$baseCurrency = 'ZAR';
$targetCurrency = 'USD';
$amount = '100';
$apiUrl = "https://open.er-api.com/v6/latest/{$baseCurrency}?apikey={$apiKey}";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if ($data && isset($data['rates'][$targetCurrency])) {
$exchangeRate = $data['rates'][$targetCurrency];
$convertedAmount = $amount * $exchangeRate;
$convertedAmount = round($convertedAmount, 2);
$amount = $convertedAmount;
} else {
$amount = 'Failed to retrieve exchange rate data.';
}
?>



<?php $__env->startSection('content'); ?>
<style>
    #text {
        font-weight: bold;
        font-size: 12px;
        animation-name: blink;
        animation-duration: 3s;
        animation-iteration-count: infinite;
    }

    @keyframes blink {
        0% {
            color: pink
        }

        50% {
            color: black;
        }

        100% {
            color: pink;
        }
    }
</style>
<div class="container mt-4">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <a href="<?php echo e(url('edit-profile')); ?>">
                            <img src="<?php echo e(\Storage::url(auth()->user()->avatar ?? 'default_avatar.png')); ?>" alt=""
                                class="img-fluid rounded-circle" width="100" height="100">
                            <div class="ms-3">
                                <p class="text-muted"><?php echo e(Auth::user()->name); ?></p>
                            </div>
                        </a>
                        
                        <?php if(Auth::user()->upload_status == 1): ?>
                        <div class="text-center ms-3">
                            <a class="btn btn-primary btn-smtext-center" href="<?php echo e(url('/all-music/create')); ?>"><i
                                    class="icon-upload"></i> Upload</a>
                        </div>
                        <hr>
                        <br>
                        <?php endif; ?>
                    </div>
                    <nav class="text-center">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Balance</a>
                            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
                                aria-controls="nav-profile" aria-selected="false">M-Pesa</a>
                            <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab"
                                aria-controls="nav-contact" aria-selected="false">Paypal</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="text-center">
                                <p class="mb-0">Account Holder <?php echo e(Auth::user()->name); ?></p>
                                
                            </div>
                            <?php if(Auth::user()->upload_status == 1): ?>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <h6 class="text-center">account Wallet</h6>

                                        <?php if($songs->count() > 0): ?>
                                        <table border="1">
                                            <thead>
                                                <tr>
                                                    <th class=""><i class="icon-library_music text-muted"></i><span
                                                            class="card-text"> Tracks</span></th>
                                                    <th><i class="icon-cloud-download text-muted"></i><span
                                                            class="card-text"> Downloads</span></th>
                                                    <th><i class="icon-monetization_on text-muted"></i><span
                                                            class="card-text"> Price</span></th>
                                                    <th><i class="icon-drag_handle text-muted"></i><span
                                                            class="card-text"> Total</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $grandTotal = 0;
                                                ?>

                                                <?php $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $total = $song->md * $song->amount;
                                                $grandTotal += $total;
                                                ?>
                                                <tr>
                                                    <td class=""><?php echo e($index + 1); ?>

                                                        <?php echo e($song->title); ?></td>
                                                    <td><?php echo e($song->md); ?></td>
                                                    <td><?php echo e($song->amount); ?></td>
                                                    <td><?php echo e($total); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </tbody>
                                        </table>
                                        <P class="text-center">
                                        </P>
                                        <hr class="">
                                        <h6 class="text-center"><?php echo e(Auth::user()->name); ?> You have <strong>
                                                R<?php echo e($grandTotal); ?> </strong>
                                            <script>
                                                var currentDate = new Date();
                                                            var currentMonthIndex = currentDate.getMonth();
                                                            var currentYear = currentDate.getFullYear();

                                                            // Array of month names
                                                            var monthNames = [
                                                                "January", "February", "March", "April", "May", "June",
                                                                "July", "August", "September", "October", "November", "December"
                                                            ];

                                                            var currentMonthName = monthNames[currentMonthIndex];

                                                            document.write("this " + currentMonthName + " " + currentYear);
                                            </script>
                                        </h6>
                                        <p class="text-muted text-center">
                                            md -> monthly downloads
                                            <br>
                                            md x amount = total


                                        </p>
                                        <hr>
                                        <?php else: ?>
                                        <p>No songs found.</p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="justify-content-center">
                                <h6 class="text-center">Activate your upload status</h6>
                                <p class="text-center">Note!! You must subscribe first to be able to upload and sell
                                    your music with us.</p>
                                <form id="paymentForm" class="text-center" action="<?php echo e(route('upload.status')); ?>"
                                    method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">M-pesa</label>
                                        <div class="input-group mb-2">
                                            <?php if(Auth::user()->upload_status == 0): ?>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> <img src="<?php echo e(asset('assets/vcl1.png')); ?>"
                                                        alt="" style="width: 24px; height: 24px;"> </i></div>
                                            </div>
                                            <input type="number" class="form-control" name="mobileNumber" value=""
                                                placeholder="mpesa number" maxlength="8" required>
                                            <input type="hidden" name="amount" value="<?php echo e($upload_fee); ?>">
                                            <input type="hidden" name="client_reference" value="uploading Fee">
                                            <input type="hidden" name="userId" value="<?php echo e(Auth::user()->id); ?>">



                                            &nbsp; <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <span class="circle2"><img src="<?php echo e(asset('assets/vcl1.png')); ?>" alt=""
                                                        style="width: 24px; height: 24px;">
                                                    </i></span>
                                                <span class="title2 gee">Pay M<?php echo e($upload_fee); ?></span>
                                            </button>
                                            <?php else: ?>
                                            <div class="alert alert-success justify-content-center" role="alert">
                                                <p class="text-center" id="text">Upload Activated! </p>
                                            </div>

                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </form>

                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="text-center">
                                <h6 class="text-center">Activate your upload status</h6>
                                <p>Note!! You must subscribe first to be able to upload and sell your music with us.</p>
                                <form id="activate" action="<?php echo e($Paypal); ?>" method="post"
                                    onsubmit="return checkUploadStatus()">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="amount" value="<?php echo e($amount); ?>">
                                    <input type="hidden" name="currency_code" value="<?php echo e($currency); ?>">
                                    <input type="hidden" name="business" value="<?php echo e($PAYPAL_ID); ?>">

                                    <input type="hidden" name="custom" value="<?php echo e(Auth::user()->id); ?>">

                                    <input type="hidden" name="item_name" value="Registration Fee">
                                    <input type="hidden" name="item_number" value="5907">
                                    <input type="hidden" name="return" value="<?php echo e(route('success2')); ?>">
                                    <input type="hidden" name="cancel_return" value="<?php echo e(url('cancel')); ?>">
                                    <input type="hidden" name="notify_url" value="<?php echo e(url('ipn')); ?>">

                                    <?php if(Auth::user()->upload_status == 0): ?>
                                    <button class="btn btn-primary btn-sm" type="submit"><i class="icon-paypal"></i> Pay
                                        R100</button>
                                    <?php else: ?>
                                    <button class="btn btn-primary btn-sm" type="button" disabled><i
                                            class="icon-paypal"></i>Upload Activated</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('upload_status'); ?>
<script>
    function checkUploadStatus() {
            // Check if upload_status is "0"
            var uploadStatus = "<?php echo e(Auth::user()->upload_status); ?>";
            if (uploadStatus === "0") {
                // Allow form submission
                return true;
            } else {
                // Display Notyf alert or perform other actions if needed
                var notyf = new Notyf({
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                    dismissible: true,
                    duration: 7000,
                });
                notyf.alert('Your upload status is already activated');

                // Prevent form submission
                return false;
            }
        }

        document.getElementById("activate").addEventListener("submit", function(event) {
            if (!checkUploadStatus()) {
                event.preventDefault(); // Prevent the form from submitting
            }
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
                    url: '<?php echo e(route('upload.status')); ?>',
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
                                location.reload();
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/top-up.blade.php ENDPATH**/ ?>