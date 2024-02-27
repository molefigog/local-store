@extends('layouts.master')

@section('content')
    <div class="main-block">
        <h1>Registration</h1>
        <hr>
        <form onsubmit="validatePhoneNumber()" method="POST" action="{{ route('register') }}">
            @csrf
            <label id="icon" for="name"><i class="fas fa-user"></i></label>
            <input type="text" id="name" placeholder="Enter Your Name" id="name" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
            <!-- @error('name')
        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
    @enderror -->

            <label id="icon" for="email"><i class="fas fa-envelope"></i></label>
            <input type="text" id="email" placeholder="Enter Your Email" id="email" name="email"
                value="{{ old('email') }}" required autocomplete="email">
            <!-- @error('email')
        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
    @enderror -->
    
            <input type="hidden" name="full_mobile_number" id="full_mobile_number" value="">
            <label id="icon" for="email"><i class="fas fa-phone"></i></label>
            <div class="form-group input-group">
                <select class="custom-select" style="max-width: 80px;" id="dialing_code" name="country_code">
                    <option selected="">+266</option>
                    <option value="1">+27</option>
                    <option value="2">+258</option>
                    <option value="3">+267</option>
                    <option value="4">+263</option>
                    <option value="5">+234</option>
                    <option value="6">+93</option>
                </select>
               
                <input id="mobile_number" type="text" name="mobile_number" placeholder="Mobile Number" required
                    oninput="updateFullMobileNumber()">
            </div>

            <label id="icon" for="password"><i class="fas fa-unlock-alt"></i></label>
            <input type="password" id="password" placeholder="Enter Password" id="password" name="password" required>
            <!-- @error('password')
        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
    @enderror -->

            <label id="icon" for="password-confirm"><i class="fas fa-unlock-alt"></i></label>
            <input type="password" id="password-confirm" placeholder="Confirm Password" name="password_confirmation"
                id="password-confirm">

            <hr>
            <div class="btn-block">
                <button type="submit" class="ms_modal hideCurrentModel" id="customLoginButton">
                    <span class="">Register</span>
                </button>
                <p>Already Have An Account? <a href="{{ route('login') }}" class="" title="Login">sign in <i
                            class="icon-login"></i></a></p>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        function formatPhoneNumber(phoneNumber) {
            // Remove non-digit characters and leading "+" if present
            return phoneNumber.replace(/\D/g, '').replace(/^\+/, '');
        }

        function validatePhoneNumber() {
            // Get the selected country dialing code
            const selectedDialingCode = document.querySelector('.custom-select').value;

            // Get the entered phone number
            let phoneNumber = document.querySelector('input[name="mobile_number"]').value;

            // Format the phone number without the "+" sign
            phoneNumber = formatPhoneNumber(phoneNumber);

            // Define regular expressions based on the selected country dialing code
            let regex;
            switch (selectedDialingCode) {
                case '0': // +266 (Lesotho)
                    regex = /^266\d{8}$/;
                    break;
                case '1': // +27 (South Africa)
                    regex = /^27\d{9}$/;
                    break;
                case '2': // +258 (Mozambique)
                    regex = /^258\d{7}$/;
                    break;
                case '3': // +267 (Botswana), +263 (Zimbabwe), +234 (Nigeria), +93 (Afghanistan)
                    regex = /^\d{10,12}$/;
                    break;
                default:
                    // Invalid dialing code
                    alert('Invalid dialing code');
                    return;
            }

            // Check if the formatted phone number matches the regular expression
            if (regex.test(phoneNumber)) {
                alert('Phone number is valid: ' + selectedDialingCode + phoneNumber);
                // Save the formatted phone number (e.g., 26659073443) to the database
                // Add your code here to save the formatted phone number to the database
            } else {
                alert('Invalid phone number');
            }

        }

        function updateFullMobileNumber() {
            const selectedDialingCode = document.querySelector('#dialing_code').value;
            const mobileNumber = document.querySelector('input[name="mobile_number"]').value;

            // Ensure the mobile number is not empty
            if (mobileNumber.trim() === '') {
                alert('Mobile number cannot be empty.');
                return;
            }

            // Remove non-digit characters from the mobile number
            const formattedMobileNumber = mobileNumber.replace(/\D/g, '');

            // Concatenate the dialing code and the formatted mobile number
            const fullMobileNumber = selectedDialingCode + formattedMobileNumber;

            // Update the hidden input field
            document.querySelector('#full_mobile_number').value = fullMobileNumber;
        }
    </script>
@endpush
