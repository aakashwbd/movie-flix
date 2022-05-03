@extends('layouts.landing.index')
@section('content')
    <div class="container content-config">
        <div class="p-3 my-3 bg-primary d-flex justify-content-between text-white">
            <span>from 10 years old to 49 years old- who hosts and/or visits - in New York and around </span>
            <span class="iconify cursor-pointer" data-bs-toggle="modal" data-bs-target="#videoModal"
                  data-icon="ri:equalizer-line" data-width="20" data-height="20"></span>
        </div>
        <div class="">
            <div class="row bg-white" id="allVideoList">

            </div>
        </div>
    </div>

    {{--    <div class="container" id="weekVideo">--}}
    {{--        <div class="row align-items-center">--}}
    {{--            <div class="col-lg-6 col-sm-12 col-12">--}}


    {{--                <video--}}
    {{--                    id="my-player"--}}
    {{--                    class="video-js vjs-big-play-centered"--}}
    {{--                    width="500px"--}}
    {{--                    height="500px"--}}
    {{--                    controls--}}
    {{--                    preload="auto"--}}
    {{--                    poster="//vjs.zencdn.net/v/oceans.png"--}}
    {{--                    data-setup='{}'>--}}
    {{--                    <source src="{{asset('/asset/video/Coke Studio Season 9- Afreen Afreen- Rahat Fateh Ali Khan & Momina Mustehsan.mp4')}}" type="video/mp4">--}}
    {{--                    <p class="vjs-no-js">--}}
    {{--                        To view this video please enable JavaScript, and consider upgrading to a--}}
    {{--                        web browser that--}}
    {{--                        <a href="https://videojs.com/html5-video-support/" target="_blank">--}}
    {{--                            supports HTML5 video--}}
    {{--                        </a>--}}
    {{--                    </p>--}}
    {{--                </video>--}}

    {{--            </div>--}}

    {{--            <div class="col-lg-6 col-sm-12 col-12">--}}
    {{--                <h4 class="text-capitalize text-white">video of the week</h4>--}}
    {{--                <hr class="text-white">--}}
    {{--                <div class="d-flex align-items-center justify-content-between">--}}
    {{--                    <h5 class="text-white fw-bold text-capitalize">video title</h5>--}}
    {{--                    <a href="" class="text-white text-capitalize">learn more</a>--}}
    {{--                </div>--}}


    {{--                <div class="d-flex align-items-center">--}}
    {{--                    <div id="rater"></div>--}}
    {{--                    <div id="total-rating"></div>--}}
    {{--                </div>--}}
    {{--                <span class="text-white-50 fst-italic">published 2 years ago</span>--}}

    {{--                <div class="d-flex align-items-center my-3">--}}
    {{--                    <img class="avatar-sm"--}}
    {{--                         src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"--}}
    {{--                         alt="">--}}

    {{--                    <div class="ms-4">--}}
    {{--                        <h6 class="text-white-50 text-capitalize">--}}
    {{--                            <span class="iconify text-primary" data-icon="carbon:location-filled" data-width="25" data-height="25"></span>--}}
    {{--                            paris--}}
    {{--                        </h6>--}}

    {{--                        <span class="text-capitalize text-white-50 fs-6">name | 36y.o</span>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="p-3 my-3 bg-primary d-flex justify-content-between text-white">--}}
    {{--            <span>from 10 years old to 49 years old- who hosts and/or visits - in New York and around </span>--}}
    {{--            <span class="iconify cursor-pointer" data-bs-toggle="modal" data-bs-target="#videoModal" data-icon="ri:equalizer-line" data-width="20" data-height="20"></span>--}}
    {{--        </div>--}}

    {{--        <div class="row" id="videoList">--}}
    {{--        </div>--}}
    {{--    </div>--}}



        <div class="modal fade" id="videoModal" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h6 class="text-capitalize">Sort Video By</h6>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/api/file/video/search')}}" id="filterForm">
                            <div class="row">
{{--                                <div class="col-lg-12 col-12 mb-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" name="keyword" class="form-control" placeholder="Keyword Search">--}}
{{--                                        <span class="text-danger"></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-lg-12 col-12 mb-3">
                                    <div class="form-group">
                                        <select name="filter" id="" class="form-select">
                                            <option value="date">Filter By Date</option>
                                            <option value="note">Filter By Note</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12 mb-3">
                                    <div class="form-group">
                                        <select name="video" id="" class="form-select">
                                            <option value="all">All Videos</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12 mb-3">
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <input name="minage" type="text" class="form-control" placeholder="10">
                                        <label class="text-capitalize mx-3">to</label>
                                        <input name="maxage" type="text" class="form-control" placeholder="49">
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

@endsection
@push('custom-js')
    <script>
        let constant = {
            allVideoListURL:  '/api/file/video',
        }

        function fetch (url){
            $.ajax({
                url: window.origin + url,
                type: 'GET',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {
                    // console.log(res)
                    getVideoContent(res)

                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        function getVideoContent(res) {
            res.data.forEach(item => {
                $('#allVideoList').append(`
                    <div class="col-lg-4 col-sm-12 col-12 mb-3">
                        <a href="{{url('videos/${item.id}')}}">
                        <video width="320" height="240" autoplay>
                          <source src="${item.video}" type="video/mp4">
                        Your browser does not support the video tag.
                        </video>
                        </a>
                        <div class='d-flex'>
                            <img style='width: 80px; height: 80px;' src='${item.user.image}'/>

                            <div class="ms-2">
                                    <div class="d-flex align-items-center">
                                        <span class="iconify text-warning me-2" data-icon="bxs:star" data-width="20" data-height="20"></span>
                                       <span id='rating-count' class='text-white'></span>
                                    </div>

                                   <h6 class=''>${item.user.username}</h6>
                                    <span class=''>${item.user.address}</span>
                            </div>
                        </div>
                    <div>
                `)

                $.ajax({
                    url: window.origin + '/api/rating/count/'+item.id,
                    type: 'GET',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (res) {
                        console.log(res)
                        $('#rating-count').text(res.data)


                    }, error: function (jqXhr, ajaxOptions, thrownError) {
                        console.log(jqXhr)
                    }
                });
            })
        }

        $(document).ready(function (){
            fetch(constant.allVideoListURL)
        })

        // <video
        // id="video${item.id}"
        // class="video-js vjs-big-play-centered"
        // controls
        // preload="auto"
        // poster="//vjs.zencdn.net/v/oceans.png"
        // data-setup='{}'
        //     >
        //     <source src="${item.video}" type="video/mp4">
        //     </video>



        // var myRating = raterJs({
        //     element: document.querySelector("#rater"),
        //     rateCallback: function rateCallback(rating, done) {
        //         this.setRating(rating);
        //         done();
        //     },
        //     showToolTip: true,
        //     max: 5,
        // });
        //
        //
        // $(document).on('click', "#rater", function () {
        //     let token = localStorage.getItem('accessToken')
        //     let rate = $(this).attr('data-rating')
        //     let video = 2
        //
        //     let formData = new FormData();
        //     formData.append('rating', rate)
        //     formData.append('video_id', video)
        //
        //     $.ajax({
        //         url: window.origin + '/api/rating/store',
        //         type: 'POST',
        //         data: formData,
        //         dataType: "json",
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //             'Authorization': token
        //         },
        //         success: function (res) {
        //
        //             toastr.success(res.message)
        //
        //         }, error: function (jqXhr, ajaxOptions, thrownError) {
        //             console.log(jqXhr)
        //         }
        //     });
        // })
        //
        // $(document).ready(function () {
        //     let formData = new FormData();
        //     let video = 2
        //     formData.append('video_id', video)
        //     $.ajax({
        //         url: window.origin + '/api/rating/count',
        //         type: 'POST',
        //         data: formData,
        //         dataType: "json",
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //         },
        //         success: function (res) {
        //             $('#total-rating').append(`
        //                 <span class="text-white-50 ms-3">total ${res.data}</span>
        //             `)
        //
        //         }, error: function (jqXhr, ajaxOptions, thrownError) {
        //             console.log(jqXhr)
        //         }
        //     });
        // })


        $('#filterForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit('post', form)
        })





    </script>
@endpush
