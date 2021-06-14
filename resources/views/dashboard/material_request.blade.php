@extends('dashboard.layouts.dashboard_app')


@section('content')

<div id="content" class="app-content" style="height: 100%">
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="row">

                    <div class="col-xl-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item header_new_text"><a href="home">Dashboard</a></li>
                            <li class="breadcrumb-item active header_new_text">{{ Session::get('view', 'non') }}</li>
                        </ul>
                        <h1 class="page-header header_new_text">
                            {{ Session::get('view', 'non') }}
                        </h1>

                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">Material Request List</h6>
                                            </div>
                                            <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                data-placement="bottom" title="Refresh Table">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="mr_list"
                                            class="table table-borderless table-striped text-nowrap pt-2 w-100">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">JOB CODE</th>
                                                    <th scope="col">MATERIAL CODE</th>
                                                    <th scope="col">CREATED DATE</th>
                                                    <th scope="col">LOCATION</th>
                                                    <th scope="col">VEHICLE CODE</th>
                                                    <th scope="col">VEHICLE MODAL</th>
                                                    <th scope="col">STATUS</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody id="mr_list_tbody">
                                                @include('dashboard.components.material_request_table')
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

<div class="modal fade" id="mr_view_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark-400">

                <h5 class="modal-title Available header_new_text text-white">MATERIAL REQUEST <span
                        id="mr_view_job_code" class="text-yellow" style="font-weight: 700">#MR/370621/001</span></h5>

                <div class="d-flex">
                    <div class="px-1 ">
                        <a id="mr_view_print_btn" class="btn btn-sm btn-default btnround"><i class="fa fa-print"></i></a>
                    </div>

                    <div class="px-1 ">
                        <a id="myi_mr_modal_view" class="btn btn-sm btn-yellow btnround">
                            <i class="far fa-window-minimize"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-xl-12">

                        <div class="row">

                            <div class="col-xl-12">

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mt-2">Material Request Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td><b>MATERIAL CODE</b>&nbsp;</td>
                                                <td id="mr_view_t_mr_code">MR/370621/001</td>
                                            </tr>
                                            <tr>
                                                <td><b>JOB CODE</b>&nbsp;</td>
                                                <td id="mr_view_t_job">TCJ001</td>
                                            </tr>
                                            <tr>
                                                <td><b>DATE</b>&nbsp;</td>
                                                <td id="mr_view_t_date">16/06/2021</td>
                                            </tr>
                                            <tr>
                                                <td><b>LOCATION</b>&nbsp;</td>
                                                <td id="mr_view_t_location">Polgahawela Store</td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-xl-12 mb-3">

                                        <div class="card shadow-sm mb-3 border-1 h-100">

                                            <div class="card-header">
                                                <h6 class="mt-2">Requested Materials</h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-xl-12">

                                                        <div class="table-responsive">
                                                            <table id="mr_view_modal_table"
                                                                class="table table-striped text-nowrap pt-2 w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>P/Code</th>
                                                                        <th>Part Code</th>
                                                                        <th>Qty</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="mr_view_modal_tbody">

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


                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="d-flex">

                            <div class="d-flex">

                                <div class="px-1">
                                    <button class="btn btn-yellow btn-sm"> <i class='fa fa-check'></i>
                                        Approve </button>
                                </div>

                                <div class="px-1">
                                    <button class="btn btn-danger btn-sm"> <i class='fa fa-close'></i>
                                        Refuse </button>
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
