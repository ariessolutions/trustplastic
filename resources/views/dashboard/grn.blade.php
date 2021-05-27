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
                                <li class="breadcrumb-item active">GRN Management</li>
                            </ul>
                            <h1 class="page-header">
                                GRN
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="card">

                                        <div class="card-header">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2">Create a GRN</h6>
                                                </div>
                                                <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                    data-placement="bottom" title="Refresh All Feilds">
                                                    <i class="fa fa-redo"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    GRN Code <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" value="GRN0001" readonly />
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Select Purchase Order Code <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                    <input type="text" value="" placeholder="Type 'P'"
                                                        class="form-control rounded-end" id="grnAutoSelect"
                                                        name="grnAutoSelect" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Created Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input id="grnDate" type="text" class="form-control"
                                                        placeholder="dd/mm/yyyy">
                                                    <label class="input-group-text" for="grnDate"><i
                                                            class="fa fa-calendar"></i></label>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="card-header" style="border-top: 1px solid lightgrey">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 class="mt-2">
                                                        GRN has items
                                                    </h6>

                                                </div>
                                                <div class="col-6 d-flex flex-row-reverse">
                                                    <div class="ms-auto">
                                                        <a href="#grnItemInsert" data-bs-toggle="modal"
                                                            class="btn btn-primary"><i class="fa fa-plus-circle me-1"></i>
                                                            Add Items</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    GRN Total Amount
                                                </label>
                                                <input type="text" class="form-control" readonly />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2">GRN List</h6>
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
                                                        <th scope="col">GRN Code</th>
                                                        <th scope="col">PO Code</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">GRN Total (LKR)</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">2</td>
                                                        <td class="py-1 align-middle">GRN0085</td>
                                                        <td class="py-1 align-middle">PO0001</td>
                                                        <td class="py-1 align-middle">25/05/2021</td>
                                                        <td class="py-1 align-middle">153,250.00</td>
                                                        <td class="py-1 align-middle"><span
                                                                class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                                                                Successful</span></td>
                                                        <td>
                                                            <div class="input-group flex-nowrap">
                                                                <div class="m-1">
                                                                    <button class="btn btn-secondary btn-sm">
                                                                        View
                                                                    </button>
                                                                </div>

                                                                <div class="m-1">
                                                                    <button class="btn btn-default btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#discountinuedPo">
                                                                        Deactivate
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">3</td>
                                                        <td class="py-1 align-middle">GRN0105</td>
                                                        <td class="py-1 align-middle">PO0015</td>
                                                        <td class="py-1 align-middle">25/05/2021</td>
                                                        <td class="py-1 align-middle">223,250.00</td>
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



    <div class="modal  fade" id="grnItemInsert">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title">ADD ITEMS : GRN0110</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label">Select Item Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" value="" placeholder="Type 'I'" class="form-control rounded-end"
                                        id="itemAutoSelect" name="itemAutoSelect" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Unit Price <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    &nbsp;
                                </label>
                                <br>
                                <button class="btn btn-primary w-100">Add to Table</button>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-header bg-secondary">
                    <h6 class="mt-2">Added Item List</h6>
                </div>

                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Unit Price (LKR)</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Net Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="py-1 align-middle">1</td>
                                    <td class="py-1 align-middle">ITM00010</td>
                                    <td class="py-1 align-middle">15,250.00</td>
                                    <td class="py-1 align-middle">17 l</td>
                                    <td class="py-1 align-middle">258,000.00</td>
                                    <td>
                                        <div class="input-group flex-nowrap">
                                            <div class="m-1">
                                                <button class="btn btn-secondary btn-sm">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="m-1">
                                                <button class="btn btn-round btn-default btn-sm">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-1 align-middle">2</td>
                                    <td class="py-1 align-middle">ITM00011</td>
                                    <td class="py-1 align-middle">15,250.00</td>
                                    <td class="py-1 align-middle">17 l</td>
                                    <td class="py-1 align-middle">258,000.00</td>
                                    <td>
                                        <div class="input-group flex-nowrap">
                                            <div class="m-1">
                                                <button class="btn btn-secondary btn-sm">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="m-1">
                                                <button class="btn btn-round btn-default btn-sm">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="modal-body">
                    <div class="d-flex flex-row-reverse">

                        <div class="px-1">
                            <button class="btn btn-teal text-white"><i class="fa fa-check"></i>
                                Save & Complete</button>
                        </div>

                        <div class="px-1">
                            <button class="btn btn-warning text-white"><i class="fa fa-trash"></i>
                                Delete All</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
