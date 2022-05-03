@extends('layouts.landing.index')
@section('content')
    <div class="container content-config">
        <div id="specificProfile"></div>
    </div>


{{--    <div class="modal fade" id="flashModal" tabindex="-1">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="login-content">--}}
{{--                        <h6 class="text-capitalize text-center">send a flash</h6>--}}
{{--                        <hr>--}}

{{--                        <form action="">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-10 offset-lg-1">--}}
{{--                                    <div class="row row-cols-2">--}}
{{--                                        <div class="col mb-2">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                       id="flexCheckDefault">--}}
{{--                                                <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                                    Default checkbox--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col mb-2">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                       id="flexCheckDefault">--}}
{{--                                                <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                                    Default checkbox--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col mb-2">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                       id="flexCheckDefault">--}}
{{--                                                <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                                    Default checkbox--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col mb-2">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                       id="flexCheckDefault">--}}
{{--                                                <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                                    Default checkbox--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-lg-6 offset-lg-3">--}}
{{--                                            <button class="btn btn-primary form-control  mb-3">send</button>--}}
{{--                                        </div>--}}


{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="modal fade" id="testimonialModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Add Testimony</h4>
                    <hr>

                    <form action="{{url('api/testimony/store')}}" id="testimonyForm">
                        <div class="form-group mb-3">
                            <input type="hidden" id="testimonyUserId" name="testimony_user_id">
                            <input type="text" id="description" name="description" class="form-control testimony h-25" placeholder="Write Your Testimony...">
                            <span class="text-danger description_error" id="testimony_error"></span>
                        </div>

                        <button class="btn btn-primary form-control mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    <script>
        /**
         * GET USER INFO
         ***/
        let currentURL = window.location.href
        let splitURL =  currentURL.split('/')
        let userID = splitURL[5]

        $(document).ready(function (){
            $.ajax({
                type: "GET",
                url: window.origin + '/api/member/profile/'+ userID,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res){
                    if(res.status === 'success'){
                        $('#testimonyUserId').val(res.data.id)
                        $('#specificProfile').append(`
                            <div class="row bg-primary p-2">
                                <div class="col-lg-1">
                                    <span class="text-white">Back</span>
                                </div>
                                <div class="col-lg-11 ">
                                    <div class="text-center">
                                        <span class="text-white fw-bold">${res.data.username}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-white p-3">
                                <div class="col-lg-1 col-sm-1 col-3">
                                    <img  class="avatar-sm-1 profile__image"
                                         src="${res.data.image}"
                                         alt="">
                                </div>
                                <div class="col-lg-8 col-sm-6 col-6">
                                    <div class="d-flex align-items-center">
                                        <span class="iconify me-2 text-primary" data-icon="entypo:location" data-width="20"
                                                      data-height="20"></span>
                                        <span>${res.data.address}</span>
                                        <span class="mx-3">|</span>
                                        <span class="iconify text-primary me-2" data-icon="clarity:new-solid" data-width="20"
                                              data-height="20"></span>
                                        <span>1 add</span>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <span class="iconify text-success me-3" data-icon="ci:dot-03-m" data-width="30"
                                              data-height="30"></span>
                                        <span class="me-2">${res.data.username}</span>
                                        <span class="me-2">${res.data.age} y.o</span>
                                        <span>host/visit</span>
                                    </div>

                                    <span>${res.data.presentation}</span>
                                </div>




                                <div class="col-lg-11 offset-lg-1" id="testimonyList">
   <div class="d-flex align-items-center justify-content-between border-top border-bottom ">
                                        <span> testimony</span>
                                        <button class="btn" data-bs-target='#testimonialModal' data-bs-toggle='modal'>add testimony</button>
                                    </div>
                                </div>
                            </div>

                        `)
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        })


        $('#testimonyForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let token = localStorage.getItem('accessToken')
            formSubmit('post', form, token)
        })

        $(document).ready(function (){
            $.ajax({
                type: "GET",
                url: window.origin + '/api/testimony/'+ userID,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res){
                    console.log(res)
                    if(res.status === 'success'){
                        res.data.forEach((item)=>{
                            console.log('te', item)
                            $('#testimonyList').append(`


                                    <ul>
                                        <li class="d-flex my-2">
                                            <img  class="avatar-sm-1 profile__image"
                                                  src="${item.user.image}"
                                                  alt="">

                                            <div class="mx-2">
                                                <h6>${item.user.username} | ${item.user.age}y.o</h6>
                                                <span>${item.description}</span>
                                            </div>
                                        </li>
                                    </ul>


                    `)
                        })

                    }

                },
                error: function (err){
                    console.log(err)
                }
            })
        })
    </script>
@endpush


