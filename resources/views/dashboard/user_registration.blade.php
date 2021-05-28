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
                                <li class="breadcrumb-item active">User Management</li>
                            </ul>
                            <h1 class="page-header">
                                User Registration
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="card">

                                        <div class="card-header">
                                            <h6 class="mt-2">User Registration</h6>
                                        </div>
                                        <div class="card-body">
                                            
                                            <form>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="itemCategoryName">
                                                            User Type
                                                        </label>
                                                        <select class="form-select">
                                                            <option value="">Admin</option>
                                                            <option value="">Manager</option>
                                                            <option value="">Operator</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-xl-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">First Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control fs-15px"
                                                                placeholder="e.g John" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Last Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control fs-15px"
                                                                placeholder="e.g Smith" />
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Emp Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control fs-15px" />
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Email Address <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control fs-15px"
                                                        placeholder="username@address.com" />
                                                </div>

                                                <div class="row">

                                                    <div class="col-xl-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Password <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" class="form-control fs-15px" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Confirm Password <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" class="form-control fs-15px" />
                                                        </div><s></s>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" id="userStatus"
                                                            checked>
                                                        <label class="form-check-label" for="userStatus">
                                                            User active status
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3 mt-4">
                                                        <input type="submit" class="btn btn-primary text-white"
                                                            value="Submit" />

                                                        <button class="btn btn-round btn-secondary">
                                                            Clear All
                                                        </button>

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

    <div class="modal fade" id="resetPassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control fs-15px" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control fs-15px" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
