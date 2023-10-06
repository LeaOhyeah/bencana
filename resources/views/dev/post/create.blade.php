<!DOCTYPE html>
<html>

<head>
    <title>Create Post</title>
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
    <h1>Create Post</h1>

    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input type="text" id="code" name="code" required><br>
        <br>

        <label for="disaster_id">Disaster ID:</label>
        @error('disaster_id')
            {{ $message }}
        @enderror
        <select name="disaster_id" id="disaster_id">
            <option>Select Disaster</option>
            @foreach ($disasters as $disaster)
                <option value="{{ $disaster->id }}" data-lat="{{ $disaster->lat }}" data-long="{{ $disaster->long }}">
                    {{ $disaster->name }}</option>
            @endforeach
        </select><br><br>

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <br>

        <label for="photo">Photo:</label>
        @error('photo')
            {{ $message }}
        @enderror
        <input type="file" id="photo" name="photo"><br>
        <br>

        <div id="map"></div>

        <label for="lat">Lat:</label>
        @error('lat')
            {{ $message }}
        @enderror
        <input type="text" id="lat" name="lat" required><br>
        <br>

        <label for="long">Long:</label>
        @error('long')
            {{ $message }}
        @enderror
        <input type="text" id="long" name="long" required><br>
        <br>

        <button id="myLocation" type="button">Use My Location</button>

        <button type="submit">
            <h4>Save Data</h4>
        </button>
    </form>

</body>

{{-- leafet js --}}
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
    }).setView([-0.79021988479697, 118.92346179551438], 4); // tenah indonesia
    var baseMap = {
        'Terang': OpenStreet,
        'Gelap': Stadia_AlidadeSmoothDark,
    }
    L.control.layers(baseMap).addTo(map);

    // Fungsi untuk mengubah isi initialLatLng berdasarkan pilihan yang dipilih
    document.getElementById('disaster_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var disasterLat = selectedOption.getAttribute('data-lat');
        var disasterLong = selectedOption.getAttribute('data-long');

        // Mengubah isi initialLatLng sesuai dengan data yang terkait dengan pilihan yang dipilih
        initialLatLng = [parseFloat(disasterLat), parseFloat(disasterLong)];

        // Mengatur ulang marker ke lokasi yang sesuai dengan data baru
        marker.setLatLng(initialLatLng);
        map.setView(initialLatLng, 14); // Sesuaikan dengan tingkat zoom yang diinginkan

        // Mengisi input lat dan long dengan data yang sesuai
        $('#lat').val(initialLatLng[0]);
        $('#long').val(initialLatLng[1]);
    });
    // end map

    // marker {tengah indonesia}
    var initialLatLng = [-0.79021988479697, 118.92346179551438];
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
