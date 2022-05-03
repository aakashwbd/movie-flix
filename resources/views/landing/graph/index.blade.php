<?php
    $currentControllerName = Request::segment(1);
    $currentFullRouteName = Route::getFacadeRoot()
        ->current()
        ->uri();
?>


@extends('layouts.landing.index')
@section('content')
    <div id="profile" class="profile">
        <div class="container">
            <ul class="nav nav-tabs justify-content-center border-0 bg-primary" id="profileNav" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Visit</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Flash</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Testimony</button>
                </li>
            </ul>
            <div class="tab-content bg-white" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <ul id="visitorList" class="p-2">

                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <ul id="testimonyList" class="p-2">

                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom-js')
    <script>
        // function hello(){
        //     $.ajax({
        //         url: window.origin + '/api/profile/visitors',
        //         type: 'get',
        //         // dataType: "json",
        //         // processData: false,
        //         // contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //             'Authorization': token
        //         },
        //         success: function (res) {
        //             console.log('vis', res)
        //             // toastr.success(res.message)
        //         }, error: function (jqXhr, ajaxOptions, thrownError) {
        //             console.log(jqXhr)
        //         }
        //     });
        // }

        $(document).ready(function (){

            let token =localStorage.getItem('accessToken')
            $.ajax({
                url: window.origin + '/api/profile/visitors',
                type: 'get',
                // dataType: "json",
                // processData: false,
                // contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': token
                },
                success: function (res) {
                    console.log('vis', res)
                    res.data.forEach(item=>{
                        $('#visitorList').append(`

                        <li class="border-bottom d-flex p-2">
                            <img style="width: 80px; height: 80px"  src="${item.user.image}" alt="">

                            <div class="ms-3">
                                <h6>${item.user.username}</h6>
                                <h6>${item.user.address}</h6>
                            </div>
                        </li>
                        `)
                    })
                    // toastr.success(res.message)
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });

            $.ajax({
                url: window.origin + '/api/profile/visitors',
                type: 'get',
                // dataType: "json",
                // processData: false,
                // contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': token
                },
                success: function (res) {
                    console.log('vis', res)
                    res.data.forEach(item=>{
                        $('#testimonyList').append(`

                        <li class="border-bottom d-flex p-2">
                            <img style="width: 80px; height: 80px"  src="${item.user.image}" alt="">

                            <div class="ms-3">
                                <h6>${item.user.username}</h6>
                                <h6>${item.user.address}</h6>
                            </div>
                        </li>
                        `)
                    })
                    // toastr.success(res.message)
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });

        })



    </script>


@endpush
