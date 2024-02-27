@php
$apiKey = '863c6f17965b59a056305e51';
$baseCurrency = 'ZAR';
$targetCurrency = 'USD';
$amount = $beat->amount; // Assuming $beat->amount contains the ZAR amount you want to convert

// Make API request to get the exchange rate
$apiUrl = "https://open.er-api.com/v6/latest/{$baseCurrency}?apikey={$apiKey}";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if ($data && isset($data['rates'][$targetCurrency])) {
    // Perform the conversion
    $exchangeRate = $data['rates'][$targetCurrency];
    $convertedAmount = $amount * $exchangeRate;

    // Round the converted amount to 2 decimal places (you can adjust this as needed)
    $convertedAmount = round($convertedAmount, 2);

    // Assign the converted amount to $amount
    $amount = $convertedAmount;
} else {
    // Handle the case where the exchange rate data is not available
    $amount = "Failed to retrieve exchange rate data.";
}


@endphp


@extends('layouts.master')

@section('content')
    
    <div class="container mt-5">
        <div class="row">
            <div class="card-img-wrapper col-md-6 ">
                <img src="{{ $beat->image ? \Storage::url($beat->image) : '' }}" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2>{{ $beat->title ?? '-' }}</h2>
                <p class="text-muted">{{ $beat->description ?? '-' }}</p>
                <P> Size: {{ $beat->size ?? '-' }}MB Duration:
                    <span>{{ $beat->duration ?? '-' }}</span>
                </P>
                <h3 class="text-success">Price R{{ $beat->amount }} </h3>
                <p>
                    Genre <span
                        class="text-success">{{ $beat->genre ? $beat->genre->title : '-' }}</span>
                </p>
                <div class="mb-3">
                    @if ($beat->used == 1)
                        <div id="wrap">
                            <button type="submit" class="btn buy-button2" onclick="showSoldOutNotification()">
                                <span class="circle2"><i class="icon-download"></i></span>
                                <span class="title2 gee">Sold</span>
                            </button>
                        </div>
                    @else
                        <div id="wrap">
                            <form action="{{ route('buy-beat') }}" method="post">
                                @csrf
                                <input type="hidden" name="beat_id" value="{{ $beat->id }}">
                                <button type="submit" class="btn buy-button2">
                                    <span class="circle2"><i class="fa fa-shopping-cart"></i></span>
                                    <span class="title2 gee">Buy R{{ $beat->amount }}</span>

                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if ($beat->used == 1)
                       <p>---</p> 
                    @else
                        <div id="wrap">
                            <form id="buyNowForm" action="{{$Paypal}}" method="post">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="amount" value="{{$amount}}">
                                <input type="hidden" name="currency_code" value="{{$currency}}">
                                <input type="hidden" name="business" value="{{$PAYPAL_ID }}">
                                
                                <input type="hidden" name="custom" value="{{$userId}}">
    
                                <input type="hidden" name="item_name" value="{{$beat->title}}">
                                <input type="hidden" name="item_number" value="{{$beat->id}}">
                                <input type="hidden" name="return" value="{{ route('success') }}">
                                <input type="hidden" name="cancel_return" value="{{ url('cancel') }}">
                                <input type="hidden" name="notify_url" value="{{ url('ipn') }}">
    
                                <button type="submit" class="btn buy-button2" title="secure online payment with paypal"><i class="icon-paypal"></i> Buy ${{$amount}}</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div id="wrapper">
                    <audio preload="auto" controls>
                        <source src="{{ \Storage::url($beat->demo) }}">
                    </audio>
                   
                </div>

                <div>
                    <h5>share to <i class="icon-share2"></i></h5>
                    {!! $shareButtons !!}
                </div>
                <hr>
            </div>
        </div>
    </div>
    <br>
@endsection
@section('head')
    <title>{{ $metaTags['title'] }}</title>
    <meta name="description" content="{{ $metaTags['description'] }}">
    <meta property="og:title" content="{{ $metaTags['title'] }}">
    <meta property="og:image" content="{{ $metaTags['image'] }}">
    <meta property="og:description" content="{{ $metaTags['description'] }}">
    <meta property="og:url" content="{{ $metaTags['url'] }}" />
    <meta name="keywords" content="{{ $metaTags['keywords'] }}">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $metaTags['title'] }}" />
    <meta name="twitter:description" content="{{ $metaTags['description'] }}" />
    <meta name="twitter:image" content="{{ $metaTags['image'] }}" />
    <meta property="fb:app_id" content="337031642040584" />
    <meta property="og:type" content="beat.song">
@endsection

@push('ghead')
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MT3JSPQW');
    </script>
    <!-- End Google Tag Manager -->
@endpush

@push('gbody')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT3JSPQW" height="0" width="0"
            style="display:none;visibility:hidden">
        </iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endpush

@push('aplayer')
<link rel="stylesheet" href="{{ asset('frontend/css/audioplayer.css') }}">
@endpush

@push('player')
    <script src="{{ asset('frontend/js/audioplayer.js') }}"></script>
    <script>
        $(function() {
            $('audio').audioPlayer();
        });
    </script>
    <script>
        document.getElementById('buyNowForm').addEventListener('submit', function(event) {
            var userId = document.getElementsByName('custom')[0].value;
    
            // Check if userId is null
            if (!userId) {
                var intendedUrl = '{{ route('msingle.slug', ['slug' => urlencode($beat->slug)]) }}';
                window.sessionStorage.setItem('intended_url', intendedUrl);
    
                // Redirect to login page
                window.location.href = '{{ route('login') }}';
                event.preventDefault(); // Prevent the form from being submitted
            }
            // If userId is not null, the form will be submitted as usual
        });
    </script>
@endpush

{{-- @push('pal')
<script src="https://www.paypal.com/sdk/js?client-id=AeRSIFbaU4PkzhnTfU5FqhzAc6itH1ZbVAq7ODXTc_FXyELjk7ZGWyJcjYk1TJPOpMIlSSJK-nyWPbjz"></script>
<script>
    async function convertZARtoUSD(amount) {
        // Replace 'YOUR_API_KEY' with your actual Open Exchange Rates API key
        const apiKey = '863c6f17965b59a056305e51';
        const apiUrl = `https://open.er-api.com/v6/latest/ZAR?apikey=${apiKey}`;

        try {
            const response = await fetch(apiUrl);
            const data = await response.json();

            const exchangeRate = data.rates.USD;
            const convertedAmount = (amount * exchangeRate).toFixed(2);

            return convertedAmount;
        } catch (error) {
            console.error('Error fetching conversion data:', error);
            return null;
        }
    }

    paypal.Buttons({
    createOrder: function (data, actions) {
        // Convert the amount from ZAR to USD
        return convertZARtoUSD('{{ $beat->amount }}').then(function (convertedAmount) {
            if (convertedAmount !== null) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: convertedAmount
                        }
                    }]
                });
            } else {
                // Handle conversion error
                alert('Error converting amount');
                throw new Error('Error converting amount');
            }
        });
    },
    onApprove: (function (data, actions) {
        // Additional data you want to pass
        const additionalData = {
            beat_id: '{{ $beat->id }}',
           
            // Add more parameters as needed
        };

        // Returning the actual onApprove function
        return function () {
            return actions.order.capture().then(function (details) {
                // Merge additional data with details
                const requestData = { ...additionalData, orderID: data.orderID };

                // Example AJAX call
                fetch('{{ url("paypal-success") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(requestData)
                })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response from your server (success or error)
                        if (data.success) {
                            // Redirect or show a success message
                            window.location.href = '{{ route("purchased-beats") }}';
                        } else {
                            // Show an error message
                            alert('Error processing payment');
                        }
                    });
            });
        };
    })()
}).render('#paypal-button-container');

</script>
@endpush --}}



