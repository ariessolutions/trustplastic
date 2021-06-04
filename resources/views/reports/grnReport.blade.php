<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['grn_code'] }} - {{ Session::get('view', 'non') }}</title>

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
                padding-top:10px;
                padding-bottom:10px;
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

        .tbleft{
            padding-left: 10px;
            border-left: 1px solid #212121
        }

        .tbright{
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

        .text-align-right{
            margin-left: auto;
            margin-right: 0px;
        }

        .text-center{
            text-align: center;
        }

        .text-left{
            text-align: left;
        }

    </style>

</head>

<body class="font">

    <div class="text-center">
        <h3>TRUST PLASTIC INDUSTRIES PRIVATE LIMITED</h3>
        <span>No. 451/6, Makola North, Makola - 11640</span>
    </div>

    <br>
    <div style="padding: 0px">

        <div class="row">
            <div class="col-6">
                <table>
                    <tr>
                        <td><b>GRN #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['grn_code'] }}</td>
                    </tr>
                    <tr>
                        <td><b>GRN Date</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['created_at'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Receiving Store</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['location']['location_name'] }}, {{ $data['location']['location_address'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Purchase Order #</b></td>
                        <td>&nbsp;</td>
                        <td>{{ $data['po']['po_code'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-6">
                <div style="margin-left: auto; margin-right: 0px">
                    <table>
                        <tr>
                            <td><b>Vendor #</b></td>
                            <td>&nbsp;</td>
                            <td>{{ $data['po']['supplier']['supplier_code'] }}</td>
                        </tr>

                        <tr>
                            <td><b>Vendor Name</b></td>
                            <td>&nbsp;</td>
                            <td>{{ $data['po']['supplier']['supplier_name'] }}</td>
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
            <table class="table-border"
                style="border-spacing: 0; border-width: 0; padding: 0; border-width: 0; width:100%">
                <thead>
                    <tr class="trcolor">
                        <th class="tborderth tborder tbleft bold-100" style="text-align: left">#</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Item Part</th>
                        <th class="tborderth tborder bold-100" style="text-align: left">Item Name</th>
                        <th class="tborderth tborder bold-100 text-left">Unit Price</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Qty</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">Discount %</th>
                        <th class="tborderth tborder bold-100" style="text-align: right">VAT %</th>
                        <th class="tborderth tborder tbright bold-100 " style="text-align: right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index=1;
                    @endphp
                    @foreach ($data['grnitems'] as $gi)
                    <tr>
                        <td class="tborder tbleft">{{ $index }}</td>
                        <td class="tborder">{{ $gi['item']['item_part_code'] }}</td>
                        <td class="tborder">{{ $gi['item']['item_name'] }}</td>
                        <td class="tborder alright text-left">{{ env('CURRENCY').' ' . number_format($gi['unit_price'], 2, '.', ',') }}</td>
                        <td class="tborder alright text-center">{{ $gi['qty'] }}</td>
                        <td class="tborder alright text-center">{{ $gi['discount'] }}</td>
                        <td class="tborder alright text-center">{{ $gi['vat'] }}</td>
                        <td class="tborder alright tbright ">{{ env('CURRENCY').' ' . number_format($gi['subtotal'], 2, '.', ',') }}</td>
                    </tr>
                    @php
                        $index++;
                    @endphp
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
                    <td style="text-align: right">{{  number_format($data['po']['po_tot'], 2, '.', ',') }}</td>
                </tr>
                <tr class="smargin">
                    <td class="smargin"><b>Discount (%)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right">{{  number_format($data['po']['discount'], 2, '.', ',') }}</td>
                </tr>
                <tr class="smargin">
                    <td class="smargin"><b>VAT (%)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right; ">{{  number_format($data['po']['tot_vat'], 2, '.', ',') }}</td>
                </tr>
                <tr class="smargin">
                    <td class="smargin"><b>Net Total (LKR)</b></td>
                    <td>&nbsp;</td>
                    <td style="text-align: right; border-bottom: 4px double black; border-top:1px solid black">
                        {{  number_format($data['grn_total'], 2, '.', ',') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style="margin-top: 50px">
        <p style="text-align: justify"><strong>Note : </strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
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

</body>

</html>
