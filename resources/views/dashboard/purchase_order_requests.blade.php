@extends('dashboard.layouts.dashboard_app')

@section('content')

    <div id="content" class="app-content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-xl-10">

                    <div class="row">

                        <div class="col-xl-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item header_new_text"><a href="/home">Dashboard</a></li>
                                <li class="breadcrumb-item active header_new_text">{{ Session::get('view', 'non') }}</li>
                            </ul>

                            <h1 class="page-header header_new_text">
                                {{ Session::get('view', 'non') }}
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

                                <div class="col-xl-12">

                                   <div class="row">

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
                                                        <h3 id="pendingN" class="mb-1">

                                                        </h3>
                                                        <div class="text-success font-weight-600 fs-13px">
                                                            <i class="fa fa-globe"></i>
                                                            <span id="pendingP">

                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="width-50 height-50 bg-warning-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-hourglass-end fa-lg text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">

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
                                                        <h3 id="activeN" class="mb-1"></h3>
                                                        <div class="text-success font-weight-600 fs-13px">
                                                            <i class="fa fa-globe"></i> <span id="activeP"></span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="width-50 height-50 bg-success-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-check fa-lg text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
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
                                                        <h3 id="deactiveN" class="mb-1"></h3>
                                                        <div class="text-success font-weight-600 fs-13px">
                                                            <i class="fa fa-globe"></i> <span id="deactiveP"></span>
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

                                    <div class="col-xl-3">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-1"><span class="text-primary">Completed</span>
                                                            Purchase Orders</h5>
                                                        <div>Total completed purchase order count</div>
                                                    </div>
                                                    <a href="#" data-bs-toggle="dropdown" class="text-muted"><i
                                                            class="fa fa-redo"></i></a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h3 id="completeN" class="mb-1"></h3>
                                                        <div class="text-success font-weight-600 fs-13px">
                                                            <i class="fa fa-globe"></i> <span id="completeP"></span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-check-circle fa-lg text-primary"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   </div>

                                </div>

                                <div class="col-xl-12">
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
                                            <table id="purchase_orders"
                                                class="table table-borderless table-striped text-nowrap pt-2 w-100 ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">PO NO</th>
                                                        <th scope="col">SUP NAME</th>
                                                        <th scope="col">DATE</th>
                                                        <th scope="col">SUB TOT</th>
                                                        <th scope="col">NET TOT (LKR)</th>
                                                        <th scope="col">D/ADDRESS</th>
                                                        <th scope="col">STATUS</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="po_list_tbody">

                                                    @include('dashboard.components.purchase_orders')

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

    <div class="modal fade " id="poItemInsert">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark-400">

                    <h5 class="modal-title header_new_text text-white">CREATE PURCHASE ORDER</h5>

                    <div class="d-flex">
                        <div class="px-1 ">
                            <button id="deleteAllSessions" class="btn btn-sm btn-default btnround"><i class="far fa-trash-alt"></i></button>
                        </div>

                        <div class="px-1 ">
                            <button id="modal_close_btn" class="btn btn-sm btn-yellow btnround">
                                <i class="far fa-window-minimize"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-9">

                            <form id="poForm" method="POST" action="/po/savePO">
                                @csrf

                                <div class="row">

                                    <div class="col-xl-4 mb-3">

                                        <div class="card mb-3 h-100 border-1 shadow-sm">

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

                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Expected Deliver Date</label>
                                                        <input id="po_expt_deliver_date" name="po_expt_deliver_date"
                                                            class="form-control" type="text" />
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-4 mb-3">

                                        <div class="card mb-3 h-100 border-1 shadow-sm">

                                            <div class="card-header bg-gradient-custom-teal border-0">
                                                <h6 class="mt-2 text-white">Secondary Details</h6>
                                            </div>

                                            <div class="card-body">

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

                                    <div class="col-xl-4 mb-3">

                                        <div class="card mb-3 h-100 border-1 shadow-sm">

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

                        <div class="col-xl-3 pb-3">

                            <div class="card h-100 border-1 shadow-sm">

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
                                                        class="form-control rounded-end" id="item_code" />
                                                </div>
                                                <input type="hidden" id="item_code_val" name="item_code" />
                                            </div>
                                        </div>

                                        <div class="col-xl-12">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Item Bin Location <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">

                                                        <select id="bin_location_id" name="bin_location_id"
                                                            class="form-select">
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Unit Price <span class="text-danger">*</span>
                                                </label>
                                                <input id="unit_price" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
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

                            <div class="card mb-3 border-1 shadow-sm">

                                <div class="card-header bg-dark-400 ">
                                    <h6 class="mt-2 text-white">Added Items for Purchase Order</h6>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="table-responsive">
                                            <table id="table"
                                                class="table table-borderless table-striped text-nowrap pt-2 w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Item Code</th>
                                                        <th>BIN / L</th>
                                                        <th>Unit Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount (%)</th>
                                                        <th>VAT (%)</th>
                                                        <th>Total</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
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

                                    <button id="submit" class="btn btn-teal"> <i class='fa fa-check'></i>
                                        Save & Complete </button>
                                </div>

                                <div class="px-1">
                                    <button id="deleteAllinPoSave" class="btn btn-default"><i class="fa fa-trash"></i>
                                        Delete All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="poItemView">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark-400">

                    <h5 class="modal-title header_new_text text-white">VIEW / UPDATE PURCHASE ORDER</h5>


                    <div class="d-flex">
                        <div class="px-1 ">
                            <span id="poStatus"
                                class="badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                                <i class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>
                                Pending
                            </span>
                        </div>

                        <div class="px-1">
                            <button id="po_printReport_button" class="btn btn-sm btn-default btnround"><i class="fa fa-print"></i></button>
                        </div>

                        <div class="px-1">
                            <button id="modal_close_btn_view" class="btn btn-sm btn-yellow btnround">
                                <i class="far fa-window-minimize"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-9">

                            <form>
                                @csrf

                                <div class="row">

                                    <div class="col-xl-4 mb-3">

                                        <div class="card mb-3 h-100 border-1 shadow-sm">

                                            <div class="card-header bg-gradient-custom-teal">
                                                <h6 class="mt-2 text-white">Primary Details</h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">
                                                            Purchase Order Number
                                                        </label>
                                                        <input id="po_code_view" name="po_code_view" type="text"
                                                            class="form-control" readonly />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="location_id">
                                                            Location
                                                        </label>
                                                        <select id="location_id_view" name="location_id_view"
                                                            class="form-select">
                                                            <option id="location_id_option_view"></option>
                                                        </select>

                                                        @error('location_id_view')
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

                                                            <input id="supplier_id_view" name="supplier_id_view" type="text"
                                                                class="form-control"
                                                                placeholder="Type 'Supplier Code / Name' ">

                                                        </div>

                                                        @error('supplier_id_view')
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
                                                        <input id="po_date_view" name="po_date_view" class="form-control"
                                                            type="date" />
                                                        @error('po_date_view')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Expected Deliver Date</label>
                                                        <input id="po_expt_deliver_date_view"
                                                            name="po_expt_deliver_date_view" class="form-control"
                                                            type="date" />
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-4 mb-3">

                                        <div class="card mb-3 h-100 border-1 shadow-sm">

                                            <div class="card-header bg-gradient-custom-teal border-0">
                                                <h6 class="mt-2 text-white">Secondary Details</h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">
                                                            Total Discount (%)
                                                        </label>
                                                        <input id="discount_view" name="discount_view" type="number"
                                                            step="0.01" class="form-control" />
                                                        @error('discount_view')
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
                                                        <input id="tot_vat_view" name="tot_vat_view" type="number"
                                                            step="0.01" class="form-control" />
                                                        @error('tot_vat_view')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="approved_quotation_code_view">
                                                            Approved Quotation Code
                                                        </label>
                                                        <input id="approved_quotation_code_view"
                                                            name="approved_quotation_code_view" type="text"
                                                            class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="remark_view">Remark</label>
                                                        <textarea class="form-control" id="remark_view" name="remark_view"
                                                            rows="5"></textarea>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-xl-4 mb-3">

                                        <div class="card mb-3 h-100 border-1 shadow-sm">

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
                                                            <input id="po_tot_view" name="po_tot_view" type="text"
                                                                class="form-control" readonly />

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                PO Net Total
                                                            </label>
                                                            <input id="po_net_tot_view" name="po_net_tot_view" type="text"
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

                        <div class="col-xl-3 pb-3">

                            <div class="card h-100 border-1 shadow-sm">

                                <div class="card-header bg-gradient-cyan-indigo border-0">

                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-2 text-white">PO has Items</h6>
                                        </div>
                                        <a class="text-muted mt-2" data-placement="top" title="Refresh All Feilds">
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
                                                        class="form-control rounded-end" id="item_code_view" />
                                                </div>
                                                <input type="hidden" id="item_code_val_view" name="item_code_view" />
                                            </div>
                                        </div>

                                        <div class="col-xl-12">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Item Bin Location <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">

                                                        <select id="bin_location_id_view" name="bin_location_id_view"
                                                            class="form-select">
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Unit Price <span class="text-danger">*</span>
                                                </label>
                                                <input id="unit_price_view" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Quantity <span class="text-danger">*</span>
                                                </label>
                                                <input id="qty_view" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Discount (%)
                                                </label>
                                                <input id="item_discount_view" type="number" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    VAT (%)
                                                </label>
                                                <input id="item_vat_view" type="number" class="form-control" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <button id="addbutton_view" class="btn btn-block btn-primary w-100"><i
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

                            <div class="card mb-3 border-1 shadow-sm">

                                <div class="card-header bg-dark-400 ">
                                    <h6 class="mt-2 text-white">Added Items for Purchase Order</h6>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="table-responsive">
                                            <table id="table_view"
                                                class="table table-borderless table-striped text-nowrap pt-2 w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Item Code</th>
                                                        <th>BIN / L</th>
                                                        <th>Unit Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount (%)</th>
                                                        <th>VAT (%)</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
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

                                    <button id="updatePO" class="btn btn-teal"><i class='fa fa-check'></i>
                                        Update
                                    </button>
                                </div>

                                <div class="px-1">
                                    <button id="approvePo" class="btn btn-yellow"><i class="fa fa-check"></i>
                                        Approve</button>
                                </div>

                                <div class="px-1">
                                    <button id="refusePo" class="btn btn-danger"><i class="fa fa-close"></i>
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
        var todayDate = new Date();

        $('#po_date').val(('0' +
                todayDate.getDate()).slice(-2) + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + todayDate
            .getFullYear());


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

        $('#purchase_orders').DataTable();

        var modal = $('#poItemInsert');
        var modal = $('#poItemView');

        var po_tot;
        var po_net_tot;
        var discount;
        var vat;

        @if ($errors->any())
            $('#poItemInsert').modal('show');
            calculateSessionTotal();
        @endif

        @if (session()->has('code'))
            Notiflix.Notify.Success('Purchase Order Successfully Saved');
        @endif

        $('#modal_close_btn').click(function(e) {
            e.preventDefault();
            $('#poItemInsert').modal('hide');
            $("#poItemInsert").removeClass("in");
            $('#poItemInsert').modal('toggle');

        });

        var purchaseOrderTable = $('#table').DataTable({
            ajax: {
                url: '/po/table',
                dataSrc: ''
            },
            createdRow: function(row, data, dataIndex, cells) {
                $(cells).addClass('py-1 align-middle');
            }
        });

        $('#modal_close_btn_view').click(function(e) {
            e.preventDefault();
            $('#poItemView').modal('hide');
            $("#poItemView").removeClass("in");
            $('#poItemView').modal('toggle');

        });

        function loadModalforView(id) {
            clearLoadPoItemsforView();

            $.ajax({
                type: "GET",
                url: "{{ route('po.viewPO') }}",
                data: {
                    po_id: id,
                },
                success: function(response) {
                    purchaseOrderTableView.clear().draw();

                    $('#po_printReport_button').attr('onclick', 'po_printReport(' + id + ')');

                    $('#location_id_view').prop('readonly', true);
                    $('#supplier_id_view').prop('readonly', true);
                    $('#po_date_view').prop('readonly', true);

                    $('#location_id_view').empty();

                    $('#po_code_view').val(response[0].po_code);

                    $('#location_id_view').append($('<option>').text(response[1].location_name)
                        .attr(
                            'value', response[1].id));

                    $('#supplier_id_view').val(response[2].supplier_name);
                    $('#po_date_view').val(response[0].po_date);
                    $('#po_expt_deliver_date_view').val(response[0].po_expected_deliver_date);
                    $('#discount_view').val(response[0].discount);
                    $('#tot_vat_view').val(response[0].tot_vat);
                    $('#approved_quotation_code_view').val(response[0].approved_quotation_code);
                    $('#remark_view').val(response[0].remark);
                    $('#po_tot_view').val(formatNumber(response[0].po_tot, 'LKR '));
                    $('#po_net_tot_view').val(formatNumber(response[0].po_net_tot, 'LKR '));

                    purchaseOrderTableView.ajax.reload(null, false);

                    if (response[0].status === 1) {

                        visibleFalse(true);

                        $('#poStatus').removeAttr('class');
                        $('#poStatus').addClass(
                            'badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center'
                        );
                        $('#poStatus').html(
                            '<i class="fa fa-circle text-success fs-9px fa-fw me-5px"></i>Approved');

                    } else if (response[0].status === 2) {

                        visibleFalse(true);

                        $('#poStatus').removeAttr('class');
                        $('#poStatus').addClass(
                            'badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center'
                        );
                        $('#poStatus').html(
                            '<i class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>Discontinued');

                    } else if (response[0].status === 3) {

                        visibleFalse(false);

                        $('#poStatus').removeAttr('class');
                        $('#poStatus').addClass(
                            'badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center'
                        );
                        $('#poStatus').html(
                            '<i class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>Pending');

                    } else {
                        visibleFalse(true);
                        $('#poStatus').removeAttr('class');
                        $('#poStatus').addClass(
                            'badge bg-blue-100 text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center'
                        );
                        $('#poStatus').html(
                            '<i class="fa fa-circle text-primary fs-9px fa-fw me-5px"></i>GRN In : Completed');
                    }

                    $('#poItemView').modal('show');

                }
            });
        }

        function visibleFalse(action) {
            $('#discount_view').prop('readonly', action);
            $('#tot_vat_view').prop('readonly', action);
            $('#addbutton_view').prop('hidden', action);
            $('#updatePO').prop('hidden', action);
            $('#approvePo').prop('hidden', action);
            $('#refusePo').prop('hidden', action);
        }

        var purchaseOrderTableView = $('#table_view').DataTable({
            ajax: {
                url: '/po/table_view',
                dataSrc: ''
            },
            processing: true,
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading...'
            },
            createdRow: function(row, data, dataIndex, cells) {
                $(cells).addClass('py-1 align-middle');
            }
        });

        function viewPOItemFromDb(id) {

            clearLoadPoItemsforView();

            $.ajax({
                type: "GET",
                url: "{{ route('po.viewPOItems') }}",
                data: {
                    id: id,
                },
                success: function(response) {

                    $('#bin_location_id_view').empty();

                    $('#item_code_view').val('(' + response[1].item_part_code + ')' + ' ' + response[1]
                        .item_name);

                    $.each(response[2], function(i, value) {
                        $('#bin_location_id_view').append($('<option>').text(value
                                .bin_location_name)
                            .attr(
                                'value', value.id));
                    });

                    $('#bin_location_id_view').val(response[0].bin_location_id);
                    $('#item_code_val_view').val(response[0].item_id);
                    $('#unit_price_view').val(response[0].unit_price);
                    $('#qty_view').val(response[0].qty);
                    $('#item_discount_view').val(response[0].discount);
                    $('#item_vat_view').val(response[0].vat);

                }
            });

        }

        $('#addbutton_view').click(function(e) {
            e.preventDefault();

            if ($('#unit_price_view').val() === '' || $('#qty_view').val() === '') {
                Notiflix.Report.Failure('Item Insert Failure',
                    'Unable to insert item with empty quantity or empty unit price. Please try again',
                    'Click');
            } else {

                Notiflix.Confirm.Show('Item Update Confirmation',
                    'Are you sure to change purchase order has items ?', 'Yes', 'No',
                    function() {
                        UpdateSelectedPoFromDb();
                        Notiflix.Notify.Success('Successfully complete purchase order item changes');
                    },
                    function() {
                        Notiflix.Notify.Warning('Ignoring purchase order item changes');
                    });


            }

        });

        function UpdateSelectedPoFromDb() {

            $.ajax({
                type: "GET",
                url: "{{ route('po.updateSelectedPoFromDb') }}",
                data: {
                    po_expt_deliver_date: $('#po_expt_deliver_date_view').val(),
                    tot_discount: $('#discount_view').val(),
                    tot_vat: $('#tot_vat_view').val(),
                    approved_quotation_code: $('#approved_quotation_code_view').val(),
                    remark: $('#remark_view').val(),
                    item_id: $('#item_code_val_view').val(),
                    bin_location_id: $('#bin_location_id_view').val(),
                    unit_price: $('#unit_price_view').val(),
                    qty: $('#qty_view').val(),
                    discount: $('#item_discount_view').val(),
                    vat: $('#item_vat_view').val(),

                },
                success: function(response) {
                    purchaseOrderTableView.ajax.reload(null, false);
                    clearLoadPoItemsforView();
                    refreshLoadPoforView(response)
                }
            });
        }

        function removePOItemFromDb(id) {

            Notiflix.Confirm.Show('Notiflix Confirm', 'Do you agree with me?', 'Yes', 'No', function() {

                $.ajax({
                    type: "GET",
                    url: "{{ route('po.changeStatusPoItemFromDb') }}",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        Notiflix.Notify.Success('Successfully Delete Item form Purchase Order');
                        purchaseOrderTableView.ajax.reload(null, false);
                        clearLoadPoItemsforView();
                        refreshLoadPoforView(response);
                    }
                });

            }, function() {
                Notiflix.Notify.Warning('Deactivation ignored');
            });
        }

        function refreshLoadPoforView(response) {

            $('#po_code_view').val(response.po_code);

            $('#location_id_view').append($('<option>').text(response.location_name)
                .attr(
                    'value', response.id));

            $('#po_date_view').val(response.po_date);
            $('#po_expt_deliver_date_view').val(response.po_expected_deliver_date);
            $('#discount_view').val(response.discount);
            $('#tot_vat_view').val(response.tot_vat);
            $('#approved_quotation_code_view').val(response.approved_quotation_code);
            $('#po_tot_view').val(formatNumber(response.po_tot, 'LKR '));
            $('#po_net_tot_view').val(formatNumber(response.po_net_tot, 'LKR '));
        }

        function clearLoadPoItemsforView() {
            $('#bin_location_id_view').empty();
            $("#item_code_val_view").val('');
            $("#item_code_view").val('');
            $("#unit_price_view").val('');
            $("#qty_view").val('');
            $("#item_discount_view").val('');
            $("#item_vat_view").val('');
        }

        $('#discount_view').change(function(e) {
            e.preventDefault();

            if ($('#discount_view').val() < 0) {

                Notiflix.Report.Failure('Total Discount Inserting Failure ',
                    'Total Discount Connot Be Negative Value.',
                    'Click ');
                $('#discount_view ').val('');
                calculateDbTotal();
            } else {
                calculateDbTotal();
            }

        });

        $('#tot_vat_view').change(function(e) {
            e.preventDefault();

            if ($('#tot_vat_view').val() < 0) {

                Notiflix.Report.Failure('Total Discount Inserting Failure ',
                    'Total Discount Connot Be Negative Value.',
                    'Click ');
                $('#tot_vat_view ').val('');
                calculateDbTotal();
            } else {
                calculateDbTotal();
            }

        });

        function calculateDbTotal() {

            Notiflix.Confirm.Show('Purchase Order Update Confirm', 'Please confirm the update to purchase order?', 'Yes',
                'No',
                function() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('po.calculateDbTotal') }}",
                        data: {
                            dis: $("#discount_view").val(),
                            vat: $("#tot_vat_view").val(),
                        },
                        success: function(response) {
                            $("#po_net_tot_view").val(formatNumber(parseFloat(response), 'LKR '));
                        }
                    });

                },
                function() {
                    Notiflix.Notify.Warning('Ignoring Update');
                });
        }

        $('#updatePO').click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('po.updatePo') }}",
                data: {
                    po_expt_deliver_date: $('#po_expt_deliver_date_view').val(),
                    approved_quotation_code: $('#approved_quotation_code_view').val(),
                    remark: $('#remark_view').val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    Notiflix.Notify.Success('Purchase order update successful');
                    clearLoadPoItemsforView();
                    refreshLoadPoforView(response);
                }
            });

        });

        $('#approvePo').click(function(e) {
            e.preventDefault();

            Notiflix.Confirm.Show('Purchase Approval Confirmation',
                'Are you sure want to approve this purchase order?', 'Yes', 'No',
                function() {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('po.approvePo') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Notiflix.Notify.Success('Approval successful');
                            setInterval(function() {
                                location.reload();
                            }, 1000);
                        }
                    });

                },
                function() {
                    Notiflix.Notify.Warning('Ignoring approval purchase order');
                });
        });

        $('#refusePo').click(function(e) {
            e.preventDefault();

            Notiflix.Confirm.Show('Purchase Refuse Confirmation',
                'Are you sure want to refuse this purchase order?', 'Yes', 'No',
                function() {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('po.refusePo') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Notiflix.Notify.Success('Refuse successful');
                            setInterval(function() {
                                location.reload();
                            }, 1000);
                        }
                    });
                },
                function() {
                    Notiflix.Notify.Warning('Ignoring refuse purchase order');
                });
        });


        // Save Scripts

        $('#submit').click(function(e) {
            e.preventDefault();

            isValid = false;

            if ($('#supplier_id').val() === '') {
                isValid = false;
            } else {
                isValid = true;
            }

            if (true) {
                $.ajax({
                    type: "get",
                    url: "{{ route('po.savePO') }}",
                    data: {
                        po_code: $('#po_code').val(),
                        location_id: $('#location_id').val(),
                        supplier_id: $('#supplier_id').val(),
                        po_date: $('#po_date').val(),
                        po_expt_deliver_date: $('#po_expt_deliver_date').val(),
                        discount: $('#discount').val(),
                        tot_vat: $('#tot_vat').val(),
                        approved_quotation_code: $('#approved_quotation_code').val(),
                        remark: $('#remark').val(),
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // alert(JSON.stringify(response));

                        if ($.isEmptyObject(response.error)) {
                            Notiflix.Notify.Success('Purchase order successfully saved ');
                            setInterval(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            $.each(response.error, function(key, value) {
                                console.log(key);
                                Notiflix.Notify.Failure(value);
                            });
                        }
                    }
                });
            }
        });

        $('#addbutton').click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "{{ route('po.sessionPOItemCheck') }}",
                data: {
                    item_code: $('#item_code_val').val(),
                },
                success: function(response) {

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

        function saveRequest() {

            nullCheck = false;

            let ic = $("#item_code_val").val();
            let bid = $("#bin_location_id").val();
            let up = $("#unit_price").val();
            let qty = $("#qty").val();
            let dis = $("#item_discount").val();
            let vat = $("#item_vat").val();

            if (!(ic === '') && !(up === '') && !(qty === '')) {
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
                        bid: bid,
                        up: up,
                        qty: qty,
                        dis: dis,
                        vat: vat,
                    },
                    success: function(response) {

                        if (response === "1") {
                            Notiflix.Report.Failure('Item Insert Failure',
                                'Item Code, Unit Price, Quantity Cannot be Empty',
                                'Click');
                        } else if (response === '2') {

                            $('#item_code').val('');
                            $('#bin_location_id').empty();

                            Notiflix.Report.Failure('Item Insert Failure',
                                'Item Not Valid, Please Insert a Registered Item',
                                'Click');

                        } else {
                            clearFeilds();
                            purchaseOrderTable.ajax.reload(null, false);
                            calculateSessionTotal();
                            Notiflix.Notify.Success('Item Insert Successful');
                        }
                    }
                });

            }

        }

        function editPOItem(index) {
            $('#item_code').val($('#editbtn' + index).attr('ia' + index));
            $('#item_code_val').val($('#editbtn' + index).attr('iaid' + index));
            $("#unit_price").val($('#editbtn' + index).attr('ic' + index));
            $("#qty").val($('#editbtn' + index).attr('id' + index));
            $("#item_discount").val($('#editbtn' + index).attr('ie' + index));
            $("#item_vat").val($('#editbtn' + index).attr('if' + index));

            $("#addbutton").html('<i class="fa fa-pencil-square-o me-1"></i>Update Item');
            $("#addbutton").addClass('btn-indigo');

            $.ajax({
                type: "GET",
                url: "{{ Route('po.loadbinlocation') }}",
                async: true,
                data: {
                    item_id: $('#editbtn' + index).attr('iaid' + index),
                    location_id: $("#location_id").val(),
                },
                success: function(response) {
                    $('#bin_location_id').empty();
                    $.each(response, function(i, value) {
                        $('#bin_location_id').append($('<option>').text(value.name)
                            .attr(
                                'value', value.id));
                    });

                    $('#bin_location_id').val($('#editbtn' + index).attr('ib' + index));

                }
            });

        }

        function formatNumber(n, currency) {
            return currency + n.toFixed(2).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
            });
        }

        $('#discount').change(function(e) {
            e.preventDefault();

            if ($('#discount').val() < 0) {

                Notiflix.Report.Failure('Total Discount Failure ', 'Total Discount Connot Be Negative Value.',
                    'Click ');
                $('#discount ').val('');
                calculateSessionTotal();
            } else {
                calculateSessionTotal();
            }

        });

        $('#tot_vat').change(function(e) {
            e.preventDefault();

            if ($('#tot_vat').val() < 0) {
                Notiflix.Report.Failure('Total VAT Failure',
                    'Total VAT Connot Be Negative Value.',
                    'Click');
                $('#tot_vat').val('');
                calculateSessionTotal();
            } else {
                calculateSessionTotal();
            }
        });

        function calculateSessionTotal() {

            $.ajax({
                type: "GET",
                data: {
                    dis: $("#discount").val(),
                    vat: $("#tot_vat").val(),
                },
                url: "{{ route('po.calculateSessionTotal') }}",
                success: function(response) {
                    $("#po_tot").val(formatNumber(response[0], 'LKR '));
                    $("#po_net_tot").val(formatNumber(response[1], 'LKR '));
                }
            });
        }

        function sessionDeleteinSave() {
            Notiflix.Confirm.Show('PO Items Remove All Confirmation',
                'Do you really want to remove all items from purchase order?', 'Yes', 'No',
                function() {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('po.sessionPOClear') }}",
                        success: function(response) {
                            purchaseOrderTable.ajax.reload(null, false);
                        }
                    });

                    Notiflix.Notify.Success('Successfully Removing Items');

                },
                function() {

                    Notiflix.Notify.Info('Ignoring Removing Items From Purchase Order');

                });

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
                            purchaseOrderTable.ajax.reload(null, false);
                            calculateSessionTotal();
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
            $('#bin_location_id').empty();
            $("#unit_price").val('');
            $("#qty").val('');
            $("#item_discount").val('');
            $("#item_vat").val('');
        }

        $('#po_table_refresh').click(function(e) {
            e.preventDefault();
            sessionDeleteinSave();
        });

        $('#deleteAllSessions').click(function(e) {
            e.preventDefault();
            sessionDeleteinSave();
        });

        $('#deleteAllinPoSave').click(function(e) {
            e.preventDefault();
            sessionDeleteinSave();
        });

        $('#location_id').change(function(e) {
            e.preventDefault();

            Notiflix.Confirm.Show('Location Changing Warning',
                'Unable to change the location after adding items. if continued, it will deleted all session data.',
                'Yes', 'No',
                function() {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('po.sessionPOClear') }}",
                        success: function(response) {
                            purchaseOrderTable.ajax.reload(null, false);
                        }
                    });

                    Notiflix.Notify.Success('Successfully clear session');

                },
                function() {

                    Notiflix.Notify.Info('Ignoring Location changing');

                });

        });

        $('#po_expt_deliver_date').change(function(e) {
            e.preventDefault();

            if ($('#po_date').val() !== '') {

                var isValid = false;

                if (parseFloat($('#po_expt_deliver_date').val().split('/')[2]) > parseFloat($(
                            '#po_date').val()
                        .split('/')[2])) {

                    console.log('Year OK');
                    isValid = true;

                } else if (parseFloat($('#po_expt_deliver_date').val().split('/')[2]) ===
                    parseFloat($('#po_date').val().split('/')[2])) {

                    if (parseFloat($('#po_expt_deliver_date').val().split('/')[1]) >
                        parseFloat($('#po_date').val().split('/')[1])) {

                        isValid = true;

                    } else if (parseFloat($('#po_expt_deliver_date').val().split('/')[1]) ===
                        parseFloat($('#po_date').val().split('/')[1])) {

                        if (parseFloat($('#po_expt_deliver_date').val().split('/')[0]) >=
                            parseFloat($('#po_date').val().split('/')[0])) {

                            isValid = true;

                        } else {

                            isValid = false;

                        }

                    }

                } else {

                    isValid = false;

                }


                if (!isValid) {

                    $('#po_expt_deliver_date').val('');
                    $('#po_expt_deliver_date').focus();

                    Notiflix.Report.Failure('Invalid Date Inserting',
                        'Please insert valid date as purchase order expecting date',
                        'Click');

                }

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

        var itemsDataArray = {};

        var poItemsTypeHead = $('#item_code').typeahead({
            source: function(query, process) {
                return $.get("{{ route('po.loaditem') }}", {
                    query: query,
                }, function(data) {
                    itemsDataArray = {};
                    data.forEach(element => {
                        itemsDataArray[element['name']] = element['id'];
                    });
                    return process(data);
                });
            },
        });

        poItemsTypeHead.change(function(e) {
            var tempId = itemsDataArray[$('#item_code').val()];
            if (tempId != undefined) {
                $('#item_code_val').val(tempId);

                $.ajax({
                    type: "GET",
                    url: "{{ Route('po.loadbinlocation') }}",
                    async: true,
                    data: {
                        item_id: tempId,
                        location_id: $("#location_id").val(),
                    },
                    success: function(response) {

                        if (response.length !== 0) {

                            $('#bin_location_id').empty();
                            $.each(response, function(i, value) {
                                $('#bin_location_id').append($('<option>').text(
                                        value.name)
                                    .attr(
                                        'value', value.id));
                            });

                        } else {

                            $('#item_code').val('');

                            Notiflix.Report.Failure('Item Insert Failure',
                                'This item does not exist a BIN Location. Please assign a BIN Location and try again.',
                                'Click');
                        }

                    }
                });

            }
        });

        var poItemsTypeHead = $('#item_code_view').typeahead({
            source: function(query, process) {
                return $.get("{{ route('po.loaditem') }}", {
                    query: query,
                }, function(data) {
                    itemsDataArray = {};
                    data.forEach(element => {
                        itemsDataArray[element['name']] = element['id'];
                    });
                    return process(data);
                });
            },
        });

        poItemsTypeHead.change(function(e) {
            var tempId = itemsDataArray[$('#item_code_view').val()];
            if (tempId != undefined) {
                $('#item_code_val_view').val(tempId);

                $.ajax({
                    type: "GET",
                    url: "{{ Route('po.loadbinlocation') }}",
                    async: true,
                    data: {
                        item_id: tempId,
                        location_id: $("#location_id").val(),
                    },
                    success: function(response) {

                        if (response.length !== 0) {

                            $('#bin_location_id_view').empty();
                            $.each(response, function(i, value) {
                                $('#bin_location_id_view').append($('<option>').text(
                                        value.name)
                                    .attr(
                                        'value', value.id));
                            });

                        } else {

                            $('#item_code_view').val('');

                            Notiflix.Report.Failure('Item Insert Failure',
                                'This item does not exist a BIN Location. Please assign a BIN Location and try again.',
                                'Click');
                        }

                    }
                });

            }
        });

        $(function() {
            $.mask.definitions['~'] = "[+-]";
            $("#po_expt_deliver_date").mask("99/99/9999", {
                placeholder: "dd/mm/yyyy",
                completed: function() {
                    // alert("completed!");
                }
            });
        });

        $(function() {
            $.mask.definitions['~'] = "[+-]";
            $("#po_date").mask("99/99/9999", {
                placeholder: "dd/mm/yyyy",
                completed: function() {
                    // alert("completed!");
                }
            });
        });

        $(document).ready(function() {

            $.ajax({
                type: "GET",
                url: "{{ route('po.counts') }}",
                success: function(response) {

                    $('#pendingN').html(response[2]);
                    $('#pendingP').html(((response[2] / response[3]) * 100).toFixed(2) + '%');

                    $('#activeN').html(response[0]);
                    $('#activeP').html(((response[0] / response[3]) * 100).toFixed(2) + '%');

                    $('#deactiveN').html(response[1]);
                    $('#deactiveP').html(((response[1] / response[3]) * 100).toFixed(2) + '%');

                    $('#completeN').html(response[4]);
                    $('#completeP').html(((response[4] / response[3]) * 100).toFixed(2) + '%');

                }
            });

        });

        function po_printReport(id) {

            Notiflix.Confirm.Show('Print', 'Do you sure to print this report?', 'Yes', 'No', function() {
                $.ajax({
                    type: "GET",
                    url: "/po/printReport",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == 2) {
                            Notiflix.Notify.Warning('Something Wrong.');
                        } else {
                            printReport(response);
                        }
                    }
                });
            }, function() {});

        }

    </script>

@endsection
