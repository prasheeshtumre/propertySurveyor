<div class="d-flex justify-content-between align-items-center mb-1 row ser_re"  >
    <div>
        <h6 class="mb-0">Search Result: {{ $property_count }}</h6>
    </div>
</div>
<table class="table table-striped table-hover dt-responsive nowrap data-table" style="width:100%">
    <thead>
        <tr class="table-primary">
            <th>S.No</th>
            <th>Date </th>
            <th>Time </th>
            <th>GIS ID</th>
            <th>Project Name</th>
            {{-- <th>Latitude</th> --}}
            {{-- <th>Longitude</th> --}}
            {{-- <th>Surveyor Name</th> --}}
            <th>Category of the property</th>
            <th>Residential Sub-Type</th>
            {{-- <th>House No.</th> --}}
            <th>Colony/Locality Name</th>
            {{-- <th>Owner Full Name</th> --}}
            <th>Street Details</th>
            <th>Latest Price</th>

            <th>Builder Name</th>
            @if ($category_type == 7)
                <th>No of Towers</th>
            @endif


            <th>Remarks</th>
            <!--<th>Pincode</th>-->
            {{-- <th>No Of Floors</th>
            <th>Images</th> --}}
            <th class="noExport">Action</th>
        </tr>
    </thead>
    <!--12. Type-->
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $loop->iteration ?? 'N/A' }}</td>
                <td>{{ $property->date ?? 'N/A' }}</td>
                <td>{{ $property->time ?? 'N/A' }}</td>
                <td>{{ $property->gis_id ?? 'N/A' }} </td>
                <td>{{ $property->project_name ?? 'N/A' }}</td>
                {{-- <td>{{ $property->latitude ?? 'N/A' }} </td> --}}
                {{-- <td>{{ $property->longitude ?? 'N/A' }} </td> --}}
                {{-- <td>{{ $property->surveyor_name ?? 'N/A' }} </td> --}}
                <td>{{ $property->residential_type ?? 'N/A' }}</td>
                <td>{{ $property->residential_sub_category ?? 'N/A' }} </td>
                {{-- <td>{{ $property->house_no ?? 'N/A' }}</td> --}}
                <td>{{ $property->locality_name ?? 'N/A' }}</td>
                {{-- <td>{{ $property->owner_name ?? 'N/A' }} </td> --}}
                <td>{{ $property->street_details ?? 'N/A' }}</td>
                <td>{{ $property->price ?? 'N/A' }}</td>

                <td>{{ $property->builder_name ?? 'N/A' }}</td>
                @if ($category_type == 7)
                    <td>{{ $property->no_of_towers }}</td>
                @endif

                <td>{{ $property->remarks ?? 'N/A' }}</td>
                <!--<td>N/A</td>-->
                {{-- <td>{{ $property->no_of_floors ?? 'N/A' }}</td> --}}
                {{-- <td>

                    @forelse ($property->images->take(1) as $image)
                        <img src="{{ config('app.propert') }}{{ '/public/uploads/property/images/' . $image->file_url }}"
                            alt="" height="120px" class="">
                    @empty
                        N/A
                    @endforelse


                </td> --}}
                <td class="noExport"><a target="_blank"
                        href=" {{ route('surveyor.property.report_details', $property->id) }} ">

                        <button class="btn btn-sm btn-primary"><i class="fa fa-file"></i> View more </button>

                    </a></td>
            </tr>
        @endforeach
    </tbody>

</table>
<div id="pagination">
    {{ $properties->links('pagination::bootstrap-4', ['secure' => true]) }}
    {{-- {{ $properties->links() }} --}}
</div>
