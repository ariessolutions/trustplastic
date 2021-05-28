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
                                <li class="breadcrumb-item active">Product Registration & Management</li>
                            </ul>
                            <h1 class="page-header">
                                Product Registration
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="card">

                                        <div class="card-header">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2">Register New Product</h6>
                                                </div>
                                                <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                    data-placement="bottom" title="Refresh All Feilds">
                                                    <i class="fa fa-redo"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Vehicle Model Code<span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input type="text" value="" placeholder="Type 'Vehicle Code / Model Name'"
                                                            class="form-control rounded-end" id="itemAutoSelect"
                                                            name="itemAutoSelect" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Product Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" />
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Product Code <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" value="MG ZX Bumper" readonly />
                                            </div>


                                            <div class="col-xl-12">
                                                <div class="form-group mb-3 mt-4">
                                                    <input id="submit" type="submit" class="btn btn-primary text-white"
                                                        value="Submit" />
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                </div>

                                <div class="col-xl-8">
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
                                                        <th scope="col">Product Code</th>
                                                        <th scope="col">Barnd</th>
                                                        <th scope="col">Vehicle Model</th>
                                                        <th scope="col">Product Name</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">1</td>
                                                        <td class="py-1 align-middle">MG/ZX/B0001</td>
                                                        <td class="py-1 align-middle">Morris Garage</td>
                                                        <td class="py-1 align-middle">ZX</td>
                                                        <td class="py-1 align-middle">ZX Bumper</td>
                                                        <td class="py-1 align-middle"><span
                                                                class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                                                                Active</span></td>
                                                        <td>
                                                            <div class="input-group flex-nowrap">
                                                                <div class="m-1">
                                                                    <button class="btn btn-secondary btn-sm">
                                                                        View / Edit
                                                                    </button>
                                                                </div>

                                                                <div class="m-1">
                                                                    <button class="btn btn-default btn-sm">
                                                                        Deactivate
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">2</td>
                                                        <td class="py-1 align-middle">MG/ZX/B0002</td>
                                                        <td class="py-1 align-middle">Morris Garage</td>
                                                        <td class="py-1 align-middle">ZX</td>
                                                        <td class="py-1 align-middle">ZX Bumper</td>
                                                        <td class="py-1 align-middle"><span
                                                                class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
                                                                Inactive</span>
                                                        </td>
                                                        <td class="py-1 align-middle">
                                                            <div class="m-1">
                                                                <button class="btn btn-default btn-sm">
                                                                    Activate
                                                                </button>
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

@endsection
