@extends('admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('genres.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('genres.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('title')</h5>
                    <span>{{ $genre->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('image')</h5>
                    <x-partials.thumbnail
                        src="{{ $genre->image ? \Storage::url($genre->image) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('genres.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('back')
                </a>

                @can('create', App\Models\Genre::class)
                <a href="{{ route('genres.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
