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
    var id = $('#student-id').val();
    $.ajax({
        url: '/api/apistudents/' + id,
        method: 'GET',
        success: function (data) {
            if (data.result) {
                $.each(data.data, function (key, value) {
                    $(`#${key}`).val(value);
                });
                $(`select option[value="${data.data.major.id}"]`).attr("selected", "selected");
            }
        }
    });
    $('#submit-post').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            url: '/api/apistudents/' + id,
            method: 'PATCH',
            data: $('#edit-form').serialize(),
            success: function (data) {
                if (data.result) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
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