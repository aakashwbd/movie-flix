@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-package">
            <h6 class="portion-title mb-5">Package</h6>

            <table class="table table-striped table-bordered data-table mt-5">
                <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Package Price</th>
                        <th>Package List</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div class="modal fade" id="packageModal"  tabindex="-1">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h6 class="text-capitalize">Edit Package</h6>
                        </div>
                        <div class="modal-body">

                            <form action="{{url('api/admin/package/update')}}" id="packageForm">
                                <input type="hidden" id="package_id" name="package_id">
                                <div class="form-group mb-3">
                                    <label for="package_name" class="form-label">Package Name</label>
                                    <input type="text" name="package_id" id="package_name" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" id="price">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="list" class="form-label">Add list</label>
                                    <input type="text" class="form-control" name="list[]" id="list">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="list" class="form-label">Add list</label>
                                    <input type="text" class="form-control" name="list[]" id="list2">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="list" class="form-label">Add list</label>
                                    <input type="text" class="form-control" name="list[]" id="list3">
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </section>




    </main>
@endsection

@push('custom-js')
    <script>
        let constantData = {
            getPackageUrl: '/api/admin/package',
            getSinglePackageUrl: '/api/admin/package/id',
        }

        function packageHandler(id){
            $.ajax({
                url: window.origin + constantData.getSinglePackageUrl.replace('id', id),
                type: 'get',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {
                    if(res.status === 'success'){
                        $('#package_name').val(res.data.name)
                        $('#package_id').val(res.data.id)
                        $('#price').val(res.data.price)

                        res.data.list.forEach(item=>{
                            $('#list').val(item)
                        })

                    }


                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
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
                ajax: "{{url('api/admin/package/list/get-all')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'list', name: 'list'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });


        $('#packageForm').submit(function (e) {
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
    </script>
@endpush



