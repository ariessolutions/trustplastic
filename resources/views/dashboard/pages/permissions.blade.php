@extends('dashboard.layouts.dashboard_app')

@section('content')

<div id="content" class="app-content">
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="row">

                    <div class="col-xl-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ Session::get('view', 'non') }}</li>
                        </ul>
                        <h1 class="page-header">
                            {{ Session::get('view', 'non') }}
                        </h1>
                        <hr class="mb-4" />

                        <div class="row">

                            <div class="col-xl-4">
                                <div class="card">

                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-2">{{ Session::get('view', 'non') }}</h6>
                                            </div>
                                            <a type="button" id="resetatag" class="text-muted mt-2" data-toggle="tooltip" data-placement="bottom" title="Refresh All Feilds">
                                                <i class="fa fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <form action="/permissions/enroll" method="POST" id="submitform">
                                            @csrf
                                            <input type="hidden" id="formconfig" name="formconfig" value="enroll">
                                            <input type="hidden" id="formkey" name="formkey" value="enroll">

                                            <div class="row ">
                                                <div class="mb-3">
                                                    <label class="form-label">Usertype Name <span class="text-danger">*</span></label>
                                                    <input required id="name" name="name" value="{{ old('name') }}" type="text" class="form-control fs-15px" />
                                                    @error('name')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-check form-switch">
                                                    <input name="status" id="status" type="checkbox" class="form-check-input" {{ ((old('status')==1))?'checked':'' }}>
                                                    <label class="form-check-label" for="status">
                                                        Usertype active status
                                                    </label>
                                                </div>
                                                @error('status')
                                                <span class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-xl-12">
                                                <hr>
                                                @foreach ($data['routes'] as $route)
                                                <div class="form-check form-switch">
                                                    <input name="status{{ $route->id }}" id="status{{ $route->id }}" type="checkbox" class="form-check-input" {{ ((old('status'.$route->id)=='on'))?'checked':'' }}>
                                                    <label class="form-check-label" for="status{{ $route->id }}">
                                                        {{ $route->name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3 mt-4">
                                                    <input id="submitbtn" type="submit" class="btn btn-primary text-white" value="Submit" />

                                                    <button id="resetbtn" type="reset" class="btn btn-round btn-secondary">
                                                        Clear All
                                                    </button>

                                                </div>
                                            </div>

                                           @include('alerts.formalert')

                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="permissionsTable" class="display table table-borderless table-striped text-nowrap pt-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
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
