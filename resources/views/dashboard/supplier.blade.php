@extends('dashboard.layouts.dashboard_app')

@section('content')

    <div id="content" class="app-content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-xl-10">

                    <div class="row">

                        <div class="col-xl-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item header_new_text"><a href="inventory">Dashboard</a></li>
                                <li class="breadcrumb-item active header_new_text">{{ Session::get('view', 'non') }}</li>
                            </ul>
                            <h1 class="page-header header_new_text">
                                {{ Session::get('view', 'non') }}
                            </h1>
                            <hr class="mb-4" />

                            <div id="formControls" class="mb-5">

                                <div class="row">

                                    <div class="col-xl-12 mb-3">

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mt-2">Supplier Registration</h6>
                                                    </div>
                                                    <a class="text-muted mt-2" data-toggle="tooltip" data-placement="top"
                                                        title="Refresh All Feilds" value="reset() outside form"
                                                        onclick="supplier_form.reset(); $('#submit').removeClass('btn-indigo'); $('#submit').val('Submit'); ">
                                                        <i class="fa fa-redo"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body pb-2">

                                                @include('dashboard.components.flash')

                                                <form method="POST" action="/supplier/store" name="supplier_form">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col-xl-3">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">
                                                                    Supplier Code
                                                                </label>
                                                                <input id="supplier_code" name="supplier_code" type="text"
                                                                    class="form-control" value="{{ $supplierCode }}"
                                                                    readonly />
                                                                @error('supplier_code')
                                                                    <span class="text-danger">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplier_name">
                                                                    Supplier / Business Name
                                                                </label>
                                                                <input id="supplier_name" type="text" class="form-control"
                                                                    name="supplier_name" />

                                                                @error('supplier_name')
                                                                    <span class="text-danger">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplier_primary_tel">
                                                                    Primary Contact No
                                                                </label>
                                                                <input id="supplier_primary_tel" type="text"
                                                                    class="form-control phone"
                                                                    name="supplier_primary_tel" />

                                                                @error('supplier_primary_tel')
                                                                    <span class="text-danger">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplier_secondary_tel">
                                                                    Secondary Contact No
                                                                </label>
                                                                <input id="supplier_secondary_tel" type="text"
                                                                    class="form-control phone"
                                                                    name="supplier_secondary_tel" />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="supplier_address">Supplier /
                                                                    Business
                                                                    Address</label>
                                                                <textarea class="form-control" id="supplier_address"
                                                                    rows="3" name="supplier_address"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label"
                                                                    for="supplier_payment_details">Supplier Payment
                                                                    Details</label>
                                                                <textarea class="form-control" id="supplier_payment_details"
                                                                    rows="5" name="supplier_payment_details"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label"
                                                                    for="supplier_remark">Remark</label>
                                                                <textarea class="form-control" id="supplier_remark" rows="5"
                                                                    name="supplier_remark"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="form-group mb-3 mt-3">
                                                                <input id="submit" type="submit"
                                                                    class="btn btn-primary text-white" value="Submit" />
                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>
                                            </div>

                                        </div>


                                    </div>

                                    <div class="col-xl-12">

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mt-2">Supplier List</h6>
                                                    </div>
                                                    <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                        data-placement="bottom" title="Refresh Table">
                                                        <i class="fa fa-redo"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table id="supplier_table" class="table table-borderless table-striped text-nowrap pt-2">
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
                                                    <tbody >
                                                        @include('dashboard.components.supplier_list')
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

    <script>
        function setSupplierValueForEdit(supplier) {
            $("#supplier_code").val(supplier.supplier_code);
            $("#supplier_name").val(supplier.supplier_name);
            $("#supplier_primary_tel").val(supplier.supplier_primary_tel);
            $("#supplier_secondary_tel").val(supplier.supplier_secondary_tel);
            $("#supplier_address").val(supplier.supplier_address);
            $("#supplier_payment_details").val(supplier.supplier_payment_details);
            $("#supplier_remark").val(supplier.supplier_remark);
            $("#submit").val('Update');
            $("#submit").addClass('btn-indigo');
        }

    </script>

    <script>
        $('#supplier_table').DataTable();
    </script>


    <script>
        $(document).ready(function() {

            $(document).on('click', 'a[data-role = completed-deactivate]', function() {

                let id = $(this).data('id');
                let _token = $(this).data('token');


                $.ajax({
                    type: "post",
                    url: "{{ route('supplier.deactivate') }}",
                    data: {
                        id: id,
                        _token: _token,
                    },
                    success: function(response) {

                        location.reload();
                        Notiflix.Notify.Success('Supplier Deactivation Successful');

                    }
                });
            });
        });

        $(document).ready(function() {

            $(document).on('click', 'a[data-role = completed-activate]', function() {

                let id = $(this).data('id');
                let _token = $(this).data('token');

                $.ajax({
                    type: "post",
                    url: "{{ route('supplier.activate') }}",
                    data: {
                        id: id,
                        _token: _token,
                    },
                    success: function(response) {
                        location.reload();
                        Notiflix.Notify.Success('Supplier Activation Successful');

                    }
                });
            });
        });


    </script>

@endsection
