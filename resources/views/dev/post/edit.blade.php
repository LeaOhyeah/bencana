@extends('layouts.main2')
@section('title', 'Edit Posko')

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
    {{-- <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input value="{{ $post->code }}" type="text" id="code" name="code" required><br>
        <br>

        <label for="disaster_id">Disaster ID:</label>
        @error('disaster_id')
            {{ $message }}
        @enderror
        <select name="disaster_id" id="disaster_id">
            <option>Select Disaster</option>
            @foreach ($disasters as $disaster)
                @if ($post->disaster_id == $disaster->id)
                    <option value="{{ $disaster->id }}" selected>{{ $disaster->name }}</option>
                @else
                    <option value="{{ $disaster->id }}">{{ $disaster->name }}</option>
                @endif
            @endforeach
        </select><br><br>

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input value="{{ $post->name }}" type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10">{{ $post->description }}</textarea><br>
        <br>

        <label for="photo">Photo:</label>
        @error('photo')
            {{ $message }}
        @enderror
        <input type="file" id="photo" name="photo"><br>
        <input value="{{ $post->photo }}" type="hidden" name="old_photo"><br>
        <img src="{{ asset('storage/' . $post->photo) }}" alt="" style="width: 300px;"><br><br>

        <label for="lat">Lat:</label>
        @error('lat')
            {{ $message }}
        @enderror
        <input value="{{ $post->lat }}" type="text" id="lat" name="lat" required><br>
        <br>

        <label for="long">Long:</label>
        @error('long')
            {{ $message }}
        @enderror
        <input value="{{ $post->long }}" type="text" id="long" name="long" required><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form> --}}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Data Posko</h3>
        </div>
        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <div class="row mx-1">
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="disaster_id">Pusat Bencana</label>
                            <select name="disaster_id" class="form-control @error('disaster_id') is-invalid @enderror"
                                id="disaster_id">
                                @foreach ($disasters as $disaster)
                                    @if ($post->disaster_id == $disaster->id)
                                        <option value="{{ $disaster->id }}" data-lat="{{ $disaster->lat }}"
                                            data-long="{{ $disaster->long }}" selected>{{ $disaster->name }}</option>
                                    @else
                                        <option value="{{ $disaster->id }}" data-lat="{{ $disaster->lat }}"
                                            data-long="{{ $disaster->long }}">{{ $disaster->name }}</option>
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
                                value="{{ old('code', $post->code) }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukkan Nama Posko" required
                                value="{{ old('name', $post->name) }}">
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
                            <textarea class="form-control custom-textarea" id="description" name="description" placeholder="Masukkan Deskripsi">{{ old('description', $post->description) }}</textarea>
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
                        <input type="hidden" id="lat" name="lat" value="{{$post->lat}}">
                        <input type="hidden" id="long" name="long" value="{{$post->long}}">
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

        var initialLatLng = [parseFloat({{ $post->lat }}), parseFloat({{ $post->long }})];
        var marker = L.marker(initialLatLng, {
            draggable: true
        }).addTo(map);
        map.setView(initialLatLng, 11);
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
