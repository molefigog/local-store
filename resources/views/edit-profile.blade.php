<!-- resources/views/edit-profile.blade.php -->

@extends('admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

  <div class="row">
    <div class="col-md-12">
      
      <div class="card mb-4 bg-transparent">
        <h5 class="card-header text-center">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img
              src="{{ \Storage::url(auth()->user()->avatar ?? 'default_avatar.png') }}" alt="Avatar"
              alt="user-avatar"
              class="d-block rounded"
              height="100"
              width="100"
              id="uploadedAvatar"
            />
            <form action="" method="post" enctype="multipart/form-data">
              @csrf
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">{{ Auth::user()->name }}</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input
                  type="file"
                  name="avatar" id="avatar"
                  class="account-file-input"
                  hidden
                  accept="image/png, image/jpeg"
                />
              </label>
              
            </div>
            <button type="button" class="btn btn-primary">upload Profile</button>
          </form>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                  required>
          </div>

          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                  required>
          </div>

          <div class="form-group">
              <label for="avatar">Avatar</label>
              <input type="file" name="avatar" id="avatar" class="form-control-file" accept="image/png, image/jpeg">
              @if ($user->avatar)
                  <img src="{{ \Storage::url($user->avatar) }}" class="d-block rounded"
                  height="100"
                  width="100">
              @else
                  <p>No avatar available.</p>
              @endif
          </div>

          <hr>

          <!-- Password fields -->
          <div class="form-group">
              <label for="current_password">Current Password</label>
              <input type="password" name="current_password" id="current_password" class="form-control" >
          </div>

          <div class="form-group">
              <label for="new_password">New Password</label>
              <input type="password" name="new_password" id="new_password" class="form-control" >
          </div>

          <div class="form-group">
              <label for="new_password_confirmation">Verify Password</label>
              <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                  class="form-control" >
          </div>

          <button type="submit" class="btn btn-primary">Update Profile</button>
      </form>
        </div>
        <!-- /Account -->
      </div>
      
    </div>
  </div>
</div>  
@endsection
