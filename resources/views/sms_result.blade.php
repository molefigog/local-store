@extends('admin.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <h1 class="text-center">SMS Results</h1>
            <div class="card bg-transparent">
                <div class="card-body bg-transparent">
                    <div class="alert alert-success mt-3">
                        Successfully sent: {{ $successCount }} SMS
                    </div>

                    <div class="alert alert-danger mt-3">
                        Failed to send: {{ $errorCount }} SMS
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
