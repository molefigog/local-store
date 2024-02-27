@extends('admin.master')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection
@push('tinymce')
<script src="https://cdn.tiny.cloud/1/nxk4prfbs31hvdbw9gm9p620mx2kdsqfv8lqdytidhb0mrg9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
       tinymce.init({
           // Select the element(s) to add TinyMCE to using any valid CSS selector
           selector: "#myTextarea",
           plugins: "preview powerpaste casechange searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample advtable table charmap pagebreak nonbreaking anchor advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter permanentpen pageembed linkchecker emoticons export",
           height: '700px',
           toolbar_sticky: true,
           icons: 'thin',
           autosave_restore_when_empty: true,
           content_style: `
               body {
                   background: #fff;
               }

               @media (min-width: 840px) {
                   html {
                       background: #eceef4;
                       min-height: 100%;
                       padding: 0 .5rem
                   }

                   body {
                       background-color: #fff;
                       box-shadow: 0 0 4px rgba(0, 0, 0, .15);
                       box-sizing: border-box;
                       margin: 1rem auto 0;
                       max-width: 820px;
                       min-height: calc(100vh - 1rem);
                       padding:4rem 6rem 6rem 6rem
                   }
               }
           `,
       });
   </script>
@endpush