<?php

$host = $_SERVER['HTTP_HOST'];
$currentURI = $_SERVER['REQUEST_URI'];
$currentPage = $host . $currentURI;
$explode = explode('/', $currentPage);
$comment_id = null;

if (sizeof($explode) === 3) {
    $comment_id = $explode[2];
}

?>

@extends('layouts.landing.index')
@section('content')

    <div id="blog" class="blog container">
        <nav class="bg-primary">
            <div class="nav nav-tabs justify-content-center border-0" id="nav-tab" role="tablist">

                <button
                    class="nav-link bg-transparent border-0 {{ ((request()->get('tab')) === "blogs") ? "active" : ''}}  text-white"
                    id="nav-recent-tab" data-bs-toggle="tab" data-bs-target="#nav-recent"
                    type="button" role="tab">Recent
                </button>


                <button
                    class="nav-link bg-transparent border-0 {{ ((request()->get('tab')) === "comments/$comment_id") ? "active" : ''}}  text-white"
                    id="nav-comment-tab" data-bs-toggle="tab" data-bs-target="#nav-comment"
                    type="button" role="tab">Comment
                </button>
            </div>
        </nav>

        <div class="tab-content bg-white p-4" id="nav-tabContent">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="tab-pane fade show  {{ ((request()->get('tab')) === "blogs") ? "active" : ''}}"
                         id="nav-recent" role="tabpanel">

                        <div id="top-blog"></div>
                        <div class="row" id="blogList"></div>
                    </div>


                    <div class="tab-pane fade show {{((request()->get('tab')) === "comments/$comment_id") ? "active" : ''}}"id="nav-comment" role="tabpanel">
                        <div id="singleBlog">

                        </div>
                        <div id="blogCommentList">

                            <form action="{{url('/api/blog/comment')}}" class="d-flex align-items-center" id="blogCommentForm">
                                <input type="hidden" id="blog_id" name="blog_id" value="">
                                <input type="text" name="comment_text" class="form-control me-3" placeholder="write your comment">
                                <button class="btn btn-primary">Send</button>
                            </form>

                        </div>


                    </div>
                </div>

                <div class="col-lg-4 col-sm-12 col-12">
                    <div class="title">
                        <span class="bg-primary text-white py-1 px-4">Popular</span>
                    </div>

{{--                    <div class="d-flex align-items-center my-3">--}}
{{--                        <img class="avatar-sm-1"--}}
{{--                             src="https://images.unsplash.com/photo-1545239351-ef35f43d514b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80"--}}
{{--                             alt="">--}}

{{--                        <div class="ms-3">--}}
{{--                            <a href="{{url('/blogs?tab=comments')}}/{{'blogid'}}" class="text-black d-block">Lorem ipsum--}}
{{--                                dolor sit amet, consectetur--}}
{{--                                adipisicing elit. Excepturi, nam?</a>--}}

{{--                            <span class="text-black-50 text-capitalize">14 april, 2022</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                </div>
            </div>

        </div>
    </div>

@endsection

@push('custom-js')
    <script>
        $('#blogCommentForm').submit(function (e) {
            e.preventDefault();

            let token = localStorage.getItem('accessToken')
            let form = $(this);
            formSubmit('post', form, token)
        })

        let constant = {
            location: window.location.search,
            allBlogs: '?tab=blogs',
            singleBlog: '?tab=comments/<?= $comment_id?>',
            allBlogURL : '/api/admin/blog/get-all',
            singleBlogURL : '/api/admin/blog/<?= $comment_id?>'
        }

        function allBlog(res){
            res.data.forEach(item => {
                $('#blogList').append(`
                    <div class="col-lg-6 col-sm-12 col-12 my-5">
                        <img class="img-fluid" src="${item.image}" alt="">
                        <h6 class="my-3">${item.title}</h6>
                        <span class="text-black-50 fst-italic text-capitalize"></span>
                        <a href="{{url('/blogs?tab=comments')}}/${item.id}">
                            <article class="text-black-50 blog-short-description my-2">
                                ${item.description}
                            </article>
                        </a>
                    </div>
                `)
            })
        }

        function singleBlog(res){
            console.log("single blog res: ", res)
            $('#blog_id').val(res.data.id)

            $('#singleBlog').append(`
                    <img src="${res.data.image}" alt="">
                    <h6>${res.data.title}</h6>
                    <article>${res.data.description}</article>


                `)

            if(res.data.blog_comments){
                res.data.blog_comments.forEach(item=>{
                    $('#blogCommentList').append(`
                            <ul class="mt-2">
                                <li class="d-flex my-3">
                                    <img style="width: 50px; height: 50px" src="${item.user.image}" alt="">

                                    <div class="ms-3">
                                        <h6>${item.user.username}</h6>
                                        <span id="comments${item.id}">${item.comment_text}</span>
                                    </div>
                                </li>

                            </ul>
            `)
                })
            }

        }



        function fetchData(url){
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
                    if(url === constant.allBlogURL){
                        allBlog(res)
                    }else if(url === constant.singleBlogURL){

                        singleBlog(res)
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        }

        $(document).ready(function (){
            if(constant.location === constant.allBlogs){

                fetchData(constant.allBlogURL)
            }
            else if(constant.location === constant.singleBlog){
                fetchData(constant.singleBlogURL)

            }
        })


    </script>
@endpush
