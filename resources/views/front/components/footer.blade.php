@yield('audio')
@php
$artists = App\Models\User::orderBy('name')->get();
@endphp
{{-- <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
  <div class="col-md-4 d-flex align-items-center">
    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
      <i class="icon-library_music"> </i> </a>&nbsp;&nbsp;&nbsp;
    <span class="mb-3 mb-md-0 text-primary">©
      <script>
        document.write(new Date().getFullYear());
      </script> GENIUS WORKS ENT
    </span>
  </div>

  <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
    <li class="ms-3"><a class="text-primary" href="#"><i class="icon-facebook" width="24" height="24"></i></a></li>
    &nbsp;&nbsp;
    <li class="ms-3"><a class="text-primary" href="#"><i class="icon-whatsapp" width="24" height="24"></i></a></li>
    &nbsp;&nbsp;
    <li class="ms-3"><a class="text-primary" href="#"><i class="icon-twitter" width="24" height="24"></i></a></li>
    &nbsp;&nbsp;
  </ul>
</footer> --}}

<footer class="footer-07">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h2 class="footer-heading"><a href="/" class="logo">GW ENT</a></h2>

        <p class="">Select Songs By Artist</p>
        <ul class="nav">
          @foreach ($artists as $artist)
          <li class="nav-item">
            <a class="nav-link text-secondary" href="{{ route('songs-by-artist', rawurlencode($artist->name)) }}">
              {{ $artist->name }}
            </a>
          </li>
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