@extends('layouts.landing.index')
@section('content')

    <div class="content-config">
        <div id="map"></div>

        <button id="locationButton" class="btn btn-warning d-none">Set Pin Your Location</button>

        <input type="hidden" name="long" id="long">
        <input type="hidden" name="lat" id="lat">
    </div>




@endsection
@push('custom-js')
    <script>
        let token = localStorage.getItem('accessToken')

        let button = document.getElementById('locationButton')
        let long = document.getElementById('long')
        let lat = document.getElementById('lat')

        // const data = [
        //     {long: 12.55, lat: 55.70, title: 'hi'},
        //     {long: 14.554729, lat: 56.70651, title: 'hello'},
        //     {long: 16.554729, lat: 57.70651, title: 'bye'},
        //     {long: 18.554729, lat: 58.70651, title: 'good bye'},
        // ]

        mapboxgl.accessToken = 'pk.eyJ1IjoiYWthc2gtd2JkIiwiYSI6ImNsMmVoZTRkNzAwcWIzYm52N2ljcWFkdmgifQ.09ZCXCfd8NEGvJoFqOzOyg';

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [12.550343, 55.665957],
            zoom: 5
        })

        // data.forEach((item, i) => {
        //     const popup = new mapboxgl.Popup({offset: 25}).setText(item.title);
        //     new mapboxgl.Marker()
        //         .setLngLat([item.long, item.lat])
        //         .setPopup(popup)
        //         .addTo(map);
        // })
        var geolocate = new mapboxgl.GeolocateControl();
        map.addControl(geolocate);




        geolocate.on('geolocate', function (e) {
            var lon = e.coords.longitude;
            var latt = e.coords.latitude
           var position = [lon, lat];


            if(token){
                button.classList.remove('d-none')
            }

            long.value =lon
            lat.value =latt


            // positions(position)


        });

        // function positions (position){
        //     return position
        // }
        //
        button.addEventListener('click', ()=>{
            let user = JSON.parse(localStorage.getItem('user'))
            let formData = new FormData()
            formData.append('long', long.value)
            formData.append('lat', lat.value)
            formData.append('name', user.username)
            let token = localStorage.getItem('accessToken')

            $.ajax({
                url: window.origin + '/api/set-location',
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': token
                },
                data: formData,
                success: function (res) {
                    toastr.success(res.message)
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            })


        })


        $(document).ready(function (){
            $.ajax({
                url: window.origin + '/api/get-location',
                type: 'GET',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {
                    console.log(res)

                    res.data.forEach((item, i) => {
                        const popup = new mapboxgl.Popup({offset: 25}).setText(item.name);
                        new mapboxgl.Marker()
                            .setLngLat([item.long, item.lat])
                            .setPopup(popup)
                            .addTo(map);
                    })
                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        })


    </script>


@endpush
