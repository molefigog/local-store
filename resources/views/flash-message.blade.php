@if ($message = Session::get('success'))
    @php
        $alertType = 'success';
        $title = 'Success!';
    @endphp
@elseif ($message = Session::get('error'))
    @php
        $alertType = 'error';
        $title = 'Error!';
    @endphp
@elseif ($message = Session::get('warning'))
    @php
        $alertType = 'warning';
        $title = 'Warning!';
    @endphp
@elseif ($message = Session::get('info'))
    @php
        $alertType = 'info';
        $title = 'Info!';
    @endphp
@endif

@if(isset($alertType))
    <script>
        Swal.fire({
            title: '{{ $title }}',
            text: '{{ $message }}',
            icon: '{{ $alertType }}',
            showProgressSteps: true,
            timer: 36000,
            customClass: {
                popup: 'small-popup',
            },
        });
    </script>
@endif

@if($errors->has('login'))
    <script>
        let errorMessage = "{{ $errors->first('login') }}";
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: errorMessage,
        });
    </script>
@endif

@if($errors->has('password'))
    <script>
        let errorMessage = "{{ $errors->first('password') }}";
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: errorMessage,
        });
    </script>
@endif
