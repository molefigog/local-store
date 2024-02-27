
@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">

    <div class="card bg-transparent">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <form>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="" class="form-control" placeholder="Full name" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="" class="form-control" placeholder="Email address" type="email">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <select class="custom-select" style="max-width: 80px;">
                        <option selected="">+266</option>
                        <option value="1">+27</option>
                        <option value="2">+258</option>
                        <option value="3">+267</option>
                        <option value="2">+263</option>
                        <option value="3">+234</option>
                        <option value="3">+93</option>
                    </select>
                    <input name="" class="form-control" placeholder="Phone number" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                    </div>
                    <select class="form-control">
                        <option selected=""> Select job type</option>
                        <option>Web Developer</option>
                        <option>Full Stack Developer</option>
                        <option>Mean Stack</option>
                    </select>
                </div> <!-- form-group end.// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Create password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Repeat password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="#">Log In</a> </p>
            </form>
        </article>
    </div>

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