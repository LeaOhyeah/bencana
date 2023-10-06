<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test get data</title>

    {{-- leafet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 300px;
        }
    </style>
</head>

<body>
    <div id="map">

    </div>
    <button id="useLocationButton">Use My Location</button>
    <input type="text" name="" id="latitude">
    <input type="text" name="" id="longitude">
</body>

{{-- leafet js --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

{{-- kode leaflet --}}
<script>
    //     map
    var OpenStreet = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        //  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    var Stadia_AlidadeSmoothDark = L.tileLayer(
        'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0,
            maxZoom: 20,
            // attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            ext: 'png'
        });
    var map = L.map('map', {
        center: [-1.9722445569324243, 116.86002939934983],
        zoom: 5,
        layers: [OpenStreet],
    }).setView([-8.674550075372617, 115.19050205461602], 11);
    var baseMap = {
        'Map': OpenStreet,
        'Gelap': Stadia_AlidadeSmoothDark,
    }
    //     end map

    //     marker
    var initialLatLng = [-8.670574868371705, 115.21504981590279];

    var marker = L.marker(initialLatLng, {
        draggable: true
    }).addTo(map);
    //     end marker

    //     function get data
    marker.on('drag', function(event) {
        var coordinate = marker.getLatLng();
        $('#latitude').val(coordinate.lat);
        $('#longitude').val(coordinate.lng);
    });

    function setMarkerToCurrentLocation() {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            marker.setLatLng([latitude, longitude]);
            marker.bindPopup("Lokasi Saya").openPopup();

            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
        });
    }

    document.getElementById('useLocationButton').addEventListener('click', function() {
        setMarkerToCurrentLocation();
    });
    //     end function get data

    //     control
    //     const komponen = {
    //         'Marks': marks
    //     }

    L.control.layers(baseMap).addTo(map);
    //     end control
</script>

</html>
