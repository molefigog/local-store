@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('owners.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('Contact info')
            </h4>

            <x-form
                method="POST"
                action="{{ route('owners.store') }}"
                class="mt-4"
            >
                @include('owners.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('owners.index') }}" class="btn btn-light">
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
