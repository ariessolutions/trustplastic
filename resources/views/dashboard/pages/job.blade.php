@extends('dashboard.layouts.dashboard_app')

@section('content')

<div id="content" class="app-content" style="height: 100%">
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="row">

                    <div class="col-xl-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item header_new_text"><a href="inventory">Dashboard</a></li>
                            <li class="breadcrumb-item active header_new_text">{{ Session::get('view', 'non') }}</li>
                        </ul>
                        <h1 class="page-header header_new_text">
                            {{ Session::get('view', 'non') }}
                        </h1>
                        <hr class="mb-4" />

                        <div class="row">

                            <div class="row mb-3 d-flex justify-content-end">
                                <div class="ms-auto">
                                    <a id="modal_button" class="btn btn-primary job_modal_button">
                                        <i class="fa fa-plus-circle me-1"></i>
                                        Create New Job
                                    </a>
                                </div>
                            </div>
                            @include('alerts.formalert')
                            <div class="col-xl-12">

                                <div class="row">

                                    <div class="col-xl-3">

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex mb-3">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1"><span class="text-warning">Pending </span>
                                                    Jobs</h5>
                                                <div>Total approval pending job count</div>
                                            </div>
                                            <a onclick="refreshStatistics()" class="text-muted"><i class="fa fa-redo"></i></a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1" id="job_pending_count1">{{ $data['statistics'][2][0] }}</h3>
                                                <div class="text-success font-weight-600 fs-13px">
                                                    <i class="fa fa-globe"></i> <span id="job_pending_count11">{{ $data['statistics'][2][1] }}</span>%
                                                </div>
                                            </div>
                                            <div class="width-50 height-50 bg-warning-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
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
                                                        <h5 class="mb-1"><span class="text-success">Approved</span> Jobs
                                                        </h5>
                                                        <div>Total active job count</div>
                                                    </div>
                                                    <a onclick="refreshStatistics()" class="text-muted"><i class="fa fa-redo"></i></a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h3 class="mb-1" id="job_pending_count2">{{ $data['statistics'][0][0] }}</h3>
                                                        <div class="text-success font-weight-600 fs-13px">
                                                            <i class="fa fa-globe"></i> <span id="job_pending_count22">{{ $data['statistics'][0][1] }}</span>%
                                                        </div>
                                                    </div>
                                                    <div class="width-50 height-50 bg-success-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
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
                                                        <h5 class="mb-1"><span class="text-danger">Refused </span>
                                                            Jobs</h5>
                                                        <div>Total closed job count</div>
                                                    </div>
                                                    <a onclick="refreshStatistics()" class="text-muted"><i class="fa fa-redo"></i></a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h3 class="mb-1" id="job_pending_count3">{{ $data['statistics'][1][0] }}</h3>
                                                        <div class="text-success font-weight-600 fs-13px">
                                                            <i class="fa fa-globe"></i> <span id="job_pending_count33">{{ $data['statistics'][1][1] }}</span>%
                                                        </div>
                                                    </div>
                                                    <div class="width-50 height-50 bg-danger-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-close fa-lg text-danger"></i>
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
                                                <h6 class="mt-2">Job List</h6>
                                            </div>
                                            <a id="jonrecords_refresh" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-borderless table-striped text-nowrap pt-2 w-100" id="jobDataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">DATE</th>
                                                    <th scope="col">CODE</th>
                                                    <th scope="col">LOCATION</th>
                                                    <th scope="col">VEHICLE</th>
                                                    <th scope="col">LBR / COST</th>
                                                    <th scope="col">STATUS</th>
                                                    <th scope="col">ACTIONS</th>
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
        </div>

    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="GET" action="/job/create" id="job_form">
                @csrf
                <div class="modal-header">

                    <h5 class="modal-title">CREATE NEW JOB</h5>

                    <div class="d-flex">
                        <div class="px-1 ">
                            <a id="job_modal_reset_button" class="btn btn-default"><i class="fa fa-trash"></i></a>
                        </div>

                        <div class="px-1 ">
                            <a id="jobprintbtn" class="btn btn-default"><i class="fa fa-print"></i></a>
                        </div>

                        <div class="px-1 ">
                            <a id="modal_close" class="btn bg-dark-100">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="formconfig" name="formconfig" value="enroll">
                    <input type="hidden" id="formkey" name="formkey" value="enroll">
                    <div class="row">
                        @include('alerts.formalert')
                        <div class="col-xl-12">

                            <div class="row">

                                <div class="col-xl-3 mb-3">

                                    <div class="card shadow-sm mb-3 h-100 border-1" id="jobprimarydata">

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
                                                        <input id="job_code" class="form-control consthidden" readonly />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">
                                                            Job Date
                                                        </label>
                                                        <input id="job_date" type="date" class="form-control consthidden" readonly />
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xol-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        Select Location
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="job_location_id" name="job_location" class="form-select">
                                                        @foreach ($data['locations'] as $location)
                                                        <option {{ (old('job_location')==$location->id)?'selected':'' }} value="{{ $location->id }}">{{ $location->location_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('job_location')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Vehicle<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                        <input id="job_vehicle_suggetions" name="job_vehicle_suggetions" value="{{ old('job_vehicle_suggetions') }}" type="text" placeholder="Type 'Modal Code / Name'" class="form-control rounded-end" />
                                                        <input id="job_vehicle" name="job_vehicle" type="hidden" value="{{ old('job_vehicle') }}">
                                                        @error('job_vehicle')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="job_remark">Remark</label>
                                                    <textarea class="form-control" id="job_remark" name="job_remark" rows="6">{{ old('job_remark') }}</textarea>
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
                                                                <a id="job_jhpc_btn" class="text-muted mt-2" data-placement="top" title="Refresh All Feilds">
                                                                    <i class="fa fa-redo text-dark"></i>
                                                                </a>
                                                            </div>

                                                        </div>

                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div class="col-xl-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Select BIN Location <span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"><i class="fa fa-search"></i></span>

                                                                            <input type="text" id="bin_location_suggetion" name="bin_location_suggetion" placeholder="Type 'Type BIN Code'" class="form-control rounded-end" />
                                                                            <input type="hidden" name="job_bin_location" id="job_bin_location" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Product Code <span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                                            <input readonly name="job_product_sugg" id="job_product_sugg" type="text" placeholder="Type 'Product Code / Name'" class="form-control rounded-end" />
                                                                            <input type="hidden" name="job_product" id="job_product" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Unit Labour Cost <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input id="job_unit_labour_cost" type="number" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Qty <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input id="job_qty" type="number" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            VAT (%)
                                                                        </label>
                                                                        <input id="job_vat" type="number" class="form-control" step="0.01" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Sub Total
                                                                        </label>
                                                                        <input id="job_sub_total" type="number" class="form-control consthidden" readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Net Total
                                                                        </label>
                                                                        <input id="job_net_total" type="number" class="form-control consthidden" readonly />
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

                                                                <a id="job_oxc_btn" class="text-muted mt-2" data-placement="top" title="Refresh All Feilds">
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
                                                                        <input id="job_exp_name" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Expense Reference
                                                                        </label>
                                                                        <input id="job_exp_ref" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">
                                                                            Expense Amount
                                                                        </label>
                                                                        <input type="number" id="job_exp_amount" class="form-control" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label" for="ref_remark">Remark</label>
                                                                        <textarea class="form-control" id="job_ref_remark" name="ref_remark" rows="1"></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div style="margin-left: -16px; margin-right: -16px">
                                                                <hr>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex flex-row-reverse">
                                                                    <div class="px-1">
                                                                        <a id="job_add_expenses_button" class="btn btn-primary">
                                                                            <i class='fa fa-plus'></i>
                                                                            Add Expense</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-header border-1 mt-3 mb-3" style="margin-left: -16px; margin-right: -16px; border-top: 1px solid #e0e0e0">
                                                                <h6 class="mt-2 ">Outside Expenses List</h6>
                                                            </div>

                                                            <div class="row">

                                                                <div class="table-responsive">
                                                                    <table class="table table-borderless table-striped text-nowrap pt-2">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Expense</th>
                                                                                <th>Reference</th>
                                                                                <th>Amount</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody id="job_outside_exp_list">

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
                                                            <a id="job_sessionclear_button" class="btn btn-default"><i class="fa fa-trash"></i>
                                                                Delete All</a>
                                                        </div>

                                                        <div class="px-1">
                                                            <a id="job_add_button" class="btn btn-primary">
                                                                <i class='fa fa-check'></i>
                                                                Add / Update Job Product </a>
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
                                                <table id="job_register_product_table" class="w-100 table table-borderless table-striped text-nowrap pt-2">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bin</th>
                                                            <th>Product Code</th>
                                                            <th>Unit L/C</th>
                                                            <th>Qty</th>
                                                            <th>VAT (%)</th>
                                                            <th>Sub total</th>
                                                            <th>Tot O/Exp</th>
                                                            <th>Net total</th>
                                                            <th>Action</th>
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


                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="d-flex">

                            <div class="d-flex">
                                <div class="px-1">
                                    <button id="jobsaveandcompletebtn" type="submit" class="btn btn-teal"> <i class='fa fa-check'></i>
                                        Submit / Update </button>
                                </div>

                                <div class="px-1">
                                    <a type="reset" id="jobdeleteall" class="btn btn-default"><i class="fa fa-trash"></i>
                                        Delete All</a>
                                </div>

                                <div class="px-1">
                                    <a id="jobapprove" class="btn btn-yellow"> <i class='fa fa-check'></i>
                                        Approve </a>
                                </div>

                                <div class="px-1">
                                    <a id="job_refuse" class="btn btn-danger"> <i class='fa fa-close'></i>
                                        Refuse </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
