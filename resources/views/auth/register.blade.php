@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <form id="registrationForm" method="POST" action="{{ route('register') }}">
                @csrf
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
                            class="form-control @error('login') is-invalid @enderror" name="name"
                            value="{{ old('login') }}" required autocomplete="login" autofocus>
                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="login" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Mobile number</label>
                    <div class="input-group mb-2">
                        {{-- <input type="hidden" name="full_number" id="full_number" value=""> --}}
                        <input id="phone" type="tel"
                            class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number"
                            value="{{ old('mobile_number') }}" required>
                        <div id="error-message" class="text-danger"></div>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                            class="form-control  @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                <button type="submit" id="submitBtn" class="btn btn-primary w-100">Register</button>
                <p>Have an account &nbsp;<a href="{{ route('login') }}" class="text-center" title="Login">sign in
                        &nbsp;<i class="icon-person_add"></i></a>
            </form>
        </div>
    </div>
@endsection

@push('tellcss')
    <link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
@endpush

@push('telljs')
    <script src="{{ asset('build/js/intlTelInput.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.querySelector("#phone");
            var errorDisplay = document.getElementById("error-message");
            var form = document.querySelector("#registerForm"); // Replace with your form ID

            var iti = window.intlTelInput(input, {
                allowDropdown: true,
                autoInsertDialCode: true,
                autoPlaceholder: "no",
                dropdownContainer: document.body,
                excludeCountries: ["us"],
                formatOnDisplay: true,
                geoIpLookup: function(callback) {
                    fetch("https://ipapi.co/json")
                        .then(function(res) {
                            return res.json();
                        })
                        .then(function(data) {
                            callback(data.country_code);
                        })
                        .catch(function() {
                            callback("us");
                        });
                },
                // hiddenInput: "full_number",
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
                utilsScript: "{{ asset('build/js/utils.js') }}"
            });

            // Map of country codes to maximum phone number length
            var maxLengthMap = {
                'za': 9,
                'bw': 8,
                'ls': 8,
                'zw': 9,
                'mz': 9
            };

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var selectedCountry = iti.getSelectedCountryData();
                var maxLength = maxLengthMap[selectedCountry.iso2] || 15;

                var sanitizedValue = input.value.replace(/\D/g, '').slice(0, maxLength);

                if (sanitizedValue.length > maxLength) {
                    errorDisplay.innerText =
                        "Phone number exceeds the maximum length for the selected country.";
                    return;
                } else {
                    errorDisplay.innerText = "";
                }

                input.value = selectedCountry.dialCode + sanitizedValue;

                form.submit();
            });
        });
    </script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Show loader while processing
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            // Use Fetch or Ajax to submit the form data
            fetch(this.action, {
                method: this.method,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: new URLSearchParams(new FormData(this))
            })
            .then(response => response.json())
            .then(data => {
                // Close the loader
                Swal.close();

                // Handle success
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success'
                    }).then(() => {
                        // You can redirect or perform other actions after success
                        window.location.href = "/";
                    });
                } else {
                    // Handle error
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                // Close the loader
                Swal.close();

                // Handle network error or other issues
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error'
                });
            });
        });
    </script>
@endpush
