function displayImg(input, displayTo) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + displayTo).attr('src', e.target.result);
            $(input).siblings('.custom-file-label').html(input.files[0].name)
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#' + displayTo).attr('src', "./images/music-logo.jpg");
        $(input).siblings('.custom-file-label').html("Choose File")
    }
}

function displayFileText(input) {
    if (!!input.files[0].name)
        $(input).siblings('.custom-file-label').html(input.files[0].name);
    else
        $(input).siblings('.custom-file-label').html("Choose File");
}

function start_loader() {
    Swal.fire({
        title: 'Uploading...',
        allowOutsideClick: false,
        showConfirmButton: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}
function end_loader() {
    Swal.close();
}
$(function () {
    setTimeout(() => {
        end_loader();
    }, 500);

    $('#music-form').submit(function (e) {
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        var el = $('<div>');
        el.addClass("alert alert-danger err-msg'");
        el.hide();
        start_loader();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: mp3StoreRoute,
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('AJAX Error:');
                console.log('Status:', textStatus);
                console.log('Error:', errorThrown);
                console.log('Response:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unknown error occurred. Please try again later.'
                });
                end_loader();
            },
            success: function (resp) {
                console.log('Response:', resp);
                if (resp && resp.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'File uploaded: ' + resp.msg,
                        timer: 4000,
                    });
                    setTimeout(() => {
                        console.log('Redirecting...');
                        window.location.href = MusicIndexPage;
                    }, 3000);
                } else {
                    console.error('Unknown response:', resp);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unknown error occurred.'
                    });
                }
                end_loader();
            }
        });
    });
});