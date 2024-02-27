@extends('layouts.master')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
           

            <form class="rounded shadow-sm" method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="icon-envelope-o"></i></div>
                        </div>
                        <input id="login" type="text" placeholder="Email"
                            class="form-control @error('login') is-invalid @enderror" name="login"
                            value="{{ old('login') }}" required autocomplete="login" autofocus>
                        @error('login')
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

                <!-- Remember Me checkbox -->
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="basic_checkbox_1"
                        {{ old('remember') ? 'checked' : '' }}>
                    {{-- <input type="checkbox" class="form-check-input" id="rememberMe"> --}}
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>

                <!-- Forgotten Password link -->
                <div class="mb-3 text-end">
                    @if (Route::has('password.request'))
                        <a class="text-muted" href="{{ route('password.request') }}">
                            <i class="mdi mdi-lock"></i> {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </div>

                <!-- Login button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p>Create An Account? <a href="{{ route('register') }}" class="text-center" title="Login">sign up <i
                    class="icon-login"></i></a>
        </p>
            </form>

               
         
            
        </div>

    </div>
@endsection

@push('ghead')
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MT3JSPQW');
</script>
<!-- End Google Tag Manager -->
@endpush

@push('gbody')
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT3JSPQW"
height="0" width="0" style="display:none;visibility:hidden">
</iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@endpush