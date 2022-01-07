$(function () {
    $.ajax({
        url: '/api/apistudents',
        method: 'GET',
        success: function (data) {
            if (data.result) {
                data.data.forEach(student => {
                    $('tbody').append(
                        `<tr>
                            <td>${student.name}</td>
                            <td>${student.email}</td>
                            <td>${student.major.name}</td>
                            <td>${student.phone}</td>
                            <td>${student.address}</td>
                            <td>${student.dob}</td>
                            <td>${student.created_at}</td>
                            <td>
                            <a href="/api/students/showEditView/${student.id}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm del-btn"
                                data-id="${student.id}">Delete
                            </button>
                            </td>
                        </tr>`
                    );
                });
            }
        }
    });
    $(document).on('click', '.del-btn', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/apistudents/' + id,
                    method: 'DELETE',
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
                                document.location.reload();
                            }, 3000);
                        }
                    }
                });
            }
        });
    });
});