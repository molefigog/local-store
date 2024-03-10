<!-- resources/views/edit-profile.blade.php -->

@extends('admin.master')

@section('content')
<div class="container">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>


  <div class="card-body">
    <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="justify-content-center text-center">
        @if ($user->avatar)
          <img src="{{ \Storage::url(auth()->user()->avatar ?? 'default_avatar.png') }}" class="d-block rounded" height="100" width="100">
        @else
          <p>No avatar available.</p>
        @endif
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
          </div>
        

        <div class="form-group">
          <label for="avatar">Avatar</label>
          <input type="file" name="avatar" id="avatar" class="form-control" accept="image/png, image/jpeg">
        </div>
        </div>
      

      <div class="col-md-6">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" name="current_password" id="current_password" class="form-control">
        </div>

        <div class="form-group">
          <label for="new_password">New Password</label>
          <input type="password" name="new_password" id="new_password" class="form-control">
        </div>

        <div class="form-group">
          <label for="new_password_confirmation">Verify Password</label>
          <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
        </div>
      </div>
  </div>
  <br>
  <div class="justify-content-center text-center">
  <button type="submit" class="btn btn-primary">Update Profile</button>
</div>
  </form>
</div>

<!-- /Account -->
</div>


@endsection