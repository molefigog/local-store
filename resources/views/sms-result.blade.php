@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center">
                SMS Sending Result
            </h4>

            <strong><p>{{ $response }}</p></strong>
            <a href="{{ route('send-sms-form') }}">Send another SMS</a>
        </div>
    </div>
</div>
@endsection