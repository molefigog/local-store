@php
    $owner = App\Models\Owner::orderBy('created_at', 'desc')
        ->select('email', 'whatsapp', 'facebook', 'address')
        ->first();
@endphp


<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

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
    }

    // Apply theme on page load
    let savedTheme = localStorage.getItem('isDarkMode') === 'true';
    applyTheme(savedTheme);
</script>

<script>
    // Truncate text for each product description
    document.addEventListener("DOMContentLoaded", function() {
        const productDescriptions = document.querySelectorAll(".card-text");
        productDescriptions.forEach(description => {
            let text = description.textContent;
            const maxLength = 60; // Set the maximum length of the text
            if (text.length > maxLength) {
                text = text.substring(0, maxLength); // Truncate the text
                text = text.substring(0, Math.min(text.length, text.lastIndexOf(
                " "))); // Cut off at the last space to avoid cutting off in the middle of a word
                description.textContent = text + "..."; // Add ellipsis
            }
        });
    });
</script>

@stack('pal')
@stack('upload_status')

<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

@stack('upload_status')
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

<script>
    function showSoldOutNotification() {
        var notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
            duration: 7000, // 7 seconds in milliseconds
        });

        notyf.error('This item is already sold out.');
    }
</script>

</body>

</html>
