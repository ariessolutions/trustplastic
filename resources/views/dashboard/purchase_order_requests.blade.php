@extends('dashboard.layouts.dashboard_app')

@section('content')

    <div id="content" class="app-content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-xl-10">

                    <div class="row">

                        <div class="col-xl-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="inventory">Dashboard</a></li>
                                <li class="breadcrumb-item active">Purchase Order Management</li>
                            </ul>
                            <h1 class="page-header">
                                Purchase Order Requests
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="row mb-3 d-flex justify-content-end">
                                    <div class="ms-auto">
                                        <a id="modal_button" href="#poItemInsert" data-bs-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fa fa-plus-circle me-1"></i>
                                            Create Purchase Order
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-3">

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1"><span class="text-warning">Pending</span> Quotations
                                                    </h5>
                                                    <div>Total pending quotations count</div>
                                                </div>
                                                <a href="#" data-bs-toggle="dropdown" class="text-muted"><i
                                                        class="fa fa-redo"></i></a>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h3 class="mb-1">128</h3>
                                                    <div class="text-success font-weight-600 fs-13px">
                                                        <i class="fa fa-globe"></i> 25%
                                                    </div>
                                                </div>
                                                <div
                                                    class="width-50 height-50 bg-warning-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-hourglass-end fa-lg text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1"><span class="text-success">Approved</span> Quotations
                                                    </h5>
                                                    <div>Total approved quotations count</div>
                                                </div>
                                                <a href="#" data-bs-toggle="dropdown" class="text-muted"><i
                                                        class="fa fa-redo"></i></a>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h3 class="mb-1">128</h3>
                                                    <div class="text-success font-weight-600 fs-13px">
                                                        <i class="fa fa-globe"></i> 55%
                                                    </div>
                                                </div>
                                                <div
                                                    class="width-50 height-50 bg-success-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-check fa-lg text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1"><span class="text-danger">Discontinued</span>
                                                        Quotations</h5>
                                                    <div>Total discontinued quotations count</div>
                                                </div>
                                                <a href="#" data-bs-toggle="dropdown" class="text-muted"><i
                                                        class="fa fa-redo"></i></a>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h3 class="mb-1">128</h3>
                                                    <div class="text-success font-weight-600 fs-13px">
                                                        <i class="fa fa-globe"></i> 20%
                                                    </div>
                                                </div>
                                                <div
                                                    class="width-50 height-50 bg-danger-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-close fa-lg text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="col-xl-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2">Purchase Order List</h6>
                                                </div>
                                                <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                    data-placement="bottom" title="Refresh Table">
                                                    <i class="fa fa-redo"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-hover text-nowrap ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">PO NO</th>
                                                        <th scope="col">ASQC</th>
                                                        <th scope="col">SUP NAME</th>
                                                        <th scope="col">DATE</th>
                                                        <th scope="col">EXPT DATE</th>
                                                        <th scope="col">NET TOT (LKR)</th>
                                                        <th scope="col">DELIVER ADDRESS</th>
                                                        <th scope="col">STATUS</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">1</td>
                                                        <td class="py-1 align-middle">PO145</td>
                                                        <td class="py-1 align-middle">QC451</td>
                                                        <td class="py-1 align-middle">Test Name 01</td>
                                                        <td class="py-1 align-middle">15/05/2021</td>
                                                        <td class="py-1 align-middle">15/05/2021</td>
                                                        <td class="py-1 align-middle">254,500.00</td>
                                                        <td class="py-1 align-middle">No. 20 Panadura Rd, Pinwatta</td>
                                                        <td class="py-1 align-middle"><span
                                                                class="badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>
                                                                Pending</span></td>
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
                                                        <td class="py-1 align-middle">2</td>
                                                        <td class="py-1 align-middle">PO123</td>
                                                        <td class="py-1 align-middle">WC451</td>
                                                        <td class="py-1 align-middle">Test Name 02</td>
                                                        <td class="py-1 align-middle">28/05/2021</td>
                                                        <td class="py-1 align-middle">28/05/2021</td>
                                                        <td class="py-1 align-middle">254,500.00</td>
                                                        <td class="py-1 align-middle"
                                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;  ">
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
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-cover fade bg-dark" id="poItemInsert">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title text-white">CREATE PURCHASE ORDER</h5>


                    <div class="d-flex">
                        <div class="px-1 ">
                            <button class="btn btn-default"><i class="fa fa-trash"></i></button>
                        </div>

                        <div class="px-1 ">
                            <button class="btn btn-default"><i class="fa fa-print"></i></button>
                        </div>

                        <div class="px-1 ">
                            <button id="modal_close_btn" class="btn bg-dark-100">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-9 mb-3">

                            <form id="poForm" method="POST" action="/po/savePO">
                                @csrf

                                <div class="row">

                                    <div class="col-xl-4">

                                        <div class="card mb-3 h-100 border-0">

                                            <div class="card-header bg-gradient-custom-teal">
                                                <h6 class="mt-2 text-white">Primary Details</h6>
                                            </div>

                                            <div class="card-body">

                                                @include('dashboard.components.flash')

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">
                                                            Purchase Order Number
                                                        </label>
                                                        <input id="po_code" name="po_code" type="text" class="form-control"
                                                            value="{{ $poCode }}" readonly />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="location_id">
                                                            Location
                                                        </label>
                                                        <select id="location_id" name="location_id" class="form-select">
                                                            @foreach ($location as $key => $location)
                                                                <option value="{{ $location->id }}">
                                                                    {{ $location->location_name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('location_id')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Bin Location <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-search"></i></span>

                                                            <input id="bin_location_id" name="bin_location_id" type="text"
                                                                class="form-control" placeholder="Type 'BIN Name' ">
                                                        </div>

                                                        @error('bin_location_id')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Supplier <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-search"></i></span>

                                                            <input id="supplier_id" name="supplier_id" type="text"
                                                                class="form-control"
                                                                placeholder="Type 'Supplier Code / Name' ">

                                                        </div>

                                                        @error('supplier_id')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Created Date <span
                                                                class="text-danger">*</span></label>
                                                        <input id="po_date" name="po_date" class="form-control"
                                                            type="text" />
                                                        @error('po_date')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-4">

                                        <div class="card mb-3 h-100 border-0">

                                            <div class="card-header bg-gradient-custom-teal border-0">
                                                <h6 class="mt-2 text-white">Secondary Details</h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Expected Deliver Date</label>
                                                        <input id="po_expt_deliver_date" name="po_expt_deliver_date"
                                                            class="form-control" type="text" />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="approved_quotation_code">
                                                            Approved Quotation Code
                                                        </label>
                                                        <input id="approved_quotation_code" name="approved_quotation_code"
                                                            type="text" class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="remark">Remark</label>
                                                        <textarea class="form-control" id="remark" name="remark" rows="5"
                                                            name="remark"></textarea>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-xl-4">

                                        <div class="card mb-3 h-100 border-0">

                                            <div class="card-header bg-gradient-custom-teal border-0">
                                                <h6 class="mt-2 text-white">PO Net Amount Details</h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                PO Total
                                                            </label>
                                                            @if (isset($subtotal))
                                                                <input id="po_tot" name="po_tot" type="text"
                                                                    class="form-control" value="{{ $subtotal }}"
                                                                    readonly />
                                                            @else
                                                                <input id="po_tot" name="po_tot" type="text"
                                                                    class="form-control" readonly />
                                                            @endif

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                Total Discount (%)
                                                            </label>
                                                            <input id="discount" name="discount" type="number" step="0.01"
                                                                class="form-control" />
                                                            @error('discount')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                VAT(%)
                                                            </label>
                                                            <input id="tot_vat" name="tot_vat" type="number" step="0.01"
                                                                class="form-control" />
                                                            @error('tot_vat')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                PO Net Total
                                                            </label>
                                                            <input id="po_net_tot" name="po_net_tot" type="text"
                                                                class="form-control font-weight-500" readonly />
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="col-xl-3 mb-3">

                            <div class="card h-100 border-0">

                                <div class="card-header bg-gradient-cyan-indigo border-0">

                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-2 text-white">PO has Items</h6>
                                        </div>
                                        <a id="po_table_refresh" class="text-muted mt-2" data-placement="top"
                                            title="Refresh All Feilds">
                                            <i class="fa fa-redo text-white"></i>
                                        </a>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="mb-3">
                                                <label class="form-label">Item Code <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-search"></i></span>

                                                    <input type="text" placeholder="Type 'Item Code / Name'"
                                                        class="form-control rounded-end" id="item_code" name="item_code" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Unit Price <span class="text-danger">*</span>
                                                </label>
                                                <input id="unit_price" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Quantity <span class="text-danger">*</span>
                                                </label>
                                                <input id="qty" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Discount (%)
                                                </label>
                                                <input id="item_discount" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    VAT (%)
                                                </label>
                                                <input id="item_vat" type="number" class="form-control" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <button id="addbutton" class="btn btn-block btn-primary w-100"><i
                                                class="fa fa-plus"></i>&nbsp;
                                            Add Item
                                            to Table</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xl-12">

                            <div class="card mb-3 border-0">

                                <div class="card-header bg-dark-400 ">
                                    <h6 class="mt-2 text-white">Added Items for Purchase Order</h6>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="table-responsive">
                                            <table id="table" class="table table-borderless table-striped text-nowrap pt-2">
                                                <thead>
                                                    <tr>
                                                        <th>Item Code</th>
                                                        <th>Unit Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount (%)</th>
                                                        <th>VAT (%)</th>
                                                        <th>Total</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="po_item_list">
                                                    @include('dashboard.components.potable')
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="d-flex">

                            <div class="d-flex">
                                <div class="px-1">

                                    <button type="submit" form="poForm" class="btn btn-teal"> <i class='fa fa-check'></i>
                                        Save & Complete </button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-default"><i class="fa fa-trash"></i>
                                        Delete All</button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-yellow"><i class="fa fa-check"></i>
                                        Approve</button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-danger"><i class="fa fa-close"></i>
                                        Refuse</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function() {
                Notiflix.Loading.Circle('Please wait...');
            },
            complete: function() {
                Notiflix.Loading.Remove();
            },
        });

        $('#table').DataTable();

        var modal = $('#poItemInsert');

        var po_tot;
        var po_net_tot;
        var discount;
        var vat;

        @if ($errors->any())
            $('#poItemInsert').modal('show');

            refreshTotal($('#po_tot').val())

        @endif

        @if (session()->has('code'))
            $('#poItemInsert').modal('show');
        @endif

        $('#modal_close_btn').click(function(e) {
            e.preventDefault();
            $('#poItemInsert').modal('hide');

        });

        function refreshTotal(value) {
            po_tot = parseFloat(value);
            $('#po_tot').val('');
            $('#po_tot').val(formatNumber(po_tot, 'LKR '));
            calculateNetTotal(po_tot);
        }

        function saveRequest() {

            nullCheck = false;

            let ic = $("#item_code").val().split('-')[0];
            let up = $("#unit_price").val();
            let qty = $("#qty").val();
            let dis = $("#item_discount").val();
            let vat = $("#item_vat").val();

            if (!(ic === "") && !(up === "") && !(qty === "")) {
                nullCheck = true;
            } else {
                Notiflix.Report.Failure('Item Insert Failure',
                    'Item Code, Unit Price, Quantity Cannot be Empty',
                    'Click');
            }

            if (nullCheck) {

                $.ajax({
                    type: "GET",
                    url: "{{ route('po.sessionAdd') }}",
                    data: {
                        ic: ic,
                        up: up,
                        qty: qty,
                        dis: dis,
                        vat: vat
                    },
                    success: function(response) {

                        if (response === "1") {
                            Notiflix.Report.Failure('Item Insert Failure',
                                'Item Code, Unit Price, Quantity Cannot be Empty',
                                'Click');
                        } else if (response === '2') {
                            Notiflix.Report.Failure('Item Insert Failure',
                                'Item Not Valid, Please Insert a Registered Item',
                                'Click');

                        } else {
                            clearFeilds();
                            $('#po_item_list').html(response.tbody);
                            po_tot = response.subtotal;
                            $('#po_tot').val(formatNumber(response.subtotal, 'LKR '));
                            Notiflix.Notify.Success('Item Insert Successful');
                            calculateNetTotal(po_tot)
                        }
                    }
                });

            }

        }

        $('#addbutton').click(function(e) {
            e.preventDefault();

            let item_code = $('#item_code').val().split('-')[0];

            $.ajax({
                type: "GET",
                url: "{{ route('po.sessionPOItemCheck') }}",
                data: {
                    item_code: item_code,
                },
                success: function(response) {

                    console.log(response)

                    if (response === '1') {

                        Notiflix.Confirm.Show('Item Update Confirmation',
                            'Do you really want to update selected item?', 'Yes', 'No',
                            function() {
                                saveRequest()
                                clearPoSelectedItemValues()
                                $('#item_code').focus()
                            },
                            function() {
                                Notiflix.Notify.Info('Ignoring Item Update');
                            });

                    } else if (response === '2') {
                        saveRequest()
                        $('#item_code').focus()
                    }
                }
            });




        });

        function editPOItem(item, uc, qty, dis, vat) {

            $('#item_code').val(item.item_code + '-' + item.item_name);
            $("#unit_price").val(uc);
            $("#qty").val(qty);
            $("#item_discount").val(dis);
            $("#item_vat").val(vat);

            $("#addbutton").html('<i class="fa fa-pencil-square-o me-1"></i>Update Item');
            $("#addbutton").addClass('btn-indigo');


        }

        function removePOItem(item_index) {

            Notiflix.Confirm.Show('Item Remove Confirmation', 'Do you really want to remove this item from purchase order?',
                'Yes', 'No',
                function() {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('po.sessionPOItemRemove') }}",
                        data: {
                            item_index: item_index
                        },
                        success: function(response) {
                            clearFeilds();
                            $('#po_item_list').html(response.tbody);
                            refreshTotal(response.subtotal)

                            Notiflix.Notify.Success('Item Removing Successful');

                        }
                    });

                },
                function() {

                });

        }

        function clearPoSelectedItemValues() {
            $('#addbutton').removeClass('btn-indigo');
            $("#addbutton").html('<i class="fa fa-plus-circle me-1"></i> Add Item to Table');
        }

        function clearFeilds() {
            $("#item_code").val('');
            $("#unit_price").val('');
            $("#qty").val('');
            $("#item_discount").val('');
            $("#item_vat").val('');
        }

        $('#po_table_refresh').click(function(e) {
            e.preventDefault();


            Notiflix.Confirm.Show('PO Items Remove All Confirmation',
                'Do you really want to remove all items from purchase order?', 'Yes', 'No',
                function() {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('po.sessionPOClear') }}",
                        success: function(response) {

                            $('#po_item_list').html(response);
                        }
                    });

                    Notiflix.Notify.Success('Successfully Removing Items');

                },
                function() {

                    Notiflix.Notify.Info('Ignoring Removing Items From Purchase Order');

                });

        });

        function formatNumber(n, currency) {
            return currency + n.toFixed(2).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
            });
        }

        $('#discount').change(function(e) {
            e.preventDefault();

            if ($('#discount').val() < 0) {
                Notiflix.Report.Failure('Total Discount Failure',
                    'Total Discount Connot Be Negative Value.',
                    'Click');
                $('#discount').val('');
            }

            calculateNetTotal(po_tot)

        });

        $('#tot_vat').change(function(e) {
            e.preventDefault();

            if ($('#tot_vat').val() < 0) {
                Notiflix.Report.Failure('Total VAT Failure',
                    'Total VAT Connot Be Negative Value.',
                    'Click');
                $('#tot_vat').val('');
            }

            calculateNetTotal(po_tot)

        });

        function calculateNetTotal(po_tot) {

            discount = parseFloat($('#discount').val());
            vat = parseFloat($('#tot_vat').val());

            if (isNaN(discount) && isNaN(vat)) {
                po_net_tot = po_tot;
            } else if (!isNaN(discount) && isNaN(vat)) {
                po_net_tot = po_tot * ((100 - discount) / 100)
            } else if (isNaN(discount) && !isNaN(vat)) {
                po_net_tot = po_tot * ((100 + vat) / 100)
            } else if (!isNaN(discount) && !isNaN(vat)) {
                po_net_tot = (po_tot * ((100 - discount) / 100)) * ((100 + vat) / 100)
            }

            $("#po_tot").val(formatNumber(po_tot, 'LKR '));
            $("#po_net_tot").val(formatNumber(po_net_tot, 'LKR '));

        }

        var bin_location_path = "{{ Route('po.loadbinlocation') }}";

        $('#bin_location_id').typeahead({
            source: function(query, process) {
                let selected_location = $('#location_id').val();
                return $.get(bin_location_path, {
                    query: query,
                    location: selected_location
                }, function(data) {
                    return process(data);
                });
            }
        });

        var supplier_path = "{{ route('po.loadsupplier') }}";

        $('#supplier_id').typeahead({
            source: function(query, process) {
                return $.get(supplier_path, {
                    query: query,
                }, function(data) {
                    return process(data);
                });
            }
        });

        var path = "{{ route('po.loaditem') }}";

        $('#item_code').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query,
                }, function(data) {
                    return process(data);
                });
            }
        });

        $('#po_expt_deliver_date').change(function(e) {
            e.preventDefault();

            if ($('#po_date').val() !== '') {

                if (parseFloat($('#po_date').val().split("/")[2]) <=
                    parseFloat($('#po_expt_deliver_date').val().split("/")[2]) &&
                    parseFloat($('#po_date').val().split("/")[1]) <=
                    parseFloat($('#po_expt_deliver_date').val().split("/")[1]) &&
                    parseFloat($('#po_date').val().split("/")[0]) <=
                    parseFloat($('#po_expt_deliver_date').val())) {

                } else {

                    $('#po_expt_deliver_date').val('');
                    $('#po_expt_deliver_date').focus();

                    Notiflix.Report.Failure('Invalid Date Inserting',
                        'Please insert valid date as purchase order expecting date',
                        'Click');

                }

            }

        });

        var location_id;
        var bin_location_id;
        var supplier_id;
        var approved_quotation_code;
        var po_date;
        var po_expt_deliver_date;
        var remark;

        $('#saveandcomplete').click(function(e) {
            e.preventDefault();

            date_validation = false;

            po_code = $('#po_code').val();
            location_id = $('#location_id').val();
            bin_location_id = $('#bin_location_id').val();
            supplier_id = $('#supplier_id').val();
            approved_quotation_code = $('#approved_quotation_code').val();
            po_date = $("#po_date").val()
            po_expt_deliver_date = $("#po_expected_deliver_date").val()
            remark = $('#remark').val();

            // variables_validation(po_code, location_id, bin_location_id, supplier_id, po_date, po_date)

            if (true) {
                if (po_expt_deliver_date !== "") {

                    if (date_check_and_validation(po_date, po_expt_deliver_date)) {
                        date_validation = true;
                    } else {
                        date_validation = false;
                    }
                }
                date_validation = true;
            }

            posubmit_data(date_validation)

        });

    </script>

@endsection
