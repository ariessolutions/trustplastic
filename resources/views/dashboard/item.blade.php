@extends('dashboard.layouts.dashboard_app')

@section('content')

    <div id="content" class="app-content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-xl-10">

                    <div class="row">

                        <div class="col-xl-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item header_new_text"><a href="/home">Dashboard</a></li>
                                <li class="breadcrumb-item active header_new_text">{{ Session::get('view', 'non') }}</li>
                            </ul>
                            <h1 class="page-header header_new_text">
                                {{ Session::get('view', 'non') }}
                            </h1>
                            <hr class="mb-4" />

                            <div id="formControls" class="mb-3">

                                <div class="row">

                                    <div class="col-xl-12">

                                        <div class="card mb-3">

                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mt-2">Items Registration</h6>
                                                    </div>
                                                    <a class="text-muted mt-2" data-toggle="tooltip" data-placement="top"
                                                        title="Refresh All Feilds" value="reset() outside form"
                                                        onclick="item_form.reset(); $('#submit').removeClass('btn-indigo'); $('#submit').val('Submit'); ">
                                                        <i class="fa fa-redo"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body pb-2">

                                                @include('dashboard.components.flash')

                                                <form method="POST" action="/item/store" name="item_form">
                                                    @csrf

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                Code
                                                            </label>
                                                            <input id="item_code" name="item_code" type="text"
                                                                class="form-control" value="{{ $itemCode }}" readonly />
                                                            @error('item_code')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">
                                                                Item Part Code
                                                            </label>

                                                            <input id="item_part_code" name="item_part_code" type="text"
                                                                class="form-control" />
                                                            @error('item_part_code')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="item_name">
                                                                Name
                                                            </label>
                                                            <input id="item_name" name="item_name" type="text"
                                                                class="form-control" />

                                                            @error('item_name')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="item_category_id">
                                                                Item Category
                                                            </label>
                                                            <select id="item_category_id" name="item_category_id"
                                                                class="form-select">

                                                                @foreach ($itemCategory as $key => $item_category)
                                                                    <option value="{{ $item_category->id }}">
                                                                        {{ $item_category->item_category_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            @error('item_category_id')
                                                                <span class="text-danger">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="measure_unit_id">
                                                                Measure Unit
                                                            </label>
                                                            <select id="measure_unit_id" name="measure_unit_id"
                                                                class="form-select">
                                                                @foreach ($itemMeasureUnit as $key => $measureUnit)
                                                                    <option value="{{ $measureUnit->id }}">
                                                                        {{ $measureUnit->symbol }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('measure_unit_id')
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

                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mt-2">Items List</h6>
                                                    </div>
                                                    <a type="button" href="#" class="text-muted mt-2" data-toggle="tooltip"
                                                        data-placement="bottom" title="Refresh Table">
                                                        <i class="fa fa-redo"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body table-responsive">
                                                <table id="itemtable"
                                                    class="table table-borderless table-striped text-nowrap pt-2">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Item Code</th>
                                                            <th scope="col">Item P/C</th>
                                                            <th scope="col">Item Name</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Measure Unit</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @include('dashboard.components.item_list')

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
        function setItemValueForEdit(item) {
            $("#item_code").val(item.item_code);
            $("#item_part_code").val(item.item_part_code);
            $("#item_name").val(item.item_name);
            $("#item_category_id").val(item.item_category_id);
            $("#measure_unit_id").val(item.measure_unit_id);
            $("#submit").val('Update');
            $("#submit").addClass('btn-indigo');
        }

    </script>

    <script>
        $('#itemtable').DataTable();
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', 'a[data-role = completed-deactivate]', function() {

                let id = $(this).data('id');
                let _token = $(this).data('token');

                Notiflix.Confirm.Show('Item De-activation Confirmation',
                    'Are you sure want to deactivate this item?', 'Yes', 'No',
                    function() {

                        $.ajax({
                            type: "post",
                            url: "{{ route('item.deactivate') }}",
                            data: {
                                id: id,
                                _token: _token,
                            },
                            success: function(response) {
                                location.reload();
                                Notiflix.Notify.Success('Item Deactivate Successful');

                            }
                        });


                    },
                    function() {

                        Notiflix.Notify.Warning('Item Deactivate Ignored');

                    });

            });
        });

        $(document).ready(function() {

            $(document).on('click', 'a[data-role = completed-activate]', function() {

                let id = $(this).data('id');
                let _token = $(this).data('token');

                Notiflix.Confirm.Show('Item Activation Confirmation',
                    'Are you sure want to activate this item?', 'Yes', 'No',
                    function() {

                        $.ajax({
                            type: "post",
                            url: "{{ route('item.activate') }}",
                            data: {
                                id: id,
                                _token: _token,
                            },
                            success: function(response) {
                                location.reload();
                                Notiflix.Notify.Success('Item Activate Successful');
                            }
                        });

                    },
                    function() {
                        Notiflix.Notify.Warning('Item Activate Ignored');
                    });

            });
        });

    </script>

@endsection
