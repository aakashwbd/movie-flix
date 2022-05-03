@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-category">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">category</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">subcategory</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <Button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">Add Category</Button>

                    <ul class="row" id="categoryList" >

                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
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
                            <input type="text" class="form-control" name="name" placeholder="category name">
                        </div>

                        <input type="file" id="logo-uploader" hidden onchange="uploader(event, '','','categoryImage')"/>
                        <input type="hidden" id="categoryImage" name="image">
                        <label for="logo-uploader"
                               class="border-dashed cursor-pointer text-black-50 py-2 rounded text-uppercase d-flex align-items-center">
                                    <span class="iconify mx-3" data-icon="fluent:add-12-filled" data-width="20"
                                          data-height="20"></span>
                            upload Image
                        </label>

                        <button type="submit" class="btn  btn-primary">save</button>
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
                <div class="modal-body">
                    <form action="{{url('api/admin/category')}}" id="categoryForm">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="name" placeholder="category name">
                        </div>

                        <input type="file" id="logo-uploader" hidden onchange="uploader(event, '','','categoryImage')"/>
                        <input type="hidden" id="categoryImage" name="image">
                        <label for="logo-uploader"
                               class="border-dashed cursor-pointer text-black-50 py-2 rounded text-uppercase d-flex align-items-center">
                                    <span class="iconify mx-3" data-icon="fluent:add-12-filled" data-width="20"
                                          data-height="20"></span>
                            upload Image
                        </label>

                        <button type="submit" class="btn  btn-primary">save</button>
                    </form>
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
            formSubmit("post", form);
        })
        let url = window.origin + '/api/admin/category/id'
        getEditData(url)
        $(document).ready(function (){
            let showURL = window.origin + '/api/admin/category/all'
            getShowData(showURL)
        })

    </script>
@endpush
