@extends('admin.master')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            
            <div class="col-md-6 text-right">
                
                <a href="{{ route('owners.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('create')
                </a>
               
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('email')
                            </th>
                            <th class="text-left">
                                @lang('whatsapp')
                            </th>
                            <th class="text-left">
                                @lang('facebook')
                            </th>
                            <th class="text-left">
                                @lang('address')
                            </th>
                            <th class="text-center">
                                @lang('actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($owners as $owner)
                        <tr>
                            <td>{{ $owner->email ?? '-' }}</td>
                            <td>{{ $owner->whatsapp ?? '-' }}</td>
                            <td>{{ $owner->facebook ?? '-' }}</td>
                            <td>{{ $owner->address ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                   
                                    <a
                                        href="{{ route('owners.edit', $owner) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >   edit
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                   
                                    <a
                                        href="{{ route('owners.show', $owner) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >   view
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                   
                                    <form
                                        action="{{ route('owners.destroy', $owner) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        > Delete
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{!! $owners->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
