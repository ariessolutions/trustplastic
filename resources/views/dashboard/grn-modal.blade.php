<form action="/grn/enroll" method="POST" id="grnForm">
    @csrf
    <div class="modal modal-cover fade bg-dark" id="modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title text-white">ADD NEW GRN</h5>

                    <div class="d-flex">
                        <div class="px-1 ">
                            <a id="grnmodalreset" class="btn btn-default"><i class="fa fa-trash"></i></a>
                        </div>

                        <div class="px-1 ">
                            <a id="printmodal" class="btn btn-default"><i class="fa fa-print"></i></a>
                        </div>

                        <div class="px-1 ">
                            <a id="grnmodalclose" class="btn bg-dark-100">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">

                            <div class="row">
                                <div class="col-xl-3 mb-3">
                                    <div class="card mb-3 h-100 border-0">

                                        <div class="card-header bg-gradient-custom-teal border-0">

                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-2 text-white">Primary Details</h6>
                                                </div>
                                                <a id="grnpd_refresh" class="text-muted mt-2" data-placement="top" title="Refresh All Feilds">
                                                    <i class="fa fa-redo text-white"></i>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="card-body">

                                            @include('alerts.formalert')

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        Date
                                                    </label>
                                                    <input id="grn_date" autofocus="autofocus" name="grn_date" type="date" class="form-control" readonly />
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        PO Code
                                                    </label>
                                                    <input id="grnpocode" name="grnpocode" type="text" class="form-control" />

                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Remark <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="grn_remark" name="grn_remark" cols="30" rows="5"></textarea>
                                                    @error('grn_remark')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-xl-9">

                                    <div class="card mb-3 border-0">

                                        <div class="card-header bg-dark-400 ">
                                            <h6 class="mt-2 text-white">Added Items for Purchase Order</h6>
                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="table-responsive">
                                                    <table id="grnTable" class="table table-borderless table-striped text-nowrap pt-2 w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>Item Code</th>
                                                                <th>Unit Price</th>
                                                                <th>Qty</th>
                                                                <th></th>
                                                                <th>Total</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="d-flex">

                                                    <div class="d-flex">
                                                        <div class="px-1">

                                                            <button id="newgrnsubmitbtn" type="submit" form="grnForm" class="btn btn-teal"> <i class='fa fa-check'></i>
                                                                Save & Complete </button>
                                                        </div>

                                                        <div class="px-1">
                                                            <a class="btn btn-default" id="grnallclearbtn"><i class="fa fa-trash"></i>
                                                                Delete All</a>
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
            </div>
        </div>
    </div>
</form>