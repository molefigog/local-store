@extends('admin.master')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
           
            <div class="col-md-6 text-right">
                
                <a
                    href="{{ route('settings.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon-plus"></i> @lang('create')
                </a>
                
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title text-center">@lang('title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('site')
                            </th>
                            <th class="text-left">
                                @lang('description')
                            </th>
                            <th class="text-left">
                                @lang('tagline')
                            </th>
                            <th class="text-left">
                                @lang('image')
                            </th>
                            <th class="text-left">
                                @lang('logo')
                            </th>
                            <th class="text-left">
                                @lang('favicon')
                            </th>
                            <th class="text-center">
                                @lang('actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings as $setting)
                        <tr>
                            <td>{{ $setting->site ?? '-' }}</td>
                            <td>{{ $setting->description ?? '-' }}</td>
                            <td>{{ $setting->tagline ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $setting->image ? \Storage::url($setting->image) : '' }}"
                                />
                            </td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $setting->logo ? \Storage::url($setting->logo) : '' }}"
                                />
                            </td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $setting->favicon ? \Storage::url($setting->favicon) : '' }}"
                                />
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                   
                                    <a
                                        href="{{ route('settings.edit', $setting) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon-create"></i>
                                        </button>
                                    </a>
                                   
                                    <a
                                        href="{{ route('settings.show', $setting) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                  
                                    <form
                                        action="{{ route('settings.destroy', $setting) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon-trash-empty"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                @lang('no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{!! $settings->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
