@extends('layouts.landing.index')
@section('content')
    @if(session()->has('token'))
        <script>
            let token = "{{session()->get('token')}}"
            localStorage.setItem('accessToken', token)
        </script>
    @endif
    <div class="container content-config">
        <div id="searchBannerImg">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-12 order-sm-2 order-lg-1 mb-3">
                    <form action="{{url('api/search-user')}}" id="searchForm">
                        <h6 class="text-white fw-bold fs-5 mb-2">Peoples around me</h6>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control  getLocation address" name="address"
                                   placeholder="Search Location">
                            <span class="text-danger address_error"></span>
                        </div>

                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <input type="text" class="form-control" name="minage" placeholder="10">
                            <label class="text-capitalize mx-3 text-white">to</label>
                            <input type="text" class="form-control" name="maxage" placeholder="49">
                        </div>
                        <select name="type" class="form-select mb-3">
                            <option value="" selected>Who Hosts and/or Visits</option>
                            <option value="host">Who Hosts</option>
                            <option value="visit">Who Visits</option>
                        </select>
                        <select name="member" class="form-select mb-3">
                            <option value="" selected>Suggested Members</option>
                            <option value="online">Online Members</option>
                            <option value="new">New Members</option>
                            <option value="all">All Members</option>
                        </select>
                        <input type="text" class="form-control mb-3" name="keyword" placeholder="Keyword">
                        <button type="submit" class="btn btn-primary form-control mb-3 text-capitalize">search</button>
                    </form>
                </div>

                <div class="col-lg-8 col-sm-12 order-sm-1 order-lg-2 mb-3">
                    <img class="bannerImg"
                         src=""
                         alt="">
                </div>
            </div>
        </div>

        <div id="searchList">
            <div class="py-2 my-5 bg-primary text-white d-flex align-items-center justify-content-center">
                <span class="iconify me-5 cursor-pointer" data-icon="ant-design:reload-outlined" data-width="20"
                      data-height="20"></span>
                <span> from 10 years old to 49 years old- who hosts and/or visits - in New York and around  </span>
                <span class="iconify ms-5 cursor-pointer" data-icon="ep:close" data-width="20" data-height="20"></span>
            </div>

            <ul class="list" id="homeSearchListContainer"></ul>

            <div class="text-center">
                <button class="btn text-white text-capitalize" id="loadMoreBtn">show more result</button>
            </div>
        </div>
    </div>


    <div class="modal fade" id="flashModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="login-content">
                        <h6 class="text-capitalize text-center">send a flash</h6>
                        <hr>


                        <div class="row">
                            <div class="col-lg-10 offset-lg-1" id="flashForm">
                                <form action="{{url('/api/user/send-flash')}}" id="sendFlashForm">
                                    <input type="hidden" id="receiver_id" name="receiver_id" value="">
                                    <div class="row row-cols-2" id="flashList"></div>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom-js')
    <script>
        $('#searchForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit('post', form)
        })

        $('#sendFlashForm').submit(function (e) {
            e.preventDefault();
            let token = localStorage.getItem('accessToken')
            let form = $(this);
            formSubmit('post', form, token)
        })


        const loadMore = document.querySelector('#loadMoreBtn');
        let currentItems = 5;
        loadMore.addEventListener('click', (e) => {
            const elementList = [...document.querySelectorAll('#homeSearchListContainer .list-item')];
            for (let i = currentItems; i < currentItems + 5; i++) {
                if (elementList[i]) {
                    elementList[i].style.display = 'block';
                }
            }
            currentItems += 5;

            // Load more button will be hidden after list fully loaded
            if (currentItems >= elementList.length) {
                event.target.style.display = 'none';
            }
        })


        $(document).ready(function () {
            $.ajax({
                url: window.origin + '/api/admin/flash/get',
                type: 'GET',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {

                    res.data.forEach(item => {
                        $('#flashList').append(`
                            <div class="col mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" name="flash" type="radio" value="${item.id}"
                                               id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ${item.name}
                                        </label>
                                    </div>
                                </div>

                            `)
                    })


                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        })


    </script>
@endpush


