@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-banner">
            <h6 class="portion-title">Manage Banner</h6>
            <button class="btn btn-primary rounded-32 my-4" data-bs-target="#bannerModal" data-bs-toggle="modal">
                <span class="iconify" data-width="20" data-height="20" data-icon="fluent:add-12-filled"></span>
                add banner image
            </button>

            <ul class="row p-0" id="bannerImgList">

            </ul>

        </section>
    </main>

    <div id="bannerModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="portion-title fs-5 mb-5">Add Banner Image</h6>

                    <form action="{{url('api/admin/banner-image/store')}}" id="bannerForm">
                        <input type="file" id="logo-uploader" hidden onchange="bannerImgUpload(event)"/>
                        <input type="hidden" id="bannerImg" name="image">
                        <label for="logo-uploader"
                               class="border-dashed cursor-pointer text-black-50 py-2 rounded text-uppercase d-flex align-items-center">
                                    <span class="iconify mx-1" data-icon="ant-design:cloud-upload-outlined"
                                          data-width="20"
                                          data-height="20"></span>
                            upload Banner Image
                        </label>


                        <img style="width: 100%; height: 280px;" class="my-2 d-none" id="bannerImgPreview"
                             src=""
                             alt="">
                        <button type="submit" class="btn btn-primary my-2">Save</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <div id="editBannerModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="portion-title fs-5 mb-5">Edit Banner Image</h6>
                    <div id="editBannerFormContent">

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom-js')
    <script>

        function bannerImgUpload(event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'banner');

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
                    if (res.status === 'success') {
                        toastr.success(res.message)
                        $('#bannerImg').val(res.data)
                        $('#bannerImgPreview').removeClass('d-none').attr('src', res.data)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        function editBannerImgUpload(event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'banner');

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
                    if (res.status === 'success') {
                        toastr.success(res.message)
                        $('#editBannerImg').val(res.data)
                        $('#editBannerImgPreview').attr('src', res.data)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        $('#bannerForm').submit(function (e) {
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

        function bannerEditHandler(url) {
            $('#editBannerModal').modal('show')

            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    $('#editBannerFormContent').html('')
                    if (response.status === 'success') {

                        $('#editBannerFormContent').append(`
<form action="{{url('api/admin/banner-image/${response.data.id}')}}" id="editBannerForm">


                    <input type="file" id="uploader" hidden onchange="editBannerImgUpload(event)"/>
                        <input type="hidden" id="editBannerImg" value="${response.data.image}" name="image">
                        <label for="uploader"
                               class="border-dashed cursor-pointer text-black-50 py-2 rounded text-uppercase d-flex align-items-center">
                                    <span class="iconify mx-1" data-icon="ant-design:cloud-upload-outlined"
                                          data-width="20"
                                          data-height="20"></span>
                            change Banner Image
                        </label>


                        <img style="width: 100%; height: 280px;" class="my-2" id="editBannerImgPreview"
                             src="${response.data.image}"
                             alt="">
                        <button type="submit" class="btn btn-primary my-2">Save</button>
                               </form>
                    `)
                    }

                    $('#editBannerForm').submit(function (e) {
                        e.preventDefault();
                        let form = $(this);
                        let form_data = JSON.stringify(form.serializeJSON());
                        let formData = JSON.parse(form_data);
                        let url = form.attr("action");

                        $.ajax({
                            type: 'patch',
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

                },
                error: function (xhr, resp, text) {
                    console.log(xhr, resp)
                }
            });
        }


        $(document).ready(function () {
            $.ajax({
                url: window.origin + '/api/admin/banner-image/index',
                type: 'GET',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {
                    if (res.status === 'success' && res.data.length > 0) {
                        res.data.forEach(item => {
                            $('#bannerImgList').append(`
                           <li class="col-lg-3 mb-3">
                               <div class="card">
                                    <img
                                        style="width: 100%; height: 250px"
                                        src="${item.image}"
                                         alt=""
                                    >
                                    <div class="card-body">
                                        <button class="btn" onclick="bannerEditHandler('/api/admin/banner-image/'+${item.id})">
                                            <span class="iconify" data-icon="bxs:edit" data-width="20" data-height="20"></span>
                                        </button>
                                        <button class="btn" onclick="bannerDeleteHandler('/api/admin/banner-image/'+${item.id})">
                                            <span class="iconify" data-icon="ep:delete-filled" data-width="20" data-height="20"></span>
                                        </button>
                                    </div>
                                </div>
                           </li>
                           `)
                        })
                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        })

        function bannerDeleteHandler(url) {
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

    </script>
@endpush
