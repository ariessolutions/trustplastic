@if (isset($purchase_orders))

    <?php $rowval = 0; ?>

    @foreach ($purchase_orders as $po)

        <?php
        $supplier = App\Models\supplier::Where('id', $po->supplier_id)->first();
        $location = App\Models\location::Where('id', $po->location_id)->first();
        ?>

        <tr>
            <td scope="row" class="py-1 align-middle">{{ $rowval += 1 }}</td>
            <td class="py-1 align-middle">{{ $po->po_code }}</td>
            <td class="py-1 align-middle">{{ $supplier->supplier_name }}</td>
            <td class="py-1 align-middle">{{ $po->po_date }}</td>
            <td class="py-1 align-middle">{{ env('CURRENCY', '') }} {{ number_format($po->po_tot, 2, '.', ',') }}
            </td>
            <td class="py-1 align-middle">{{ env('CURRENCY', '') }}
                {{ number_format($po->po_net_tot, 2, '.', ',') }}
            <td class="py-1 align-middle"> {{ $location->location_name }}</td>
            </td>
            {{-- <td class="py-1 align-middle">{{ $po_deliver_address }}</td> --}}

            @if ($po->status == 1)
                <td class="py-1 align-middle"><span
                        class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                            class="fa fa-circle text-success fs-9px fa-fw me-5px"></i>
                        Approved</span>
                </td>
            @elseif ($po->status == 2)
                <td class="py-1 align-middle"><span
                        class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                            class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
                        Discontinued</span>
                </td>

            @elseif($po->status == 3)
                <td class="py-1 align-middle">
                    <span
                        class="badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                            class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>
                        Pending
                    </span>
                </td>

            @elseif($po->status == 4)
                <td class="py-1 align-middle">
                    <span
                        class="badge bg-blue-100 text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                            class="fa fa-circle text-primary fs-9px fa-fw me-5px"></i>
                        Complete
                    </span>
                </td>
            @endif


            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button class="btn btn-secondary btn-sm" onclick="loadModalforView({{ $po->id }})">
                            View
                        </button>
                        <button class="btn btn-default btn-sm" onclick="po_printReport({{ $po->id }})">
                            <i class="fa fa-print" aria-hidden="true"></i> Print
                        </button>
                    </div>
                </div>
            </td>
        </tr>

        {{-- <tr>
            <td class="py-1 align-middle">2</td>
            <td class="py-1 align-middle">PO123</td>
            <td class="py-1 align-middle">WC451</td>
            <td class="py-1 align-middle">Test Name 02</td>
            <td class="py-1 align-middle">28/05/2021</td>
            <td class="py-1 align-middle">28/05/2021</td>
            <td class="py-1 align-middle">254,500.00</td>
            <td class="py-1 align-middle" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;  ">
                Kelaniya Rd, Paliyagoda.</td>
            <td class="py-1 align-middle"><span
                    class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                        class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                    Approved</span></td>
            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button class="btn btn-secondary btn-sm">
                            View
                        </button>
                    </div>

                </div>
            </td>
        </tr>

        <tr>
            <td scope="row" class="py-1 align-middle">3</td>
            <td class="py-1 align-middle">PO175</td>
            <td class="py-1 align-middle">SD128</td>
            <td class="py-1 align-middle">Test Name 03</td>
            <td class="py-1 align-middle">15/05/2021</td>
            <td class="py-1 align-middle">15/05/2021</td>
            <td class="py-1 align-middle">254,500.00</td>
            <td class="py-1 align-middle">No. 20 Nugegoda Rd, Kohuwala</td>
            <td class="py-1 align-middle"><span
                    class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                        class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
                    Discontinued</span></td>
            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button class="btn btn-secondary btn-sm">
                            View
                        </button>
                    </div>
                </div>
            </td>
        </tr> --}}

    @endforeach

@endif
