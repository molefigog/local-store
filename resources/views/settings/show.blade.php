@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center">
                <a href="{{ route('settings.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('site')</h5>
                    <span>{{ $setting->site ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('description')</h5>
                    <span>{{ $setting->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('tagline')</h5>
                    <span>{{ $setting->tagline ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('image')</h5>
                    <x-partials.thumbnail
                        src="{{ $setting->image ? \Storage::url($setting->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('logo')</h5>
                    <x-partials.thumbnail
                        src="{{ $setting->logo ? \Storage::url($setting->logo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('favicon')</h5>
                    <x-partials.thumbnail
                        src="{{ $setting->favicon ? \Storage::url($setting->favicon) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('settings.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('back')
                </a>

                @can('create', App\Models\Setting::class)
                <a href="{{ route('settings.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
