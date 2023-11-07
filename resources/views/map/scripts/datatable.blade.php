<!-- Datatables -->
<link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

<script>
    // datatable
    $('#dataTelemetriLogs').DataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A3',
                text: 'Export to PDF',
                title: '{{ $app->name }}_TelemetriLogs',
            },
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: '{{ $app->name }}_TelemetriLogs'
            }
        ],
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
            },

        ],
        createdRow: function(row, data, index) {

            // Updated Schedule Week 1 - 07 Mar 22
            $('td', row).css('background-color', '#e2e8f0');
        }
    });
</script>
