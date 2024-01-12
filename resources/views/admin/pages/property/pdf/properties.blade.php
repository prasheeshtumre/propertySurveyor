<table class="" style="width:100%">
    <thead>
        <tr>
            <th>Sl.no</th>
            <th>Date </th>
            <th>Time </th>
            <th>GIS ID</th>
            <th>Category of the property</th>
            <th>Type of property</th>
            <th>House No.</th>
            <th>Colony/Locality Name</th>
            <th>Owner Full Name</th>
            <th>Contact No</th>
           
        </tr>
    </thead>

    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $loop->iteration ?? '' }}</td>
                <td>{{ $property->date ?? '' }}</td>
                <td>{{ $property->time ?? '' }}</td>
                <td>{{ $property->gis_id ?? '' }} </td>
                <td>{{ $property->cat ?? '' }}</td>
                <td>{{ $property->sub_cat ?? '' }}</td>
                <td>{{ $property->house_no ?? '' }}</td>
                <td>{{ $property->locality_name ?? '' }}</td>
                <td>{{ $property->owner_name ?? '' }} </td>
                <td>{{ $property->contact_no ?? '' }}</td>
                
            </tr>
        @endforeach
    </tbody>

</table>