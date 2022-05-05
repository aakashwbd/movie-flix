@include('partial.admin.header')
<div class="container-fluid py-5">
    <div class="row py-5">
        <div class="col-lg-4 col-sm-12 offset-lg-4">
            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <h4>Login</h4>
                        <span></span>
                    </div>

                    <form action="{{url('/api/auth/login')}}" id="adminLoginForm">

                        <div class="form-group mb-3">
                            <label for="email" class="form-label email_label" id="email_label">Email</label>
                            <input type="email" name="email" class="form-control py-2 rounded-0" id="email"
                                   placeholder="example@example.com">
                            <span class="text-danger email_error" id="email_error"></span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label password_label" id="password_label">Password</label>
                            <input type="password" name="password" class="form-control py-2 rounded-0" id="password"
                                   placeholder="******">
                            <span class="text-danger password_error" id="password_error"></span>
                        </div>

{{--                        <div class="text-end mb-3">--}}
{{--                            <span>--}}
{{--                                <a href="" class="text-black-50 text-decoration-underline">forget password</a>--}}
{{--                            </span>--}}
{{--                        </div>--}}

                        <button type="submit" class="btn btn-primary text-capitalize mb-3 form-control rounded-0 py-2">
                            login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-js')
    <script>
        $('#adminLoginForm').submit(function (e) {
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
                    if(response.status === 'success'){
                        toastr.success(response.message)
                        localStorage.setItem('adminAccess', response.data.token)
                        localStorage.setItem('adminInfo',JSON.stringify(response.data.user))
                        window.location.href = window.origin + '/admin'
                    }

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


@include('partial.admin.footer')


