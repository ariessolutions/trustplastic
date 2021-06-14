<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Order Report</title>

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                padding-left: 10px;
                padding-right: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
            }

        }

        .font {
            font-family: 'Segoe UI';
        }

        .text-center {
            text-align: center;
        }


        .row {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            margin-top: 5px;
        }

        .col-2 {
            width: 16.66%;
        }


        .col-3 {
            width: 25%;
        }

        .col-4 {
            width: 33.33%
        }

        .col-6 {
            width: 50%;
        }

        .tborderth {
            border-top: 1px solid #212121;
            /* border: 1px solid black; */
            padding: 5px;
            margin: 0px;

        }

        .tbleft {
            padding-left: 10px;
            border-left: 1px solid #212121
        }

        .tbright {
            padding-right: 10px;
            border-right: 1px solid #212121
        }

        .tborder {
            /* border-left: 1px solid #212121; */
            /* border-right: 1px solid #212121; */
            /* border-top: 1px solid #212121; */
            border-bottom: 1px solid #212121;
            /* padding: 5px; */
            padding-top: 10px;
            padding-bottom: 10px;
            margin: 0px;

        }

        .alright {
            text-align: right
        }

        .smargin {
            padding: 5px;
        }

        .bold-100 {
            font-weight: 500;
        }

        .trcolor {
            background-color: #eeeeee;
            -webkit-print-color-adjust: exact;
        }

        .text-align-right {
            margin-left: auto;
            margin-right: 0px;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body class="font">

    <div class="text-center">
        <h3>TRUST PLASTIC INDUSTRIES PRIVATE LIMITED</h3>
        <span>No. 451/6, Makola North, Makola - 11640</span>
        <h3>MATERIAL REQUEST REPORT</h3>
    </div>

    <br>

    <div style="padding: 0px">

        <div class="row">
            <div class="col-6">
                <table>
                    <tr>
                        <td><b>MR #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['mr_code'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Job Code</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['getjobs']['code'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Store</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['getjobs']['locationdata']['location_name'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['date'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-4" style="margin-left: auto; margin-right: 0px;">
                <table>
                    <tr>
                        <td><b>Status</b></td>
                        <td>&nbsp;</td>

                        @if($data['status']==1)
                        <td>Approved</td>
                        @elseif($data['status']==2)
                        <td>Refuse</td>
                        @elseif($data['status']==3)
                        <td>Pending</td>
                        @elseif($data['status']==4)
                        <td>Item Issued</td>
                        @endif

                    </tr>
                    <tr>
                        <td><b>Print Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ Carbon\Carbon::now()->toDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td><b>Printed by</b></td>
                        <td>&nbsp;</td>
                        <td>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</td>
                    </tr>

                </table>
            </div>

        </div>

        <br>
        <br>

        <div>
            <table class="table-border"
                style="border-spacing: 0; border-width: 0; padding: 0; border-width: 0; width:100%">
                <thead>
                    <tr class="trcolor">
                        <th class="tborderth tborder tbleft bold-100" style="text-align: left">#</th>
                        <th class="tborderth tborder bold-100">Product Code</th>
                        <th class="tborderth tborder bold-100">Part Code</th>
                        <th class="tborderth tborder tbright bold-100" style="text-align: center">Qty</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data['getallmaterials'] as $key=>$item )

                    <tr>
                        <td class="tborder tbleft">{{ $key+1 }}</td>
                        <td class="tborder text-center">{{ $item['getjobhasproducts']['code'] }}</td>
                        <td class="tborder text-center">{{ $item['getitembyid']['item_part_code'] }}</td>
                        <td class="tborder text-center tbright">{{ $item['qty'] }}</td>
                    </tr>

                    @endforeach


                </tbody>
            </table>

        </div>

    </div>
    <br>


    <div class="text-center row" style="margin-top: 70px">
        <div>
            <span>..............................................</span><br><span><i>Issued by</i></span>
        </div>
    </div>

</body>

</html>
