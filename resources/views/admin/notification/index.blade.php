@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-package">
            <h6 class="portion-title">Notification</h6>

            <button class="btn btn-primary rounded-32 my-3" data-bs-target="#notificationModal" data-bs-toggle="modal"> Send</button>

            <table class="table table-bordered data-table mt-5">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Account Created</th>
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
                                <select name="package_id" id="" class="form-select">
                                    <option value="">Select User</option>
                                    <option value="gold">Gold</option>
                                    <option value="premium">Premium</option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <select name="video_id" id="" class="form-select">
                                    <option value="" selected>Select Month</option>
                                    <option value="jan">jan</option>
                                    <option value="feb">feb</option>
                                </select>
                            </div>

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
        $('#notificationForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", form);
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
                ajax: "{{url('api/admin/invite-code/get-all')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
