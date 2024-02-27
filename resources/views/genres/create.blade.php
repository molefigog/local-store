@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('genres.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('genres')
            </h4>

            <x-form
                method="POST"
                action="{{ route('genres.store') }}"
                has-files
                class="mt-4"
            >
                @include('genres.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('genres.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
