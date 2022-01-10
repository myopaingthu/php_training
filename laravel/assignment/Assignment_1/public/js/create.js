$(function () {
    $.ajax({
        url: '/api/apistudents/majors',
        method: 'GET',
        success: function (data) {
            if (data.result) {
                data.data.forEach(major => {
                    $('select').append(
                        `<option value="${major.id}">${major.name}</option>`
                    );
                });
            }
        }
    });
    $('#submit-post').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/api/apistudents',
            method: 'POST',
            data: $('#post-form').serialize(),
            success: function (data) {
                if (data.result) {
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    setTimeout(function () {
                        location.href = "/api/students/show";
                    }, 3000);
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    $('.container:first-child').append(
                        `<div class="alert alert-danger">
                        <strong>Whoops! Something went wrong!</strong>
                        <br><br>
                        <ul class="error">
                        </ul>
                        </div>`
                    );
                    $.each(err.responseJSON.errors, function (key, value) {
                        $('.error').append(
                            `<li>${value[0]}</li>`
                        );
                        $(`#${key}`).addClass('is-invalid');
                    });
                    $('div.alert').delay(10000).slideUp(300);
                }
            }
        });
    });
});