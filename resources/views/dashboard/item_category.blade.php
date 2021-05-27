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
                                <li class="breadcrumb-item active">Item Caregory Registration</li>
                            </ul>
                            <h1 class="page-header">
                                Item Category Registration
                            </h1>
                            <hr class="mb-4" />

                            <div class="row">

                                <div class="col-xl-4">

                                    <div id="formControls" class="mb-5">

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mt-2">Create Category</h6>
                                                    </div>
                                                    <a class="text-muted mt-2" data-toggle="tooltip" data-placement="top"
                                                        title="Refresh All Feilds" value="reset() outside form"
                                                        onclick="item_category_form.reset(); $('#submit').removeClass('btn-indigo'); $('#submit').val('Submit'); ">
                                                        <i class="fa fa-redo"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body pb-2">

                                                @include('dashboard.components.flash')

                                                <form method="POST" action="/item/category/store" name="item_category_form">
                                                    @csrf

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                Code
                                                            </label>
                                                            <input type="text" class="form-control" id="item_category_code"
                                                                name="item_category_code" value="{{ $itemCode }}"
                                                                readonly />
                                                            @error('item_category_code')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="item_category_name">
                                                                Name
                                                            </label>
                                                            <input id="item_category_name" type="text"
                                                                name="item_category_name" class="form-control" />
                                                            @error('item_category_name')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <input id="submit" type="submit"
                                                                class="btn btn-primary text-white" value="Submit" />

                                                        </div>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-8">

                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2">Category Registration</h6>
                                                </div>
                                                <a href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                    data-placement="top" title="Refresh Table">
                                                    <i class="fa fa-redo"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="card-body table-responsive">
                                            <table class="table table-borderless table-striped text-nowrap pt-2"
                                                id="ictable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Category Code</th>
                                                        <th scope="col">Category Name</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="item_category_list">

                                                    @include('dashboard.components.item_category_list')

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

    <script>
        function setItemCategoryValueForEdit(item_category) {
            $("#item_category_code").val(item_category.item_category_code);
            $("#item_category_name").val(item_category.item_category_name);
            $("#submit").val('Update');
            $("#submit").addClass('btn-indigo');
        }

    </script>

    <script>
        $('#ictable').DataTable();
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', 'a[data-role = completed-deactivate]', function() {

                let id = $(this).data('id');
                let _token = $(this).data('token');

                $.ajax({
                    type: "post",
                    url: "{{ route('item/category.deactivate') }}",
                    data: {
                        id: id,
                        _token: _token,
                    },
                    success: function(response) {

                        // $('#item_category_list').html(response);

                        // location.reload();

                        alertProcessing(response);

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
                    url: "{{ route('item/category.activate') }}",
                    data: {
                        id: id,
                        _token: _token,
                    },
                    success: function(response) {
                        // $('#item_category_list').html(response);

                        // location.reload();

                        alertProcessing(response);

                    }
                });
            });
        });

        function alertProcessing(response) {

            let timerInterval
            Swal.fire({
                title: 'Processing...!',
                html: 'Will close in <b></b> milliseconds.',
                timer: response,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal
                                    .getTimerLeft()
                            }
                        }
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
            })

        }

    </script>



@endsection
