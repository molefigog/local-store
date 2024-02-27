@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('run-migrations') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="db_database">Database Name:</label>
                    <input type="text" class="form-control" id="db_database" name="db_database">
                </div>
                <div class="form-group">
                    <label for="db_username">Database Username:</label>
                    <input type="text" class="form-control" id="db_username" name="db_username">
                </div>
                <div class="form-group">
                    <label for="db_password">Database Password:</label>
                    <input type="password" class="form-control" id="db_password" name="db_password">
                </div>
                <button type="submit" class="btn btn-primary">Run Migrations</button>
                <p>step 2</p>
                <button type="submit" formaction="{{ route('run-seeder') }}" class="btn btn-success">Run Admin
                    Seeder</button>
            </form>
        </div>
    </div>
@endsection
