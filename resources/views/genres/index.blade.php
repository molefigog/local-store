@extends('admin.master')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
               
                <a href="{{ route('genres.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('create')
                </a>
                
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('genres.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('genres.inputs.title')
                            </th>
                            <th class="text-left">
                                @lang('genres.inputs.image')
                            </th>
                            <th class="text-center">
                                @lang('actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($genres as $genre)
                        <tr>
                            <td>{{ $genre->title ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $genre->image ? \Storage::url($genre->image) : '' }}"
                                />
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    
                                    <a
                                        href="{{ route('genres.edit', $genre) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                        <i class="icon-edit"></i>
                                        </button>
                                    </a>
                                   
                                    <a
                                        href="{{ route('genres.show', $genre) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >  
                                        <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                   
                                    <form
                                        action="{{ route('genres.destroy', $genre) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >     
                                        <i class=" icon-trash-empty"></i>
                                        </button>
                                    </form>
                                  
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                @lang('no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"> {{ $genres->links('custom-pagination') }}</td>
                           
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
