@extends('layouts.landing.index')
@section('content')
    <div class="container content-config">
        <div id="searchBannerImg">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-12 order-sm-2 order-lg-1 mb-3">
                    <div class="row">
                        <div class="col-lg-10 col-12 offset-lg-1">
                            <button class="btn btn-primary mb-3" data-bs-target="#placeModal" data-bs-toggle="modal">Place an ad
                            </button>
                            <h6 class="text-white text-capitalize">filter ads:</h6>
                            <form action="{{url('/api/news/search')}}" id="newsSearchForm">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="text" name="address" class="form-control mb-3" placeholder="Search Location">
                                    </div>
                                    <div class="col-lg-12">
                                        <select name="type" class="form-select mb-3">
                                            <option value="all" selected>Who Hosts and/or Visits</option>
                                            <option value="host">Who Hosts</option>
                                            <option value="visit">Who Visits</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <input type="text" class="form-control" name="minage" placeholder="10">
                                            <label class="text-capitalize mx-3 text-white">to</label>
                                            <input type="text" class="form-control" name="maxage" placeholder="49">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" name="keyword" class="form-control mb-3" placeholder="keyword">
                                    </div>

                                    <div class="col-lg-12">
                                        <select name="member" class="form-select mb-3">
                                            <option value="closest" selected>The Closest</option>
                                            <option value="online">Online Members</option>
                                            <option value="recent">Recent Members</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary form-control mb-3">search</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-sm-12 order-sm-1 order-lg-2 mb-3">
                    <img class="bannerImg"
                         src=""
                         alt="">
                </div>
            </div>
        </div>

        <div class="py-2 my-5 bg-primary text-white d-flex align-items-center justify-content-center">
                <span class="iconify me-5 cursor-pointer" data-icon="ant-design:reload-outlined" data-width="20"
                      data-height="20"></span>
            <span> from 10 years old to 49 years old- who hosts and/or visits - in New York and around </span>
            <span class="iconify ms-5 cursor-pointer" data-icon="ep:close" data-width="20" data-height="20"></span>
        </div>
        <div class="row" id="placeList"></div>
    </div>

    <div class="modal" id="placeModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom justify-content-center">
                    <h4>Place Ad</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('api/place/store')}}" id="placeForm">
                        <div class="text-center">
                            <span>your ad will expired</span>

                            <div class="d-flex align-items-center justify-content-center my-2">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" value="1 month" name="duration" id="month">
                                    <label class="form-check-label" for="month">
                                        1 month
                                    </label>
                                </div>

                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" value="1 week" name="duration" id="week">
                                    <label class="form-check-label" for="week">
                                        1 week
                                    </label>
                                </div>

                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" value="24 hour" name="duration" id="hour">
                                    <label class="form-check-label" for="hour">
                                        24 hours
                                    </label>
                                </div>
                            </div>
                        </div>

                        <input type="text" name="title" class="form-control mb-3" placeholder="Message Title">
                        <input type="text" name="address" class="form-control mb-3" placeholder="Location">
                        <textarea name="description" placeholder="message" class="form-control mb-3"></textarea>

                        <div class="row">
                            <div class="col-lg-6">
                                <img class="avatar-sm me-3 d-none" id="placeImagePreview" src="" alt="">
                                <input type="hidden" name="image" id="placeImageURL">
                                <input type="file" id="file-uploader" hidden name="image" onchange="placeImgUpload(event)"/>
                                <label for="file-uploader"
                                       class="d-flex align-items-center cursor-pointer">
                                    <span class="iconify me-3" data-icon="fa-solid:camera" data-width="20"
                                          data-height="20"></span>
                                    Upload Ad Image
                                </label>
                            </div>

                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




{{--    <div class="modal fade" id="commentModal" data-bs-keyboard="false" tabindex="-1">--}}
{{--        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header justify-content-center">--}}
{{--                    <h6 class="text-capitalize">Ad Comment</h6>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="comment" class="form-control " placeholder="Write Your Comment">--}}
{{--                        <span class="locationError text-danger d-none">Please select your city</span>--}}
{{--                    </div>--}}
{{--                    <div class="text-center my-3">--}}
{{--                        <button id="location-btn" class="btn btn-primary w-75  form-control">Submit</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

@push('custom-js')
    <script>
        function placeImgUpload (event) {
            event.preventDefault();
            let file = event.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'place');

            let showURL = window.origin + '/api/image-uploader';
            $.ajax({
                url: showURL,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                success: function (res) {
                    console.log(res)
                    if(res.status === 'success'){
                        toastr.success(res.message)
                        $('#placeImageURL').val(res.data)
                        $('#placeImagePreview').removeClass('d-none').attr('src',res.data)
                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        }

        $('#placeForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let token = localStorage.getItem('accessToken')
            formSubmit("post", form, token);
        })




        $('#newsSearchForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let token = localStorage.getItem('accessToken')
            let form_data = JSON.stringify(form.serializeJSON());
            let formData = JSON.parse(form_data)


            let url = form.attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': token
                }, success: function (response) {
                    console.log('ad res', response)

                    if(response.status === 'success'){
                        $('#placeList').html('')
                        let user = JSON.parse(localStorage.getItem('user'))
                        response.data.forEach((item, index)=>{



                            $('#placeList').append(`
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h6>${item.title}</h6>
                                                    <p>${item.description}</p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <img id="adsImage" class="" style="width: 100px; height: 100px;" src="${item.image}" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <h6>${item.address}</h6>
                                                    <span>${item.user.username}</span>
                                                </div>
                                            </div>
                                        </div>
                                         <div id='postAction${item.id}' class="d-none card-action text-center p-2 border-top">
                                             <span data-bs-target="#editplaceModal${item.id}" data-bs-toggle='modal' class="iconify me-3 cursor-pointer" data-icon="bxs:edit" data-width="20" data-height="20"></span>
                                               <span class="iconify cursor-pointer" data-icon="ep:delete" data-width="20" data-height="20"></span>
                                           </div>

                                    </div>
                                </div>


                                <div class="modal" id="editplaceModal${item.id}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom justify-content-center">
                                                <h4>Edit Place Ad</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{'/api/place/update'}}" id="editPlaceForm${item.id}">
                                                <input type='hidden' name='ad_id' value='${item.id}'/>
                                                    <div class="text-center">
                                                        <span>your ad will expired</span>

                                                        <div class="d-flex align-items-center justify-content-center my-2">
                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" value="1 month" name="duration" id="month">
                                                                <label class="form-check-label" for="month">
                                                                    1 month
                                                                </label>
                                                            </div>

                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" value="1 week" name="duration" id="week">
                                                                <label class="form-check-label" for="week">
                                                                    1 week
                                                                </label>
                                                            </div>

                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" value="24 hour" name="duration" id="hour">
                                                                <label class="form-check-label" for="hour">
                                                                    24 hours
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="text" value='${item.title}' name="title" class="form-control mb-3" placeholder="Message Title">
                                                    <input type="text" value='${item.address}' name="address" class="form-control mb-3" placeholder="Location">
                                                    <textarea name="description" placeholder="message" class="form-control mb-3">${item.description}</textarea>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <img class="avatar-sm me-3 d-none" id="placeImagePreview" src="" alt="">
                                                            <input type="hidden" name="image" id="placeImageURL">
                                                            <input type="file" id="file-uploader" hidden name="image" onchange="placeImgUpload(event)"/>
                                                            <label for="file-uploader"
                                                                   class="d-flex align-items-center cursor-pointer">
                                                                <span class="iconify me-3" data-icon="fa-solid:camera" data-width="20"
                                                                      data-height="20"></span>
                                                                Upload Ad Image
                                                            </label>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            `)
                            if(user){
                                if(user.id === item.user.id){
                                    // console.log('user:', typeof(user.id) , "item User id:", typeof(item.user.id) )
                                    $('#postAction'+item.id).removeClass('d-none')
                                }
                            }

                            $('#editPlaceForm'+item.id).submit(function (e) {
                                e.preventDefault();
                                let form = $(this);
                                let token = localStorage.getItem('accessToken')
                                formSubmit("post", form, token);
                            })
                        })
                    }
                }, error: function (xhr, resp, text) {
                    console.log(xhr)
                }
            });
        })
        //

        $(document).ready(function (){
            $.ajax({
                url: window.origin + '/api/place/get-all',
                type: 'GET',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {
                    console.log('all', res)

                    if(res.status === 'success'){
                        // fetchData(res.data)
                        let user = JSON.parse(localStorage.getItem('user'))
                        res.data.forEach((item, index)=>{
                            // alert(index)
                            //
                            //


                            $('#placeList').append(`
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h6>${item.title}</h6>
                                                    <p>${item.description}</p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <img id="adsImage" class="" style="width: 100px; height: 100px;" src="${item.image}" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <h6>${item.address}</h6>
                                                    <span>${item.user.username}</span>
                                                </div>
                                            </div>
                                        </div>
                                         <div id='postAction${item.id}' class="d-none card-action text-center p-2 border-top">
                                             <span data-bs-target="#editplaceModal${item.id}" data-bs-toggle='modal' class="iconify me-3 cursor-pointer" data-icon="bxs:edit" data-width="20" data-height="20"></span>
                                               <span class="iconify cursor-pointer" data-icon="ep:delete" data-width="20" data-height="20"></span>
                                           </div>

                                    </div>
                                </div>


                                <div class="modal" id="editplaceModal${item.id}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom justify-content-center">
                                                <h4>Edit Place Ad</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{'/api/place/update'}}" id="editPlaceForm${item.id}">
                                                <input type='hidden' name='ad_id' value='${item.id}'/>
                                                    <div class="text-center">
                                                        <span>your ad will expired</span>

                                                        <div class="d-flex align-items-center justify-content-center my-2">
                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" value="1 month" name="duration" id="month">
                                                                <label class="form-check-label" for="month">
                                                                    1 month
                                                                </label>
                                                            </div>

                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" value="1 week" name="duration" id="week">
                                                                <label class="form-check-label" for="week">
                                                                    1 week
                                                                </label>
                                                            </div>

                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" value="24 hour" name="duration" id="hour">
                                                                <label class="form-check-label" for="hour">
                                                                    24 hours
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="text" value='${item.title}' name="title" class="form-control mb-3" placeholder="Message Title">
                                                    <input type="text" value='${item.address}' name="address" class="form-control mb-3" placeholder="Location">
                                                    <textarea name="description" placeholder="message" class="form-control mb-3">${item.description}</textarea>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <img class="avatar-sm me-3 d-none" id="placeImagePreview" src="" alt="">
                                                            <input type="hidden" name="image" id="placeImageURL">
                                                            <input type="file" id="file-uploader" hidden name="image" onchange="placeImgUpload(event)"/>
                                                            <label for="file-uploader"
                                                                   class="d-flex align-items-center cursor-pointer">
                                                                <span class="iconify me-3" data-icon="fa-solid:camera" data-width="20"
                                                                      data-height="20"></span>
                                                                Upload Ad Image
                                                            </label>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            `)
                            if(user){
                                if(user.id === item.user.id){
                                    // console.log('user:', typeof(user.id) , "item User id:", typeof(item.user.id) )
                                    $('#postAction'+item.id).removeClass('d-none')
                                }
                            }

                            $('#editPlaceForm'+item.id).submit(function (e) {
                                e.preventDefault();
                                let form = $(this);
                                let token = localStorage.getItem('accessToken')
                                formSubmit("post", form, token);
                            })
                        })
                    }
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        })





    </script>
@endpush

