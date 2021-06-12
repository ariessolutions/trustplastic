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
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header bg-dark-400">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2 text-white">Material Request List</h6>
                                                </div>
                                                <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                    data-placement="bottom" title="Refresh Table">
                                                    <i class="fa fa-redo text-white"></i>
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
                                                        <th scope="col">CREATED DATE</th>
                                                        <th scope="col">LBR / COST</th>
                                                        <th scope="col">DIS (%)</th>
                                                        <th scope="col">VAT (%)</th>
                                                        <th scope="col">NET COST</th>
                                                        <th scope="col">PDU / COUNT</th>
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
                                                        <td class="py-1 align-middle">12</td>
                                                        <td>
                                                            <div class="input-group flex-nowrap">
                                                                <div class="px-1">
                                                                    <button id="mr_modal" href="#modal"
                                                                        data-bs-toggle="modal"
                                                                        class="btn btn-primary btn-sm">
                                                                        <i class='fa fa-plus'></i>
                                                                        Add Materials </button>
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

    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">ADD MATERIAL REQUEST FOR <span id="mr_job_code" class="text-primary"
                            style="font-weight: 700"></span></h5>

                    <div class="d-flex">
                        <div class="px-1 ">
                            <button class="btn btn-default"><i class="fa fa-trash"></i></button>
                        </div>

                        <div class="px-1 ">
                            <button class="btn btn-default"><i class="fa fa-print"></i></button>
                        </div>

                        <div class="px-1 ">
                            <button id="modal_close" class="btn bg-dark-100">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-12">

                            <div class="row">

                                <div class="col-xl-12">

                                    <div class="row">

                                        <div class="col-xl-3 mb-3">

                                            <div class="card shadow-sm mb-3 border-1 h-100">

                                                <div class="card-header bg-dark-400 ">
                                                    <h6 class="mt-2 text-white">Added Products for Job</h6>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div id="mr_created_jobs" class="table-responsive">
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-xl-9 mb-3">

                                            <div class="card shadow-sm mb-3 border-1 h-100">

                                                <div class="card-header bg-dark-400 ">
                                                    <h6 class="mt-2 text-white">Add Material Request</h6>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-xl-4">

                                                            <div class="card shadow-sm mb-3 h-100 border-1">

                                                                <div class="card-header">

                                                                    <div class="d-flex">
                                                                        <div class="flex-grow-1">
                                                                            <h6 class="mt-2">Add New Materials</h6>
                                                                        </div>
                                                                        <a id="mr_fields_delete" class="text-muted mt-2"
                                                                            data-placement="top" title="Refresh All Feilds">
                                                                            <i class="fa fa-redo text-dark"></i>
                                                                        </a>
                                                                    </div>

                                                                </div>

                                                                <div class="card-body">
                                                                    <div class="row">

                                                                        <div class="col-xl-12">
                                                                            <div class="form-group mb-3">
                                                                                <label class="form-label">
                                                                                    Material Request Code
                                                                                </label>
                                                                                <input id="mr_code" type="text"
                                                                                    class="form-control" readonly />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-12">
                                                                            <div class="form-group mb-3">
                                                                                <label class="form-label">
                                                                                    Product Code <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input id="mr_selected_prodcut_code" type="text"
                                                                                    class="form-control" readonly />

                                                                                    <input type="text" id="mr_selected_prodcut_id" hidden="true">

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-12">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Select Item <span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text"><i
                                                                                            class="fa fa-search"></i></span>

                                                                                    <input type="text"
                                                                                        placeholder="Type 'ITEM CODE / NAME'"
                                                                                        class="form-control rounded-end"
                                                                                        id="mr_item_code"
                                                                                        name="mr_item_code" />

                                                                                    <input type="text" id="mr_item_id"
                                                                                        name="mr_item_id" hidden="true">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-12">
                                                                            <div class="form-group mb-3">
                                                                                <label class="form-label">
                                                                                    Quantity <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <input id="mr_item_qty" type="number"
                                                                                    class="form-control" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-12 mb-1">
                                                                            <div class="input-group flex-nowrap">
                                                                                <div class="px-1 w-100">
                                                                                    <a id="mr_item_save_session_button"
                                                                                        class="btn btn-primary w-100">
                                                                                        <i class='fa fa-check'></i>
                                                                                        Save Material </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-xl-8">

                                                            <div class="card shadow-sm mb-3 h-100 border-1">

                                                                <div class="card-header">

                                                                    <div class="d-flex">
                                                                        <div class="flex-grow-1">
                                                                            <h6 class="mt-2">Added Product Materials</h6>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="card-body">

                                                                    <div class="table-responsive">
                                                                        <table id="mr_session_added_list"
                                                                            class="table table-borderless table-striped text-nowrap pt-2 w-100">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>P/Code</th>
                                                                                    <th>Part Code</th>
                                                                                    <th>Qty</th>
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
                                        <button id="mr_save_to_db_button" class="btn btn-teal"> <i class='fa fa-check'></i>
                                            Save & Complete </button>
                                    </div>

                                    <div class="px-1">
                                        <button id="mr_session_product_clear" class="btn btn-default"><i class="fa fa-trash"></i>
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


    @endsection
