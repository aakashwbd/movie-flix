@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-blog">
            <h6 class="portion-title">Blogs</h6>

            <form action="{{url('api/admin/blog/store')}}" id="blogForm" class="my-5">
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

        </section>


    </main>


@endsection

@push('custom-js')
    <script>
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
                    // console.log(response)
                    toastr.success(response.message)
                    // if(response.status === 'success'){
                    //     toastr.success(response.message)
                    //     localStorage.setItem('adminAccess', response.data.token)
                    //     localStorage.setItem('adminInfo',JSON.stringify(response.data.user))
                    //     window.location.href = window.origin + '/admin'
                    // }

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
        // let url = window.origin + '/api/admin/category/id'
        // getEditData(url)
        // $(document).ready(function (){
        //     let showURL = window.origin + '/api/admin/category/all'
        //     getShowData(showURL)
        // })

    </script>
@endpush
