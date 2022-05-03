@extends('layouts.landing.index')
@section('content')
    <div class="container content-config">

        <div class="bg-primary py-3 px-2 text-center">
            <span class="text-white fw-bold">Title</span>
        </div>
        <div class="bg-white p-2">
            <h6>tile</h6>
            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, asperiores autem commodi corporis dignissimos dolor earum eius, eum harum molestiae nisi numquam placeat quaerat qui quia saepe soluta vel. Accusamus ad blanditiis consequuntur cum delectus, ducimus eos est expedita fugiat impedit in itaque minima, placeat quam quia quis repudiandae tenetur?</span>

            <h6>tile</h6>
            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, asperiores autem commodi corporis dignissimos dolor earum eius, eum harum molestiae nisi numquam placeat quaerat qui quia saepe soluta vel. Accusamus ad blanditiis consequuntur cum delectus, ducimus eos est expedita fugiat impedit in itaque minima, placeat quam quia quis repudiandae tenetur?</span>
        </div>

    </div>

{{--    <div class="modal" id="placeModal">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header border-bottom justify-content-center">--}}
{{--                    <h4>Place Ad</h4>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form action="{{url('api/place/store')}}" id="placeForm">--}}
{{--                        <div class="text-center">--}}
{{--                            <span>your ad will expired</span>--}}

{{--                            <div class="d-flex align-items-center justify-content-center my-2">--}}
{{--                                <div class="form-check me-3">--}}
{{--                                    <input class="form-check-input" type="radio" value="1 month" name="duration" id="month">--}}
{{--                                    <label class="form-check-label" for="month">--}}
{{--                                        1 month--}}
{{--                                    </label>--}}
{{--                                </div>--}}

{{--                                <div class="form-check me-3">--}}
{{--                                    <input class="form-check-input" type="radio" value="1 week" name="duration" id="week">--}}
{{--                                    <label class="form-check-label" for="week">--}}
{{--                                        1 week--}}
{{--                                    </label>--}}
{{--                                </div>--}}

{{--                                <div class="form-check me-3">--}}
{{--                                    <input class="form-check-input" type="radio" value="24 hour" name="duration" id="hour">--}}
{{--                                    <label class="form-check-label" for="hour">--}}
{{--                                        24 hours--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <input type="text" name="title" class="form-control mb-3" placeholder="Message Title">--}}
{{--                        <input type="text" name="address" class="form-control mb-3" placeholder="Location">--}}
{{--                        <textarea name="description" placeholder="message" class="form-control mb-3"></textarea>--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <img class="avatar-sm me-3 d-none" id="placeImagePreview" src="" alt="">--}}
{{--                                <input type="hidden" name="image" id="placeImageURL">--}}
{{--                                <input type="file" id="file-uploader" hidden name="image" onchange="placeImgUpload(event)"/>--}}
{{--                                <label for="file-uploader"--}}
{{--                                       class="d-flex align-items-center cursor-pointer">--}}
{{--                                    <span class="iconify me-3" data-icon="fa-solid:camera" data-width="20"--}}
{{--                                          data-height="20"></span>--}}
{{--                                    Upload Ad Image--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-6">--}}
{{--                                <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

@push('custom-js')
    <script>
        // function placeImgUpload (event) {
        //     event.preventDefault();
        //     let file = event.target.files[0];
        //     let formData = new FormData()
        //     formData.append('file', file);
        //     formData.append('folder', 'place');
        //
        //     let showURL = window.origin + '/api/image-uploader';
        //     $.ajax({
        //         url: showURL,
        //         type: 'POST',
        //         dataType: "json",
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //         },
        //         data: formData,
        //         success: function (res) {
        //             console.log(res)
        //             if(res.status === 'success'){
        //                 toastr.success(res.message)
        //                 $('#placeImageURL').val(res.data)
        //                 $('#placeImagePreview').removeClass('d-none').attr('src',res.data)
        //             }
        //         }, error: function (jqXhr, ajaxOptions, thrownError) {
        //             console.log(jqXhr)
        //         }
        //     });
        // }
        //
        // $('#placeForm').submit(function (e) {
        //     e.preventDefault();
        //     let form = $(this);
        //     let token = localStorage.getItem('accessToken')
        //     formSubmit("post", form, token);
        // })
        // //
        //
        // $(document).ready(function (){
        //     $.ajax({
        //         url: window.origin + '/api/place/get-all',
        //         type: 'GET',
        //         dataType: "json",
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //         },
        //         success: function (res) {
        //             if(res.status === 'success'){
        //                 res.data.forEach(item=>{
        //                     $('#placeList').append(`
        //                         <div class="col-lg-4">
        //                             <div class="card">
        //                                 <div class="card-body">
        //                                     <div class="row">
        //                                         <div class="col-lg-8">
        //                                             <h6>${item.title}</h6>
        //                                             <p>${item.description}</p>
        //                                         </div>
        //                                         <div class="col-lg-4">
        //                                             <img style="width: 100px; height: 100px;" src="${item.image}" alt="">
        //                                         </div>
        //                                         <div class="col-lg-6">
        //                                             <h6>${item.address}</h6>
        //                                             <span>username</span>
        //                                         </div>
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     `)
        //                 })
        //             }
        //         }, error: function (jqXhr, ajaxOptions, thrownError) {
        //             console.log(jqXhr)
        //         }
        //     });
        // })

    </script>
@endpush

