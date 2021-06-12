<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Report - {{ Session::get('view', 'non') }}</title>

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
        
        .text-left {
            text-align: left;
        }
    </style>

</head>

<body class="font">

    <div class="text-center">
        <h3>TRUST PLASTIC INDUSTRIES PRIVATE LIMITED</h3>
        <span>No. 451/6, Makola North, Makola - 11640</span>
        <span> - <strong>Stock Report</strong></span>
    </div>

    <br>
    <div style="padding: 0px">

        <div class="row">
            <div class="col-6">
                <table>
                    <tr>
                        <td><b>GRN #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ ($data['filters']['grn']!=null)?$data['filters']['grn']['grn_code']:'-'}}</td>
                    </tr>
                    <tr>
                        <td><b>Item</b></td>
                        <td>&nbsp;</td>
                        <td>{{ ($data['filters']['item']!=null)?'('.$data['filters']['item']['item_code'].') '.$data['filters']['item']['item_name']:'-'}}</td>
                    </tr>
                    <tr>
                        <td><b>Location</b></td>
                        <td>&nbsp;</td>
                        <td>{{ ($data['filters']['location']!=null)?$data['filters']['location']['location_name'].' '.$data['filters']['location']['location_address']:'-'}}</td>
                    </tr>
                    <tr>
                        <td><b>Bin Location</b></td>
                        <td>&nbsp;</td>
                        <td>{{ ($data['filters']['bin']!=null)?$data['filters']['bin']['bin_location_name']:'-'}}</td>
                    </tr>
                </table>
            </div>

            <div class="col-6">
                <div style="margin-left: auto; margin-right: 0px">
                    <table>
                        <tr>
                            <td><b>Date From</b></td>
                            <td>&nbsp;</td>
                            <td>{{ ($data['filters']['from']!=0)?$data['filters']['from']:'-'}}</td>
                        </tr>
                        <tr>
                            <td><b>Date To</b></td>
                            <td>&nbsp;</td>
                            <td>{{ ($data['filters']['to']!=0)?$data['filters']['to']:'-'}}</td>
                        </tr>

                        <tr>
                            <td><b>Print Date</b></td>
                            <td>&nbsp;</td>
                            <td>{{ Carbon\Carbon::now()->toDateTimeString() }}</td>
                        </tr>

                        <tr>
                            <td><b>Print by</b></td>
                            <td>&nbsp;</td>
                            <td>{{ Auth::user()->fname }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <br>
        <br>

        <div>
            <table class="table-border" style="border-spacing: 0; border-width: 0; padding: 0; border-width: 0; width:100%">
                <thead>
                    <tr class="trcolor">
                        <th class="tborderth tborder tbleft bold-100" style="text-align: left">#</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Item Code</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Part Code</th>
                        <th class="tborderth tborder bold-100" style="text-align: center">Item Name</th>
                        @if($data['filters']['checked']==1)
                        <th class="tborderth tborder bold-100" style="text-align: center">Bin Location</th>
                        @endif
                        <th class="tborderth tborder bold-100" style="text-align: center">Qty</th>
                        <th class="tborderth tborder tbright bold-100" style="text-align: center">Low Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index=1; @endphp @foreach ($data['records'] as $record)
                    <tr>
                        <td style="text-align: left" class="tborder tbleft">{{ $index }}</td>
                        <td style="text-align: left" class="tborder">{{ $record[0]['item_code'] }}</td>
                        <td style="text-align: left" class="tborder">{{ $record[0]['item_part_code'] }}</td>
                        <td style="text-align: center" class="tborder">{{ $record[0]['item_name'] }}</td>
                        @if($data['filters']['checked']==1)
                        <td style="text-align: center" class="tborder">{{ $record[2] }}</td>
                        @endif
                        <td style="text-align: center" class="tborder">{{ $record[1]['totqty'] }}</td>
                        <td style="text-align: center" class="tborder tbright">{{ ($record[1]['totqty']
                            <5)? 'YES': 'NO' }}</td>
                    </tr>
                    @php $index++; @endphp @endforeach
                </tbody>
            </table>

        </div>

    </div>
    <br>

</body>

</html>