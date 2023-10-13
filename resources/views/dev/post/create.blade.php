@extends('layouts.main2')
@section('title', 'Tambah Posko')

@section('css')
    {{-- leafet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 400px;
        }

        .floating-button {
            position: absolute;
            right: 20px;
            bottom: 20px;
            z-index: 999;
        }

        .custom-textarea {
            width: 100%;
            height: 100px !important;
            resize: vertical;
        }

        @media screen and (max-width: 600px) {
            .custom-textarea {
                width: 100%;
                height: 180px !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endsection

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-default-danger" role="alert">
            <b>
                {{ session('error') }}
            </b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Data Posko</h3>
        </div>
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row mx-1">
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="disaster_id">Pusat Bencana</label>
                            <select name="disaster_id" class="form-control @error('disaster_id') is-invalid @enderror"
                                id="disaster_id">
                                @foreach ($disasters as $disaster)
                                    @if (old('disaster_id') == $disaster->id)
                                        <option value="{{ $disaster->id }}" data-lat="{{ $disaster->lat }}"
                                            data-long="{{ $disaster->long }}" selected>{{ $disaster->name }}
                                            ({{ $disaster->code }})
                                        </option>
                                    @else
                                        <option value="{{ $disaster->id }}" data-lat="{{ $disaster->lat }}"
                                            data-long="{{ $disaster->long }}">{{ $disaster->name }}
                                            ({{ $disaster->code }})</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('disaster_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                name="code" placeholder="Masukkan Kode Posko" required autofocus
                                value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukkan Nama Posko" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- poto --}}
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="photo">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @error('photo')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control custom-textarea" id="description" name="description" placeholder="Masukkan Deskripsi">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label for="map">Pilih Lokasi Pusat</label>
                            <div class="text-danger mb-1">
                                @error('lat')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-control rounded" id="map"><button
                                    class="btn btn-info border-dark floating-button" id="myLocation" type="button">Lokasi
                                    Saya</button></div>
                        </div>
                        {{-- end date --}}
                        {{-- close date --}}
                        <input type="hidden" id="lat" name="lat" placeholder="Enter Latitude">
                        <input type="hidden" id="long" name="long" placeholder="Enter Longitude">
                    </div>
                </div>
            </div>
            <div class="card-footer mx-3 mb-3">
                <button type="submit" class="btn btn-primary">
                    Simpan Data
                </button>
                <a class="btn btn-outline-primary float-right" href="{{ route('post.index') }}">
                    <div class="text-primary">Batal</div>
                </a>
            </div>
        </form>

        <!-- /.card-body -->
    </div>
@endsection

@push('scripts')
    {{-- leafet js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    {{-- Select2 --}}
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
        // end map

        // dynamic map
        document.getElementById('disaster_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var disasterLat = selectedOption.getAttribute('data-lat');
            var disasterLong = selectedOption.getAttribute('data-long');

            initialLatLng = [parseFloat(disasterLat), parseFloat(disasterLong)];
            marker.setLatLng(initialLatLng);
            map.setView(initialLatLng, 14);
            $('#lat').val(initialLatLng[0]);
            $('#long').val(initialLatLng[1]);
        });
        // end dynamic map

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
            defaultMarkGeocode: false,
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
@endpush
