<!DOCTYPE html>
<html>

<head>
    <title>Edit Disaster</title>
    {{-- leafet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 500px;
            width: 600px;
            /* margin-left: 2cm; */
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

</head>

<body>
    <h1>Edit Disaster</h1>

    <form method="post" action="{{ route('disaster.destroy', $disaster->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete Disaster</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('disaster.update', $disaster->id) }}">
        @method('put')
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->code }}" type="text" id="code" name="code" required><br>
        <br>


        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->name }}" type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10">{{ $disaster->description }}</textarea><br>
        <br>

        <label for="start_date">Start Date:</label>
        @error('start_date')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->start_date }}" type="date" id="start_date" name="start_date" required><br>
        <br>

        <label for="end_date">End Date:</label>
        @error('end_date')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->end_date }}" type="date" id="end_date" name="end_date"><br>
        <br>

        <label for="closed_date">Closed Date:</label>
        @error('closed_date')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->closed_date }}" type="date" id="closed_date" name="closed_date"><br>
        <br>

        <div id="map"></div>

        @error('lat')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->lat }}" type="text" id="lat" name="lat" required><br>
        <br>

        @error('long')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->long }}" type="text" id="long" name="long" required><br>
        <br>

        <button id="myLocation" type="button">Use My Location</button>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    // map
    var OpenStreet = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
    });
    var Stadia_AlidadeSmoothDark = L.tileLayer(
        'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.{ext}', {
            maxZoom: 20,
            ext: 'png'
        });
    var map = L.map('map', {
        layers: [OpenStreet],
    }).setView([{{ $disaster->lat }}, {{ $disaster->long }}], 11); // sesuai data
    var baseMap = {
        'Terang': OpenStreet,
        'Gelap': Stadia_AlidadeSmoothDark,
    }
    L.control.layers(baseMap).addTo(map);
    // end map

    // marker {sesuai data}
    var initialLatLng = [{{ $disaster->lat }}, {{ $disaster->long }}];
    var marker = L.marker(initialLatLng, {
        draggable: true
    }).addTo(map);
    // end marker

    // function get data
    marker.on('drag', function(event) {
        var coordinate = marker.getLatLng();
        $('#lat').val(coordinate.lat);
        $('#long').val(coordinate.lng);
        marker.bindPopup("Pilih Lokasi Baru").openPopup();
    });

    function setMarkerToCurrentLocation() {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            marker.setLatLng([latitude, longitude]);
            marker.bindPopup("Lokasi Anda").openPopup();
            map.setView([latitude, longitude], 14);
            $('#lat').val(latitude);
            $('#long').val(longitude);
        });
    }
    document.getElementById('myLocation').addEventListener('click', function() {
        setMarkerToCurrentLocation();
    });
    // end function get data

    // inisialisasi geocoder
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false, // Tidak otomatis menandai hasil geocode
    }).addTo(map);
    // end inisialisasi geocoder

    // function return geocoder
    geocoder.on('markgeocode', function(event) {
        var result = event.geocode;
        var latlng = result.center;
        marker.setLatLng([latlng.lat, latlng.lng]);
        $('#lat').val(latlng.lat);
        $('#long').val(latlng.lng);
        marker.bindPopup("Lokasi Pencarian").openPopup();
        map.setView([latlng.lat, latlng.lng], 14);
    });
    // end function return geocoder
</script>

</html>
