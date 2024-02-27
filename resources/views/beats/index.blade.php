@extends('admin.master')

@section('content')
    <div class="container">

        <div class="searchbar mt-0 mb-4">
            <div class="row">

                <div class="col-md-6 text-right">

                    <a href="{{ route('beats.create') }}" class="btn rounded-pill btn-outline-primary"
                        title="add new song">
                        <i class=" icon-plus"></i> Create
                    </a>

                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">All beat</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th>ARTIST</th>
                            <th>TITLE</th>
                            <th>PRICE</th>
                            <th>COVER</th>
                            {{-- <th>FILE</th> --}}
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse(Auth::user()->role == 1 ? $beats : $userbeat as $beat)
                            <tr>
                                <td>{{ $beat->artist ?? '-' }}</td>
                                <td>{{ $beat->title ?? '-' }}</td>
                                <td>{{ $beat->amount ?? '-' }}</td>

                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="" title=""
                                            data-bs-original-title="Lilian Fuller">
                                            <img src="{{ $beat->image ? \Storage::url($beat->image) : '' }}"
                                                alt="Avatar" class="" style="width:40px; height:40;">
                                        </li>
                                    </ul>
                                </td> 
                               {{-- <td>
                                     @if ($beat->file)
                                        <a href="{{ \Storage::url($beat->file) }}" target="blank"><i
                                                class="icon-download"></i>&nbsp;</a>
                                    @else
                                        -
                                    @endif
                                </td> --}}

                                <td >
                                   
                                            <a class="" href="{{ route('beats.edit', $beat) }}">
                                                <button type="button" class="btn rounded-pill btn-icon btn-sm btn-outline-secondary">
                                                    <i class="icon-edit"></i>
                                                </button>
                                            </a>

                                            {{-- <a class="dropdown-item" href="{{ route('all-beat.show', $beat) }}">
                                                <button type="button" class="btn rounded-pill btn-icon btn-outline-secondary">
                                                    <i class="icon-eye"></i>
                                                </button>
                                            </a> --}}

                                            <form class="" action="{{ route('beats.destroy', $beat) }}"
                                                method="POST" onsubmit="return confirm('{{ __('are_you_sure') }}')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn rounded-pill btn-icon btn-sm btn-outline-secondary text-danger">
                                                    <i class=" icon-trash-empty"></i>
                                                </button>
                                            </form>
                                        
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    @lang('no_items_found')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination">
            @if (Auth::user()->role == 1)
                {{ $beats->links('custom-pagination') }}
            @else
                {{ $userbeat->links('custom-pagination') }}
            @endif
        </div>
    </div>
@endsection

