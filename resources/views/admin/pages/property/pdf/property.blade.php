<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title><style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
    <div style="width:800px;" id="customers">
   
<table class="" style="width:100%" >
    <thead>
        <tr>
            <th>Sl.no</th>
            <th>Date </th>
            <th>GIS ID</th>
            <th>Category of the property</th>
            <th>Type of property</th>
            <th>House No.</th>
            <th>Owner Full Name</th>
            <th>Contact No</th>
           
        </tr>
    </thead>

    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $loop->iteration ?? '' }}</td>
                <td>{{ date('d-M-y', strtotime($property->created_date)) ?? '' }}</td>
                <td>{{ $property->gis_id ?? '' }} </td>
                <td>{{ $property->category->title ?? '' }}</td>
                <td>{{ $property->sub_category->title ?? '' }}</td>
                <td>{{ $property->house_no ?? '' }}</td>
                <td>{{ $property->owner_name ?? '' }} </td>
                <td>{{ $property->contact_no ?? '' }}</td>
                
            </tr>
        @endforeach
    </tbody>

</table></div>
  
</body>
</html>

