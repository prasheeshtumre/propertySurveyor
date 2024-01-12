<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style>
        @import url("//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");

        .data-table {
            width: 100%;
            background-color: #fdfdfd;
            font-size: 0.8rem;
            color: #333;
        }

        .data-table thead {
            background-color: #cccfd1;
        }

        .data-table thead th {
            text-align: left;
            text-transform: uppercase;
            padding: 0.5rem;
            font-weight: bold;
            color: #000;
            font-size: 0.9rem;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #e7e9ea;
        }

        .data-table tbody td {
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }

        @media only screen and (max-width: 680px) {

            /* Force tables to not be like tables anymore */
            /* Hide table headers (but not display: none;
 , for accessibility) */
            .responsive-table,
            .responsive-table thead,
            .responsive-table tbody,
            .responsive-table th,
            .responsive-table td,
            .responsive-table tr {
                display: block;
            }

            .responsive-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .responsive-table td {
                /* Behave like a "row" */
                border: none;
                position: relative;
                padding-left: 33% !important;
            }

            .responsive-table td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
            }

            .table-hr td:last-of-type:after {
                content: " ";
                height: 2px;
                background: #cbc7c7;
                width: 100%;
                position: absolute;
                top: 98%;
                left: 0;
            }
        }

        @media only screen and (max-width: 680px) {
            .collapse-table tr.collapse td {
                display: none;
            }

            .collapse-table tr.collapse td:first-of-type {
                display: block !important;
            }
        }

        .collapse-table td {
            vertical-align: top;
        }

        .collapse-table td i {
            cursor: pointer;
        }

        @media only screen and (min-width: 680px) {
            .collapse-table td.collapse img {
                display: none;
            }
        }
    </style>
    <table class="table-hr data-table collapse-table responsive-table">
        <thead>
            <tr>
                <th></th>
                <th>IMAGE</th>
                <th>TYPE</th>
                <th>MAKE</th>
                <th>MODEL</th>
                <th>DESCRIPTION</th>
            </tr>
        </thead>
        <tbody>
            <tr class="collapse">
                <td data-label="Bipod"><i class="h3 fa fa-plus-square js-tdToggle"></i></td>
                <td data-label="IMAGE" class="collapse"><img src="https://brash-ui.firebaseapp.com/img/test-pic1.png"
                        width="100px;" alt="testimg">
                </td>
                <td data-label="TYPE">Bipod</td>
                <td data-label="MAKE">Manufacturer</td>
                <td data-label="MODEL">Manufacturer</td>
                <td data-label="DESC">It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout.</td>
            </tr>
            <tr class="collapse">
                <td data-label="Grip"><i class="h3 fa fa-plus-square js-tdToggle"></i></td>
                <td data-label="IMAGE" class="collapse">
                    <img src="https://brash-ui.firebaseapp.com/img/test-pic1.png" width="100px;" alt="testimg">
                </td>
                <td data-label="TYPE">Grip</td>
                <td data-label="MAKE">Manufacturer</td>
                <td data-label="MODEL">Manufacturer</td>
                <td data-label="DESC">It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout.</td>
            </tr>
            <tr class="collapse">
                <td data-label="Scope"><i class="h3 fa fa-plus-square js-tdToggle"></i></td>
                <td data-label="IMAGE" class="collapse">
                    <img src="https://brash-ui.firebaseapp.com/img/test-pic1.png" width="100px;" alt="testimg">
                </td>
                <td data-label="TYPE">Scope</td>
                <td data-label="MAKE">Manufacturer</td>
                <td data-label="MODEL">Manufacturer</td>
                <td data-label="DESC">It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout.</td>
            </tr>
        </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.js-tdToggle').on('click', function() {
            if (window.innerWidth < 681) {
                $(this).toggleClass("fa-plus-square fa-minus-square");
                var
                    trParent = $(this).parent().parent();
                trParent.toggleClass("collapse expand");
            } else {
                $(this).toggleClass("fa-plus-square fa-minus-square");
                var tdParent = $(this).parent();
                tdParent.next("td").toggleClass("collapse expand");
            }
        });
    </script>
</body>

</html>
