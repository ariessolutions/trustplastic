@extends('dashboard.layouts.dashboard_app') @section('content')

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

                            <div class="col-xl-12 mb-3">
                                <div class="card">

                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Filters</h6>
                                            </div>
                                            <a type="button" id="resetatag" class="text-muted mt-2"
                                                data-toggle="tooltip" data-placement="bottom"
                                                title="Refresh All Feilds">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <form method="POST" id="submitform">

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Existing GRN Code</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-search"></i>
                                                            </span>
                                                            <input type="text" value="{{ old('grn_code_filter') }}"
                                                                placeholder="GRN Code" class="form-control rounded-end"
                                                                name="grn_code_filter" id="grn_code_filter" />
                                                            <input value="{{ old('exist_grn_code') }}" type="hidden"
                                                                class="form-control rounded-end" id="exist_grn_code"
                                                                name="exist_grn_code" /> @error('exist_grn_code')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span> @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Item Code<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-search"></i>
                                                            </span>
                                                            <input type="text" value="{{ old('stock_item_code') }}"
                                                                placeholder="Item Code" class="form-control rounded-end"
                                                                name="stock_item_code" id="stock_item_code" />
                                                            <input value="{{ old('stock_item') }}" type="hidden"
                                                                class="form-control rounded-end" id="stock_item"
                                                                name="stock_item" /> @error('stock_item')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span> @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">

                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="stockdatefrom">
                                                            Date From
                                                        </label>
                                                        <input type="date" id="stockdatefrom" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="stockdateto">
                                                            Date To
                                                        </label>
                                                        <input type="date" id="stockdateto" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="stocklocation">
                                                            Location
                                                        </label>
                                                        <select class="form-control" name="stocklocation"
                                                            id="stocklocation">
                                                            <option value="0" selected>None</option>
                                                            @foreach ($data['locations'] as $item)
                                                            <option value="{{ $item->id }}">{{ $item->location_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">

                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="stockbin">
                                                            Bin Location
                                                        </label>
                                                        <select class="form-control clearhtml" name="stockbin"
                                                            id="stockbin">
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xl-12">

                                                <div class="row">

                                                    <div class="col-xl-12">


                                                        <div class="form-group mb-3 mt-4">

                                                            <div class="row">

                                                                <div class="col-xl-3">
                                                                    <div class="d-flex">
                                                                        <div class="pt-2" style="padding-right: 15px">
                                                                            <i class="fa fa-filter"
                                                                                aria-hidden="true"></i>&nbsp;<label class="form-check-label">Order&nbsp;by</label>
                                                                        </div>

                                                                        <div class="form-check px-3 pt-2">
                                                                            <!-- <i class="fa fa-book" aria-hidden="true"></i>&nbsp; -->
                                                                            <input class="form-check-input" type="radio"
                                                                                id="stock-item-wise" name="a" checked />
                                                                            <label class="form-check-label"
                                                                                for="stock-item-wise">Item</label>
                                                                        </div>

                                                                        <div class="form-check px-3 pt-2">
                                                                            <!-- <i class="fa fa-database" aria-hidden="true"></i>&nbsp; -->
                                                                            <input class="form-check-input" type="radio"
                                                                                id="stock-bin-wise" name="a" />
                                                                            <label class="form-check-label"
                                                                                for="stock-bin-wise">Bin</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-9">
                                                                    <div class="form-group d-flex flex-md-row-reverse pt-4 pt-md-0">

                                                                        <div class="px-1">
                                                                            <button id="resetbtn" type="reset"
                                                                                class="btn btn-round btn-default">
                                                                                <i class="fa fa-filter"
                                                                                    aria-hidden="true"></i>
                                                                                Refine
                                                                                Filters
                                                                            </button>
                                                                        </div>

                                                                        <div class="px-1">
                                                                            <a id="stockprintbtn"
                                                                                class="btn btn-purple">
                                                                                <i class="fa fa-print"
                                                                                    aria-hidden="true"></i>
                                                                                Print
                                                                                Report
                                                                            </a>
                                                                        </div>

                                                                        <div class="px-1">
                                                                            <a id="submitstockfilters"
                                                                                class="btn btn-primary text-white">
                                                                                <i class="fa fa-share-square-o"
                                                                                    aria-hidden="true"></i>
                                                                                Submit
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </form>

                                    </div>



                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Stocks</h6>
                                            </div>
                                            <a type="button" href="#" id="refreshstocktable" class="text-muted mt-2"
                                                data-toggle="tooltip" data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="stockTable"
                                            class="tableMheight table table-borderless table-striped text-nowrap pt-2 w-100">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Item Code</th>
                                                    <th scope="col">Part Code</th>
                                                    <th scope="col">Bin Location</th>
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
