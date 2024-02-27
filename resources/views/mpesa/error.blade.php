@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="card">
        
        @if ($error)
        
    
        <h5 class="card-header text-success text-center">Payment is Error</h5>
        <div class="card-body">
            <h4></h4>
            <h5 class="card-title text-center">Payment Information</h5>
            <p class="card-text"><b>Reference Number:</b> {{ $error }}</p>
        
      @endif

      <a href="{{ url('purchased-musics') }}" class="btn buy-button">Downloads</a>
    </div>
    
  </div>
</div>
  @endsection