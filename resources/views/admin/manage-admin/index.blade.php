@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-user">
            <div class="d-flex align-items-center mb-5">
                <h6 class="portion-title">Manage Admin</h6>
                <button class="btn btn-primary btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#adminModal">
                    <span class="iconify" data-icon="fluent:add-12-filled" data-width="15" data-height="15"></span>
                </button>
            </div>


            <ul class="nav nav-tabs mb-5" id="admin-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="admin-tab-button" data-bs-toggle="tab" data-bs-target="#admin-content" type="button" role="tab">Admin</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="super-tab-button" data-bs-toggle="tab" data-bs-target="#super-content" type="button" role="tab">Super Admin</button>
                </li>
            </ul>

            <div class="tab-content" id="admin-tab-content">
                <div class="tab-pane fade show active" id="admin-content" role="tabpanel">

                    <table class="table table-bordered admin-data-table mt-5">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Account Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

                <div class="tab-pane fade" id="super-content" role="tabpanel">

                    <table class="table table-bordered super-data-table w-100">
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
                </div>
            </div>
        </section>

        <div class="modal fade" id="adminModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title portion-title" id="adminModalTitle">Add Admin</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/api/auth/register')}}" id="adminForm">


                            <div class="form-group mb-2">
                                <label for="role" class="form-label role_label" id="role_label">Role</label>
                                <select name="user_role_id" id="role" class="form-select py-2 rounded-0">
                                    <option value="2">Admin</option>
                                    <option value="1">Super Admin</option>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="name" class="form-label name_label" id="name_label">Name</label>
                                <input type="text" class="form-control py-2 rounded-0" id="name" name="name" placeholder="John Doe">
                                <span class="text-danger name_error" id="name_error"></span>
                            </div>


                            <div class="form-group mb-2">
                                <label for="email" class="form-label email_label" id="email_label">Email</label>
                                <input type="email" class="form-control py-2 rounded-0" id="email" name='email' placeholder="example@example.com">
                                <span class="text-danger email_error" id="email_error"></span>
                            </div>

                            <div class="form-group mb-2">
                                <label for="phone" class="form-label phone_label" id="phone_label">Phone</label>
                                <input type="text" class="form-control py-2 rounded-0" name="phone" id="phone" placeholder="">
                            </div>

                            <div class="form-group mb-2">
                                <label for="password" class="form-label password_label" id="password_label">Password</label>

                                <div class="input-group">
                                    <input type="password" class="form-control py-2 rounded-0" id="password" name="password"
                                           placeholder="******">
                                    <span class="input-group-text rounded-0 cursor-pointer toggle-password" onclick="togglePassword();">
                                        <span class="iconify showIcon" data-icon="codicon:eye" data-width="20" data-height="20"></span>
                                        <span class="iconify d-none hideIcon" data-icon="codicon:eye-closed" data-width="20" data-height="20"></span>
                                    </span>
                                </div>

                                <span class="text-danger password_error" id="password_error"></span>
                            </div>

                            <div class="d-flex align-items-center">
                                <button class="btn text-capitalize rounded-0" data-bs-dismiss="modal" >
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary text-capitalize rounded-0">
                                    Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('custom-js')
    <script>

        $('#adminForm').submit(function (e) {
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
                    console.log(response);


                },
                error: function (xhr, resp, text) {
                    if (xhr && xhr.responseJSON) {
                        let response = xhr.responseJSON;
                        if (response.status && response.status === "validate_error") {
                            $.each(response.message, function (index, message) {
                                $("." + message.field).addClass("is-invalid");
                                $("." + message.field + "_label").addClass(
                                    "text-danger"
                                );
                                $("." + message.field + "_error").html(message.error);
                            });
                        }
                    }
                }
            });
        })



        function togglePassword() {
            let passwordFiled = document.querySelector('#password');
            let show = document.querySelector('.showIcon');
            let hide = document.querySelector('.hideIcon');

            if (passwordFiled.type === 'password'){
                passwordFiled.type = 'text'
                show.classList.add('d-none')
                hide.classList.remove('d-none')
            }else{
                passwordFiled.type = 'password'
                hide.classList.add('d-none')
                show.classList.remove('d-none')
            }
        }

        let url = {
            adminURL: window.origin + '/api/admin/' + 2,
            superAdminURL: window.origin + '/api/admin/' + 3,
        }

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.admin-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url.adminURL,
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            var table2 = $('.super-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url.superAdminURL,
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });



        });
    </script>
@endpush

