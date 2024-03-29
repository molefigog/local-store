@extends('admin.master')

@section('content')
<div class="container">
    <div class="card bg-transparent">
        <div class="card-body bg-transparent">
            <h4 class="card-title text-center">
                <a href="{{ route('beats.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('Beats')
            </h4>
            @if(Auth::user()->upload_status == 1)
            <x-form
                action="" id="music-form"
                has-files
                class="mt-4"
            >
          
                @include('beats.form-inputs')

                <div class="mt-4 text-center">
                    <a
                        href="{{ route('beats.index') }}"
                        class="btn btn-light text-center"
                    >
                        <i class="icon-arrow-left"></i>
                        @lang('back')
                    </a>

                    <button type="submit" class="btn btn-primary text-center" form="music-form">
                        <i class="fa fa-save"></i>
                        @lang('create')
                    </button>
                </div>
            </x-form>
            @else
            <p>pay R100 to upload 8 song </p>
            @endif
        </div>
    </div>
</div>
@endsection
@push('tinymce')
<script>
    const mp3StoreRoute = "{{ route('beats.store') }}";
    const MusicIndexPage = "{{ url('beats') }}";
  </script>
<script src="https://cdn.tiny.cloud/1/nxk4prfbs31hvdbw9gm9p620mx2kdsqfv8lqdytidhb0mrg9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
       tinymce.init({
           // Select the element(s) to add TinyMCE to using any valid CSS selector
           selector: "#myTextarea",
           plugins: "preview powerpaste casechange searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample advtable table charmap pagebreak nonbreaking anchor advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter permanentpen pageembed linkchecker emoticons export",
           height: '400px',
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
