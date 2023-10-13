@extends('layouts.main2')
@section('title', 'Edit Data')

@section('css')
    {{-- leaflet --}}
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
    </style> {{-- geocoder --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-default-primary" role="alert">
            <b>
                {{ session('success') }}
            </b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
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
            <h3 class="card-title">Data Bencana<small class="text-sm">,
                    Diperbarui pada
                    {{ $disaster->updated_at() }} </small> </h3>
        </div>

        <form method="POST" action="{{ route('disaster.update', $disaster->id) }}">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row mx-1">
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                name=code placeholder="Masukkan Kode Bencana" required
                                value="{{ old('code', $disaster->code) }}">
                            @error('code')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama Bencana" required value="{{ old('name', $disaster->name) }}">
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required
                                value="{{ old('start_date', $disaster->start_date) }}">
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ old('end_date', $disaster->end_date) }}">
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label for="closed_date">Tanggal Ditutup</label>
                            <input type="date" class="form-control" id="closed_date" name="closed_date"
                                value="{{ old('closed_date', $disaster->closed_date) }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control custom-textarea" id="description" name="description" placeholder="Masukkan Deskripsi">{{ old('description', $disaster->description) }}</textarea>
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

                        <input type="hidden" id="lat" name="lat" placeholder="Enter Latitude"
                            value="{{ old('lat', $disaster->lat) }}">
                        <input type="hidden" id="long" name="long" placeholder="Enter Longitude"
                            value="{{ old('long', $disaster->long) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer mx-3 mb-3">
                <button type="submit" class="btn btn-custom btn-primary my-1">
                    Perbarui Data
                </button>
                <a class="d-none d-md-block btn btn-outline-primary float-right my-1" href="{{ route('disaster.index') }}">
                    <b>Batal</b>
                </a>
            </div>
        </form>

        <!-- /.card-body -->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function toggleBtnBlock() {
                if ($(window).width() <= 767) {
                    $(".btn-custom").addClass("btn-block");
                } else {
                    $(".btn-custom").removeClass("btn-block");
                }
            }

            toggleBtnBlock();

            $(window).resize(function() {
                toggleBtnBlock();
            });
        });
    </script>
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
@endpush
