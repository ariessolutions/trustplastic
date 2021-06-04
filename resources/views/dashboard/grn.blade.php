@extends('dashboard.layouts.dashboard_app')

@section('content')

<div id="content" class="app-content">
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="row">
                    @include('alerts.formalert')
                    <div class="col-xl-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="inventory">Dashboard</a></li>
                            <li class="breadcrumb-item active">GRN Management</li>
                        </ul>
                        <h1 class="page-header">
                            GRN Management
                        </h1>
                        <hr class="mb-4" />

                        <div class="row">

                            <div class="row mb-3 d-flex justify-content-end">
                                <div class="ms-auto">
                                    <a id="grnaddnewbtn" class="btn btn-primary">
                                        <i class="fa fa-plus-circle me-1"></i>
                                        Add New GRN
                                    </a>
                                </div>
                            </div>

                            <div class="col-xl-3">

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex mb-3">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1"><span class="text-success">Active</span> GRN
                                                </h5>
                                                <div>Total active GRN count</div>
                                            </div>
                                            <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1">{{ $data['active'] }}</h3>
                                                <div class="text-success font-weight-600 fs-13px">
                                                    <i class="fa fa-globe"></i> {{ ($data['active']!=0)?(($data['active']/($data['active']+$data['deactive']) )*100):'--'}}%
                                                </div>
                                            </div>
                                            <div class="width-50 height-50 bg-success-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
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
                                                    GRN</h5>
                                                <div>Total discontinued GRN count</div>
                                            </div>
                                            <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1">{{ $data['deactive'] }}</h3>
                                                <div class="text-success font-weight-600 fs-13px">
                                                    <i class="fa fa-globe"></i> {{ ($data['deactive']!=0)?(($data['deactive']/($data['active']+$data['deactive']) )*100):'--'}}%
                                                </div>
                                            </div>
                                            <div class="width-50 height-50 bg-danger-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
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
                                            <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover text-nowrap " id="grnDataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">GRN NO</th>
                                                    <th scope="col">PO CODE</th>
                                                    <th scope="col">SUPPLIER</th>
                                                    <th scope="col">LOCATION</th>
                                                    <th scope="col">DATE</th>
                                                    <th scope="col">TOTAL</th>
                                                    <th scope="col">STATUS</th>
                                                    <th scope="col">ACTION</th>
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

@if($errors->any())
<input type="hidden" value="1" id="iserror">
@endif

@include('dashboard.grn-modal')

@endsection
