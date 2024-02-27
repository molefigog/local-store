@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center">
                SEND SMS
            </h4>
            <div class="mt-4">
            <form method="post" action="{{ route('send-sms-send') }}">
                @csrf
                <div class="form-group">
                <label for="content">Message Content:</label>
                <textarea name="content" id="content" rows="4" class="form-control" required></textarea><br>
                </div>

                <div class="form-group">
                <label for="from">From:</label>
                <input type="text" name="from" id="from" class="form-control" required><br>
                </div>

                <div class="form-group">
                <label for="to">To:</label>
                <input type="text" name="to" id="to" class="form-control" required><br>
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">Send SMS</button>
                </div>

            </form>
        </div>
        
        </div>
    </div>
</div>
@endsection