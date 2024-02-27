@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('owners.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('email')</h5>
                    <span>{{ $owner->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('whatsapp')</h5>
                    <span>{{ $owner->whatsapp ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('facebook')</h5>
                    <span>{{ $owner->facebook ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('address')</h5>
                    <span>{{ $owner->address ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('owners.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('back')
                </a>

                @can('create', App\Models\Owner::class)
                <a href="{{ route('owners.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
