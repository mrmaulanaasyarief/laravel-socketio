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
                    <div class="flex h-[30%] justify-between p-[1rem]">
                        <div class="flex flex-col">
                            <div class="flex flex-col items-center">
                                <h5 class="text-[15px] font-[600] uppercase">Speedometer</h5>
                                <canvas id="speedo"></canvas>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-col items-center">
                                <h5 class="text-[15px] font-[600] uppercase">Accelerometer</h5>
                                <canvas id="acl"></canvas>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-col items-center">
                                <h5 class="text-[15px] font-[600] uppercase">Gyro</h5>
                                <div id="gyro"></div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-col items-center">
                                <h5 class="text-[15px] font-[600] uppercase">COMPAS</h5>
                                <canvas id="compas"></canvas>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-col items-center">
                                <h5 class="text-[15px] font-[600] uppercase">Altimeter</h5>
                                <canvas id="altmeter"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- load cdn js leaflet --}}
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script>
        $(function(){
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
                center: [{{ $centerPoint->latitude }},{{ $centerPoint->longitude }}],
                zoom: 15,
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
            // var latlngs = [
            //     [-6.952226396233895,107.62005865573883],
            //     [-6.952434070241399,107.6193505525589],
            //     [-6.9529399424396665,107.61891067028047],
            //     [-6.953248790461353,107.61865317821503],
            //     [-6.95362153780333,107.61837422847749],
            //     [-6.954015584671849,107.61800944805147],
            //     [-6.954500155367788,107.61654496192934]
            // ];

            // connect ke server node.js
            let socket = io('http://localhost:3000');
            socket.on('connection');

            var loc = []
            // listener/subscribe untuk emit message
            socket.on("message", function (msg) {
                loc.push(msg.split(","));
                console.log(loc);
                var polyline = L.polyline(loc, {color: 'red'}).addTo(map);
                // zoom the map to the polyline
                map.fitBounds(polyline.getBounds());
            });

            // GAUGE
            var compas = new RadialGauge({
            renderTo: 'compas',
            minValue: 0,
            height: 225,
            width: 175,
            maxValue: 360,
            majorTicks: [
                "N",
                "NE",
                "E",
                "SE",
                "S",
                "SW",
                "W",
                "NW",
                "N"
            ],
            minorTicks: 22,
            ticksAngle: 360,
            startAngle: 180,
            strokeTicks: false,
            highlights: false,
            colorPlate: "transparent",
            colorMajorTicks: "#9eabec",
            colorMinorTicks: "#ddd",
            colorNumbers: "#ccc",
            colorNeedle: "#121c47",
            colorNeedleEnd: "#9eabec",
            valueBox: false,
            valueTextShadow: false,
            colorCircleInner: "#fff",
            colorNeedleCircleOuter: "#ccc",
            needleCircleSize: 15,
            needleCircleOuter: false,
            animationRule: "linear",
            needleType: "arrow",
            needleStart: 30,
            needleEnd: 50,
            needleWidth: 3,
            borders: true,
            borderInnerWidth: 0,
            borderMiddleWidth: 0,
            borderOuterWidth: 10,
            colorBorderOuter: "#ccc",
            colorBorderOuterEnd: "#ccc",
            colorNeedleShadowDown: "#222",
            borderShadowWidth: 0,
            animationTarget: "plate",
            animationDuration: 1500,
            value: 0,
            animateOnInit: true
        }).draw();
        var acl = new RadialGauge({
            renderTo: 'acl',
            minValue: 0,
            maxValue: 8,
            height: 225,
            width: 175,
            majorTicks: [
                "3",
                "4",
                "5",
                "-2",
                "-1",
                "0",
                "1",
                "2",
                "3"
            ],
            minorTicks: 5,
            ticksAngle: 360,
            startAngle: 180,
            strokeTicks: false,
            highlights: false,
            colorPlate: "transparent",
            colorMajorTicks: "#f5f5f5",
            colorMinorTicks: "#ddd",
            colorNumbers: "#ccc",
            colorNeedle: "#121c47",
            colorNeedleEnd: "#9eabec",
            valueBox: false,
            valueTextShadow: false,
            colorCircleInner: "#fff",
            colorNeedleCircleOuter: "#ccc",
            needleCircleSize: 15,
            needleCircleOuter: false,
            animationRule: "linear",
            needleType: "arrow",
            needleStart: 30,
            needleEnd: 50,
            needleWidth: 3,
            borders: true,
            borderInnerWidth: 0,
            borderMiddleWidth: 0,
            borderOuterWidth: 10,
            colorBorderOuter: "#ccc",
            colorBorderOuterEnd: "#ccc",
            colorNeedleShadowDown: "#222",
            borderShadowWidth: 0,
            animationDuration: 1500,
            value: 0 + 5,
            animateOnInit: true
        }).draw();
        var altmeter = new LinearGauge({
            renderTo: 'altmeter',
            width: 125,
            minValue: 0,
            maxValue: 400,
            borders: false,
            majorTicks: [
                "0",
                "100",
                "200",
                "300",
                "400",
            ],
            colorPlate: 'transparent',
            colorNumbers: "#FFFFFF",
            colorNeedle: "#9eabec",
            colorNeedleEnd: "#9eabec",
            height: 225,
        }).draw();
        var gauge = new RadialGauge({
            renderTo: 'speedo',
            width: 175,
            height: 225,
            units: "Km/h",
            minValue: 0,
            maxValue: 220,
            majorTicks: [
                "0",
                "20",
                "40",
                "60",
                "80",
                "100",
                "120",
                "140",
                "160",
                "180",
                "200",
                "220"
            ],
            minorTicks: 5,
            strokeTicks: true,
            colorPlate: "transparent",
            colorMajorTicks: "#FFFFFF",
            colorMinorTicks: "#FFFFFF",
            colorNumbers: "#FFFFFF",
            borderShadowWidth: 0,
            colorNeedle: "#121c47",
            colorNeedleEnd: "#9eabec",
            borders: false,
            needleType: "arrow",
            needleWidth: 4,
            needleCircleSize: 7,
            needleCircleOuter: true,
            needleCircleInner: false,
            animationDuration: 1500,
            animationRule: "dequint",
            animatedValue: true,
            animateOnInit: true
        }).draw();

        });
    </script>
</x-app-layout>
