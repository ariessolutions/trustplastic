@extends('dashboard.layouts.dashboard_app')

@section('content')

    <div id="content" class="app-content">

        <h1 class="page-header mb-3">
            Hi, User. <small>here's what's happening with your store today.</small>
        </h1>

        <div class="row">

            <div class="col-xl-6">

                <div class="row">

                    <div class="col-sm-4">

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Total Stock Value</h5>
                                        <div>Currently available stock value</div>
                                    </div>
                                    <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">LKR. 184,593</h3>
                                        <div class="text-success font-weight-600 fs-13px">
                                            <i class="fa fa-caret-up"></i> +3.59%
                                        </div>
                                    </div>
                                    <div
                                        class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-money fa-lg text-primary"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="col-sm-4">

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Total Stock In Item</h5>
                                        <div>Available stock item count</div>
                                    </div>
                                    <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">754</h3>
                                        <div class="text-success font-weight-600 fs-13px">
                                            <i class="fa fa-caret-up"></i> +3.59%
                                        </div>
                                    </div>
                                    <div
                                        class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cube fa-lg text-primary"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-sm-4">

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-warning">Pending Jobs</h5>
                                        <div>Pending all Job count</div>
                                    </div>
                                    <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">193</h3>
                                        <div class="text-success font-weight-600 fs-13px">
                                            <i class="fa fa-caret-up"></i> +3.59%
                                        </div>
                                    </div>
                                    <div
                                        class="width-50 height-50 bg-warning-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-cogs fa-lg text-warning"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-6">

                <div class="row">

                    <div class="col-sm-6">

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-warning">Pending Purchase Orders</h5>
                                        <div>Pending purchase order requests</div>
                                    </div>
                                    <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">21</h3>
                                        <div class="text-success font-weight-600 fs-13px">
                                            <i class="fa fa-caret-up"></i> +3.59%
                                        </div>
                                    </div>
                                    <div
                                        class="width-50 height-50 bg-warning-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-clipboard fa-lg text-warning"></i>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="col-sm-6">

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-warning">Pending Material Requests</h5>
                                        <div>Currently available stock Qty</div>
                                    </div>
                                    <a href="#" data-bs-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">84</h3>
                                        <div class="text-success font-weight-600 fs-13px">
                                            <i class="fa fa-caret-up"></i> +3.59%
                                        </div>
                                    </div>
                                    <div
                                        class="width-50 height-50 bg-warning-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-flask fa-lg text-warning"></i>
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
