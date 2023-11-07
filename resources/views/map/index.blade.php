<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>
    <div class="py-3">
        <div class="max-w-full mx-auto sm:px-3 lg:px-3">
            <div class="flex flex-col space-y-2">
                <div class="flex flex-row space-x-1.5">
                    <div class="basis-1/4 xl:basis-2/12 space-y-2 grid grid-cols-1 grid-flow-row justify-stretch">
                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Jarak Tempuh') }}
                                            </h2>
                                        </header>

                                        <div class="mt-2.5 space-y-2">
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

                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Waktu Tempuh') }}
                                            </h2>
                                        </header>

                                        <div class="mt-2.5 space-y-2">
                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/2">
                                                    <x-input-label for="waktuAwal" :value="__('Waktu Awal')" />
                                                    <x-text-input id="waktuAwal" name="waktuAwal" type="text" class="mt-1 block w-full"  value="{{ $telemetriLogs ? date('H:i:s', $telemetriLogs[0]->tPayload).' WIB' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/2">
                                                    <x-input-label for="waktuAkhir" :value="__('Waktu Akhir')" />
                                                    <x-text-input id="waktuAkhir" name="waktuAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? date('H:i:s', end($telemetriLogs)->tPayload).' WIB' : 'not available'}}" disabled />
                                                </div>
                                            </div>

                                            <div>
                                                <x-input-label for="totalWaktu" :value="__('Total Waktu')" />
                                                <x-text-input id="totalWaktu" name="totalWaktu" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? date('H:i:s', end($telemetriLogs)->tPayload - $telemetriLogs[0]->tPayload).' s' : 'not available'}}" disabled />
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Drone 3D Position') }}
                                            </h2>
                                        </header>
                                        <div class="mt-2.5 space-y-2">
                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/3">
                                                    <x-input-label for="roll" :value="__('Roll')" />
                                                    <x-text-input id="roll" name="roll" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->roll.'°' : 'not available'}}" disabled />
                                                    @if ($telemetriLogs)
                                                        @if ((float) end($telemetriLogs)->roll > 0)
                                                            @php
                                                                $status_roll = "miring kanan";
                                                            @endphp
                                                        @else
                                                            @php
                                                                $status_roll = "miring kiri";
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    <x-input-info class="text-center" :value="$status_roll ? $status_roll : null" />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="pitch" :value="__('Pitch')" />
                                                    <x-text-input id="pitch" name="pitch" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->pitch.'°' : 'not available'}}" disabled />
                                                    @if ($telemetriLogs)
                                                        @if ((float) end($telemetriLogs)->pitch > 0)
                                                            @php
                                                                $status_pitch = "menjulang";
                                                            @endphp
                                                        @else
                                                            @php
                                                                $status_pitch = "menukik";
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    <x-input-info class="text-center" :value="$status_pitch ? $status_pitch : null" />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="yaw" :value="__('Yaw')" />
                                                    <x-text-input id="yaw" name="yaw" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->yaw.'°' : 'not available'}}" disabled />
                                                    @if ($telemetriLogs)
                                                        @if ((float) end($telemetriLogs)->pitch > 0)
                                                            @php
                                                                $status_yaw = "putar kanan";
                                                            @endphp
                                                        @else
                                                            @php
                                                                $status_yaw = "putar kiri";
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    <x-input-info class="text-center" :value="$status_yaw ? $status_yaw : null" />
                                                </div>
                                            </div>
                                            <div class="flex flex-row">
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

                                                    #panel img{
                                                        max-width: 50%;
                                                        height: auto;
                                                    }
                                                </style>
                                                <div class="container flex items-center justify-center">
                                                    {{-- <div id="panel" data-rotate-x=0 data-rotate-y=0 data-rotate-z=0><img src="http://placehold.it/360x150"/></div> --}}
                                                    <div class="flex items-center justify-center" id="panel" data-rotate-x=0 data-rotate-y=0 data-rotate-z=0><img src="https://png.pngtree.com/png-clipart/20230425/original/pngtree-drone-from-top-view-png-image_9095281.png"/></div>
                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="basis-2/4 xl:basis-8/12 space-y-2 grid grid-cols-1 grid-flow-row justify-stretch">
                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 text-gray-900">
                                <div>
                                    <div id="map" class="h-[545px] xl:h-[580px]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 text-gray-900">
                                <div class="max-w-lg xl:max-w-4xl overflow-x-auto ">
                                    <div class="flex h-[30%] justify-between space-x-1.5 p-[1rem]">
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
                                        <div class="flex flex-col">
                                            <div class="flex flex-col items-center">
                                                <h5 class="text-[15px] font-[600] uppercase">Humidity</h5>
                                                <canvas id="humidity"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="basis-1/4 xl:basis-2/12 space-y-2 grid grid-cols-1 grid-flow-row justify-stretch">
                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Penggunaan Daya') }}
                                            </h2>
                                        </header>

                                        <div class="mt-2.5 space-y-2">
                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/2">
                                                    <x-input-label for="teganganAwal" :value="__('Tegangan Awal')" />
                                                    <x-text-input id="teganganAwal" name="teganganAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->tegangan.' V' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/2">
                                                    <x-input-label for="teganganAkhir" :value="__('Tegangan Akhir')" />
                                                    <x-text-input id="teganganAkhir" name="teganganAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->tegangan.' V' : 'not available'}}" disabled />
                                                </div>
                                            </div>

                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/2">
                                                    <x-input-label for="arusAwal" :value="__('Arus Awal')" />
                                                    <x-text-input id="arusAwal" name="arusAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->arus.' mA' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/2">
                                                    <x-input-label for="arusAkhir" :value="__('Arus Akhir')" />
                                                    <x-text-input id="arusAkhir" name="arusAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->arus.' mA' : 'not available'}}" disabled />
                                                </div>
                                            </div>

                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/2">
                                                    <x-input-label for="dayaAwal" :value="__('Daya Awal')" />
                                                    <x-text-input id="dayaAwal" name="dayaAwal" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $telemetriLogs[0]->daya.' mW' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/2">
                                                    <x-input-label for="dayaAkhir" :value="__('Daya Akhir')" />
                                                    <x-text-input id="dayaAkhir" name="dayaAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->daya.' mW' : 'not available'}}" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Magnetometer') }}
                                            </h2>
                                        </header>
                                        <div class="mt-2.5 space-y-2">
                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/3">
                                                    <x-input-label for="magnetometerX" :value="__('X')" />
                                                    <x-text-input id="magnetometerX" name="magnetometerX" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->mx.' n/T' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="magnetometerY" :value="__('Y')" />
                                                    <x-text-input id="magnetometerY" name="magnetometerY" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->my.' n/T' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="magnetometerZ" :value="__('Z')" />
                                                    <x-text-input id="magnetometerZ" name="magnetometerZ" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->mz.' n/T' : 'not available'}}" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Acceleration') }}
                                            </h2>
                                        </header>
                                        <div class="mt-2.5 space-y-2">
                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/3">
                                                    <x-input-label for="accelerationX" :value="__('X')" />
                                                    <x-text-input id="accelerationX" name="accelerationX" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->ax.' g' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="accelerationY" :value="__('Y')" />
                                                    <x-text-input id="accelerationY" name="accelerationY" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->ay.' g' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="accelerationZ" :value="__('Z')" />
                                                    <x-text-input id="accelerationZ" name="accelerationZ" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->az.' g' : 'not available'}}" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-y-auto p-4 text-gray-900">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Gyroscope') }}
                                            </h2>
                                        </header>
                                        <div class="mt-2.5 space-y-2">
                                            <div class="flex flex-row space-x-1.5">
                                                <div class="basis-1/3">
                                                    <x-input-label for="gyroscopeX" :value="__('X')" />
                                                    <x-text-input id="gyroscopeX" name="gyroscopeX" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->gx.'°/s' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="gyroscopeY" :value="__('Y')" />
                                                    <x-text-input id="gyroscopeY" name="gyroscopeY" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->gy.'°/s' : 'not available'}}" disabled />
                                                </div>

                                                <div class="basis-1/3">
                                                    <x-input-label for="gyroscopeZ" :value="__('Z')" />
                                                    <x-text-input id="gyroscopeZ" name="gyroscopeZ" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? end($telemetriLogs)->gz.'°/s' : 'not available'}}" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 text-gray-900">
                                <div class="max-w-full">
                                    <table class="table" id="dataTelemetriLogs">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Time Received</th>
                                                <th>Time Payload</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Altitude</th>
                                                <th>SoG</th>
                                                <th>Cog</th>
                                                <th>Arus</th>
                                                <th>Tegangan</th>
                                                <th>Daya</th>
                                                <th>Klasifikasi</th>
                                                <th>AX</th>
                                                <th>AY</th>
                                                <th>AZ</th>
                                                <th>GX</th>
                                                <th>GY</th>
                                                <th>GZ</th>
                                                <th>MX</th>
                                                <th>MY</th>
                                                <th>MZ</th>
                                                <th>Roll</th>
                                                <th>Pitch</th>
                                                <th>Yaw</th>
                                                <th>Suhu</th>
                                                <th>Humidity</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous">
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
                humidity.value = {{ $telemetriLog->humidity }};

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
                temperature.value = event.message.telemetriLog.suhu;
                humidity.value = event.message.telemetriLog.humidity;

                document.getElementById("koorAkhir").value = event.message.telemetriLog.lat+ ', '+ event.message.telemetriLog.long;
                document.getElementById("waktuAkhir").value = event.message.telemetriLog.tPayload;
                document.getElementById("totalWaktu").value = event.message.totalWaktu;
                document.getElementById("teganganAkhir").value = event.message.telemetriLog.tegangan;
                document.getElementById("arusAkhir").value = event.message.telemetriLog.arus;
                document.getElementById("dayaAkhir").value = event.message.telemetriLog.daya;
                document.getElementById("roll").value = event.message.telemetriLog.roll;
                document.getElementById("pitch").value = event.message.telemetriLog.pitch;
                document.getElementById("yaw").value = event.message.telemetriLog.yaw;
                document.getElementById("accelerationX").value = event.message.telemetriLog.ax;
                document.getElementById("accelerationY").value = event.message.telemetriLog.ay;
                document.getElementById("accelerationZ").value = event.message.telemetriLog.az;
                document.getElementById("gyroscopeX").value = event.message.telemetriLog.gx;
                document.getElementById("gyroscopeY").value = event.message.telemetriLog.gy;
                document.getElementById("gyroscopeZ").value = event.message.telemetriLog.gz;
                document.getElementById("magnetometerX").value = event.message.telemetriLog.mx;
                document.getElementById("magnetometerY").value = event.message.telemetriLog.my;
                document.getElementById("magnetometerZ").value = event.message.telemetriLog.mz;

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
