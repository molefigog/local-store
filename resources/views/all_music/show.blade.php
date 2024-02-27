@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-music.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('artist')</h5>
                    <span>{{ $music->artist ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('title')</h5>
                    <span>{{ $music->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('amount')</h5>
                    <span>{{ $music->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('image')</h5>
                    <x-partials.thumbnail
                        src="{{ $music->image ? \Storage::url($music->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('demo')</h5>
                    @if($music->demo)
                    <a href="{{ \Storage::url($music->demo) }}" target="blank"
                        ><i class="icon ion-md-download"></i>&nbsp;Download</a
                    >
                    @else - @endif
                </div>
                <div class="mb-4">
                    <h5>@lang('file')</h5>
                    @if($music->file)
                    <a href="{{ \Storage::url($music->file) }}" target="blank"
                        ><i class="icon ion-md-download"></i>&nbsp;Download</a
                    >
                    @else - @endif
                </div>
                <div class="mb-4">
                    <h5>@lang('description')</h5>
                    <span>{{ $music->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('genre')</h5>
                    <span>{{ $music->genre ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('all-music.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('back')
                </a>

                @can('create', App\Models\Music::class)
                <a href="{{ route('all-music.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
