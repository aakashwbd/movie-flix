@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-package">
            <div class="d-flex align-items-center">
                <h6 class="portion-title">Clean Video</h6>

                <button data-bs-target="#videoModal" data-bs-toggle="modal" class="btn btn-primary ms-3">Add Video</button>
            </div>

            <div class="modal fade" id="videoModal" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h6 class="text-capitalize">Add Video</h6>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('api/admin/video/store')}}" id="videoForm">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Video Title</label>
                                    <input class="form-control" type="text" id="title" name="title" placeholder="Video Title">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="category" class="form-label">Select Category</label>
                                    <select class="form-select" name="category_id" id="categorySelect"></select>
                                </div>

                                <div id="videoPreview"></div>

                                <input id="video-uploader" type="file" hidden onchange="videoUploader(event)">
                                <label for="video-uploader" class="cursor-pointer btn border form-control">Upload a Video</label>

                                <input type="hidden" id="video" name="video">

                                <button type="submit" class="btn btn-primary my-3">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editVideoModal" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h6 class="text-capitalize">Edit Video</h6>
                        </div>
                        <div class="modal-body" id="editVideoFormContent">

                        </div>
                    </div>
                </div>
            </div>


            <table class="table table-bordered data-table mt-5">
                <thead>
                <tr>
                    <th>Video Title</th>
                    <th>Video</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
    </main>
@endsection


@push('custom-js')
    <script>

        function videoUploader (event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'video');

            let showURL = window.origin + '/api/image-uploader';
            $.ajax({
                url: showURL,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                success: function (res) {
                    if(res.status === 'success'){
                        toastr.success(res.message)
                        $('#video').val(res.data)

                        $('#videoPreview').append(`
                            <video style="width: 100%; height: 200px" controls>
                                <source src="${res.data}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        `)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }



        $(document).ready(function (){
            $.ajax({
                type: 'get',
                url: window.origin + '/api/admin/category/all',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if(response.status === 'success' && response.data.length > 0){

                        response.data.forEach(item=>{
                            $('#categorySelect').append(`
                                <option value="${item.id}">${item.name}</option>
                            `)
                        })

                    }

                },
                error: function (xhr, resp, text) {
                    console.log(xhr, resp)
                }
            });
        })

        $('#videoForm').submit(function (e) {
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

        function categoryDeleteHandler(id) {
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
                        url: window.origin + '/api/admin/video/'+id,
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

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url('api/admin/video/get-all')}}",
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'video', name: 'video'},
                    {data: 'category.name', name: 'category.name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });


        function videoEditHandler(id){
            $('#editVideoModal').modal('show')
            $.ajax({
                type: "GET",
                url: window.origin + '/api/admin/video/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    $('#editVideoFormContent').html('')
                    if(response.status === 'success'){
                        $('#editVideoFormContent').append(`
                            <form action="{{url('api/admin/video/store')}}" id="videoForm">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Video Title</label>
                                    <input value='${response.data.title}' class="form-control" type="text" id="title" name="title" placeholder="Video Title">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="category" class="form-label">Select Category</label>
                                    <select class="form-select" name="category_id" id="editCategorySelect">
                                            <option value='${response.data.category.id}'>${response.data.category.name}</option>
                                    </select>
                                </div>

                                <div id="editVideoPreview">
                                     <video style="width: 100%; height: 200px" controls>
                                        <source src="${response.data.video}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>

                                <input id="video-uploader" type="file" hidden onchange="editVideoUploader(event)">
                                <label for="video-uploader" class="cursor-pointer btn border form-control">Upload a Video</label>

                                <input type="hidden" value='${response.data.video}' id="editVideo" name="video">

                                <button type="submit" class="btn btn-primary my-3">Save</button>
                            </form>
                        `)

                        $.ajax({
                            type: 'get',
                            url: window.origin + '/api/admin/category/all',
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                if(response.status === 'success' && response.data.length > 0){
                                    response.data.forEach(item=>{
                                        $('#editCategorySelect').append(`
                                            <option value="${item.id}">${item.name}</option>
                                        `)
                                    })
                                }
                            },
                            error: function (xhr, resp, text) {
                                console.log(xhr, resp)
                            }
                        });
                    }


                }, error: function (xhr, resp, text) {
                    console.log(xhr && xhr.responseJSON)
                }
            });
        }


        function editVideoUploader (event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'video');

            let showURL = window.origin + '/api/image-uploader';
            $.ajax({
                url: showURL,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                success: function (res) {
                    if(res.status === 'success'){
                        toastr.success(res.message)
                        $('#editVideo').val(res.data)
                        $('#editVideoPreview').html('')
                        $('#editVideoPreview').append(`
                            <video style="width: 100%; height: 200px" controls>
                                <source src="${res.data}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        `)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }
    </script>
@endpush


