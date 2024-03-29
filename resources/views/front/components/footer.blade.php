@yield('audio')
@php
$artists = App\Models\User::orderBy('name')->get();
@endphp

<footer class="footer-07">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h4 class="footer-heading"><a href="/" class="logo">GW ENT</a></h4>

        <p class="">Select Songs By Artist</p>
        <ul class="nav">
          @foreach ($artists as $artist)
          @php
            $musicCount = DB::table('music_user')->where('user_id', $artist->id)->count();
          @endphp
        
          @if ($musicCount > 0)
            <li class="nav-item text-uppercase">
              <a class="nav-link text-secondary" href="{{ route('songs-by-artist', rawurlencode($artist->name)) }}">
                {{ $artist->name }}
              </a>
            </li>
          @endif
        @endforeach
        </ul>

        <ul class="nav justify-content-center">
          <li class="social"><a href="https://www.facebook.co.za/elliot.gog" target="_blank" class="nav-link"><span class="icon-facebook"></span></a></li>
          <li class="social"><a href="https://twitter.com/Molefi18186414" target="_blank" class="nav-link"><span class="icon-twitter"></span></a></li>
          <li class="social"><a href="mailto:molefigw@gmail.com" target="_blank" class="nav-link"><span class="icon-mail_outline"></span></a></li>
      </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-12 text-center">
        <p class="copyright">
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | GENIUS WORKS ENT <i class="ion-ios-heart" aria-hidden="true"></i> by <a
            href="mailto:molefigw@gmail.com" target="_blank">Elliot Molefi</a>
        </p>
      </div>
    </div>
  </div>
</footer>