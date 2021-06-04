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
                            User Registration
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

                                        <form action="/users/enroll" method="POST" id="submitform">
                                            @csrf
                                            <input type="hidden" id="formconfig" name="formconfig" value="enroll">
                                            <input type="hidden" id="formkey" name="formkey" value="enroll">

                                            <div class="row ">
                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="usertype">
                                                            User Type
                                                        </label>
                                                        <select class="form-select" id="usertype" name="usertype">
                                                            @foreach ($data['usertypes'] as $ut)
                                                            <option {{ (old('usertype')==$ut->id)?'selected':'' }} value="{{ $ut->id }}">{{ $ut->usertype }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('usertype')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                        <input id="firstname" name="firstname" value="{{ old('firstname') }}" type="text" class="form-control fs-15px" placeholder="e.g John" />
                                                        @error('firstname')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                        <input id="lastname" name="lastname" value="{{ old('lastname') }}" type="text" class="form-control fs-15px" placeholder="e.g Smith" />
                                                        @error('lastname')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Emp Number <span class="text-danger">*</span></label>
                                                <input name="emp_number" id="emp_number" value="{{ old('emp_number') }}" type="text" class="form-control fs-15px" />
                                                @error('emp_number')
                                                <span class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input id="email" name="email" value="{{ old('email') }}" type="text" class="form-control fs-15px" placeholder="username@address.com" />
                                                @error('email')
                                                <span class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="row">

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                                        <input id="password" name="password" value="{{ old('password') }}" type="password" class="form-control fs-15px" />
                                                        @error('password')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                        <input id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password" type="password" class="form-control fs-15px" />
                                                        @error('confirm_password')
                                                        <span class="text-danger">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                        @enderror
                                                    </div><s></s>
                                                </div>

                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-check form-switch">
                                                    <input name="status" id="status" type="checkbox" class="form-check-input" {{ ((old('status')==1))?'checked':'' }}>
                                                    <label class="form-check-label" for="status">
                                                        User active status
                                                    </label>
                                                </div>
                                                @error('status')
                                                <span class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                                @enderror
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
                                        <table id="usersTable" class="display table table-borderless table-striped text-nowrap pt-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Emp No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">User Type</th>
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
