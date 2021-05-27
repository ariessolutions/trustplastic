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
                                <li class="breadcrumb-item active">Item Management</li>
                                <li class="breadcrumb-item active">Item Registration</li>
                            </ul>
                            <h1 class="page-header">
                                Item Registration
                            </h1>
                            <hr class="mb-4" />

                            <div id="formControls" class="mb-5">

                                <div class="row">


                                    <div class="col-xl-4">

                                        <div class="card">
                                            <div class="card-body pb-2">
                                                <form>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                Code
                                                            </label>
                                                            <input type="text" class="form-control" value="ITM0001"
                                                                readonly />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="itemCategoryName">
                                                                Name
                                                            </label>
                                                            <input id="itemCategoryName" type="text" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="itemCategoryName">
                                                                Item Category
                                                            </label>
                                                            <select class="form-select">
                                                                <option value="">Buffer Paint</option>
                                                                <option value="">Fibre Glue</option>
                                                                <option value="">Fiber Panel</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
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
                                                            <th scope="col">Item Code</th>
                                                            <th scope="col">Item Name</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td class="py-1 align-middle">1</td>
                                                            <td class="py-1 align-middle">ITM00010</td>
                                                            <td class="py-1 align-middle">Buffer Paint</td>
                                                            <td class="py-1 align-middle">Buffer</td>
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

                                                        <tr>
                                                            <td scope="row" class="py-1 align-middle">3</td>
                                                            <td class="py-1 align-middle">ITM00012</td>
                                                            <td class="py-1 align-middle">Fibre Glue</td>
                                                            <td class="py-1 align-middle">Fibre</td>
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
    </div>

@endsection
