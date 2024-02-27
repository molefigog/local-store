@extends('admin.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <h1 class="text-center">SMS Sender</h1>
            <div class="card bg-transparent">
                <div class="card-body bg-transparent">
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('send-sms-send2') }}">
                        @csrf
                        <div class="form-group">
                            <label for="to">To:</label>
                            <input type="text" class="form-control" placeholder="+266 or +27 use international format" name="to" id="to" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" placeholder="160 characters " name="message" id="message" required></textarea>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary text-center">Send SMS</button>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
@endsection
