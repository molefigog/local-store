const loaderHTML = document.createElement('div');
loaderHTML.setAttribute('id', 'pre-loader');
loaderHTML.innerHTML = `
    <div id='loader-container'>
        <div></div>
        <div></div>
        <div></div>
    </div>
`;

window.start_loader = function () {
    const progressBar = document.querySelector('.progress.ajax-progress-bar');
    if (progressBar) {
        progressBar.appendChild(loaderHTML);
    }
};

window.end_loader = function () {
    const preLoader = document.getElementById('pre-loader');
    if (preLoader) {
        preLoader.remove();
    }
};
 

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
var audio = new Audio();
var slider;
var currentPlayID;
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
                console.log('Response:', xhr.responseText);  // Log the response

                // Display an error message using SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unknown error occurred. Please try again later.'
                });

                end_loader();
            },

            success: function(resp) {
                console.log('Response:', resp);
            
                if (resp && resp.status === 'success') {
                    // Display a success message using SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'File uploaded: ' + resp.msg,
                        timer: 3000,
                    });
            
                    // Redirect to the desired URL after a 3-second delay
                    setTimeout(() => {
                        console.log('Redirecting...');
                        window.location.href = MusicIndexPage;  // Adjust this to the desired URL
                    }, 3000);
                } else {
                    console.error('Unknown response:', resp);
                    // Display an error message using SweetAlert2
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
