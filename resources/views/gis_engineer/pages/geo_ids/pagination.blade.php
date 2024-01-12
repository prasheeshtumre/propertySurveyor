<div class="d-flex justify-content-between align-items-center mb-1 row ser_re">
    <div>
        <h6 class="mb-0">Search Result: {{ $geo_id_logs_count }}</h6>
    </div>
</div>
<style>
    .table-responsive {
        overflow-x: unset;
    }
</style>
<table class="table table-striped dt-responsive table-hover nowrap data-table" style="width:100%">

        <thead>
            <tr class="table-info">
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>File Name</th>
                <th>No of GIS ID's imported</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($geo_id_logs as $geo_id)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $geo_id->created_at->format('d-m-Y') ?? 'N/A' }}</td>
                    <td>{{ $geo_id->created_at->format('H:i A') ?? 'N/A' }}</td>
                    <td>{{ $geo_id->file_name ?? 'N/A' }}</td>
                    <td>{{ $geo_id->geo_ids_count ?? 'N/A' }} </td>
                    <td class="noExport">
                        <a target="_blank" href="">
                            <a href="{{asset('uploads/property/geo_id_uploaded_files/'. $geo_id->file_name)}}" class="btn btn-sm btn-primary"><span class="mdi mdi-file-download"></span> download </a>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
<div id="pagination">
    {{ $geo_id_logs->links('pagination::bootstrap-4', ['secure' => true]) }}
</div>
