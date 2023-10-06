<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test geojson</title>

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
</body>

{{-- leafet js --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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

    //     layer group
    const marks = L.layerGroup();
    var marker1 = L.marker([-8.658526008560928, 115.1628647607182]).bindPopup('kuta utara').addTo(marks);
    var marker2 = L.marker([-8.670574868371705, 115.21504981590279]).bindPopup('denpasar').addTo(marks);
    var marker3 = L.marker([-8.658310581520539, 115.2441781363419]).bindPopup('univ marmadewa').addTo(marks);
    var marker4 = L.marker([-8.646604539561233, 115.21326490444685]).bindPopup('rsu wangaya').addTo(marks);
    //     end layer group


    //     geojson
    const RSAngkatanDarat = {
        "type": "FeatureCollection",
        "features": [{
            "type": "Feature",
            "properties": {},
            "geometry": {
                "coordinates": [
                    115.21960579499341,
                    -8.663160257905716
                ],
                "type": "Point"
            }
        }]
    }

    function onEachFeature(feature, layer) {
        let popupContent = `Data Geojson  ${feature.geometry.coordinates[0]} and ${feature.geometry.coordinates[1]}`
        if (feature.properties && feature.properties.popupContent) {
            popupContent += feature.properties.popupContent
        }
        layer.bindPopup(popupContent);
    }

    const geoJson = L.geoJSON(RSAngkatanDarat, {
        style(feature) {
            return feature.properties && feature.properties.style
        },
        onEachFeature,
    }).addTo(map)
    //     endgeojson

    //     control
    const komponen = {
        'Marks': marks
    }
    L.control.layers(baseMap, komponen).addTo(map);
    //     end control
</script>

</html>
