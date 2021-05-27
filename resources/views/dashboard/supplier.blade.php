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
                                <li class="breadcrumb-item active">Supplier Management</li>
                            </ul>
                            <h1 class="page-header">
                                Supplier Registration
                            </h1>
                            <hr class="mb-4" />

                            <div id="formControls" class="mb-5">

                                <div class="row">

                                    <div class="col-xl-4">

                                        <div class="card">
                                            <div class="card-body pb-2">
                                                <form>
                                                    <div class="row">

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">
                                                                    Supplier Code
                                                                </label>
                                                                <input type="text" class="form-control" value="SUP0001"
                                                                    readonly />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplierName">
                                                                    Supplier / Business Name
                                                                </label>
                                                                <input id="supplierName" type="text" class="form-control"
                                                                    name="supplierName" />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplierTel1">
                                                                    Primary Contact No
                                                                </label>
                                                                <input id="supplierTel1" type="text" class="form-control"
                                                                    name="supplierTel1" />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplierTel2">
                                                                    Secondary Contact No
                                                                </label>
                                                                <input id="supplierTel2" type="text" class="form-control"
                                                                    name="supplierTel2" />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplierAddress">Supplier /
                                                                    Business
                                                                    Address</label>
                                                                <textarea class="form-control" id="supplierAddress" rows="3"
                                                                    name="supplierAddress"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label"
                                                                    for="supplierPaymentDetails">Supplier Payment
                                                                    Details</label>
                                                                <textarea class="form-control" id="supplierPaymentDetails"
                                                                    rows="5" name="supplierPaymentDetails"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label"
                                                                    for="supplierRemark">Remark</label>
                                                                <textarea class="form-control" id="supplierRemark" rows="5"
                                                                    name="supplierRemark"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="supplierStatus" checked>
                                                                <label class="form-check-label" for="supplierStatus">
                                                                    Supplier active status
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3 mt-3">
                                                                <input type="submit" class="btn btn-primary text-white"
                                                                    value="Submit" />

                                                                <button class="btn btn-round btn-secondary">Clear
                                                                    All</button>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>
                                            </div>

                                        </div>


                                    </div>

                                    <div class="col-xl-8">

                                        <div class="card">
                                            <div class="card-body table-responsive">
                                                <table class="table table-hover text-nowrap ">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Sup Code</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Contact No</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td class="py-1 align-middle">1</td>
                                                            <td class="py-1 align-middle">SUP00010</td>
                                                            <td class="py-1 align-middle"
                                                                style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;  ">
                                                                Lorem Ipsum Industries (Private) Ltd</td>
                                                            <td class="py-1 align-middle">0112 729 729</td>
                                                            <td class="py-1 align-middle"><span
                                                                    class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                        class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                                                                    Active</span></td>
                                                            <td>
                                                                <div class="input-group flex-nowrap">
                                                                    <div class="m-1">
                                                                        <button class="btn btn-secondary btn-sm">
                                                                            Edit
                                                                        </button>
                                                                    </div>
                                                                    <div class="m-1">
                                                                        <button class="btn btn-round btn-default btn-sm">
                                                                            Deactivate
                                                                        </button>
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
    </div>

@endsection
