@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-category">
            <div class="d-flex align-items-center">
                <h6 class="portion-title me-5">Category</h6>
                <Button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Add Category</Button>
            </div>


            <ul class="row" id="categoryList" >

            </ul>
{{--            <ul class="nav nav-tabs" id="myTab" role="tablist">--}}
{{--                <li class="nav-item" role="presentation">--}}
{{--                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">category</button>--}}
{{--                </li>--}}
{{--                <li class="nav-item" role="presentation">--}}
{{--                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">subcategory</button>--}}
{{--                </li>--}}
{{--            </ul>--}}

{{--            <div class="tab-content" id="myTabContent">--}}
{{--                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">--}}
{{--                    <Button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Add Category</Button>--}}

{{--                    <ul class="row" id="categoryList" >--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">--}}

{{--                </div>--}}

{{--            </div>--}}
        </section>


    </main>


    <div class="modal fade" id="categoryModal" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h6 class="text-capitalize">Add Category</h6>
                </div>
                <div class="modal-body">
                    <form action="{{url('api/admin/category/store')}}" id="categoryForm">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="category name">
                        </div>

                        <input type="file" id="logo-uploader" hidden onchange="categoryImageUpload(event)"/>
                        <input type="hidden" id="categoryImage" name="image">
                        <label for="logo-uploader"
                               class="border-dashed cursor-pointer text-black-50 py-2 rounded text-uppercase d-flex align-items-center">
                                    <span class="iconify mx-3" data-icon="fluent:add-12-filled" data-width="20"
                                          data-height="20"></span>
                            upload Image
                        </label>
                        <img style="width: 100%; height: 280px" id="categoryImagePreview" class="d-none my-3" src="" alt="">

                        <button type="submit" class="btn  btn-primary my-3">save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editCategoryModal" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h6 class="text-capitalize">Edit Category</h6>
                </div>
                <div class="modal-body" id="editCategoryFormContent">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        $('#categoryForm').submit(function (e) {
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

        function categoryImageUpload(event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'category');

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
                        $('#categoryImage').val(res.data)
                        $('#categoryImagePreview').removeClass('d-none').attr('src', res.data)

                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        function editCategoryImageUpload(event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'category');

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
                        $('#editCategoryImage').val(res.data)
                        $('#editCategoryImagePreview').attr('src', res.data)
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
                            $('#categoryList').append(`
                                <li class="col-lg-4 col-12 col-sm-12">
                                    <div class="card">
                                        <img style="width:100%; height: 250px;"  src="${item.image}" alt="">
                                        <div class="card-img-overlay">
                                            <button class="btn" onclick="categoryEditHandler('/api/admin/category/'+${item.id})">
                                                <span class="iconify"  data-icon="bxs:edit" data-width="20" data-height="20"></span>
                                            </button>
                                            <button class="btn" onclick="categoryDeleteHandler('/api/admin/category/'+${item.id})">
                                                <span class="iconify" data-icon="ep:delete-filled" data-width="20" data-height="20"></span>
                                            </button>
                                        </div>

                                        <div class="card-body">
                                            <h6>${item.name}</h6>
                                        </div>
                                    </div>
                                </li>
                            `)
                        })

                    }

                },
                error: function (xhr, resp, text) {
                    console.log(xhr, resp)
                }
            });
        })

        function categoryEditHandler(url) {
            $('#editCategoryModal').modal('show')

            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    $('#editCategoryFormContent').html('')
                    if (response.status === 'success') {

                        $('#editCategoryFormContent').append(`
                            <form action="{{url('api/admin/category/${response.data.id}')}}" id="editCategoryForm">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value='${response.data.name}' name="name" placeholder="category name">
                                </div>

                                <input type="file" id="uploader" hidden onchange="editCategoryImageUpload(event)"/>
                                <input type="hidden" id="editCategoryImage" value='${response.data.image}' name="image">
                                <label for="uploader"
                                       class="border-dashed cursor-pointer text-black-50 py-2 rounded text-uppercase d-flex align-items-center">
                                            <span class="iconify mx-3" data-icon="fluent:add-12-filled" data-width="20"
                                                  data-height="20"></span>
                                   change upload Image
                                </label>
                                <img style='width: 100%; height: 250px;' class='my-3' id="editCategoryImagePreview" src="${response.data.image}" alt="">

                                <button type="submit" class="btn  btn-primary">save</button>
                            </form>


                        `)
                    }


                    $('#editCategoryForm').submit(function (e) {
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



        function categoryDeleteHandler(url) {
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
