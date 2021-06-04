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
                            <li class="breadcrumb-item active">{{ Session::get('view', 'non') }}</li>
                        </ul>
                        <h1 class="page-header">
                            Manage Stock
                        </h1>
                        <hr class="mb-4" />

                        <div class="row">

                            <div class="col-xl-4">
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

                                        <form method="POST" id="submitform">
                                            <div class="mb-3">
                                                <label class="form-label">Existing GRN Code</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('grn_code_filter') }}" placeholder="GRN Code" class="form-control rounded-end" name="grn_code_filter" id="grn_code_filter" />
                                                    <input value="{{ old('exist_grn_code') }}" type="hidden" class="form-control rounded-end" id="exist_grn_code" name="exist_grn_code" />
                                                    @error('exist_grn_code')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Item Code<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('stock_item_code') }}" placeholder="Item Code" class="form-control rounded-end" name="stock_item_code" id="stock_item_code" />
                                                    <input value="{{ old('stock_item') }}" type="hidden" class="form-control rounded-end" id="stock_item" name="stock_item" />
                                                    @error('stock_item')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label" for="stockdatefrom">
                                                    Date From
                                                </label>
                                                <input type="date" id="stockdatefrom" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label" for="stockdateto">
                                                    Date To
                                                </label>
                                                <input type="date" id="stockdateto" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label" for="stocklocation">
                                                    Location
                                                </label>
                                                <select class="form-control" name="stocklocation" id="stocklocation">
                                                    <option value="none" selected>None</option>
                                                    @foreach ($data['locations'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->location_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label" for="stockbin">
                                                    Bin Location
                                                </label>
                                                <select class="form-control clearhtml" name="stockbin" id="stockbin">
                                                </select>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3 mt-4">
                                                    <a id="submitstockfilters" class="btn btn-primary text-white">Submit</a>

                                                    <button id="resetbtn" type="reset" class="btn btn-round btn-secondary">
                                                        Refine Filters
                                                    </button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>



                                </div>
                            </div>

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Stocks</h6>
                                            </div>
                                            <a type="button" href="#" id="refreshstocktable" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="stockTable" class="display table table-borderless table-striped text-nowrap pt-2 ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Item Code</th>
                                                    <th scope="col">Part Code</th>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Low Stock</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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

@endsection
