@extends('dashboard.layouts.dashboard_app')

@section('content')

    <div id="content" class="app-content" style="height: 100%">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-xl-10">

                    <div class="row">

                        <div class="col-xl-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
                                <li class="breadcrumb-item active">Job Management</li>
                            </ul>
                            <h1 class="page-header">
                                Job Registration
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="row mb-3 d-flex justify-content-end">
                                    <div class="ms-auto">
                                        <a id="modal_button" href="#jobItemInsert" data-bs-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fa fa-plus-circle me-1"></i>
                                            Create New Job
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-3">

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1"><span class="text-warning">Approval Pending </span>
                                                        Jobs</h5>
                                                    <div>Total approval pending job count</div>
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
                                                    <h5 class="mb-1"><span class="text-success">Approved</span> Jobs
                                                    </h5>
                                                    <div>Total active job count</div>
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
                                                    <h5 class="mb-1"><span class="text-danger">Closed </span>
                                                        Job</h5>
                                                    <div>Total closed job count</div>
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
                                                        <th scope="col">JOB CODE</th>
                                                        <th scope="col">CREATED DATE</th>
                                                        <th scope="col">LBR / COST</th>
                                                        <th scope="col">DIS (%)</th>
                                                        <th scope="col">VAT (%)</th>
                                                        <th scope="col">NET COST</th>
                                                        <th scope="col">STATUS</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">1</td>
                                                        <td class="py-1 align-middle">JOB1235</td>
                                                        <td class="py-1 align-middle">06/06/2021</td>
                                                        <td class="py-1 align-middle">13,540.00</td>
                                                        <td class="py-1 align-middle">2.5</td>
                                                        <td class="py-1 align-middle">8</td>
                                                        <td class="py-1 align-middle">16,500.00</td>
                                                        <td class="py-1 align-middle">
                                                            <span
                                                                class="badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>
                                                                Pending</span>
                                                        </td>
                                                        <td>

                                                            <div class="input-group flex-nowrap">
                                                                <div class="m-1">
                                                                    <a class="btn btn-secondary btn-sm">
                                                                        View / Edit
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">2</td>
                                                        <td class="py-1 align-middle">JOB1235</td>
                                                        <td class="py-1 align-middle">06/06/2021</td>
                                                        <td class="py-1 align-middle">13,540.00</td>
                                                        <td class="py-1 align-middle">2.5</td>
                                                        <td class="py-1 align-middle">8</td>
                                                        <td class="py-1 align-middle">16,500.00</td>
                                                        <td class="py-1 align-middle">
                                                            <span
                                                                class="badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>
                                                                Pending</span>
                                                        </td>
                                                        <td>

                                                            <div class="input-group flex-nowrap">
                                                                <div class="m-1">
                                                                    <a class="btn btn-secondary btn-sm">
                                                                        View / Edit
                                                                    </a>
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

    <div class="modal fade" id="jobItemInsert">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">CREATE NEW JOB</h5>

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

                        <div class="col-xl-12">

                            <div class="row">

                                <div class="col-xl-3 mb-3">

                                    <div class="card shadow-sm mb-3 h-100 border-1">

                                        <div class="card-header bg-gradient-cyan-indigo border-0">
                                            <h6 class="mt-2 text-white">Job Primary Details</h6>
                                        </div>

                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">
                                                            Job Code
                                                        </label>
                                                        <input id="job_code" name="job_code" class="form-control"
                                                            readonly />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">
                                                            Job Date
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="job_date" name="job_date" type="date"
                                                            class="form-control" readonly />

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xol-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        Select Location
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="location_id" name="location_id" class="form-select">
                                                        <option>Kaleniya Main Factory</option>
                                                        <option>Polgahawela</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Vehicle<span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-search"></i></span>

                                                        <input type="text" placeholder="Type 'Modal Code / Name'"
                                                            class="form-control rounded-end" id="vehicle_m_code"
                                                            name="vehicle_m_code" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="remark">Remark</label>
                                                    <textarea class="form-control" id="remark" name="remark" rows="3"
                                                        name="remark"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-9 mb-3">

                                    <div class="card shadow-sm mb-3 h-100 border-1">

                                        <div class="card-header bg-dark-400">
                                            <h6 class="mt-2 text-white">Add Product to Job</h6>
                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-xl-4 mb-3">

                                                    <div class="card shadow-sm mb-3 h-100 border-1">

                                                        <div class="card-header">

                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mt-2">Job Has Products</h6>
                                                                </div>
                                                                <a id="po_table_refresh" class="text-muted mt-2"
                                                                    data-placement="top" title="Refresh All Feilds">
                                                                    <i class="fa fa-redo text-dark"></i>
                                                                </a>
                                                            </div>

                                                        </div>

                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div class="col-xl-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Select BIN Location <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-search"></i></span>

                                                                            <input type="text"
                                                                                placeholder="Type 'Type BIN Code'"
                                                                                class="form-control rounded-end"
                                                                                id="bin_location_id"
                                                                                name="bin_location_id" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Product Code <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-search"></i></span>

                                                                            <input type="text"
                                                                                placeholder="Type 'Product Code / Name'"
                                                                                class="form-control rounded-end"
                                                                                id="product_code" name="product_code" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Unit Labour Cost <span
                                                                                class="text-danger">*</span>
                                                                        </label>
                                                                        <input id="unite_labour_cost" type="number"
                                                                            class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Qty <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input id="qty" type="number"
                                                                            class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            VAT (%)
                                                                        </label>
                                                                        <input id="sub_total" type="number"
                                                                            class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Sub Total
                                                                        </label>
                                                                        <input id="sub_total" type="number"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Net Total
                                                                        </label>
                                                                        <input id="net_total" type="number"
                                                                            class="form-control" readonly />
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-xl-8 mb-3">

                                                    <div class="card shadow-sm mb-3 h-100 border-1">

                                                        <div class="card-header">

                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mt-2">Outside Expenses Details</h6>
                                                                </div>

                                                                <a id="po_table_refresh" class="text-muted mt-2"
                                                                    data-placement="top" title="Refresh All Feilds">
                                                                    <i class="fa fa-redo text-dark"></i>
                                                                </a>

                                                            </div>

                                                        </div>

                                                        <div class="card-body">

                                                            <div class="row">

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Expense Name
                                                                        </label>
                                                                        <input id="exp_name" name="exp_name"
                                                                            class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Expense Reference
                                                                        </label>
                                                                        <input id="exp_ref" name="exp_ref"
                                                                            class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Expense Amount
                                                                        </label>
                                                                        <input type="number" id="exp_amount"
                                                                            name="exp_amount" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                            for="ref_remark">Remark</label>
                                                                        <textarea class="form-control" id="ref_remark"
                                                                            name="ref_remark" rows="1"></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div style="margin-left: -16px; margin-right: -16px">
                                                                <hr>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex flex-row-reverse">
                                                                    <div class="px-1">
                                                                        <button id="jobadd_button" class="btn btn-primary">
                                                                            <i class='fa fa-plus'></i>
                                                                            Add Expense</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-header border-1 mt-3 mb-3"
                                                                style="margin-left: -16px; margin-right: -16px; border-top: 1px solid #e0e0e0">
                                                                <h6 class="mt-2 ">Outside Expenses List</h6>
                                                            </div>

                                                            <div class="row">

                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-borderless table-striped text-nowrap pt-2">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Expense Name</th>
                                                                                <th>Reference</th>
                                                                                <th>Amount</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody id="job_outside_exp_list">

                                                                            <tr>
                                                                                <td class="py-1 align-middle">1</td>
                                                                                <td class="py-1 align-middle">Buffer Paints
                                                                                </td>
                                                                                <td class="py-1 align-middle">fcd396Qv</td>
                                                                                <td class="py-1 align-middle">173,450.00
                                                                                </td>
                                                                                <td>
                                                                                    <div class="input-group flex-nowrap">
                                                                                        <div class="m-1">
                                                                                            <button
                                                                                                class="btn btn-round btn-default btn-sm">
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
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="card-footer">
                                            <div class="col-xl-12">

                                                <div class="row">

                                                    <div class="d-flex flex-row-reverse">

                                                        <div class="px-1">
                                                            <button id="jobsessionclear_button" class="btn btn-default"><i
                                                                    class="fa fa-trash"></i>
                                                                Delete All</button>
                                                        </div>

                                                        <div class="px-1">
                                                            <button id="jobadd_button" class="btn btn-primary">
                                                                <i class='fa fa-check'></i>
                                                                Add Product to Job </button>
                                                        </div>


                                                    </div>


                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-12">

                            <div class="col-xl-12">

                                <div class="card shadow-sm mb-3 border-1">

                                    <div class="card-header bg-dark-400 ">
                                        <h6 class="mt-2 text-white">Added Products for Job</h6>
                                    </div>

                                    <div class="card-body">

                                        <div class="row">

                                            <div class="table-responsive">
                                                <table id="job_register_product_table"
                                                    class="table table-borderless table-striped text-nowrap pt-2">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Code</th>
                                                            <th>Unit L/C</th>
                                                            <th>Qty</th>
                                                            <th>Sub total</th>
                                                            <th>VAT (%)</th>
                                                            <th>Tot O/Exp</th>
                                                            <th>Net total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="grn_item_list">

                                                        <tr>
                                                            {{-- <td class="py-1 align-middle">1</td> --}}
                                                            <td class="py-1 align-middle">1</td>
                                                            <td class="py-1 align-middle">PRO/00010</td>
                                                            <td class="py-1 align-middle">15,250.00</td>
                                                            <td class="py-1 align-middle">12</td>
                                                            <td class="py-1 align-middle">15,3400.00</td>
                                                            <td class="py-1 align-middle">8.75</td>
                                                            <td class="py-1 align-middle">8,000.00</td>
                                                            <td class="py-1 align-middle">173,450.00</td>
                                                            <td>
                                                                <div class="input-group flex-nowrap">
                                                                    <div class="m-1">
                                                                        <button class="btn btn-secondary btn-sm">
                                                                            View / Edit
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
                                                            {{-- <td class="py-1 align-middle">1</td> --}}
                                                            <td class="py-1 align-middle">2</td>
                                                            <td class="py-1 align-middle">PRO/00010</td>
                                                            <td class="py-1 align-middle">15,250.00</td>
                                                            <td class="py-1 align-middle">12</td>
                                                            <td class="py-1 align-middle">15,3400.00</td>
                                                            <td class="py-1 align-middle">8.75</td>
                                                            <td class="py-1 align-middle">8,000.00</td>
                                                            <td class="py-1 align-middle">173,450.00</td>
                                                            <td>
                                                                <div class="input-group flex-nowrap">
                                                                    <div class="m-1">
                                                                        <button class="btn btn-secondary btn-sm">
                                                                            View / Edit
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
                                    <button class="btn btn-teal"> <i class='fa fa-check'></i>
                                        Save & Complete </button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-default"><i class="fa fa-trash"></i>
                                        Delete All</button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-yellow"> <i class='fa fa-check'></i>
                                        Approve </button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-danger"> <i class='fa fa-close'></i>
                                        Refuse </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#job_register_product_table').DataTable();

    </script>

@endsection
