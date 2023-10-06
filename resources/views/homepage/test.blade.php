<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test map</title>

    {{-- leafet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 420px;
        }
    </style>
</head>

<body>
    <div id="map">

    </div>
</body>

{{-- leafet js --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    //     map
    // var map = L.map('map').setView([-1.9722445569324243, 116.86002939934983], 5);

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
    var Esri_WorldStreetMap = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
        });

    var map = L.map('map', {
        center: [-1.9722445569324243, 116.86002939934983],
        zoom: 5,
        layers: [OpenStreet],
    }).setView([-8.674550075372617, 115.19050205461602], 11);

    var baseMap = {
        'Map': OpenStreet,
        'Gelap': Stadia_AlidadeSmoothDark,
        'Peta Jalan': Esri_WorldStreetMap,
    }
    //     end map


    //    marker (penanda)
    //         icon
    //     var iconStyle = L.icon({

    //     });
    //         end icon
    var marker = L.marker([-8.66072312872797, 115.23964079201781], {
            draggable: false
        })
        .bindPopup('Tulis Peringatan')
        .addTo(map);
    //   end marker


    //     circle (lingkaran)
    var circle = L.circle([-8.654648903570628, 115.23359395906532], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).bindPopup('Tulis Peringatan.').addTo(map);
    //     end circle


    //     polygon (bangun datar)
    var polygon = L.polygon([
        [-8.66719266309415, 115.23058809181981],
        [-8.667765843722723, 115.23834852107048],
        [-8.673144880865774, 115.23817012039804],
        [-8.672659888872454, 115.23040969114737],
    ]).bindPopup('Tulis Peringatan.').addTo(map);
    //     end polygon


    //     polyline (garis)
    var latlng = [
        [-8.669064916702915, 115.1255256309501],
        [-8.662599686426375, 115.20291432846719],
        [-8.695463451750433, 115.27376313605326],
    ]
    var polyline = L.polyline(latlng).bindPopup('Tulis Peringatan.').addTo(map);
    //     end polyline


    // rectangle (segi empat)
    var rectangle = L.rectangle([
        [-8.66719266309415, 115.23058809181981],
        [-8.667765843722723, 115.23834852107048],
        [-8.673144880865774, 115.23817012039804],
        [-8.672659888872454, 115.23040969114737],
    ], {
        weight: 2, // ukuran garis tepi
        color: 'red',
    }).bindPopup('Tulis Peringatan.').addTo(map);
    // end rectangle


    // layer

    // end layer


    //     test (json to js) use json_encode

    //     const popup = L.popup()
    //         .setLatLng([51.513, -0.09])
    //         .setContent('I am a standalone popup.')
    //         .openOn(map);

    //     function onMapClick(e) {
    //         popup
    //             .setLatLng(e.latlng)
    //             .setContent(`You clicked the map at ${e.latlng.toString()}`)
    //             .openOn(map);
    //     }

    //     map.on('click', onMapClick);


    //     layer group
    const marks = L.layerGroup();
    var marker1 = L.marker([-8.658526008560928, 115.1628647607182]).bindPopup('kuta utara').addTo(marks);
    var marker2 = L.marker([-8.670574868371705, 115.21504981590279]).bindPopup('denpasar').addTo(marks);
    var marker3 = L.marker([-8.658310581520539, 115.2441781363419]).bindPopup('univ marmadewa').addTo(marks);
    var marker4 = L.marker([-8.646604539561233, 115.21326490444685]).bindPopup('rsu wangaya').addTo(marks);
    //     end layer group


    //     control
    const komponen = {
        'Marker': marker,
        'Marks': marks
    }
    L.control.layers(baseMap, komponen).addTo(map);
    //     end control

    //     focus (fokus)
    // map.fitBounds(marker2);
    // map.fitBounds(data kordinat);
    //     end focus
</script>

</html>
