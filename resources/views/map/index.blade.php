<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <div class="flex justify-between">
                                <div>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Mapped Drone') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __("View the drone location.") }}
                                    </p>
                                </div>
                            </div>
                        </header>
                    </section>
                    <div>
                        <style>
                            #map {
                                height: 500px;
                            }
                        </style>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- load cdn js leaflet --}}
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script>
        // Menambah attribut pada leaflet
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA';

        // membuat beberapa layer untuk tampilan map diantaranya satelit, dark mode, street
            var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            google_streets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                minZoom: 4,
                noWrap: true,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_hybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                minZoom: 4,
                noWrap: true,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_satellite = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                minZoom: 4,
                noWrap: true,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_terrain = L.tileLayer('http://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                minZoom: 4,
                noWrap: true,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });

        var baseLayers = {
            "Grayscale": dark,
            "Satellite": satellite,
            "Streets": streets,
            "Google Streets": google_streets,
            "Google Hybrid": google_hybrid,
            "Google Satellite": google_satellite,
            "Google Terrain": google_terrain,
        };

        var overlays = {
            "Streets": streets,
            "Grayscale": dark,
            "Satellite": satellite,
            "Google Streets": google_streets,
            "Google Hybrid": google_hybrid,
            "Google Satellite": google_satellite,
            "Google Terrain": google_terrain,
        };

        // Membuat var map untuk instance object map ke dalam tag div yang mempunyai id map
        // menambahkan titik koordinat latitude dan longitude peta indonesia kedalam opsi center
        // mengatur zoom map dan mengatur layer yang akan digunakan
        var map = L.map('map', {
            // center: [{{ $centerPoint->latitude }},{{ $centerPoint->longitude }}],
            // zoom: 14,
            layers: [streets]
        });

        //Menambahkan beberapa layer ke dalam peta/map
        L.control.layers(baseLayers, overlays).addTo(map);

        // set current location / lokasi sekarang dengan koordinat peta indonesia
        // var curLocation = [{{ $centerPoint->latitude }},{{ $centerPoint->longitude }}];
        map.attributionControl.setPrefix(false);

        // set marker map agar bisa di geser
        // var marker = new L.marker(curLocation, {
        //     draggable: 'true',
        // });
        // map.addLayer(marker);

        // create a red polyline from an array of LatLng points
        var latlngs = [
            [-6.952226396233895,107.62005865573883],
            [-6.952434070241399,107.6193505525589],
            [-6.9529399424396665,107.61891067028047]
        ];

        var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

        // zoom the map to the polyline
        map.fitBounds(polyline.getBounds());


    </script>
</x-app-layout>
