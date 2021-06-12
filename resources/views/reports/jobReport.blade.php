<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JOB - {{ $data['code'] }}</title>

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
        <span><strong>JOB REPORT</strong></span>
    </div>

    <br>
    <div style="padding: 0px">

        <div class="row">
            <div class="col-5">
                <table>
                    <tr>
                        <td><b>JOB #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['code'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Job Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['created_at']->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td><b>Store Location</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['locationdata']['locationname'] }} {{ $data['locationdata']['locationaddress'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Vehicle & Model #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['vehicledata']['brand'] }} {{ $data['vehicledata']['model'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-5" style="margin-left: auto; margin-right: 0px;">
                <table>
                    <tr>
                        <td><b>Approval Status</b></td>
                        <td>&nbsp;</td>

                        @php
                        $statusText = '';

                        switch ($data['status']) {
                        case 1:
                        $statusText = 'Approved';
                        break;
                        case 2:
                        $statusText = 'Refused';
                        break;
                        case 3:
                        $statusText = 'Pending';
                        break;
                        case 4:
                        $statusText = 'Meterial Approve';
                        break;
                        case 5:
                        $statusText = 'Item Issued';
                        break;
                        default:
                        $statusText = '-';
                        break;
                        }
                        @endphp

                        <td>{{ $statusText }}</td>
                    </tr>

                    <tr>
                        <td><b>Approved By</b></td>
                        <td>&nbsp;</td>
                        <td>{{ ($data['approval_user'])?$data['approved_user_data']['fname']:'' }} {{ ($data['approval_user'])?$data['approved_user_data']['lname']:'' }}</td>
                    </tr>

                    <tr>
                        <td><b>Approved Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['approval_date'] }}</td>
                    </tr>

                    <tr>
                        <td><b>Print Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ Carbon\Carbon::now()->format('Y') }}</td>
                    </tr>

                </table>
            </div>

        </div>

        <br>
        <br>

        <div>
            <table class="table-border" style="border-spacing: 0; border-width: 0; padding: 0; border-width: 0; width:100%">
                <thead>
                    <tr class="trcolor">
                        <th class="tborderth tborder tbleft bold-100" style="text-align: left">#</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">BIN</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Product Code</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Unit L/C</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Qty</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">VAT %</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Sub Total</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Tot O/Exp</th>
                        <th class="tborderth tborder bold-100 tbright" style="text-align: right">Net Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $index1=1;
                    @endphp

                    @foreach ($data['jobhasproducts'] as $jhp)
                    <tr>
                        <td class="tborder tbleft">{{ $index1 }}</td>
                        <td class="tborder">{{ $jhp['bindata']['bin_location_name'] }}</td>
                        <td class="tborder">{{ $jhp['productdata']['code'] }}</td>
                        <td class="tborder alright">{{ env('CURRENCY').' ' . number_format(($jhp['cost']/$jhp['qty']), 2, '.', ',') }}</td>
                        <td class="tborder alright">{{ $jhp['qty'] }}</td>
                        <td class="tborder alright">{{ $jhp['vat'] }}</td>
                        <td class="tborder alright">{{ env('CURRENCY').' ' . number_format($jhp['subtotal'], 2, '.', ',') }}</td>
                        <td class="tborder alright">{{ env('CURRENCY').' ' . number_format($jhp['ex_total'], 2, '.', ',') }}</td>
                        <td class="tborder alright tbright">{{ env('CURRENCY').' ' . number_format($jhp['nettotal'], 2, '.', ',') }}</td>
                    </tr>
                    @php
                    $index1++;
                    @endphp
                    @endforeach

                </tbody>
            </table>

        </div>

        <div>

            <div style="text-align: left">
                <h4>EXPENSES LIST</h4>
            </div>

            <table class="table-border" style="border-spacing: 0; border-width: 0; padding: 0; border-width: 0; width:100%">
                <thead>
                    <tr class="trcolor">
                        <th class="tborderth tborder tbleft bold-100" style="text-align: left">#</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Product Code</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Expense Name</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Expense Reference</th>
                        <th class="tborderth tborder tbright bold-100" style="text-align: right">Expense Amount</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $index2=1;
                    @endphp

                    @foreach ($data['jobhasproducts'] as $jhparray)
                        @foreach ($jhparray['outsideex'] as $oex)
                        <tr>

                        <tr>
                            <td class="tborder tbleft">{{ $index2 }}</td>
                            <td class="tborder">{{ $jhparray['productdata']['code'] }}</td>
                            <td class="tborder">{{ $oex['expense'] }}</td>
                            <td class="tborder">{{ $oex['reference'] }}</td>
                            <td class="tborder alright tbright">{{ env('CURRENCY').' ' . number_format($oex['amount'], 2, '.', ',') }}</td>
                        </tr>
                        @if ($oex['remark']!=null && $oex['remark']!='')
                        <tr>
                            <td class="tborder tbleft tbright" colspan="5">
                                <b>Expense Remark :</b> {{ $oex['remark'] }}
                            </td>
                        </tr>
                        @endif



                        </tr>
                        @php
                            $index2++;
                        @endphp
                        @endforeach
                    @endforeach

                </tbody>
            </table>

        </div>


        <div style="margin-top: 50px">
            @if ($data['remark'])
            <p style="text-align: justify"><strong>Remark : </strong>{{ $data['remark'] }}</p>
            @endif

            <br>
            <div class="row" style="margin-top: 50px">
                <div class="col-4">
                    <div style="margin-right: auto; margin-left: 0px;" class="text-center"><span>..............................................</span><br><span><i>Issued by</i></span></div>
                </div>
                <div class="col-4 text-center text-align-right">
                    <span>..............................................</span><br><span><i>Received
                            by</i></span>
                </div>
            </div>

        </div>
    </div>
    <br>

</body>

</html>
