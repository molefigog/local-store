@extends('admin.master')
 
@section('content')
<div class="container">
<br>
    <div class="searchbar mt-0 mb-4">
        <div class="row">

            <div class="col-md-6 text-center">

                <a class="btn btn-primary btn-sm" href="{{ route('products.create') }}"><i class=" icon-plus"></i>  Create New Page</a>
            </div>
        </div>
    </div>
                
     
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">All Pages</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-sm table-dark">
                <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
    {!! $products->links() !!}
</div>
</div>    
@endsection