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
                                <li class="breadcrumb-item active">Purchase Order Management</li>
                            </ul>
                            <h1 class="page-header">
                                Purchase Order Requests
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="card">

                                        <div class="card-header">
                                            <h6 class="mt-2">
                                                Purchase Order Details
                                            </h6>
                                        </div>

                                        <div class="card-body">

                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Purchase Order Number <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" value="PO0001" readonly />
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Created Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input id="poCreatedDate" type="text" class="form-control"
                                                        placeholder="dd/mm/yyyy">
                                                    <label class="input-group-text" for="poCreatedDate"><i
                                                            class="fa fa-calendar"></i></label>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Expected Deliver Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input id="expectedDeliverDate" type="text" class="form-control"
                                                        placeholder="dd/mm/yyyy">
                                                    <label class="input-group-text" for="expectedDeliverDate"><i
                                                            class="fa fa-calendar"></i></label>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label class="form-label" for="poDeliverAddress">Deliver Address<span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="poDeliverAddress" rows="3"
                                                    name="poDeliverAddress"></textarea>
                                            </div>

                                            {{-- <div class="form-group mb-3">
                                                <input type="submit" class="btn btn-round btn-primary" value="Submit" />
                                                <button class="btn btn-round btn-secondary">Clear All</button>
                                            </div> --}}

                                            {{-- <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Approval Person
                                                </label>
                                                <input type="text" class="form-control" />
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Approval Date</label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input id="poApprovalDate" type="text" class="form-control"
                                                        placeholder="dd/mm/yyyy">
                                                    <label class="input-group-text" for="poApprovalDate"><i
                                                            class="fa fa-calendar"></i></label>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </div>

                                        <div class="card-header" style="border-top: 1px solid lightgrey">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 class="mt-2">
                                                        Purchase order has items
                                                    </h6>

                                                </div>
                                                <div class="col-6 d-flex flex-row-reverse">
                                                    <div class="ms-auto">
                                                        <a href="#poItemInsert" data-bs-toggle="modal"
                                                            class="btn btn-primary"><i class="fa fa-plus-circle me-1"></i>
                                                            Add Items</a>
                                                    </div>
                                                    {{-- <button type="button" class="btn btn-primary me-2"
                                                        data-bs-toggle="modal" data-bs-target="#poItemInsert"><i
                                                            class="fa fa-plus" aria-hidden="true"></i> Modal
                                                        Cover</button> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mt-2">Purchase Order List</h6>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-hover text-nowrap ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Emp No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">User Type</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td class="py-1 align-middle">1</td>
                                                        <td class="py-1 align-middle">EMP120</td>
                                                        <td class="py-1 align-middle">Abc Def</td>
                                                        <td class="py-1 align-middle">abc@gmail.com</td>
                                                        <td class="py-1 align-middle">Admin</td>
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
                                                                    <button class="btn btn-round btn-yellow btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#resetPassword">
                                                                        Change Password
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

                                                    <tr>
                                                        <td scope="row" class="py-1 align-middle">3</td>
                                                        <td class="py-1 align-middle">EMP1325</td>
                                                        <td class="py-1 align-middle">Pqrx yza</td>
                                                        <td class="py-1 align-middle">pqrx@yahoo.com</td>
                                                        <td class="py-1 align-middle">Manager</td>
                                                        <td class="py-1 align-middle"><span
                                                                class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                                    class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
                                                                Deactive</span></td>
                                                        <td>
                                                            <div class="input-group flex-nowrap">
                                                                <div class="m-1">
                                                                    <button class="btn btn-secondary btn-sm">
                                                                        Edit
                                                                    </button>
                                                                </div>

                                                                <div class="m-1">
                                                                    <button class="btn btn-round btn-yellow btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#resetPassword">
                                                                        Change Password
                                                                    </button>
                                                                </div>

                                                                <div class="m-1">
                                                                    <button class="btn btn-round btn-default btn-sm">
                                                                        Activate
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

    <div class="modal  fade" id="poItemInsert">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title">ADD ITEMS : PO12356</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-3">
                            <div class="mb-3">
                                <label class="form-label">Select Item Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" value="" placeholder="Type 'I'" class="form-control rounded-end"
                                        id="itemAutoSelect" name="itemAutoSelect" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3">
                            <div class="mb-3">
                                <label class="form-label">Select Supplier <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" value="" placeholder="Type 'S'" class="form-control rounded-end"
                                        id="supplierAutoSelect" name="supplierAutoSelect" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Unit Price <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    &nbsp;
                                </label>
                                <br>
                                <button class="btn btn-primary w-100">Add to Table</button>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-header bg-secondary">
                    <h6 class="mt-2">Added Item List</h6>
                </div>

                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Supplier Code</th>
                                    <th scope="col">Unit Price (LKR)</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="py-1 align-middle">1</td>
                                    <td class="py-1 align-middle">ITM00010</td>
                                    <td class="py-1 align-middle">SUP0001</td>
                                    <td class="py-1 align-middle">15,250.00</td>
                                    <td class="py-1 align-middle">17</td>
                                    <td>
                                        <div class="input-group flex-nowrap">
                                            <div class="m-1">
                                                <button class="btn btn-secondary btn-sm">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="m-1">
                                                <button class="btn btn-round btn-default btn-sm">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-1 align-middle">2</td>
                                    <td class="py-1 align-middle">ITM00011</td>
                                    <td class="py-1 align-middle">SUP0015</td>
                                    <td class="py-1 align-middle">7,250.00</td>
                                    <td class="py-1 align-middle">12</td>
                                    <td>
                                        <div class="input-group flex-nowrap">
                                            <div class="m-1">
                                                <button class="btn btn-secondary btn-sm">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="m-1">
                                                <button class="btn btn-round btn-default btn-sm">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="modal-body">
                    <div class="d-flex flex-row-reverse">

                        <div class="px-1">
                            <button class="btn btn-teal text-white"><i class="fa fa-check"></i>
                                Save & Complete</button>
                        </div>

                        <div class="px-1">
                            <button class="btn btn-warning text-white"><i class="fa fa-trash"></i>
                                Delete All</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
