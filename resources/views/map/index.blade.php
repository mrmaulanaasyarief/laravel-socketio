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
                                                <x-text-input id="jarakTempuh" name="jarakTempuh" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $jarakTempuh . ' m' : 'not available'}}" disabled />
                                            </div>

                                            <div>
                                                <x-input-label for="jarakAwalAkhir" :value="__('Jarak Koordinat Awal-Akhir')" />
                                                <x-text-input id="jarakAwalAkhir" name="jarakAwalAkhir" type="text" class="mt-1 block w-full" value="{{ $telemetriLogs ? $jarakAwalAkhir . ' m' : 'not available'}}" disabled />
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
                                                    <x-input-info id="roll-info" class="text-center" :value="$telemetriLogs ? $status_roll : null" />
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
                                                    <x-input-info id="pitch-info" class="text-center" :value="$telemetriLogs ? $status_pitch : null" />
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
                                                    <x-input-info id="yaw-info" class="text-center" :value="$telemetriLogs ? $status_yaw : null" />
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
                        <div class="bg-slate-200 shadow-sm sm:rounded-lg">
                            <div class="p-4 text-gray-900">
                                <div class="relative">
                                    <div id="map" class="h-[545px] xl:h-[580px]"></div>
                                    <div class="absolute bottom-0 right-0 z-[9999] rounded-tl-[5px] bg-slate-200 p-4">
                                        <div class="flex items-center">
                                            <form method="post" action="">
                                                @csrf
                                                <select id="flight_codes" class="inline-flex items-center w-40 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#0c0b8b] hover:bg-indigo-800 focus:outline-none transition ease-in-out duration-150">
                                                    <option value="all">All</option>
                                                    @foreach ($flightCode as $code)
                                                        @if ($code->id == $selectedFlightCode)
                                                            <option value="{{ $code->id }}" selected>{{ $code->flight_code }}</option>
                                                        @else
                                                            <option value="{{ $code->id }}">{{ $code->flight_code }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <x-primary-button class="hidden">{{ __('Select') }}</x-primary-button>
                                            </form>
                                        </div>
                                    </div>
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
                                            <div class="flex flex-row space-x-1.5">
                                                @if ($telemetriLogs && end($telemetriLogs)->tegangan < 10)
                                                    @php
                                                        $class = "flex w-full items-center p-4 text-red-800 rounded-lg bg-red-50"
                                                    @endphp
                                                @else
                                                    @php
                                                        $class = "flex w-full items-center p-4 text-red-800 rounded-lg bg-red-50 hidden"
                                                    @endphp
                                                @endif
                                                <div id="alert-battery" class="{{ $class }}" role="alert">
                                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                    </svg>
                                                    <span class="sr-only">Info</span>
                                                    <div class="ml-3 text-sm font-medium">
                                                        Low Battery
                                                    </div>
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
                                                <th>Flight Code</th>
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
                                                <th>Kebun</th>
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

            var markersLayer = new L.markerClusterGroup({
                maxClusterRadius: 40
            });

            // looping variabel datas utuk menampilkan data marker
            var datas = []

            // create a red polyline from an array of LatLng points
            var loc = [];
            @foreach($telemetriLogs as $telemetriLog )
                //datas untuk marker
                datas.push({
                    "loc": ['{{ $telemetriLog->lat }}','{{ $telemetriLog->long }}'],
                    "klasifikasi": '{{ $telemetriLog->klasifikasi }}',
                    "garden_profile": '{{ $telemetriLog->garden_profile ? $telemetriLog->garden_profile->name : '-' }}'
                });
                loc.push(['{{ $telemetriLog->lat }}','{{ $telemetriLog->long }}']);
                altmeter.value = {{ $telemetriLog->alt ? $telemetriLog->alt : 0}}/10;
                gauge.value = {{ $telemetriLog->sog ? $telemetriLog->sog : 0 }};
                compas.value = Math.atan2({{ $telemetriLog->my ? $telemetriLog->my : 0 }}, {{ $telemetriLog->mx ? $telemetriLog->mx : 0 }}) * 180 / Math.PI;
                temperature.value = {{ $telemetriLog->suhu ? $telemetriLog->suhu : 0 }};
                humidity.value = {{ $telemetriLog->humidity ? $telemetriLog->humidity : 0 }};

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

            // create a red polyline from an array of LatLng points
            var latlngs = [];
            @foreach($gardenProfiles as $gardenProfile )
            // polygon
                idx = latlngs.push([])-1;
                @foreach ($gardenProfile->polygon as $coor);
                    latlngs[idx].push([{{ $coor['lat'] }}, {{ $coor['lng'] }}]);
                @endforeach

                polygon = L.polygon(latlngs[idx], {color: 'green'}).bindPopup("<div class='my-2'><strong>Nama: </strong> <br>"+'{{ $gardenProfile->name }}'+"</div>").addTo(map);
            @endforeach

            for (i in datas) {
                var title = datas[i].title,
                    location = datas[i].loc,
                    klasifikasi = datas[i].klasifikasi
                    garden_profile = datas[i].garden_profile
                    marker = new L.Marker(new L.latLng(location), {
                        icon: (klasifikasi == 1) ? greenIcon : redIcon,
                        klasifikasi: klasifikasi,
                        garden_profile: garden_profile
                    }).bindPopup(
                        "<div class='my-2'><strong>Koordinat:</strong> <br>"+location+"</div>"+
                        "<div class='my-2'><strong>Klasifikasi:</strong> <br>"+klasifikasi+"</div>"+
                        "<div class='my-2'><strong>Kebun:</strong> <br>"+garden_profile+"</div>"
                    );
                if (klasifikasi == 1) {
                    markersLayer.addLayer(marker);
                }
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
                if(event.message.selectedFlightCode == {{ !empty($selectedFlightCode) ? $selectedFlightCode : 0}}){
                    loc.push([event.message.telemetriLog.lat, event.message.telemetriLog.long]);

                    marker = new L.Marker(new L.latLng([event.message.telemetriLog.lat, event.message.telemetriLog.long]), {
                        icon: (event.message.telemetriLog.klasifikasi == 1) ? greenIcon : redIcon,
                        klasifikasi: event.message.telemetriLog.klasifikasi
                    }).bindPopup(
                        "<div class='my-2'><strong>Koordinat:</strong> <br>"+[event.message.telemetriLog.lat, event.message.telemetriLog.long]+"</div>"+
                        "<div class='my-2'><strong>Klasifikasi:</strong> <br>"+event.message.telemetriLog.klasifikasi+"</div>"
                    );

                    if (event.message.telemetriLog.klasifikasi == 1) {
                        markersLayer.addLayer(marker);
                    }
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
                    document.getElementById("jarakTempuh").value = event.message.jarakTempuh + ' m';
                    document.getElementById("jarakAwalAkhir").value = event.message.jarakAwalAkhir + ' m';
                    document.getElementById("waktuAkhir").value = event.message.telemetriLog.tPayload + ' WIB';
                    document.getElementById("totalWaktu").value = event.message.totalWaktu + ' s';
                    document.getElementById("teganganAkhir").value = event.message.telemetriLog.tegangan + ' V';
                    document.getElementById("arusAkhir").value = event.message.telemetriLog.arus + ' mA';
                    document.getElementById("dayaAkhir").value = event.message.telemetriLog.daya + ' mW';

                    if(event.message.telemetriLog.tegangan < 10){
                        document.getElementById("alert-battery").classList.remove("hidden");
                    }else{
                        document.getElementById("alert-battery").classList.add("hidden");
                    }

                    document.getElementById("roll").value = event.message.telemetriLog.roll + '°';
                    document.getElementById("roll-info").innerText = event.message.telemetriLog.roll > 0 ? "miring kanan" : "miring kiri";
                    document.getElementById("pitch").value = event.message.telemetriLog.pitch + '°';
                    document.getElementById("pitch-info").innerText = event.message.telemetriLog.pitch > 0 ? "menjulang" : "menukik";
                    document.getElementById("yaw").value = event.message.telemetriLog.yaw + '°';
                    document.getElementById("yaw-info").innerText = event.message.telemetriLog.yaw > 0 ? "putar kanan" : "putar kiri";

                    document.getElementById("accelerationX").value = event.message.telemetriLog.ax + ' g';
                    document.getElementById("accelerationY").value = event.message.telemetriLog.ay + ' g';
                    document.getElementById("accelerationZ").value = event.message.telemetriLog.az + ' g';
                    document.getElementById("gyroscopeX").value = event.message.telemetriLog.gx + '°/s';
                    document.getElementById("gyroscopeY").value = event.message.telemetriLog.gy + '°/s';
                    document.getElementById("gyroscopeZ").value = event.message.telemetriLog.gz + '°/s';
                    document.getElementById("magnetometerX").value = event.message.telemetriLog.mx + ' n/T';
                    document.getElementById("magnetometerY").value = event.message.telemetriLog.my + ' n/T';
                    document.getElementById("magnetometerZ").value = event.message.telemetriLog.mz + ' n/T';

                    $('#dataTelemetriLogs').DataTable().ajax.reload();

                    panel.dataset.rotateX = event.message.telemetriLog.pitch;
                    panel.dataset.rotateY = event.message.telemetriLog.yaw;
                    panel.dataset.rotateZ = event.message.telemetriLog.roll;
                    updatePanelTransform();
                }
            });

            $('#flight_codes').on('change', function(e){
                var select = $(this), form = select.closest('form');
                form.attr('action', 'flight-code/' + select.val() + '/select-view');
                form.submit();
            });
        });
    </script>
    @include('map.scripts.roll-pitch-yaw')
    @include('map.scripts.gauge')
    @include('map.scripts.datatable')
</x-app-layout>
