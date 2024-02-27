@extends('admin.master')

@section('content')
<div class="container">
    <br>
    <div class="search-container">@include('flash-message')</div>
    
    <div class="card">
            <h5 class="card-header text-center">user list</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-sm table-dark">
        <thead>
            <tr>
                <th>Name</th>
                <th>number</th>
                <th>Balance</th>
                <th>Credits</th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody  class="table-border-bottom-0">
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobile_number }}</td>
                    <td>{{ $user->balance }}</td>
                    @if(Auth::user()->role == 1)
                    <td>
                        <form action="{{ route('creditup', ['id' => $user->id]) }}" method="POST">
                            @csrf

                     <div class="input-group">
                        <input type="number" name="amount"  class="form-control" style="width: 40px;" placeholder="amount" aria-label="amount" aria-describedby="button-addon2"step="0.01" required>
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                        </form>

                    </td>
                    <td>
                        <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete User</button>
                        </form>
                        
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
