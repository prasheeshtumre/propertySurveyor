<style>
    .tableProperty th,
    td {
        padding: 8px;
        font-size: 14px;
        color: black;
    }

    /*.tableProperty td:nth-child(1) {*/
    /*    font-weight: 600;*/
    /*}*/
    .tableProperty {
        width: 100% !important;
    }

    /*.tableProperty tr:hover:not(:first-child) {*/
    /*    background-color: #d8e7f3;*/
    /*  }*/
    /*.tableProperty tr:nth-child(odd) {*/
    /*    background-color: #e1edff;*/
    /*}*/
    .ol-popup {
        padding: 3px 10px 2px 10px !important;
    }

    .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: -10px !important;
        right: -10px !important;
        /*background-color: #207dff;*/
        color: #FFF !important;
        border-radius: 50%;
        width: 28px !important;
        height: 28px !important;
        text-align: center;
        padding-top: 5px !important;
        text-decoration: none;
    }

    .button-add-property {
        margin-top: 10px;
        padding: 8px;
        font-size: 14px;
        border: none;
        background: rgb(222, 109, 108) !important;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<table border="1" class="tableProperty">
    <tr align="center">
        <th colspan="2">

        </th>
    </tr>
    <tr>
        <td><strong>Gis id</strong></td>
        <td>{{ $gis_id ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td colspan="2">Data not available.</td>

    </tr>
</table>
<button class="button-add-property">
    <a target="_blank" href="{{url('surveyor/basic_details')}}?gis_id={{ $gis_id ?? 'N/A'}}@if(isset($coordinate))&lat={{$lat}}&long={{$long}}@endif">Add Property</a>    
</button>
