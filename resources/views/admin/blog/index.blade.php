@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-blog">
            <div class="d-flex align-items-center">


                <button data-bs-target="#blogModal" data-bs-toggle="modal" type="submit" class="btn btn-primary">Add Blog</button>
            </div>

            <div class="row my-3" id="blogList">

            </div>




        </section>

        <div class="modal fade" id="blogModal" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h6 class="text-capitalize">Add New Blog</h6>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('api/admin/blog/store')}}" id="blogForm">
                            <label for="blogImg" class="form-label">Blog Image</label>
                            <input type="hidden" id="blogImg" name="image">
                            <div class="d-flex justify-content-between">
                                <div id="upload-content" class="">
                                    <input type="file" id="logo-uploader" hidden onchange="imageUploader(event)"/>
                                    <label id="uploadLabel" for="logo-uploader"
                                           class="border-dashed cursor-pointer text-black-50  p-2 rounded text-uppercase d-flex align-items-center">
                                    <span class="iconify mx-1" data-icon="ant-design:cloud-upload-outlined"
                                          data-width="20"
                                          data-height="20"></span>
                                        upload Blog Image
                                    </label>
                                </div>
                                <img id="imgPreview" class="d-none" style="width: 100%; height: 200px" src="" alt="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Blog Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Blog Title">
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Blog Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Blog Description"></textarea>

                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>

                        </form>



                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editBlogModal" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h6 class="text-capitalize">Edit Blog</h6>
                    </div>
                    <div class="modal-body" id="editBlogContent">




                    </div>
                </div>
            </div>
        </div>


    </main>


@endsection

@push('custom-js')
    <script>

        function imageUploader (event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'blog');

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
                        $('#blogImg').val(res.data)
                        $('#imgPreview').removeClass('d-none').attr('src',res.data)
                        $('#uploadLabel').text('Edit Blog Image')
                        $('#upload-content').addClass('d-none')

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        function editImageUploader (event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'blog');

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
                        $('#editBlogImg').val(res.data)
                        $('#editImgPreview').attr('src',res.data)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        function deleteHandler(url) {
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
                            url: window.origin + url,
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

        function editHandler(url){
            $('#editBlogModal').modal('show')
            $.ajax({
                type: "GET",
                url: window.origin + url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status === 'success'){
                        $('#editBlogContent').append(`
                            <form action="{{url('api/admin/blog/${response.data.id}')}}" id="editBlogForm">
                                <label for="editBlogImg" class="form-label">Blog Image</label>
                                <input type="hidden" value="${response.data.image}" id="editBlogImg" name="image">

                                <div>
                                    <img id="editImgPreview" class=" mb-3" style="width: 100%; height: 200px" src="${response.data.image}" alt="">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div id="upload-content" class="">
                                        <input type="file" id="uploader" hidden onchange="editImageUploader(event)"/>
                                        <label id="uploadLabel" for="uploader"
                                               class="border-dashed cursor-pointer text-black-50  p-2 rounded text-uppercase d-flex align-items-center">
                                        <span class="iconify mx-1" data-icon="ant-design:cloud-upload-outlined"
                                              data-width="20"
                                              data-height="20"></span>
                                            Change Blog Image
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Blog Title</label>
                                    <input type="text" value="${response.data.title}" name="title" id="title" class="form-control" placeholder="Blog Title">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Blog Description</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Blog Description">${response.data.description}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        `)


                        $('#editBlogForm').submit(function (e) {
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



        $('#blogForm').submit(function (e) {
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

                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                }, error: function (xhr, resp, text) {

                    console.log(xhr && xhr.responseJSON)
                }
            });
        })



        $(document).ready(function (){
            $.ajax({
                type: "GET",
                url: window.origin + '/api/admin/blog/get-all',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status === 'success' && response.data.length > 0){
                        response.data.forEach(item =>{
                            console.log(item)
                            $('#blogList').append(`
                            <div class="col-lg-6 col-12 mb-3">
                                <div class="card">
                                    <img class="card-img-top border-bottom" style="width: 100%; height: 220px; object-fit: cover" src="${item.image}" alt="">
                                    <div class='card-img-overlay'>
                                        <button class="btn " onclick="editHandler('/api/admin/blog/${item.id}')">
                                            <span class="iconify" data-icon="bxs:edit" data-width="20" data-height="20"></span>
                                        </button>



                                        <button class="btn " onclick="deleteHandler('/api/admin/blog/${item.id}')">
                                            <span class="iconify" data-icon="ep:delete-filled" data-width="20" data-height="20"></span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <h6>${item.title}</h6>
                                        <span>${item.description}</span>
                                    </div>
                                </div>
                            </div>
                            `)
                        })
                    }
                }, error: function (xhr, resp, text) {
                    console.log(xhr && xhr.responseJSON)
                }
            });
        })


    </script>
@endpush
