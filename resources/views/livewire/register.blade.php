<div>
    {{-- <form wire:submit.prevent="register" enctype="multipart/form-data">
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
                    <input wire:model="name" id="name" type="text" placeholder="User name or Artist name"
                        class="form-control @error('login') is-invalid @enderror" name="" value="{{ old('login') }}"
                        required autocomplete="name" autofocus>
                    @error('login')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="icon-envelope-o"></i></div>
                    </div>
                    <input wire:model="email" id="email" type="email" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" name=""
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                    <input wire:model="mobile_number" id="phone" type="tel" class="form-control @error('mobile_number') is-invalid @enderror"
                        name="" value="{{ old('mobile_number') }}" required>
                    <div id="error-message" class="text-danger"></div>

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="icon-lock_outline"></i></div>
                    </div>
                    <input wire:model="password" type="password" id="password" placeholder="Enter Password"
                        class="form-control  @error('password') is-invalid @enderror" name="" required
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
                    <input wire:model="password_confirmation" type="password" id="password-confirm" placeholder="Confirm Password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Profile</label>
                <div class="input-group mb-2">

                    <input wire:model="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror"
                        name="" value="{{ old('avatar') }}" required >
                    <div id="error-message" class="text-danger"></div>

                    @error('avatar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <button type="submit" id="submitBtn" class="btn btn-primary w-100">Register</button>
            <p>Have an account &nbsp;<a href="{{ route('login') }}" class="text-center" title="Login">sign in
                    &nbsp;<i class="icon-login"></i></a>
</form> --}}
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        {{-- <button type="submit">
            Submit
        </button> --}}
    </form>


</div>
