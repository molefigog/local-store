@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center">
                <a href="{{ route('settings.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('Settings')
            </h4>

            <x-form
                method="POST"
                action="{{ route('settings.store') }}"
                has-files
                class="mt-4"
            >
                @include('settings.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('settings.index') }}"
                        class="btn btn-light"
                    >
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
