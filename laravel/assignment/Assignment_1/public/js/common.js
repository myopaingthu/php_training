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
        if (confirm('Are you sure want to delete?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '/students/' + id,
                method: 'DELETE',
                success: function (data) {
                    if (data.result) {
                        $('.container:first-child').append(
                            "<div class='alert alert-success'>Student deleted successfully.</div>"
                        );
                        setTimeout(function () {
                            document.location.reload();
                        }, 3000);
                    }
                }
            });
        }
    });
});