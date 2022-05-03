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

@endsection

@push('custom-js')
    <script>

        function bannerImgUpload (event) {
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
                    if(res.status === 'success'){
                        toastr.success(res.message)
                        $('#bannerImg').val(res.data)
                        $('#bannerImgPreview').removeClass('d-none').attr('src',res.data)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        $('#bannerForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", form);
        })

        $(document).ready(function (){
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
                    if(res.status === 'success'){
                       res.data.forEach(item =>{
                           $('#bannerImgList').append(`
                           <li class="col-lg-3 mb-3">
                                <img style="width: 100%; height: 280px"
                                     src="${item.image}"
                                     alt="">
                           </li>
                           `)
                       })
                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        })

    </script>
@endpush
