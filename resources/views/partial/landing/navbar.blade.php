<?php
    $currentControllerName = Request::segment(1);
    $currentFullRouteName = Route::getFacadeRoot()
        ->current()
        ->uri();
?>

<nav id="siteNav" class="">
    <div class="container">
        <a href="{{url('/')}}">
            <img id="navLogo" class="logo" src="{{asset('images\default.png')}}" alt="logo">
        </a>

        <span class="iconify cursor-pointer nav-toggler" data-icon="gg:menu" data-width="25" data-height="25"></span>

        <ul id="siteNav-list" class="list">
            <li class="list-item">
                <a href="{{url('/')}}" class="list-link {{ $currentFullRouteName == '/' || '' ? 'active' : '' }}">members</a>
            </li>

            <li class="list-item">
                <a href="{{url('/ads')}}" class="list-link {{ $currentControllerName == 'ads' || '' ? 'active' : '' }}">ads</a>
            </li>

            <li class="list-item">
                <a href="{{url('/live')}}" class="list-link {{ $currentControllerName == 'live' || '' ? 'active' : '' }}">live</a>
            </li>

            <li class="list-item">
                <a href="{{url('/videos')}}" class="list-link {{ $currentControllerName == 'videos' || '' ? 'active' : '' }}">videos</a>
            </li>

            <li class="list-item">
                <a href="{{url('/maps')}}" class="list-link {{ $currentControllerName == 'maps' || '' ? 'active' : '' }}">maps</a>
            </li>

            <li class="list-item">
                <a href="{{url('/blogs?tab=blogs')}}" class="list-link {{ $currentControllerName == 'blogs' || '' ? 'active' : '' }}">blogs</a>
            </li>

            <li class="list-item">
                <a href="{{url('/package')}}" class="list-link {{ $currentControllerName == 'package' || '' ? 'active' : '' }}">packages</a>
            </li>

            <li class="list-item">
                <a href="{{url('/inscription')}}" class="list-link {{ $currentControllerName == 'inscription' || '' ? 'active' : '' }}">inscriptions</a>
            </li>

            <li class="list-item" id="connectionNavItem">
                <a href="javaScript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="list-link {{ $currentControllerName == 'ads' || '' ? 'active' : '' }}">connections</a>
            </li>

            <li class="list-item d-none" id="graph">
                <a href="{{url('/graph')}}" class="list-link {{ $currentControllerName == 'graph' || '' ? 'active' : '' }}">
                    <span class="iconify" data-icon="bi:flag" data-width="20" data-height="20"></span>
                </a>
            </li>

            <li class="list-item dropdown d-none" id="message" >
                <a href="#" class="list-link " data-bs-toggle="dropdown">
                    <span class="iconify" data-icon="bx:message-rounded" data-width="20" data-height="20"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                </ul>
            </li>

            <li class="list-item dropdown d-none" id="profileNavItem">
                <a class="list-link" href="#" data-bs-toggle="dropdown">
                    <img id="navbarProfileImg" class="avatar-sm rounded-circle"
                         src=""
                         alt="">
                </a>

                <ul class="dropdown-menu-end dropdown-menu text-center">
                    <li class="border-bottom py-2">
                        <a href="{{url('profile?tab=information')}}" class="dropdown-item text-capitalize">edit my profile</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="" class="dropdown-item text-capitalize">show</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('profile?tab=photos')}}" class="dropdown-item text-capitalize">photos/videos</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('profile?tab=setting')}}" class="dropdown-item text-capitalize">setting</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('profile?tab=favorite')}}" class="dropdown-item text-capitalize">favorite</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('profile?tab=blacklist')}}" class="dropdown-item text-capitalize">blacklist</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('profile?tab=premium')}}" class="dropdown-item text-capitalize">premium access</a>
                    </li>
                    <li class="">
                        <a href="{{url('profile?tab=invisible')}}" class="dropdown-item text-capitalize">become invisible</a>
                    </li>
                </ul>
            </li>

            <li class="list-item dropdown d-none" id="moreMenuDots">
                <a class="list-link" href="" data-bs-toggle="dropdown">
                        <span class="iconify" data-icon="bx:dots-vertical-rounded" data-width="25"
                              data-height="25"></span>
                </a>

                <ul class="dropdown-menu-end dropdown-menu text-center">
                    <li class="border-bottom py-2">
                        <a href="{{url('/about')}}" class="dropdown-item text-capitalize">about</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('/blogs?tab=blogs')}}" class="dropdown-item text-capitalize">blog</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('/information?tab=faq')}}" class="dropdown-item text-capitalize">help</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="#" data-bs-target="#contactModal" data-bs-toggle="modal" class="dropdown-item text-capitalize">contact</a>
                    </li>
                    <li class="border-bottom py-2">
                        <a href="{{url('/information?tab=legal')}}" class="dropdown-item text-capitalize">legal notice</a>
                    </li>
                    <li class="">
                        <a href="#" class="dropdown-item text-capitalize" id="signOut">disconnect</a>
                    </li>
                </ul>
            </li>

        </ul>


    </div>
</nav>



@push('custom-js')
    <script>
        $(document).on('click','#navbarToggler', function (){

            $('#topNavigation').toggleClass('show')
        })

        $(document).ready(function (){
            let constant = {
                token: localStorage.getItem('accessToken'),
                userInfo: JSON.parse(localStorage.getItem('user')),
                moreItem: {
                    profileNavItem: document.getElementById('profileNavItem'),
                    moreMenuDots: document.getElementById('moreMenuDots'),
                    graph: document.getElementById('graph'),
                    message: document.getElementById('message'),
                    connectionNavItem:  document.getElementById('connectionNavItem'),
                    navbarProfileImg: document.getElementById('navbarProfileImg')
                }
            }

            if(constant.token){
                Object.keys(constant.moreItem).forEach(item => {
                    if(item === 'connectionNavItem'){
                        $('#'+item).addClass('d-none')
                    }else if(item === 'navbarProfileImg'){
                        $('#'+item).attr('src', constant.userInfo.image)
                    }else{
                        $('#'+item).removeClass('d-none')
                    }
                })
            }
        })
    </script>
@endpush


{{--<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-body">--}}



{{--                <div class="forgot-content">--}}
{{--                    <h4 class="text-capitalize text-center">password forgotten</h4>--}}
{{--                    <hr>--}}
{{--                    <div class="text-center">--}}
{{--                        <span class="fs-6 text-black-50">Enter your email for reset password</span>--}}
{{--                    </div>--}}


{{--                    <form action="">--}}
{{--                        <input class="form-control my-3" type="text" placeholder="email">--}}
{{--                        <div class="text-center">--}}
{{--                            <button class="btn btn-primary form-control w-75 text-center">submit</button>--}}
{{--                            <span class="d-block fs-6 text-black-50">Lorem ipsum dolor sit amet!</span>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}


{{--                <div class="reset-password-content">--}}
{{--                    <h4 class="text-capitalize text-center">please define your new passwword</h4>--}}
{{--                    <hr>--}}
{{--                    <form action="">--}}
{{--                        <input class="form-control my-3" type="text" placeholder="password">--}}
{{--                        <input class="form-control my-3" type="text" placeholder="confirm password">--}}
{{--                        <div class="text-center">--}}
{{--                            <button class="btn btn-primary form-control w-75 text-center">submit</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

