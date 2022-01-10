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
});
$(function () {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF_TOKEN': token.content
            }
        });
    }
    $('div.alert').delay(3000).slideUp(300);
    $('.delete').on('click', function () {
        var node = $(this).parent().parent();
        if (confirm('Are you sure want to delete?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '/students/' + id,
                method: 'DELETE',
                success: function (data) {
                    if (data.result) {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                        node.hide();
                    }
                }
            });
        }
    });
    $('.custom-delete').on('click', function () {
        var node = $(this).parent().parent();
        if (confirm('Are you sure want to delete?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '/students/deletestudent/' + id,
                method: 'DELETE',
                success: function (data) {
                    if (data.result) {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                        node.hide();
                    }
                }
            });
        }
    });
});