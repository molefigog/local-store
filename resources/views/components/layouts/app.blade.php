@include('front.components.head')
@include('front.components.menu')

<body>

    <div class="container-fluid">
        @include('slider')

        {{ $slot }}


        @php

            $downloads = App\Models\Music::where('downloads', '>', 0)->orderBy('downloads', 'desc')->take(6)->get();
        @endphp
        <style>
            .card {
                flex-direction: row;
                max-width: 30em;
                border: 0;

                color: #fff;
                box-shadow: 0 7px 7px rgba(0, 0, 0, 0.18);
            }

            /* .card img {
                max-width: 25%;
                margin: auto;
                padding: 0.5em;
                border-radius: 0.7em;
            } */

            .card-body {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .text-section {
                max-width: 60%;
            }

            .cta-section {
                max-width: 40%;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                justify-content: space-between;
            }

            .cta-section .btn {
                padding: 0.2em 0.5em;
                font-size: 1em;
                color: #696969;
            }

            .card-text {
                letter-spacing: 0.1em;
            }


            #content {
                position: relative;
                overflow: hidden;
                background-color: #FFF;
            }

            .bgcolor2 {
                background-color: #131722 !important;
            }
        </style>

        <div class="articles">
            @foreach ($downloads as $song)
                <div class="card dark mb-3">
                    <img src="{{ $song->image ? \Storage::url($song->image) : '' }}" style="width: 120px; height: 120px;"
                        alt="...">

                    <div class="card-body">
                        <div class="text-section">
                            <h5 class="card-title fw-bold">{{ $song->artist ?? '-' }}</h5>
                            <p class="card-text">{{ $song->title ?? '-' }}</p>
                        </div>
                        <div class="cta-section">
                            <div><i class="icon-cloud-download"></i> {{ $song->downloads ?? '-' }} </div>
                            <a href="{{ route('msingle.slug', ['slug' => urlencode($song->slug)]) }}"
                                class="btn buy-button btn-sm">Buy R{{ $song->amount ?? '-' }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        @include('layouts.modal')

    </div>

    @include('front.components.footer')



    <!--Main js file Style-->
    @include('front.components.js')
</body>

</html>
