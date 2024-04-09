<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">

            <form id="registrationForm" method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <h6 class="card-title mt-3 text-center">Create Account</h6>
                <hr>
                <div class="mb-3">

                    <label for="name" class="form-label">Username <span style="font-size: 10px; color:gray;">or Artist
                            name</span></label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="icon-user-plus"></i></div>
                        </div>
                        <input id="name" type="text" placeholder="User name or Artist name"
                            class="form-control <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                            value="<?php echo e(old('login')); ?>" required autocomplete="login" autofocus>
                        <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <!-- Email input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="icon-envelope-o"></i></div>
                        </div>
                        <input id="email" type="email" placeholder="Email"
                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                            value="<?php echo e(old('email')); ?>" required autocomplete="login" autofocus>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Mobile number</label>
                    <div class="input-group mb-2">
                        <input type="hidden" name="full_number" id="full_number" value="">
                        <input id="phone" class="form-control" value="<?php echo e(old('mobile_number')); ?>" name="mobile_number"
                            type="tel" required />
                    </div>
                </div>

                <!-- Password input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="icon-lock_outline"></i></div>
                        </div>
                        <input type="password" id="password" placeholder="Enter Password"
                            class="form-control  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                            autocomplete="new-password">

                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Password</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="icon-vpn_key"></i></div>
                        </div>
                        <input type="password" id="password-confirm" placeholder="Confirm Password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <!-- Login button -->
                <button type="button" id="submitBtn" class="btn btn-primary w-100">Register</button>
                <p>Have an account &nbsp;<a href="<?php echo e(route('login')); ?>" class="text-center" title="Login">sign in
                        &nbsp;<i class="icon-person_add"></i></a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('tellcss'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('build/css/intlTelInput.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('telljs'); ?>
    <script src="<?php echo e(asset('build/js/intlTelInput.js')); ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.querySelector("#phone");
            var errorDisplay = document.getElementById("error-message");
            var fullMobileNumberInput = document.querySelector("#full_mobile_number"); // Add this line
            var iti = window.intlTelInput(input, {
                allowDropdown: true,
                autoInsertDialCode: true,
                autoPlaceholder: "no",
                dropdownContainer: document.body,
                excludeCountries: ["us"],
                formatOnDisplay: true,
                geoIpLookup: function(callback) {
                    fetch("https://ipapi.co/json")
                        .then(function(res) { return res.json(); })
                        .then(function(data) { callback(data.country_code); })
                        .catch(function() { callback("us"); });
                },
                hiddenInput: "full_number",
                initialCountry: "auto",
                localizedCountries: {
                    'za': 'South Africa',
                    'bw': 'Botswana',
                    'ls': 'Lesotho',
                    'zw': 'Zimbabwe',
                    'mz': 'Mozambique'
                },
                nationalMode: true,
                onlyCountries: ['ls', 'za', 'bw', 'zw', 'mz'],
                placeholderNumberType: "MOBILE",
                preferredCountries: ['cn', 'jp'],
                separateDialCode: true,
                showFlags: true,
                utilsScript: "<?php echo e(asset('build/js/utils.js')); ?>"
            });
    
            // Map of country codes to maximum phone number length
            var maxLengthMap = {
                'za': 9,
                'bw': 8,
                'ls': 8,
                'zw': 9,
                'mz': 9
            };
    
            // Add an event listener to validate the phone number length and allow only digits
            input.addEventListener('input', function() {
                var selectedCountry = iti.getSelectedCountryData();
                var maxLength = maxLengthMap[selectedCountry.iso2] || 15;
    
                // Remove non-digit characters and limit the length
                var sanitizedValue = input.value.replace(/\D/g, '').slice(0, maxLength);
    
                // Update the input value
                input.value = sanitizedValue;
    
                // Check if the input value exceeds the maximum length and display error message
                if (sanitizedValue.length > maxLength) {
                    errorDisplay.innerText = "Phone number exceeds the maximum length for the selected country.";
                } else {
                    errorDisplay.innerText = "";
                }
    
                // Update the hidden input with the full mobile number (including dialing code without +)
                var dialingCode = selectedCountry.dialCode || '';
                fullMobileNumberInput.value = dialingCode + sanitizedValue;
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            function showLoader() {
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });
            }
    
            function hideLoader() {
                Swal.close();
            }
    
            $('#submitBtn').on('click', function () {
                showLoader();
    
                // Get the full mobile number value
                var fullMobileNumber = $('#full_mobile_number').val();
    
                $.ajax({
                    url: $('#registrationForm').attr('action'),
                    method: 'POST',
                    data: {
                        // Include other form fields as needed
                        full_mobile_number: fullMobileNumber,
                        // Serialize the rest of the form data
                        ...$('#registrationForm').serializeArray().reduce((obj, item) => {
                            obj[item.name] = item.value;
                            return obj;
                        }, {})
                    },
                    success: function (response) {
                        hideLoader();
                        setTimeout(function () {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Registered successfully!',
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false,
                            }).then(function () {
                                window.location.href = '/';
                            });
                        }, 3000);
                    },
                    error: function (error) {
                        hideLoader();
                        Swal.fire('Error!', 'An error occurred while saving data.', 'error');
                    },
                });
            });
        });
    </script>
   

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gw-ent.co.za/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>