@extends('layouts.landing.index')
@section('content')

    <div id="inscription" class="inscription">
        <div class="container">

            <div class="bg-primary text-white py-2 my-3 d-flex align-items-center justify-content-center">
                <span class="mx-3 ">Already a Member?</span>
                <button class="btn text-white" data-bs-target="#loginModal" data-bs-toggle="modal">Login</button>
            </div>

            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="text-center my-3">
                        <span class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Asperiores aspernatur deleniti dolore eius fugiat fugit illum nemo numquam</span>
                    </div>

                    <form action="{{url('/api/auth/register')}}" id="inscriptionForm">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-4">
                                <div class="form-group">
                                    <input required type="text" name="emailorphone" id="emailorphone" class="form-control email phone" placeholder="Email or Phone">
                                    <span class="text-danger phone_error email_error" id="emailorphone_error"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-4">
                                <input required type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <span class="text-danger password_error" id="password_error"></span>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-4">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username (Max. 13 characters)">
                                <span class="text-danger username_error" id="username_error"></span>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-4">
                                <select id="inscriptionBirthYear" name="dob" class="form-select"></select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-4">
                                <input type="text" class="form-control" name="address" placeholder="Location">
                            </div>

                            <div class="col-lg-12 col-sm-12 mb-4">
                                <textarea class="form-control" name="presentation" placeholder="Your presentation (optional)"></textarea>
                            </div>

                            <div class="col-lg-12 col-sm-12 mb-4">
                                <div class="d-flex align-items-center">
                                    <img id="inscriptionPreviewImgURL" class="avatar-sm d-none me-3" src="" alt="">
                                    <input type="hidden" name="image" id="inscriptionImgURL" >
                                    <input type="file" id="file-uploader" onchange="uploader(event,'','', 'inscriptionImgURL','inscriptionPreviewImgURL')" hidden name="image"/>
                                    <label for="file-uploader"
                                           class="text-white-50 d-flex align-items-center cursor-pointer">
                                    <span class="iconify me-3" data-icon="fa-solid:camera" data-width="20"
                                          data-height="20"></span>
                                        Add Your Photo (optional)
                                    </label>
                                </div>

                            </div>

                            <div class="col-lg-12 col-sm-12 mb-4">
                                <div class="form-check text-white-50">
                                    <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                                    <label class="form-check-label text-white" for="termsCheck">
                                        By clicking <a href=""
                                                       class="text-white text-decoration-underline text-capitalize">terms
                                            & policy</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 offset-lg-3 mb-4">
                                <button type="submit" class="btn btn-primary form-control text-capitalize">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('custom-js')
    <script>
        $('#inscriptionForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);

            formSubmit("post", form);
        })

    </script>
@endpush
