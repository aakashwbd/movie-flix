@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-package">
            <h6 class="portion-title">Notification</h6>

            <button class="btn btn-primary rounded-32 my-3" data-bs-target="#notificationModal" data-bs-toggle="modal"> Send</button>

            <table class="table table-bordered data-table mt-5">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>


        <div class="modal fade" id="notificationModal" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h6 class="text-capitalize">Send Notication</h6>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('api/admin/notification/store')}}" id="notificationForm">
                        <div class="form-group my-3">
                            <input type="text" name="title" class="form-control " placeholder="title">
                        </div>

                            <div class="form-group my-3">
                                <textarea name="description" class="form-control " placeholder="Description"></textarea>
                            </div>

                            <div class="form-group my-3">
                                <select name="package_id" id="packages" class="form-select">

                                </select>
                            </div>

{{--                            <div class="form-group my-3">--}}
{{--                                <select name="video_id" id="" class="form-select">--}}
{{--                                    <option value="" selected>Select Month</option>--}}
{{--                                    <option value="jan">jan</option>--}}
{{--                                    <option value="feb">feb</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="form-group my-3">
                                <input type="text" name="link" class="form-control " placeholder="External Link">
                            </div>

                            <button type="submit" class="btn btn-primary my-3">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('custom-js')
    <script>


        function notificationDeleteHandler(id) {
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
                        url: window.origin + '/api/admin/notification/'+id,
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

        $(document).ready(function (){
            $.ajax({
                type: 'get',
                url: window.origin + '/api/admin/package/all-list',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                response.data.forEach(item=>{
                    console.log(item)
                    $('#packages').append(`
                        <option value="${item.id}">${item.name}</option>

                    `)
                })
                },
                error: function (xhr, resp, text) {
                    console.log(xhr, resp)
                }
            });
        })

        $('#notificationForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let form_data = JSON.stringify(form.serializeJSON());
            let formData = JSON.parse(form_data);
            let url = form.attr("action");

            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    toastr.success(response.message)
                    location.reload()
                },
                error: function (xhr, resp, text) {
                    console.log(xhr, resp)
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
                ajax: "{{url('api/admin/notification/get-all')}}",
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
