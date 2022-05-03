<div id="footer" class="footer text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <a href="{{url('/')}}">
                    <img id="footerLogo" class="img-fluid avatar-sm-1-circle"
                         src="{{asset('images\default.png')}}"
                         alt="">
                </a>

                <span id="footerDescription" class="site-description d-block my-3"></span>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <h6 class="footer_title text-capitalize fw-bold fs-5">site map</h6>

                <div class="row row-cols-2">
                    <div class="col">
                        <ul class="list">
                            <li class="list-item">
                                <a href="{{url('/')}}" class="list-link text-capitalize">Members</a>
                            </li>
                            <li class="list-item">
                                <a href="{{url('/information?tab=legal')}}" class="list-link text-capitalize">Legal
                                    Notice</a>
                            </li>

                            <li class="list-item">
                                <a href="{{url('/videos')}}" class="list-link text-capitalize">Videos</a>
                            </li>
                            <li class="list-item">
                                <a href="{{url('/about')}}" class="list-link text-capitalize">X-flix ?</a>
                            </li>
                            <li class="list-item">
                                <a href="{{url('/live')}}" class="list-link text-capitalize">Live</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list">
                            <li class="list-item">
                                <a href="{{url('/inscription')}}" class="list-link text-capitalize">Inscription</a>
                            </li>
                            <li class="list-item">
                                <a href="#" data-bs-target="#loginModal" data-bs-toggle="modal"
                                   class="list-link text-capitalize">Connection</a>
                            </li>
                            <li class="list-item">
                                <a href="{{url('/information?tab=faq')}}" class="list-link text-capitalize">Faq /
                                    Contact</a>
                            </li>
                            <li class="list-item">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#contactModal"
                                   class="list-link text-capitalize">Contact</a>
                            </li>
                            <li class="list-item">
                                <a href="" class="list-link text-capitalize">Refund Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <h6 class="footer_title text-capitalize fw-bold fs-5">Partner site</h6>
                <ul class="row list" id="partnerList">
                </ul>
            </div>


            <div class="col-lg-3 col-sm-6 col-12">
                <h6 class="footer_title text-capitalize fw-bold fs-5">Share the Website on</h6>

                <div class="d-flex align-items-center">
                    <a id="facebook-share" href="" target="_blank" class="list-link">
                        <i class="bi bi-facebook social-icon"></i>
                    </a>

                    <a id="twitter-share" href="" target="_blank" class="list-link">
                        <i class="bi bi-twitter social-icon"></i>
                    </a>


                </div>


            </div>
        </div>
    </div>
</div>

{{--Confirmation Modal--}}
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h6 class="text-capitalize">title</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="text-center">
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nostrum.</span>
                        </div>


                        <select id="dobyear" class="my-3 form-select py-3 px-4 rounded-0 "></select>
                        <span id="confirmErrMsg"
                              class="text-danger  d-none">Please Confirm Your Birth Year....</span>

                        <button id="birthConfirmDialogBtn"
                                class="btn btn-primary form-control py-3 px-4 rounded-0 my-3 text-capitalize">
                            confirm
                        </button>

                        <div class="text-center">
                            <span class="text-center">or</span>
                        </div>


                        <button data-bs-target="#loginModal" data-bs-toggle="modal"
                                class="btn btn-dark form-control py-3 px-4 rounded-0 my-3 text-capitalize">
                            login
                        </button>

                        <a href="{{url('/auth/twitter')}}"
                           class="btn btn-tweeter form-control py-3 px-4 rounded-0 my-3 text-capitalize">
                            tweeter
                        </a>


                        <h6 class="text-capitalize fw-bold">terms & condition</h6>
                        <span class="fw-lighter">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid aperiam consectetur cum deserunt distinctio eaque id ipsum libero maiores minima, molestias natus </span>

                        <div class="border-top border-bottom py-2 my-3 text-center">
                            <p class="text-black-50">How to protect your child</p>
                            <ul class="d-flex justify-content-around align-items-center">
                                <li>
                                    <a href="">
                                        <img class="avatar"
                                             src="https://w7.pngwing.com/pngs/786/126/png-transparent-logo-contracting-photography-logo-symbol.png"
                                             alt="">
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <img class="avatar"
                                             src="https://w7.pngwing.com/pngs/786/126/png-transparent-logo-contracting-photography-logo-symbol.png"
                                             alt="">
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <img class="avatar"
                                             src="https://w7.pngwing.com/pngs/786/126/png-transparent-logo-contracting-photography-logo-symbol.png"
                                             alt="">
                                    </a>
                                </li>
                            </ul>


                        </div>
                        <span class="fw-lighter">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid aperiam consectetur cum deserunt distinctio eaque id ipsum libero maiores minima, molestias natus </span>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactModal" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h6 class="text-capitalize">Contact</h6>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <span>You have a question, a problem, a suggestion ... contact us</span>
                </div>
                <form action="">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-3">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 mb-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Object">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message"></textarea>
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 offset-lg-3">
                            <button class="btn btn-primary form-control">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="locationModal" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h6 class="text-capitalize">GEO Location</h6>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <span>To display the profiles around you, <br> indicate the city below:</span>
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control  locationInput" placeholder="city">
                    <span class="locationError text-danger d-none">Please select your city</span>
                </div>
                <div class="text-center my-3">
                    <button id="location-btn" class="btn btn-primary w-75  form-control">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="forgotModal" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h6 class="text-capitalize">Recover Password</h6>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <span>Please Enter Your Email or Phone For Recovery Password</span>
                </div>
                <form action="{{url('api/forgot-password')}}" id="recoverForm">
                    <div class="form-group">
                        <input required type="text" name="emailorphone" id="emailorphone"
                               class="form-control email phone" placeholder="Email or Phone">
                        <span class="text-danger phone_error email_error" id="forgetFromEmailOrPhone"></span>
                    </div>
                    <div class="text-center my-3">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>


                <form action="{{url('api/recover-password')}}" class="d-none" id="recoverPasswordForm">
                    <input type="hidden" name="email" id="recoverEmailHiddenInput">
                    <input type="hidden" name="phone" id="recoverPhoneHiddenInput">
                    <div class="form-group">
                        <input required type="password" name="password" id="password"
                               class="form-control email phone" placeholder="New Password">
                    </div>
                    <div class="text-center my-3">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="message-box">

</div>


@include('partial.landing.auth.login')
<script src="{{asset('asset/vendor/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{--<script src="{{asset('asset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>--}}
<script src="{{asset('asset/vendor/Minimalist-jQuery-Plugin-For-Birthday-Selector-DOB-Picker/dobpicker.js')}}"></script>

<script src="{{asset('asset/vendor/toastr/toastr.js')}}"></script>
<script src="{{asset('asset/vendor/ImagesLoader-main/jquery.imagesloader-1.0.1.js')}}"></script>
<script src="{{asset('asset/vendor/rater-js-master/index.js')}}"></script>

<script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>


<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>




<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>

    $('#recoverForm').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        formSubmit("post", form);
    })

    $('#recoverPasswordForm').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        formSubmit("post", form);
    })



    $(document).ready(function () {
        $.ajax({
            url: window.origin + '/api/share-website',
            type: 'GET',
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (res) {
                $('#facebook-share').attr('href', res.data.facebook)
                $('#twitter-share').attr('href', res.data.twitter)
            }, error: function (jqXhr, ajaxOptions, thrownError) {
                console.log(jqXhr)
            }
        });



        $.ajax({
            url: window.origin + '/api/admin/setting/get-all',
            type: 'GET',
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },

            success: function (res) {
                if(res.status === 'success' && res.data.length){

                    Object.entries(res.data[0]).forEach(item =>{
                        // console.log('footerItme',item)
                        if(item[0] === 'image'){
                            if(item[1]){
                                Object.entries(item[1]).forEach(value => {
                                    if(value[0] === "logo"){
                                        $('#footerLogo').attr('src', value[1])
                                        $('#navLogo').attr('src', value[1])
                                    }
                                })
                            }


                        }
                        if(item[0] === "legal_information"){
                            if(item[1]){
                                Object.entries(item[1]).forEach(value => {
                                    if(value[0] === "'description'"){
                                        $('#footerDescription').text(value[1])
                                    }
                                })
                            }

                        }
                        if(item[0] === "partner_site"){
                            if(item[1]){
                                item[1].forEach(site =>{
                                    $('#partnerList').append(`
                                    <li class="col-lg-6 list-item">
                                        <a href="${site.url}" class="list-link">${site.name}</a>
                                    </li>
                                `)
                                })
                            }


                        }

                    })

                }

            }, error: function (jqXhr, ajaxOptions, thrownError) {
                console.log(jqXhr)
            }
        })
    })



</script>

@stack('custom-js')



</body>
</html>
