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

                            <div class="col-xl-12 mb-3">
                                <div class="card">

                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Register New Product</h6>
                                            </div>
                                            <a type="button" id="resetatag" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh All Feilds">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="/products/enroll" method="POST" id="submitform">
                                            @csrf
                                            <input type="hidden" id="formconfig" name="formconfig" value="enroll">
                                            <input type="hidden" id="formkey" name="formkey" value="enroll">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Vehicle Model / Code<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input type="text" value="{{ old('vehicle_code_sugg') }}" placeholder="Type 'Vehicle Code / Model Name'" class="form-control rounded-end" name="vehicle_code_sugg" id="products_vehicle_code" />
                                                        <input value="{{ old('vehicle_code') }}" type="hidden" class="form-control rounded-end" id="products_vehicle_code_result" name="vehicle_code" />
                                                        @error('vehicle_code')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="product_name" class="form-label">
                                                    Product Name <span class="text-danger">*</span>
                                                </label>
                                                <input id="product_name" type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" />
                                                @error('product_name')
                                                <span class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Product Code <span class="text-danger">*</span>
                                                </label>
                                                <input id="product_code" name="product_code" type="text" class="form-control consthidden" value="-------" readonly />
                                                @error('product_code')
                                                <span class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                                @enderror
                                            </div>


                                            <div class="col-xl-12">
                                                <div class="form-group mb-3 mt-4">
                                                    <input id="submitbtn" type="submit" class="btn btn-primary text-white" value="Submit" />

                                                    <button id="resetbtn" type="reset" class="btn btn-round btn-secondary">
                                                        Clear All
                                                    </button>

                                                </div>
                                            </div>

                                            @include('alerts.formalert')
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">GRN List</h6>
                                            </div>
                                            <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="productsTable" class="table table-borderless table-striped text-nowrap pt-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Product Code</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Vehicle Brand</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody></tbody>
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
