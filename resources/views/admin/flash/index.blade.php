@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-blog">
            <div class="d-flex align-items-center">
                <h6 class="portion-title">Flash Manage</h6>

                <button class="btn btn-primary ms-4" data-bs-target="#flashModal" data-bs-toggle="modal">Add Flash
                </button>
            </div>

            <table class="table table-bordered data-table w-100">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


        </section>


        <div class="modal fade" id="flashModal" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h6 class="text-capitalize">Add Flash</h6>
                    </div>
                    <div class="modal-body" id="">
                        <form action="{{url('api/admin/flash')}}" id="flashForm" class="">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Flash Title</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Flash Title">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editFlashModal" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h6 class="text-capitalize">Edit Flash</h6>
                    </div>
                    <div class="modal-body" id="editFlashFormContent">

                    </div>
                </div>
            </div>
        </div>

    </main>


@endsection

@push('custom-js')
    <script>
        $('#flashForm').submit(function (e) {
            let token = localStorage.getItem('adminAccess')
            e.preventDefault();
            let form = $(this);

            let form_data = JSON.stringify(form.serializeJSON());
            let formData = JSON.parse(form_data)

            let url = form.attr('action');

            $.ajax({
                type: "post",
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': token
                },
                success: function (response) {
                    toastr.success(response.message)
                    location.reload()

                }, error: function (xhr, resp, text) {

                    if (xhr && xhr.responseJSON) {
                        let response = xhr.responseJSON;
                        if (response.status && response.status === 'validate_error') {
                            $.each(response.message, function (index, message) {
                                $('.' + message.field).addClass('is-invalid');
                                $('.' + message.field + '_label').addClass('text-danger');
                                $('.' + message.field + '_error').html(message.error);
                            });
                        }
                    }
                }
            });
        })

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url('api/admin/flash-list/all-list')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });


        function flashDeleteHandler(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: window.origin + '/api/admin/flash-list/'+id,
                        type: 'DELETE',
                        dataType: "json",
                        success: function (res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            setInterval(function () {
                                location.reload();
                            }, 1000)

                        },
                        error: function (xhr, resp, text) {
                            console.log(xhr);
                        },
                    });
                }
            })
        }


        function flashEditHandler(id){
            $('#editFlashModal').modal('show')
            $.ajax({
                type: "GET",
                url: window.origin + '/api/admin/flash-list/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    $('#editFlashFormContent').html('')
                    if(response.status === 'success'){
                        $('#editFlashFormContent').append(`
                             <form action="{{url('api/admin/flash-list/${response.data.id}')}}" id="editFlashForm" class="">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Flash Title</label>
                                    <input value='${response.data.name}' type="text" name="name" id="editName" class="form-control" placeholder="Flash Title">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        `)


                        $('#editFlashForm').submit(function (e) {
                            e.preventDefault();

                            let form = $(this);
                            let form_data = JSON.stringify(form.serializeJSON());
                            let formData = JSON.parse(form_data)

                            let url = form.attr('action');

                            $.ajax({
                                type: "patch",
                                url: url,
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                },
                                success: function (response) {
                                    toastr.success(response.message)

                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);

                                }, error: function (xhr, resp, text) {

                                    console.log(xhr && xhr.responseJSON)
                                }
                            });
                        })
                    }
                }, error: function (xhr, resp, text) {
                    console.log(xhr && xhr.responseJSON)
                }
            });
        }
    </script>
@endpush
