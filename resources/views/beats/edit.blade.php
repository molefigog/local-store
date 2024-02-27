@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('beats.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('music edit')
            </h4>
           
            <x-form
                method="PUT"
                action="{{ route('beats.update', $beat) }}"
                has-files
                class="mt-4"
            >
                @include('beats.form-inputs')

                <div class="mt-4 text-center">
                    <a
                        href="{{ route('beats.index') }}"
                        class="btn btn-light text-center"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('back')
                    </a>

                    <a
                        href="{{ route('beats.create') }}"
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
