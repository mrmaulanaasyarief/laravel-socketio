<script>
    // datatable
    $('#dataTelemetriLogs').DataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        ajax: '{{ route('telemetri-log.data') }}',
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'tReceived'
            },
            {
                data: 'tPayload'
            },
            {
                data: 'lat'
            },
            {
                data: 'long'
            },
            {
                data: 'alt'
            },
            {
                data: 'sog'
            },
            {
                data: 'cog'
            },
            {
                data: 'arus'
            },
            {
                data: 'tegangan'
            },
            {
                data: 'daya'
            },
            {
                data: 'klasifikasi'
            },
            {
                data: 'ax'
            },
            {
                data: 'ay'
            },
            {
                data: 'az'
            },
            {
                data: 'gx'
            },
            {
                data: 'gy'
            },
            {
                data: 'gz'
            },
            {
                data: 'mx'
            },
            {
                data: 'my'
            },
            {
                data: 'mz'
            },
            {
                data: 'roll'
            },
            {
                data: 'pitch'
            },
            {
                data: 'yaw'
            },
            {
                data: 'suhu'
            },
            {
                data: 'humidity'
            }
        ]
    });
</script>
