@include('front.components.head')
@include('front.components.menu')



<div class="container">
    @include('slider')
    <hr>
    @yield('content')

    <br>


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
                                <td><img src="{{ $song->image ? \Storage::url($song->image) : '' }}"
                                    alt="Avatar" width="40" height="40"></td>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const songElements = document.querySelectorAll(".ms_weekly_box");

        songElements.forEach(song => {
            song.addEventListener("click", function() {
                const title = this.getAttribute("data-title");
                const artist = this.getAttribute("data-artist");
                const image = this.getAttribute("data-image");
                const url = this.getAttribute("data-url");

                updateOGMetaTags(title, artist, image, url);
            });
        });

        function updateOGMetaTags(title, artist, image, url) {
            document.querySelector('meta[property="og:title"]').setAttribute("content", title);
            document.querySelector('meta[property="og:description"]').setAttribute("content", artist);
            document.querySelector('meta[property="og:image"]').setAttribute("content", image);
            document.querySelector('meta[property="og:url"]').setAttribute("content", url);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    var artistName = document.getElementById('artistName');
    if (artistName.textContent.length === 16) {
        artistName.classList.add('long-artist');
    }
});
</script>
</body>

</html>
