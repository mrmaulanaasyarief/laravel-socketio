<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Center Point') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table" id="dataCenterPoint">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Action</th>
                            </tr>
                        <tbody></tbody>
                        </thead>
                    </table>

                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Delete" style="display: none">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
    // ajaxserver side  datatable untuk menampilkan data centrepoint
        $(function() {
            $('#dataCentrePoint').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                ajax: '{{ route('centre-point.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'location'
                    },
                    {
                        data: 'action'
                    }
                ]
            })
        })
    </script>
</x-app-layout>
