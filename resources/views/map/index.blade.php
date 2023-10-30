<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row space-x-3">
                <div class="basis-4/6 xl:basis-2/3">
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
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div>
                                <style>
                                    #map {
                                        height: 500px;
                                    }
                                </style>
                                <div id="map"></div>
                            </div>
                            <div class="max-w-lg xl:max-w-4xl overflow-x-auto ">
                                <div class="flex h-[30%] justify-between space-x-3 p-[1rem]">
                                    <div class="flex flex-col">
                                        <div class="flex flex-col items-center">
                                            <h5 class="text-[15px] font-[600] uppercase">Speedometer</h5>
                                            <canvas id="speedo"></canvas>
                                        </div>
                                    </div>
                                    {{-- <div class="flex flex-col">
                                        <div class="flex flex-col items-center">
                                            <h5 class="text-[15px] font-[600] uppercase">Accelerometer</h5>
                                            <canvas id="acl"></canvas>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="flex flex-col">
                                        <div class="flex flex-col items-center">
                                            <h5 class="text-[15px] font-[600] uppercase">Gyro</h5>
                                            <div id="gyro"></div>
                                        </div>
                                    </div> --}}
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
                                    <div class="flex flex-col">
                                        <div class="flex flex-col items-center">
                                            <h5 class="text-[15px] font-[600] uppercase">Temperature</h5>
                                            <canvas id="temperature"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="max-w-lg xl:max-w-4xl">
                                <table class="table" id="dataTelemetriLogs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Time Received</th>
                                            <th>Time Payload</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Altitude</th>
                                            <th>Speed over Ground</th>
                                            <th>Course over Ground</th>
                                            <th>Arus</th>
                                            <th>Tegangan</th>
                                            <th>Daya</th>
                                            <th>Klasifikasi</th>
                                            <th>Acceleration X</th>
                                            <th>Acceleration Y</th>
                                            <th>Acceleration Z</th>
                                            <th>Gyro X</th>
                                            <th>Gyro Y</th>
                                            <th>Gyro Z</th>
                                            <th>Magnetometer X</th>
                                            <th>Magnetometer Y</th>
                                            <th>Magnetometer Z</th>
                                            <th>Roll</th>
                                            <th>Pitch</th>
                                            <th>Yaw</th>
                                            <th>Suhu</th>
                                            <th>Humidity</th>
                                        </tr>
                                    <tbody class="text-center"></tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="basis-2/6 xl:basis-1/3 space-y-3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="overflow-y-auto p-6 text-gray-900 dark:text-gray-100">
                            <div class="max-w-xl">
                                <section>
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Jarak Tempuh') }}
                                        </h2>
                                    </header>

                                    <div class="mt-6 space-y-3">
                                        <div>
                                            <x-input-label for="koorAwal" :value="__('Koordinat Awal')" />
                                            <x-text-input id="koorAwal" name="koorAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->lat . ', '. $telemetriLogs[0]->long : 'not available'}}" disabled />
                                        </div>

                                        <div>
                                            <x-input-label for="koorAkhir" :value="__('Koordinat Akhir')" />
                                            <x-text-input id="koorAkhir" name="koorAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->lat . ', '. end($telemetriLogs)->long : 'not available'}}" disabled />
                                        </div>

                                        <div>
                                            <x-input-label for="jarakTempuh" :value="__('Jarak Tempuh')" />
                                            <x-text-input id="jarakTempuh" name="jarakTempuh" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? '-' : 'not available'}}" disabled />
                                        </div>

                                        <div>
                                            <x-input-label for="jarakAwalAkhir" :value="__('Jarak Koordinat Awal-Akhir')" />
                                            <x-text-input id="jarakAwalAkhir" name="jarakAwalAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? '-' : 'not available'}}" disabled />
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="overflow-y-auto p-6 text-gray-900 dark:text-gray-100">
                            <div class="max-w-xl">
                                <section>
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Waktu Tempuh') }}
                                        </h2>
                                    </header>

                                    <div class="mt-6 space-y-3">
                                        <div class="flex flex-row space-x-4">
                                            <div class="basis-1/2">
                                                <x-input-label for="waktuAwal" :value="__('Waktu Awal')" />
                                                <x-text-input id="waktuAwal" name="waktuAwal" type="text" class="mt-1 block w-full"  value="{{ $telemetriLogs ? date('H:i:s', $telemetriLogs[0]->tPayload) : 'not available'}}" disabled />
                                            </div>

                                            <div class="basis-1/2">
                                                <x-input-label for="waktuAkhir" :value="__('Waktu Akhir')" />
                                                <x-text-input id="waktuAkhir" name="waktuAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? date('H:i:s', end($telemetriLogs)->tPayload) : 'not available'}}" disabled />
                                            </div>
                                        </div>

                                        <div>
                                            <x-input-label for="totalWaktu" :value="__('Total Waktu')" />
                                            <x-text-input id="totalWaktu" name="totalWaktu" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? date('H:i:s', end($telemetriLogs)->tPayload - $telemetriLogs[0]->tPayload) : 'not available'}}" disabled />
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="overflow-y-auto p-6 text-gray-900 dark:text-gray-100">
                            <div class="max-w-xl">
                                <section>
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Penggunaan Daya') }}
                                        </h2>
                                    </header>

                                    <div class="mt-6 space-y-3">
                                        <div class="flex flex-row space-x-4">
                                            <div class="basis-1/2">
                                                <x-input-label for="teganganAwal" :value="__('Tegangan Awal')" />
                                                <x-text-input id="teganganAwal" name="teganganAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->tegangan : 'not available'}}" disabled />
                                            </div>

                                            <div class="basis-1/2">
                                                <x-input-label for="teganganAkhir" :value="__('Tegangan Akhir')" />
                                                <x-text-input id="teganganAkhir" name="teganganAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->tegangan : 'not available'}}" disabled />
                                            </div>
                                        </div>

                                        <div class="flex flex-row space-x-4">
                                            <div class="basis-1/2">
                                                <x-input-label for="arusAwal" :value="__('Arus Awal')" />
                                                <x-text-input id="arusAwal" name="arusAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->arus : 'not available'}}" disabled />
                                            </div>

                                            <div class="basis-1/2">
                                                <x-input-label for="arusAkhir" :value="__('Arus Akhir')" />
                                                <x-text-input id="arusAkhir" name="arusAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->arus : 'not available'}}" disabled />
                                            </div>
                                        </div>

                                        <div class="flex flex-row space-x-4">
                                            <div class="basis-1/2">
                                                <x-input-label for="dayaAwal" :value="__('Daya Awal')" />
                                                <x-text-input id="dayaAwal" name="dayaAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->daya : 'not available'}}" disabled />
                                            </div>

                                            <div class="basis-1/2">
                                                <x-input-label for="dayaAkhir" :value="__('Daya Akhir')" />
                                                <x-text-input id="dayaAkhir" name="dayaAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->daya : 'not available'}}" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="overflow-y-auto p-6 text-gray-900 dark:text-gray-100">
                            <div class="max-w-xl">
                                <section>
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Roll Pitch Yaw') }}
                                        </h2>
                                    </header>
                                    <div class="mt-6 space-y-3">
                                        <style>
                                            * {
                                                -webkit-user-select: none;
                                            }

                                            .container {
                                            transform: perspective(25px);
                                            }

                                            #panel {
                                            /* height:90px;
                                            width:160px; */
                                            border:1px solid #fc5300;
                                            }
                                        </style>

                                        <div class="container flex items-center justify-center">
                                            {{-- <div id="panel" data-rotate-x=0 data-rotate-y=0 data-rotate-z=0><img src="http://placehold.it/360x150"/></div> --}}
                                            <div id="panel" data-rotate-x=0 data-rotate-y=0 data-rotate-z=0><img src="https://png.pngtree.com/png-clipart/20230425/original/pngtree-drone-from-top-view-png-image_9095281.png"/></div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
                center: [{{ (!empty($centerPoint->latitude) ? $centerPoint->latitude : -6.967512300523178) }},{{ (!empty($centerPoint->longitude) ? $centerPoint->longitude : 107.65906856904034) }}],
                zoom: 15,
                layers: [google_satellite]
            });

            //Menambahkan beberapa layer ke dalam peta/map
            L.control.layers(baseLayers, overlays).addTo(map);

            map.attributionControl.setPrefix(false);

            var markersLayer = new L.markerClusterGroup();

            // looping variabel datas utuk menampilkan data marker
            var datas = []

            // create a red polyline from an array of LatLng points
            var loc = [];
            @foreach($telemetriLogs as $telemetriLog )
                //datas untuk marker
                datas.push(
                    {"loc": ['{{ $telemetriLog->lat }}','{{ $telemetriLog->long }}'],
                    "klasifikasi": '{{ $telemetriLog->klasifikasi }}',
                    "persentase": 'kosong'}
                );
                loc.push(['{{ $telemetriLog->lat }}','{{ $telemetriLog->long }}']);
                altmeter.value = {{ $telemetriLog->alt }}/10;
                gauge.value = {{ $telemetriLog->sog }};
                compas.value = Math.atan2({{ $telemetriLog->my }}, {{ $telemetriLog->mx }}) * 180 / Math.PI;
                temperature.value = {{ $telemetriLog->suhu }};

                panel.dataset.rotateX = {{ $telemetriLog->pitch }};
                panel.dataset.rotateY = {{ $telemetriLog->yaw }};
                panel.dataset.rotateZ = {{ $telemetriLog->roll }};
                updatePanelTransform();
            @endforeach

            var greenIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            for (i in datas) {
                var title = datas[i].title,
                    location = datas[i].loc,
                    klasifikasi = datas[i].klasifikasi,
                    persentase = datas[i].persentase,
                    marker = new L.Marker(new L.latLng(location), {
                        icon: (klasifikasi == 1) ? greenIcon : redIcon,
                        klasifikasi: klasifikasi,
                        persentase: persentase
                    }).bindPopup(
                        "<div class='my-2'><strong>Koordinat:</strong> <br>"+location+"</div>"+
                        "<div class='my-2'><strong>Klasifikasi:</strong> <br>"+klasifikasi+"</div>"+
                        "<div class='my-2'><strong>Persentase:</strong> <br>"+persentase+"</div>"
                    );
                markersLayer.addLayer(marker);
            }

            map.addLayer(markersLayer);

            var polyline = L.polyline(loc, {color: 'red'}).addTo(map);

            if(loc.length > 0){
                // zoom the map to the polyline
                map.fitBounds(polyline.getBounds());
            }

            // listener/subscribe untuk pusher
            window.Echo.channel('messages').listen('MessageCreated', (event) => {
                console.log("Berhasil Listen ke Pusher");
                console.log(event.message.telemetriLog);
                loc.push([event.message.telemetriLog.lat, event.message.telemetriLog.long]);

                marker = new L.Marker(new L.latLng([event.message.telemetriLog.lat, event.message.telemetriLog.long]), {
                    icon: (event.message.telemetriLog.klasifikasi == 1) ? greenIcon : redIcon,
                    klasifikasi: event.message.telemetriLog.klasifikasi,
                    persentase: event.message.telemetriLog.persentase
                }).bindPopup(
                    "<div class='my-2'><strong>Koordinat:</strong> <br>"+[event.message.telemetriLog.lat, event.message.telemetriLog.long]+"</div>"+
                    "<div class='my-2'><strong>Klasifikasi:</strong> <br>"+event.message.telemetriLog.klasifikasi+"</div>"+
                    "<div class='my-2'><strong>Persentase:</strong> <br>"+event.message.telemetriLog.persentase+"</div>"
                );
                markersLayer.addLayer(marker);
                var polyline = L.polyline(loc, {color: 'red'}).addTo(map);
                // zoom the map to the polyline
                map.fitBounds(polyline.getBounds());

                // set meteran
                altmeter.value = parseFloat(event.message.telemetriLog.alt)/10;
                gauge.value = event.message.telemetriLog.sog;
                compas.value = Math.atan2(event.message.telemetriLog.my, event.message.telemetriLog.mx) * 180 / Math.PI;
                temperature.value = event.message.suhu;

                document.getElementById("koorAkhir").value = event.message.telemetriLog.lat+ ', '+ event.message.telemetriLog.long;
                document.getElementById("waktuAkhir").value = event.message.telemetriLog.tPayload;
                document.getElementById("totalWaktu").value = event.message.totalWaktu;
                document.getElementById("teganganAkhir").value = event.message.telemetriLog.tegangan;
                document.getElementById("arusAkhir").value = event.message.telemetriLog.arus;
                document.getElementById("dayaAkhir").value = event.message.telemetriLog.daya;

                $('#dataTelemetriLogs').DataTable().ajax.reload();

                panel.dataset.rotateX = event.message.telemetriLog.pitch;
                panel.dataset.rotateY = event.message.telemetriLog.yaw;
                panel.dataset.rotateZ = event.message.telemetriLog.roll;
                updatePanelTransform();
            });
        });
    </script>
    @include('map.scripts.roll-pitch-yaw')
    @include('map.scripts.gauge')
    @include('map.scripts.datatable')
</x-app-layout>
