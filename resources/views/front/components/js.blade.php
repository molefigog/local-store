@php
    $owner = App\Models\Owner::orderBy('created_at', 'desc')
        ->select('email', 'whatsapp', 'facebook', 'address')
        ->first();
@endphp

<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@livewireScripts
@stack('telljs')
@stack('player')
<script>
    const darkMin = "{{ asset('frontend/css/dark.min.css') }}";
    const darkStyle = "{{ asset('frontend/css/dark-style.css') }}";

    const bootstrap = "{{ asset('frontend/css/bootstrap.min.css') }}";
    const style = "{{ asset('frontend/css/style.css') }}";

    function applyTheme(isDarkMode) {
        if (isDarkMode) {
            $('#cssTheme').attr('href', darkMin);
            $('link[href="' + style + '"]').attr('href', darkStyle);
            $('html').addClass('dark-mode');
        } else {
            $('#cssTheme').attr('href', bootstrap);
            $('link[href="' + darkStyle + '"]').attr('href', style);
            $('html').removeClass('dark-mode');
        }
    }

    function toggleMode() {
        let isDarkMode = localStorage.getItem('isDarkMode') === 'true';

        isDarkMode = !isDarkMode;
        localStorage.setItem('isDarkMode', isDarkMode);
        applyTheme(isDarkMode);

        // Change icon based on mode
        const iconMode = document.getElementById('iconMode');
        iconMode.className = isDarkMode ? 'icon-brightness_high' : 'icon-brightness_2';
    }

    function toggleMode2() {
    let isDarkMode = localStorage.getItem('isDarkMode') === 'true';

    isDarkMode = !isDarkMode;
    localStorage.setItem('isDarkMode', isDarkMode);
    applyTheme(isDarkMode);

    const iconMode = document.getElementById('icon');
    iconMode.className = isDarkMode ? 'icon-brightness_high' : 'icon-brightness_2';
}
    // Apply theme on page load
    let savedTheme = localStorage.getItem('isDarkMode') === 'true';
    applyTheme(savedTheme);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productDescriptions = document.querySelectorAll(".card-text");
        productDescriptions.forEach(description => {
            let text = description.textContent;
            const maxLength = 60;
            if (text.length > maxLength) {
                text = text.substring(0, maxLength);
                text = text.substring(0, Math.min(text.length, text.lastIndexOf(
                " ")));
                description.textContent = text + "...";
            }
        });
    });
</script>

@stack('pal')
@stack('upload_status')
<script>
          $('.owl-carousel').owlCarousel({
            loop:true,
            margin: 10,
            nav: true,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            autoplay:true, // Enable autoplay
            autoplayTimeout:3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
</script>
@if (session()->has('success'))
    <script>
        var notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
            duration: 7000, // 5 seconds in milliseconds
        });
        notyf.success('{{ session('success') }}');
    </script>
@endif

@if (session()->has('error'))
    <script>
        var notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
            duration: 7000, // 5 seconds in milliseconds
        });
        notyf.error('{{ session('error') }}');
    </script>
@endif

@if ($errors->has('email') || $errors->has('password'))
    <script>
        var notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
            duration: 7000, // 5 seconds in milliseconds
        });
        notyf.error('Invalid credentials');
    </script>
@endif
@stack('updated')
<script>
    function showSoldOutNotification() {
        var notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
            duration: 7000,
        });

        notyf.error('This item is already sold out.');
    }
</script>
@stack('mpesa')

  <script>
    function showStoreNotice() {
      // Check if 12 hours have passed since the last close
      const lastCloseTimestamp = localStorage.getItem('lastCloseTimestamp');
      const twelveHoursInMillis = 12 * 60 * 60 * 1000; // 12 hours in milliseconds

      if (!lastCloseTimestamp || Date.now() - lastCloseTimestamp > twelveHoursInMillis) {
        Swal.fire({
          title: 'Welcome to Our Store!',
          iconHtml:'<a class="btn btn-primary-outline btn-sm" href="{{ url('/all-music/create') }}"><i class="icon-upload"></i> Upload</a>',
          icon: 'info',
          confirmButtonText: 'Close',
        }).then((result) => {
          if (result.isConfirmed) {
            // Save the current timestamp when the close button is pressed
            localStorage.setItem('lastCloseTimestamp', Date.now());
          }
        });
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      const noticeLink = document.querySelector('a[href="#notice"]');

      if (noticeLink) {
        noticeLink.addEventListener('click', function (event) {
          event.preventDefault();
          showStoreNotice();
        });
      }
    });
  </script>
</body>

</html>
