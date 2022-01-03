$(function () {
    $('div.alert').delay(3000).slideUp(300);
    let token = document.head.querySelector('meta[name="csrf-token"]');
    $('.delete').on('click', function () {
        if (confirm('Are you sure want to delete?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '/students/' + id,
                method: 'DELETE',
                data: {
                    _token: token.content
                },
                success: function () {
                    $('.container:first-child').append(
                        "<div class='alert alert-success'>Student deleted successfully.</div>"
                    );
                    setTimeout(function () {
                        document.location.reload();
                    }, 3000);
                }
            });
        }
    });
});