@extends('dashboard.layouts.dashboard_app')

@section('content')

<div id="content" class="app-content">
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
                                    <a id="modal_button" class="btn btn-primary transfer_modal_button">
                                        <i class="fa fa-plus-circle me-1"></i>
                                        Create Transfer
                                    </a>
                                </div>
                            </div>
                            @include('alerts.formalert')
                            <div class="col-xl-12">
                                <div class="card">

                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Filters</h6>
                                            </div>
                                            <a type="button" id="resetatag" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh All Feilds">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        From <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="transfer_filter_from" type="date" class="form-control"/>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        To <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="transfer_filter_to" type="date" class="form-control"/>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3">
                                                    <a id="transfer_filter_btn" class="btn btn-primary text-white">Filter Records</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>

                            <div class="col-xl-12 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Vehicle List</h6>
                                            </div>
                                            <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="transfer_history_table" class="display table table-borderless table-striped text-nowrap pt-2 ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Transfer Code</th>
                                                    <th scope="col">From</th>
                                                    <th scope="col">To</th>
                                                    <th scope="col">Transfer By</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Action</th>
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
            <form method="GET" action="/transfer/add" id="trnasfer_form">
                @csrf
                <div class="modal-header bg-dark-400">

                    <h5 class="modal-title header_new_text text-white">CREATE INTER LOCATION TRANSFER</h5>

                    <div class="d-flex">

                        <div class="px-1 " id="transfer_print_btn_div" style="display: none;">
                            <a id="transfer_print_btn" class="btn btn-sm btn-default btnround"><i class="fa fa-print"></i></a>
                        </div>

                        <div class="px-1 ">
                            <a id="modal_close" class="btn btn-sm btn-yellow btnround">
                                <i class="far fa-window-minimize"></i>
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
                                            <h6 class="mt-2 text-white">Transfer Primary Details</h6>
                                        </div>

                                        <div class="card-body">


                                            <div class="col-xol-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        Location From
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="transfer_location_from" name="transfer_location_from" class="form-select showselect">
                                                        <option value="none" disabled selected>Select From</option>
                                                        @foreach ($data['locations'] as $location)
                                                        <option {{ (old('transfer_location_from')==$location->id)?'selected':'' }} value="{{ $location->id }}">{{ $location->location_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('transfer_location_from')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xol-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        Location To
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="transfer_location_to" name="transfer_location_to" class="form-select showselect">
                                                        <option value="none" disabled selected>Select To</option>
                                                        @foreach ($data['locations'] as $location)
                                                        <option {{ (old('transfer_location_to')==$location->id)?'selected':'' }} value="{{ $location->id }}">{{ $location->location_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('transfer_location_to')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="transfer_remark">Remark</label>
                                                    <textarea class="form-control" id="transfer_remark" name="transfer_remark" rows="6">{{ old('transfer_remark') }}</textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-9 mb-3">

                                    <div class="card shadow-sm mb-3 h-100 border-1">

                                        <div class="card-header bg-dark-400">
                                            <h6 id="transfer_modal_item_add_div_title" class="mt-2 text-white">Add Items To Transfer</h6>
                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-xl-12 mb-3">


                                                    <div class="row" id="transfer_modal_item_add_div">
                                                        <div class="row">

                                                            <div class="col-xl-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Select Item<span class="text-danger">*</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                                        <input id="transfer_item_suggetions" name="transfer_item_suggetions" value="{{ old('job_vehicle_suggetions') }}" type="text" placeholder="Type 'Modal Code / Name'" class="form-control rounded-end" />
                                                                        <input id="transfer_item" name="transfer_item" type="hidden" value="{{ old('job_vehicle') }}">
                                                                        @error('transfer_item')
                                                                        <span class="text-danger">
                                                                            <small>{{ $message }}</small>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label">
                                                                        Available Targeted Bins
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <select id="transfer_available_bins" class="form-select ">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label">
                                                                        Quantity <span class="text-danger">*</span> <span><small id="transfer_qty_show_available"></small></span>
                                                                    </label>
                                                                    <input id="transfer_qty" type="number" class="form-control" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-xl-12 text-right">
                                                            <div class="d-flex flex-row-reverse">
                                                                <div class="px-1">
                                                                    <a id="transfer_session_add_button" class="btn btn-primary">
                                                                        <i class='fa fa-plus'></i>
                                                                        Add Product</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="margin-left: -16px; margin-right: -16px">
                                                            <hr>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="table-responsive">

                                                            <table id="transfermodaltable" class="w-100 display table table-borderless table-striped text-nowrap pt-2 ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Item Code</th>
                                                                        <th>Item Name</th>
                                                                        <th>Bin Location</th>
                                                                        <th>Quantity</th>
                                                                        <th>Actions</th>
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


                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="d-flex">

                            <div class="d-flex">
                                <div class="px-1">
                                    <button id="transferresetbtn" type="submit" class="btn btn-teal"> <i class='fa fa-check'></i>
                                        Submit Transfer </button>

                                    <button id="resetbtn" type="reset" class="btn btn-secondary resetcustom"> <i class='fa fa-refresh'></i>
                                        Refine All </button>

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
