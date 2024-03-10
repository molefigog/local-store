<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="icon-mail_outline"></i></div>
                            </div>
                            <input id="login" type="text" placeholder="Enter Email"
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
                                <div class="input-group-text">
                                    <i id="togglePassword" class="icon-lock_outline"></i>
                                </div>
                            </div>
                            <input type="password" id="password" placeholder="Enter Password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
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
                </form> 
            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><a href="{{ route('register') }}" class="btn btn-primary w-100" title="Login">sign up <i
                    class="icon-person_add"></i></a></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                
            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div> --}}
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var icon = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('icon-lock_outline');
            icon.classList.add('icon-lock_open');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('icon-lock_open');
            icon.classList.add('icon-lock_outline');
        }
    });
</script>