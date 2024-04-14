@include('front.components.head')
@include('front.components.menu')

<br>
<div class="container">
    @yield('content')



    @include('layouts.modal')

</div>

@include('front.components.footer')



<!--Main js file Style-->
@include('front.components.js')
</body>

</html>
