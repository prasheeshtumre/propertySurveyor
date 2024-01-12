<div class="d-flex justify-content-between align-items-center mb-1 row ser_re">
    <div>
        <h6 class="mb-0">Search Result: {{ $property_count }}</h6>
        {{-- -{{ $category_type }} --}}
    </div>
</div>
<table class="table table-striped dt-responsive table-hover nowrap data-table" style="width:100%">
    @if ($category_type == '1' || $category_type == '3')
        <thead>
            <tr class="table-info">
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                <th>Category of the property</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>No Of Floors</th>
                <th>For Rent/Sale</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>{{ $property->no_of_floors ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->remarks }}
                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '10')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                {{-- <th>Latitutde</th> --}}
                {{-- <th>Longitude</th> --}}
                <th>Category of the property</th>
                <th>Residential Sub Type</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>Project Name</th>
                <th>Builder Name</th>
                <th>No of Towers</th>
                <th>For Rent/Sale</th>
                <th>Latest Price</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    {{-- <td>{{ $property->latitude ?? 'N/A' }} </td> --}}
                    {{-- <td>{{ $property->longitude ?? 'N/A' }} </td> --}}
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->residential_sub_category ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>{{ $property->project_name ?? 'N/A' }}</td>
                    <td>{{ $property->builder_name ?? 'N/A' }}</td>
                    <td>{{ $property->no_of_towers }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->price ?? 'N/A' }}</td>
                    <td>{{ $property->remarks }}</td>

                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '14')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                {{-- <th>Latitutde</th> --}}
                {{-- <th>Longitude</th> --}}
                <th>Category of the property</th>
                <th>Plot Land Sub Type</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>Project Name</th>
                <th>Builder Name</th>
                <th>For Rent/Sale</th>
                {{-- <th>No of Towers</th> --}}
                <th>Latest Price</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    {{-- <td>{{ $property->latitude ?? 'N/A' }} </td> --}}
                    {{-- <td>{{ $property->longitude ?? 'N/A' }} </td> --}}
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->plot_land_sub_type ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>{{ $property->project_name ?? 'N/A' }}</td>
                    <td>{{ $property->builder_name ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    {{-- <td>{{ $property->no_of_towers }}</td> --}}
                    <td>{{ $property->price ?? 'N/A' }}</td>
                    <td>{{ $property->remarks }}</td>

                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '12')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                {{-- <th>Latitutde</th> --}}
                {{-- <th>Longitude</th> --}}
                <th>Category of the property</th>
                <th>Residential Sub Type</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>Project Name</th>
                <th>Builder Name</th>
                <th>For Rent/Sale</th>
                {{-- <th>No of Towers</th> --}}
                <th>Latest Price</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    {{-- <td>{{ $property->latitude ?? 'N/A' }} </td> --}}
                    {{-- <td>{{ $property->longitude ?? 'N/A' }} </td> --}}
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->residential_sub_category ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>{{ $property->project_name ?? 'N/A' }}</td>
                    <td>{{ $property->builder_name ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    {{-- <td>{{ $property->no_of_towers }}</td> --}}
                    <td>{{ $property->price ?? 'N/A' }}</td>
                    <td>{{ $property->remarks }}</td>

                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '9' || $category_type == '11')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                <th>Category of the property</th>
                <th>Residential Sub Type</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>No of Floors</th>
                <th>For Rent/Sale</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->residential_sub_category ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>{{ $property->no_of_floors ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->remarks }}</td>
                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '13')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                <th>Category of the property</th>
                <th>Plot Land Sub Type</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>For Rent/Sale</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->plot_land_sub_type ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->remarks }}</td>
                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '5')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                {{-- <th>Latitutde</th> --}}
                {{-- <th>Longitude</th> --}}
                <th>Category of the property</th>
                <th>Construction Type</th>
                <th>Colony/Locality Name</th>
                <th>Street Details</th>
                <th>Project Name</th>
                <th>Builder Name</th>
                <th>For Rent/Sale</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    {{-- <td>{{ $property->latitude ?? 'N/A' }} </td> --}}
                    {{-- <td>{{ $property->longitude ?? 'N/A' }} </td> --}}
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->construction_type ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <td>{{ $property->project_name ?? 'N/A' }}</td>
                    <td>{{ $property->builder_name ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->remarks }}</td>
                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif($category_type == '6')
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                <th>For Rent/Sale</th>
                <th>Latitutde</th>
                <th>Longitude</th>
                <th>Category of the property</th>
                <th>Remarks</th>
                <th class="noExport">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration ?? 'N/A' }}</td>
                    <td>{{ $property->date ?? 'N/A' }}</td>
                    <td>{{ $property->time ?? 'N/A' }}</td>
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->latitude ?? 'N/A' }} </td>
                    <td>{{ $property->longitude ?? 'N/A' }} </td>
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>{{ $property->remarks }}</td>
                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @else
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date </th>
                <th>Time </th>
                <th>Surveyor </th>
                <th>GIS ID</th>
                <th>Category of the property</th>
                <th>For Rent/Sale</th>
                <th>House No.</th>
                <th>Colony/Locality Name</th>
                <th>Owner Full Name</th>
                <th>Street Details</th>
                <!--<th>Pincode</th>-->
                <th>No Of Floors</th>
                {{-- <th>Images</th> --}}
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
                    <td>{{ $property->surveyor->name ?? 'N/A' }}</td>
                    <td>{{ $property->gis_id ?? 'N/A' }} </td>
                    <td>{{ $property->cat ?? 'N/A' }}</td>
                    <td>
                        @if ($property->up_for_rent == '1' && $property->up_for_sale == '1')
                            For Sale/Rent
                        @elseif($property->up_for_rent == '1')
                            For Rent
                        @elseif($property->up_for_sale == '1')
                            For Sale
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $property->house_no ?? 'N/A' }}</td>
                    <td>{{ $property->locality_name ?? 'N/A' }}</td>
                    <td>{{ $property->owner_name ?? 'N/A' }} </td>
                    <td>{{ $property->street_details ?? 'N/A' }}</td>
                    <!--<td>N/A</td>-->
                    <td>{{ $property->no_of_floors ?? 'N/A' }}</td>
                    {{-- <td>
                        @forelse ($property->images->take(1) as $image)
                            <img src="{{ config('app.propert') }}{{ '/public/uploads/property/images/' . $image->file_url }}"
            alt="" height="120px" class="">
            @empty
            N/A
            @endforelse
            </td> --}}
                    <td class="noExport">
                        <a target="_blank" href="  {{ route('gis-engineer.property.report_details', $property->id) }}/{{$type ?? ''}}  ">
                            <button class="btn btn-sm btn-primary"> View more </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>

<div id="pagination">
    {{ $properties->links('pagination::bootstrap-4', ['secure' => true]) }}
    {{-- <!--{{ $properties->links() }}--> --}}
</div>
