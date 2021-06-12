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
        <h3>PURCHASE ORDER REPORT</h3>
    </div>

    <br>
    <div style="padding: 0px">

        <div class="row">
            <div class="col-5">
                <table>
                    <tr>
                        <td><b>PO #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['po_code'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Receiving Store</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['location']['location_name'] }}</td>
                    </tr>

                    <tr>
                        <td><b>Vendor #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['supplier']['supplier_code'] }}</td>
                    </tr>

                    <tr>
                        <td><b>Vendor Name</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['supplier']['supplier_name'] }}</td>
                    </tr>


                </table>
            </div>

            <div class="col-5" style="margin-left: auto; margin-right: 0px;">
                <table>
                    <tr>
                        <td><b>Status</b></td>
                        <td>&nbsp;</td>
                        <td>

                            @if ($data['status'] == 1)
                                Approved
                            @elseif($data['status'] == 2)
                                Refused
                            @elseif($data['status'] == 3)
                                Pending
                            @elseif($data['status'] == 4)
                                GRN In
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <td><b>PO Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['po_date'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Exp Deliver Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['po_expected_deliver_date'] }}</td>
                    </tr>

                    <tr>
                        <td><b>Print Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ Carbon\Carbon::now()->toDateTimeString() }}</td>
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
                        <th class="tborderth tborder bold-100" style="text-align: left">Item Code</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">BIN</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Unit Price</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Qty</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Discount %</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">VAT %</th>
                        <th class="tborderth tborder tbright bold-100" style="text-align: right">Amount</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data['poitems'] as $key => $items)

                        <tr>
                            <td class="tborder tbleft">{{ $key+1 }}</td>
                            <td class="tborder">{{ $items['item']['item_part_code'] }}</td>
                            <td class="tborder">{{ $items['bindata']['bin_location_name'] }}</td>
                            <td class="tborder alright">
                                {{ env('CURRENCY') . ' ' . number_format($items['unit_price'], 2, '.', ',') }}</td>
                            <td class="tborder alright">{{ $items['qty'] }}
                                {{ $items['item']['munit']->symbol }}</td>
                            <td class="tborder alright text-center">{{ $items['discount'] }}</td>
                            <td class="tborder alright text-center">{{ $items['vat'] }}</td>
                            <td class="tborder alright tbright ">
                                {{ env('CURRENCY') . ' ' . number_format($items['net_tot'], 2, '.', ',') }}</td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
    <br>

    <div>

        <div class="row">
            <table style="margin-left: auto; margin-right: 0;">
                <tr class="smargin">
                    <td class="smargin"><b>Sub Total (LKR)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right">
                        @if ($data['po_tot'] == '')
                            0
                        @else
                            {{ number_format($data['po_tot'], 2, '.', ',') }}
                        @endif
                    </td>
                </tr>
                <tr class="smargin">
                    <td class="smargin"><b>Tot Discount (%)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right">
                        @if ($data['discount'] == '')
                            0
                        @else
                            {{ $data['discount'] }}
                        @endif
                    </td>
                </tr>
                <tr class="smargin">
                    <td class="smargin"><b>Tot VAT (%)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right; ">

                        @if ($data['tot_vat'] == '')
                            0
                        @else
                            {{ $data['tot_vat'] }}
                        @endif

                    </td>
                </tr>
                <tr class="smargin">
                    <td class="smargin"><b>Net Total (LKR)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right; border-bottom: 4px double black; border-top:1px solid black">

                        @if ($data['po_net_tot'] == '')
                            0
                        @else
                            {{ number_format($data['po_net_tot'], 2, '.', ',') }}
                        @endif

                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style="margin-top: 50px">
        @if ($data['remark'])
            <p style="text-align: justify"><strong>Remark : </strong>{{ $data['remark'] }}</p>
        @endif
    </div>

    <div class="text-center row" style="margin-top: 70px">
        <div>
            <span>..............................................</span><br><span><i>Issued by</i></span>
        </div>
    </div>

</body>

</html>
