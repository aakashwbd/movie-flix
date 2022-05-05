<?php
    $currentControllerName = Request::segment(1);
    $currentControllerName2 = Request::segment(2);
    $currentFullRouteName = Route::getFacadeRoot()
        ->current()
        ->uri();

?>

<aside class="sidebar">

    <div id="dashboard-toggle-button" class="toggle-button">
{{--        <span class="iconify" data-icon="fluent:text-grammar-arrow-right-24-filled" data-width="20" data-height="20"></span>--}}

        <span class="iconify" data-icon="fluent:text-grammar-arrow-left-24-filled" data-width="20" data-height="20"></span>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <img src="{{asset('asset/image/default.jpg')}}" class="logo-lg avatar-sm-2 rounded-circle" alt="logo-lg">
    </div>

    <ul class="list">
        <li class="list-item  my-3">
            <a href="{{url('/admin')}}" class="list-link {{$currentFullRouteName == 'admin' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="ic:sharp-space-dashboard" data-width="20"
                      data-height="20"></span>
                dashboard
            </a>
        </li>

        <li class="list-item list-heading">Manage</li>
        <li class="list-item  my-3">
            <a href="{{url('/admin/category')}}" class="list-link {{$currentControllerName2 == 'category' || '' ? 'active' : '' }}">
                <span class="iconify me-2"  data-icon="material-symbols:category-outline" data-width="20"
                      data-height="20"></span>
                Category
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/blog')}}" class="list-link {{$currentControllerName2 == 'blog' || '' ? 'active' : '' }}">
                <span class="iconify me-2"  data-icon="fa6-brands:blogger-b" data-width="20"
                      data-height="20"></span>
                Blog
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/banner-image')}}" class="list-link {{$currentControllerName2 == 'banner-image' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="bi:image" data-width="20"
                      data-height="20"></span>
                Banner Image
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/flash')}}" class="list-link {{$currentControllerName2 == 'flash' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="carbon:flash-filled" data-width="20"
                      data-height="20"></span>
                Flash
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/verification')}}" class="list-link {{$currentControllerName2 == 'verification' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="uiw:verification" data-width="20"
                      data-height="20"></span>
                Verification Requests
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/report')}}" class="list-link {{$currentControllerName2 == 'report' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="ic:round-report" data-width="20"
                      data-height="20"></span>
               Reports
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/invite-code')}}" class="list-link {{$currentControllerName2 == 'invite-code' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="ic:sharp-space-dashboard" data-width="20"
                      data-height="20"></span>
                Invitation Code
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/package')}}" class="list-link {{$currentControllerName2 == 'package' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="ic:sharp-space-dashboard" data-width="20"
                      data-height="20"></span>
                Package
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/recent-payment')}}" class="list-link {{$currentControllerName2 == 'recent-payment' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="material-symbols:payments-outline-rounded" data-width="20"
                      data-height="20"></span>
                Recent Payment
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/video')}}" class="list-link {{$currentControllerName2 == 'video' || '' ? 'active' : '' }}">
                <span class="iconify me-2"  data-icon="bxs:video"  data-width="20"
                      data-height="20"></span>
                Clean Video
            </a>
        </li>

        <li class="list-item list-heading">Administration</li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/manage-admin')}}" class="list-link {{$currentControllerName2 == 'manage-admin' || '' ? 'active' : '' }}">
                <span class="iconify me-2"  data-icon="clarity:administrator-solid" data-width="20"
                      data-height="20"></span>
                Manage Admin
            </a>
        </li>

        <li class="list-item list-heading">Users</li>
        <li class="list-item  my-3">
            <a href="{{url('/admin/manage-users')}}" class="list-link {{$currentControllerName2 == 'manage-users' || '' ? 'active' : '' }}">
                <span class="iconify me-2"  data-icon="clarity:administrator-solid" data-width="20"
                      data-height="20"></span>
                Manage Users
            </a>
        </li>
        <li class="list-item  my-3">
            <a href="{{url('/admin/banned-users')}}" class="list-link {{$currentControllerName2 == 'banned-users' || '' ? 'active' : '' }}">
                <span class="iconify me-2"  data-icon="clarity:administrator-solid" data-width="20"
                      data-height="20"></span>
                Banned Users
            </a>
        </li>

        <li class="list-item list-heading">Setting</li>
        <li class="list-item  my-3">
            <a href="{{url('/admin/settings')}}" class="list-link {{$currentControllerName2 == 'settings' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="ant-design:setting-filled" data-width="20"
                      data-height="20"></span>
                Basic Setting
            </a>
        </li>

        <li class="list-item  my-3">
            <a href="{{url('/admin/notification')}}" class="list-link {{$currentControllerName2 == 'notification' || '' ? 'active' : '' }}">
                <span class="iconify me-2" data-icon="ic:sharp-space-dashboard" data-width="20"
                      data-height="20"></span>
                Notification
            </a>
        </li>


    </ul>

</aside>


{{--<div id="mobile-sidebar" class="mobile-sidebar">--}}
{{--    <aside class="sidebar">--}}
{{--        <!-- Sidebar Toggle Button -->--}}
{{--        <button class="btn btn-sm sidebar-toggle-button">--}}
{{--            <i class="bi bi-caret-left-fill"></i>--}}
{{--            <i class="bi bi-list"></i>--}}
{{--            <i class="bi bi-caret-right-fill d-none"></i>--}}
{{--        </button>--}}


{{--        <!-- Sidebar Logo & Icon -->--}}
{{--        <div class="sidebar-logo pb-2 text-center">--}}
{{--            <img src="{{asset('asset/image/default.jpg')}}" class="logo-lg avatar-sm-2 rounded-circle" alt="logo-lg">--}}
{{--            <img src="{{asset('asset/image/default.jpg')}}" class="logo-sm d-none avatar-sm" alt="logo-sm">--}}
{{--        </div>--}}

{{--        <!-- Sidebar Navigation -->--}}
{{--        <ul class="sidebar-nav">--}}

{{--            <!-- Dashboard -->--}}
{{--            <li class="sidebar-nav-item my-4">--}}
{{--                <a href="/" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="ic:sharp-space-dashboard" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Dashboard</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-heading">Manage</li>--}}


{{--            <!-- Category -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/category" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="ic:outline-category" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Category</span>--}}


{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Manege Series -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/series/series-Category.php" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="carbon:save-series" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Manege Series</span>--}}


{{--                </a>--}}
{{--            </li>--}}

{{--            <!-- Artist -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/artist" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="carbon:user-avatar-filled-alt" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Artist</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Genres -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/genres" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="ph:mask-happy" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Genres</span>--}}


{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Tv Channels -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/tv" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="eva:tv-outline" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Tv Channels</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Country -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/country" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="bx:world" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Country</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Top Features -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/top-feature" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="bi:arrow-up" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Top Features</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Home Banner -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/home-banner/home-banner.php" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="carbon:user-avatar-filled-alt" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Home Banner</span>--}}
{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Sponsors -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/sponsor-video/sponsor-banner.php" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="carbon:user-avatar-filled-alt" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Sponsors</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-heading">Video</li>--}}

{{--            <!-- Video -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/video" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="bxs:video-plus" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Video</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-heading">Administration</li>--}}

{{--            <!-- Manage Admin -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/admin/admin.php" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="clarity:administrator-solid" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Manage Admin</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-heading">User</li>--}}

{{--            <!-- Manage User -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/user" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="carbon:user-avatar-filled-alt" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Manage User</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Comment -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/comment" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="fa-solid:comment-alt" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Comment</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Report -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/report" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="ic:baseline-report" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Report</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-heading">Settings</li>--}}

{{--            <!-- Advertisement -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/advertisement" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="fa-solid:ad" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Advertisement</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!-- Notifications -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/notification" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="lucide:bell-plus" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Notifications</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--            <!--  Basic Setting  -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/setting" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="ant-design:setting-filled" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Basic Setting</span>--}}

{{--                </a>--}}
{{--            </li>--}}

{{--            <!--  Video Setting  -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/video-setting" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="bi:play-circle-fill" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Video Setting</span>--}}

{{--                </a>--}}
{{--            </li>--}}

{{--            <!--  SMTP Setting  -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/smtp" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="fluent:mail-16-filled" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">SMTP Setting</span>--}}

{{--                </a>--}}
{{--            </li>--}}

{{--            <!--  Contact Us  -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/contact" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="bx:message-check" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Contact Us</span>--}}

{{--                </a>--}}
{{--            </li>--}}

{{--            <!--  Subscriber  -->--}}
{{--            <li class="sidebar-nav-item mb-3">--}}
{{--                <a href="/subscriber" class="sidebar-nav-link">--}}

{{--               <span class="iconify me-2" data-icon="eos-icons:subscriptions-created-outlined" data-width="22"--}}
{{--                     data-height="22"></span>--}}

{{--                    <span class="sidebar-nav-title">Subscriber</span>--}}

{{--                </a>--}}
{{--            </li>--}}


{{--        </ul>--}}

{{--    </aside>--}}
{{--</div>--}}



