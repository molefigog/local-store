@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-music.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('music edit')
            </h4>
           
            <x-form
                method="PUT"
                action="{{ route('all-music.update', $music) }}"
                has-files
                class="mt-4"
            >
                @include('all_music.form-inputs')

                <div class="mt-4 text-center">
                    <a
                        href="{{ route('all-music.index') }}"
                        class="btn btn-light text-center"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('back')
                    </a>

                    <a
                        href="{{ route('all-music.create') }}"
                        class="btn btn-light text-center"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('create')
                    </a>

                    <button type="submit" class="btn btn-primary text-center">
                        <i class="icon ion-md-save"></i>
                        @lang('update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
