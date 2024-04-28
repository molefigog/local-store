@include('front.components.head')
@include('front.components.menu')

<body>

    <div class="container">
        @include('slider')

        {{ $slot }}


        @php

            $downloads = App\Models\Music::where('downloads', '>', 0)->orderBy('downloads', 'desc')->take(6)->get();
        @endphp
        <div class="card">
            <h5 class="card-header text-center">Most Downloaded Songs</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th>Art</th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th><i class="icon-download"></i></th>
                            {{-- <th>FILE</th> --}}
                            <th>Buy</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($downloads as $song)
                            <tr>
                                <td><img src="{{ $song->image ? \Storage::url($song->image) : '' }}" alt="Avatar"
                                        width="40" height="40"></td>
                                <td style="font-size: 10px">{{ $song->title ?? '-' }}</td>
                                <td style="font-size: 10px">{{ $song->artist ?? '-' }}</td>
                                <td style="font-size: 10px">{{ $song->downloads ?? '-' }}</td>
                                <td>

                                    <a href="{{ route('msingle.slug', ['slug' => urlencode($song->slug)]) }}"
                                        class="btn buy-button btn-sm">Buy R{{ $song->amount ?? '-' }}</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('layouts.modal')

    </div>

    @include('front.components.footer')



    <!--Main js file Style-->
    @include('front.components.js')
</body>

</html>
