function doPrint() {
    $('.buttons-print').click();
}

var tempAjaxRun = true;

var todayDate = new Date();

Notiflix.Loading.Init({
    fontFamily: "Quicksand",
    useGoogleFont: true,
});

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

function clearInputs(data) {
    data.forEach(element => {
        element.val('');
    });
}

$('#modal_close').click(function (e) {
    $("#modal").removeClass("in");
    $(".modal-backdrop").remove();
    $('#modal').modal('toggle');
});

function isNotEmpty(data) {
    var check = true;
    data.forEach(element => {
        if (Array.isArray(element)) {
            if (!element[0].val()) {
                element[1].addClass('border-danger');
                if (check == true) {
                    check = false;
                }
            } else {
                element[1].removeClass('border-danger')
            }
        } else {
            if (!element.val()) {
                element.addClass('border-danger');
                if (check == true) {
                    check = false;
                }
            } else {
                element.removeClass('border-danger');
            }
        }

    });
    return check;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    beforeSend: function () {
        Notiflix.Loading.Circle('Please wait...');
    },
    complete: function () {
        Notiflix.Loading.Remove();
    },
    error: function (x, status, error) {
        if (x.status == 403) {
            alert("Sorry, your session has expired. Please login again to continue");
            window.location.href = "/Account/Login";

            Notiflix.Report.Failure('Oops !', 'Sorry, your session has expired. Please login again to continue.', 'Okay');

        } else {
            Notiflix.Report.Failure('Something Wrong', "An error occurred: " + status + "nError: " + error + "<br>" + "Please try again later.", 'Okay');
        }
    }
});

$('#resetbtn').on('click', function () {
    $('#formconfig').val('enroll');
    $('input').removeAttr('readonly');
    $('input').val('');
    $('.consthidden').attr('readonly', '');
    $('.clearhtml').html('');
    $('#submitbtn').val('Submit').removeClass('btn-warning').addClass('btn-primary');
    $('input:checkbox').removeAttr('checked');
    tempAjaxRun = true;
});

$('#resetatag').on('click', function () {
    $('#resetbtn').click();
});

var usersDataTable = $('#usersTable').DataTable({
    ajax: {
        url: '/users/get/table',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function csusers(uid, status) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/users/edit/status/" + uid + "/" + status,
            success: function (response) {
                usersDataTable.ajax.reload(null, false);
                Notiflix.Notify.Success('Record Updated.');
            }
        });
    }, function () {});

}

function gudata(uid) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/users/find/" + uid,
            success: function (response) {
                $('#formkey').val(response.id);
                $('#formconfig').val('update');
                $('#submitbtn').val('Update').removeClass('btn-primary').addClass('btn-warning');
                $('#usertype').val(response.usertype);
                $('#firstname').val(response.fname);
                $('#lastname').val(response.lname);
                $('#emp_number').val(response.emp_no);
                $('#emp_number').attr('readonly', '');
                $('#email').val(response.email);
                $('#email').attr('readonly', '');
                if (response.status == 1) {
                    $('#status').attr('checked', 'checked')
                } else {
                    $('#status').removeAttr('checked')
                }
            }
        });
    }, function () {});
}

var permissionsDataTable = $('#permissionsTable').DataTable({
    ajax: {
        url: '/permissions/get/table',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function csusertypes(utid, status) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/permissions/edit/status/" + utid + "/" + status,
            success: function (response) {
                permissionsDataTable.ajax.reload(null, false);
                Notiflix.Notify.Success('Record Updated.');
            }
        });
    }, function () {});

}


function gutdata(uid) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/permissions/find/" + uid,
            success: function (response) {

                $('input:checkbox').removeAttr('checked');

                $('#formkey').val(response.id);
                $('#formconfig').val('update');
                $('#submitbtn').val('Update').removeClass('btn-primary').addClass('btn-warning');
                $('#name').val(response.usertype);
                if (response.status == 1) {
                    $('#status').attr('checked', 'checked')
                } else {
                    $('#status').removeAttr('checked')
                }

                response.permissions.forEach(element => {
                    if (response.status == 1) {
                        $('#status' + element.route).attr('checked', '')
                    }
                });
            }
        });
    }, function () {});
}

$('#vehicle_name').keyup(function () {
    if ($(this).val() && $(this).val().length > 1 && $('#vehicle_model_name').val() && $('#vehicle_model_name').val().length > 1) {
        if ($(this).val().length == 2 && tempAjaxRun == true) {
            $.ajax({
                type: "GET",
                url: "/vehicles/nextId",
                async: false,
                success: function (response) {
                    $('#vehicle_model_code').val($('#vehicle_name').val().substring(0, 2).toUpperCase() + '/' + $('#vehicle_model_name').val().substring(0, 2).toUpperCase() + '/' + pad(response.toString(), 3));
                }
            });
        } else {
            if (tempAjaxRun == false) {
                $('#vehicle_model_code').val($('#vehicle_name').val().substring(0, 2).toUpperCase() + '/' + $('#vehicle_model_name').val().substring(0, 2).toUpperCase() + '/' + pad($('#formkey').val(), 3));
            }
        }
    } else {
        $('#vehicle_model_code').val('');
    }
});

$('#vehicle_model_name').keyup(function () {
    if ($(this).val() && $(this).val().length > 1 && $('#vehicle_name').val() && $('#vehicle_name').val().length > 1) {
        if ($(this).val().length == 2 && tempAjaxRun == true) {
            $.ajax({
                type: "GET",
                url: "/vehicles/nextId",
                async: false,
                success: function (response) {
                    $('#vehicle_model_code').val($('#vehicle_name').val().substring(0, 2).toUpperCase() + '/' + $('#vehicle_model_name').val().substring(0, 2).toUpperCase() + '/' + pad(response.toString(), 3));
                }
            });
        } else {
            if (tempAjaxRun == false) {
                $('#vehicle_model_code').val($('#vehicle_name').val().substring(0, 2).toUpperCase() + '/' + $('#vehicle_model_name').val().substring(0, 2).toUpperCase() + '/' + pad($('#formkey').val(), 3));
            }
        }
    } else {
        $('#vehicle_model_code').val('');
    }
});

var vehicleTempMap = {};
var vehicleTypeHead = $('#products_vehicle_code').typeahead({
    source: function (query, process) {
        return $.get('/products/suggesions', {
            query: query,
        }, function (data) {
            vehicleTempMap = {};
            data.forEach(element => {
                vehicleTempMap[element['name']] = element['id'];
            });

            return process(data);
        });
    }
});

vehicleTypeHead.change(function (e) {
    var tempId = vehicleTempMap[$('#products_vehicle_code').val()];
    if (tempId != undefined) {
        $('#products_vehicle_code_result').val(tempId);
        productsCodeFetch($('#product_name').val());
    }
});

var vehiclesDataTable = $('#vehiclesTableView').DataTable({
    ajax: {
        url: '/vehicles/get/table',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function csvehicles(vid, status) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/vehicles/edit/status/" + vid + "/" + status,
            success: function (response) {
                vehiclesDataTable.ajax.reload(null, false);
                Notiflix.Notify.Success('Record Updated.');
            }
        });
    }, function () {});

}

function gvehicledata(vid) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/vehicles/find/" + vid,
            success: function (response) {
                tempAjaxRun = false;
                $('#formkey').val(response.id);
                $('#vehicle_name').val(response.brand);
                $('#vehicle_model_name').val(response.model);
                $('#vehicle_model_code').val(response.code);
                $('#formconfig').val('update');
                $('#submitbtn').val('Update').removeClass('btn-primary').addClass('btn-warning');
            }
        });
    }, function () {});
}

var productsDataTable = $('#productsTable').DataTable({
    ajax: {
        url: '/products/get/table',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function csproducts(pid, status) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/products/edit/status/" + pid + "/" + status,
            success: function (response) {
                productsDataTable.ajax.reload(null, false);
                Notiflix.Notify.Success('Record Updated.');
            }
        });
    }, function () {});
}

$('#product_name').keyup(function () {
    productsCodeFetch($(this).val());
});

function productsCodeFetch(proNameVal) {
    if (proNameVal && proNameVal.replace('-', '').replace(' ', '').toUpperCase().length > 1 && $('#products_vehicle_code_result').val()) {
        $.ajax({
            type: "GET",
            url: "/vehicles/next/data/" + $('#products_vehicle_code_result').val(),
            success: function (response) {
                $('#product_code').val(response.code + '/' + proNameVal.replace('-', '').replace(' ', '').toUpperCase().substring(0, 2) + '/' + pad(response.id, 3));
            }
        });
    } else {
        $('#product_code').val('');
    }
}

function gproductdata(pid) {
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to update this record ?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/products/find/" + pid,
            success: function (response) {
                $('#formkey').val(response.id);
                $('#product_code').val(response.code);
                $('#product_name').val(response.name);
                $('#products_vehicle_code_result').val(response.vehicle);
                $('#products_vehicle_code').val(response.sugg);
                $('#formconfig').val('update');
                $('#submitbtn').val('Update').removeClass('btn-primary').addClass('btn-warning');
            }
        });
    }, function () {});
}

var grnNewDataTable = $('#grnTable').DataTable({
    ajax: {
        url: '/grn/get/table',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

$('#grnmodalclose').click(function (e) {
    $("#modal").removeClass("in");
    $(".modal-backdrop").remove();
    $('#modal').modal('toggle');
});

$('#grnaddnewbtn').click(function () {
    $('#grnpocode').removeAttr('readonly', true);
    $('#grn_remark').removeAttr('readonly', true);
    $('#newgrnsubmitbtn').removeClass('d-none');
    $('#grnallclearbtn').removeClass('d-none');
    $('#grnmodalreset').removeClass('d-none');
    $('#grnForm').attr('action', '/grn/enroll');
    $('#grnpocode').val('');
    $('#grn_remark').val('');
    $('#printmodal').hide();
    grnNewDataTable.ajax.reload(null, false);
    $('#modal').modal('show');
});

$('#grnpocode').keyup(function (e) {
    $.ajax({
        type: "GET",
        data: {
            'code': $('#grnpocode').val()
        },
        url: "/purchaseorders/find/code",
        success: function (response) {
            if (response != 2) {
                Notiflix.Confirm.Show('Found', 'Purchase order found by this number. Do you want to load it ?', 'Yes', 'No', function () {
                    grnNewDataTable.ajax.reload(null, false);
                }, function () {});
            }
        }
    });
});


$('#grnmodalreset').click(function (e) {
    e.preventDefault();
    $('form#grnForm').trigger("reset");
    $('#grn_date').val(todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2));
    clearGRNSession();
});

$('#grnallclearbtn').click(function (e) {
    e.preventDefault();
    $('#grnmodalreset').click();
    clearGRNSession();
});


function clearGRNSession() {
    $.ajax({
        type: "GET",
        url: "/grn/session/clear",
        success: function (response) {
            grnNewDataTable.ajax.reload(null, false);
            Notiflix.Notify.Warning('Records Cleared Successfully.');
        }
    });
}

$('#grn_date').val(todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2));

function editGRNItem(index, quantity) {
    var qty = prompt("Please enter quantity", "0");
    if (qty != null && Number.isInteger(Number(qty)) && Number(qty) > 0) {
        if (quantity >= qty) {
            $.ajax({
                type: "GET",
                url: "/grn/session/update/" + index + "/" + qty,
                success: function (response) {
                    grnNewDataTable.ajax.reload(null, false);
                }
            });
        } else {
            Notiflix.Notify.Failure('Entered value is over than PO.');
        }
    } else {
        Notiflix.Notify.Failure('Entered value is zero or invalid.');
    }
}

function removeGRNItem(index) {
    $.ajax({
        type: "GET",
        url: "/grn/session/remove/" + index,
        success: function (response) {
            grnNewDataTable.ajax.reload(null, false);
            Notiflix.Notify.Warning('Records Updated Successfully.');
        }
    });
}

var grnDataTable = $('#grnDataTable').DataTable({
    ajax: {
        url: '/grn/data/get/table',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function viewGrn(grnID) {
    $('#grnpocode').attr('readonly', true);
    $('#grn_remark').attr('readonly', true);
    $('#newgrnsubmitbtn').addClass('d-none');
    $('#grnallclearbtn').addClass('d-none');
    $('#grnmodalreset').addClass('d-none');
    $('#grnForm').removeAttr('action');
    $('#printmodal').show();
    $('#printmodal').attr('onclick', 'printGRN(' + grnID + ')');

    $.ajax({
        type: "GET",
        url: "/grn/view/" + grnID,
        success: function (response) {
            $('#grnpocode').val($('#grnrecord' + grnID).attr('pocode'));
            $('#grn_remark').val($('#grnrecord' + grnID).attr('remark'));
            grnNewDataTable.ajax.reload(null, false);
            $('#modal').modal('show');
        }
    });
}

var stockGRNTempMap = {};
var stockGRNTempMap = $('#grn_code_filter').typeahead({
    source: function (query, process) {
        return $.get('/grn/code/get/all', {
            query: query,
        }, function (data) {
            stockGRNTempMap = {};
            data.forEach(element => {
                stockGRNTempMap[element['name']] = element['id'];
            });

            return process(data);
        });
    }
});

$('#stockprintbtn').click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: '/stocks/print/report/' + (($('#stock_item').val() !== '') ? $('#stock_item').val() : 0) + '/' + (($('#exist_grn_code').val() !== '') ? $('#exist_grn_code').val() : 0) + '/' + (($('#stockdatefrom').val() !== '') ? $('#stockdatefrom').val() : 0) + '/' + (($('#stockdateto').val() !== '') ? $('#stockdateto').val() : 0) + '/' + (($('#stockbin').val() !== '' && $('#stockbin').val() != null) ? $('#stockbin').val() : 0) + '/' +(($('#stocklocation').val() !== '' && $('#stocklocation').val() != null) ? $('#stocklocation').val() : 0),
        success: function (response) {
            if (response == 2) {
                Notiflix.Notify.Warning('No Records Found For Above Filters.');
            } else {
                printReport(response);
            }
        }
    });
});

$('#grn_code_filter').keyup(function (e) {
    if ($(this).val().length == 0) {
        $('#exist_grn_code').val('');
    }
});

stockGRNTempMap.change(function (e) {
    var tempId = stockGRNTempMap[$('#grn_code_filter').val()];
    if (tempId != undefined) {
        $('#exist_grn_code').val(tempId);
    }
});

var stockItemTempMap = {};
var stockItemTempMap = $('#stock_item_code').typeahead({
    source: function (query, process) {
        return $.get('/items/get/suggetions', {
            query: query,
        }, function (data) {
            stockItemTempMap = {};
            data.forEach(element => {
                stockItemTempMap[element['name']] = element['id'];
            });

            return process(data);
        });
    }
});

$('#stock_item_code').keyup(function (e) {
    if ($(this).val().length == 0) {
        $('#stock_item').val('');
    }
});

stockItemTempMap.change(function (e) {
    var tempId = stockItemTempMap[$('#stock_item_code').val()];
    if (tempId != undefined) {
        $('#stock_item').val(tempId);
    }
});

$('#stocklocation').change(function (e) {
    e.preventDefault();
    $('#stockbin').html('');
    $.ajax({
        type: "GET",
        url: "/binlocations/get/suggetions/" + $(this).val(),
        success: function (response) {
            $('#stockbin').append($('<option>').text('None')
                    .attr('value', 0));
            response.forEach(element => {
                $('#stockbin').append($('<option>').text(element.name)
                    .attr(
                        'value', element.id));
            });
        }
    });
});



var stockTable = $('#stockTable').DataTable({
    ajax: {
        url: '/stocks/get/table/' + (($('#stock_item').val() !== '') ? $('#stock_item').val() : 0) + '/' + (($('#exist_grn_code').val() !== '') ? $('#exist_grn_code').val() : 0) + '/' + (($('#stockdatefrom').val() !== '') ? $('#stockdatefrom').val() : 0) + '/' + (($('#stockdateto').val() !== '') ? $('#stockdateto').val() : 0) + '/' + (($('#stockbin').val() !== '' && $('#stockbin').val() != null) ? $('#stockbin').val() : 0) + '/' + (($('#stocklocation').val() !== '' && $('#stocklocation').val() != null) ? $('#stocklocation').val() : 0),
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle py-2');
    },
    "oLanguage": {
        "sEmptyTable": "No stocks found for the selected filters."
    }
});


$('#submitstockfilters').click(function (e) {
    e.preventDefault();
    stockTable.ajax.url('/stocks/get/table/' + (($('#stock_item').val() !== '') ? $('#stock_item').val() : 0) + '/' + (($('#exist_grn_code').val() !== '') ? $('#exist_grn_code').val() : 0) + '/' + (($('#stockdatefrom').val() !== '') ? $('#stockdatefrom').val() : 0) + '/' + (($('#stockdateto').val() !== '') ? $('#stockdateto').val() : 0) + '/' + (($('#stockbin').val() !== '' && $('#stockbin').val() != null) ? $('#stockbin').val() : 0) + '/' + (($('#stocklocation').val() !== '' && $('#stocklocation').val() != null) ? $('#stocklocation').val() : 0)).load(null, false);
});

$('#refreshstocktable').click(function (e) {
    e.preventDefault();
    $('#resetbtn').click();
    stockTable.ajax.url('/stocks/get/table/' + (($('#stock_item').val() !== '') ? $('#stock_item').val() : 0) + '/' + (($('#exist_grn_code').val() !== '') ? $('#exist_grn_code').val() : 0) + '/' + (($('#stockdatefrom').val() !== '') ? $('#stockdatefrom').val() : 0) + '/' + (($('#stockdateto').val() !== '') ? $('#stockdateto').val() : 0) + '/' + (($('#stockbin').val() !== '' && $('#stockbin').val() != null) ? $('#stockbin').val() : 0) + '/' + (($('#stocklocation').val() !== '' && $('#stocklocation').val() != null) ? $('#stocklocation').val() : 0)).load(null, false);
});


function printGRN(id) {
    Notiflix.Confirm.Show('Print', 'Do you sure to print this report?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/grn/get/print/" + id,
            success: function (response) {
                if (response == 2) {
                    Notiflix.Notify.Warning('Something Wrong.');
                } else {
                    printReport(response);
                }
            }
        });
    }, function () {});
}

//Start Functions - JOB

$('#job_location_id').change(function (e) {
    e.preventDefault();
    checkJobPrimaryDetailsFilled();
    $('#bin_location_suggetion').val('');
    $('#job_bin_location').val('');
});

var jobVehiclesTempMap = {};
var jobVehiclesTempMap = $('#job_vehicle_suggetions').typeahead({
    source: function (query, process) {
        return $.get('/vehicles/get/suggetions', {
            query: query,
        }, function (data) {
            jobVehiclesTempMap = {};
            data.forEach(element => {
                jobVehiclesTempMap[element['name']] = element['id'];
            });

            return process(data);
        });
    }
});
$('#job_vehicle_suggetions').keyup(function (e) {
    if ($(this).val().length == 0) {
        $('#job_vehicle').val('');
        $('#job_product_sugg').val('');
        $('#job_product').val('');
        $('#job_product_sugg').attr('readonly', 'readonly');
    }
});


jobVehiclesTempMap.change(function (e) {
    $('#job_product_sugg').val('');
    $('#job_product').val('');
    var tempId = jobVehiclesTempMap[$('#job_vehicle_suggetions').val()];
    if (tempId != undefined) {
        $('#job_vehicle').val(tempId);
        checkJobPrimaryDetailsFilled();
        $('#job_product_sugg').removeAttr('readonly');
    }
});

$('#job_date').val(todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2));

function refreshJobCode() {
    $.ajax({
        type: "GET",
        url: "/job/next/code",
        success: function (response) {
            $('#job_code').val(response);
        }
    });
}

$('#job_code').ready(function () {
    refreshJobCode();
    loadExpences();
});

var jobBinLocationsTempMap = {};
var jobBinLocationsTempMap = $('#bin_location_suggetion').typeahead({
    source: function (query, process) {
        return $.get('/binlocations/get/suggetions/' + $('#job_location_id').val(), {
            query: query,
        }, function (data) {
            jobBinLocationsTempMap = {};
            data.forEach(element => {
                jobBinLocationsTempMap[element['name']] = element['id'];
            });

            return process(data);
        });
    }
});
$('#bin_location_suggetion').keyup(function (e) {
    if ($(this).val().length == 0) {
        $('#job_bin_location').val('');
    }
});
jobBinLocationsTempMap.change(function (e) {
    var tempId = jobBinLocationsTempMap[$('#bin_location_suggetion').val()];
    if (tempId != undefined) {
        $('#job_bin_location').val(tempId);
    }
});

var jobProductTempMap = {};
var jobProductTempMap = $('#job_product_sugg').typeahead({
    source: function (query, process) {
        return $.get('/products/suggesions/' + $('#job_vehicle').val(), {
            query: query,
        }, function (data) {
            jobProductTempMap = {};
            data.forEach(element => {
                jobProductTempMap[element['name']] = element['id'];
            });

            return process(data);
        });
    }
});
$('#job_product_sugg').keyup(function (e) {
    if ($(this).val().length == 0) {
        $('#job_product').val('');
    }
});

jobProductTempMap.change(function (e) {
    var tempId = jobProductTempMap[$('#job_product_sugg').val()];
    if (tempId != undefined) {
        $('#job_product').val(tempId);
    }
});

function checkJobPrimaryDetailsFilled() {
    if ($('#job_location_id').val() == '' || $('#job_vehicle').val() == '') {
        $('#jobprimarydata :input').removeAttr('readonly');
        $('.consthidden').attr('readonly', '');
    } else {
        $('#jobprimarydata :input').attr('readonly', '');
    }
    $('#job_remark').removeAttr('disabled');
    $('#job_remark').removeAttr('readonly');
}

var job_jhpc_btn = $('#job_jhpc_btn');
var job_oxc_btn = $('#job_oxc_btn');

var bin_location_suggetion = $('#bin_location_suggetion');
var job_bin_location = $('#job_bin_location');
var job_product_sugg = $('#job_product_sugg');
var job_product = $('#job_product');
var job_unit_labour_cost = $('#job_unit_labour_cost');
var job_qty = $('#job_qty');
var job_vat = $('#job_vat');
var job_sub_total = $('#job_sub_total');
var job_net_total = $('#job_net_total');

var job_add_expenses_button = $('#job_add_expenses_button');
var job_add_button = $('#job_add_button');
var job_sessionclear_button = $('#job_sessionclear_button');

var job_register_product_table = $('#job_register_product_table');

job_jhpc_btn.click(function (e) {
    e.preventDefault();
    clearInputs([bin_location_suggetion, job_bin_location, job_product_sugg, job_product, job_unit_labour_cost, job_qty, job_vat, job_sub_total, job_net_total]);
});

job_unit_labour_cost.add(job_qty).add(job_vat).keyup(function (e) {
    e.preventDefault();
    if (job_unit_labour_cost.val() && job_qty.val()) {
        job_sub_total.val((Number(job_unit_labour_cost.val()) * Number(job_qty.val())).toFixed(2));
        if (job_vat.val()) {
            job_net_total.val(((Number(job_sub_total.val())) * (100 + Number(job_vat.val())) / 100).toFixed(2));
        } else {
            job_net_total.val(job_sub_total.val());
        }
    } else {
        job_sub_total.val('');
        job_net_total.val('');
    }
});

var job_exp_name = $('#job_exp_name');
var job_exp_ref = $('#job_exp_ref');
var job_exp_amount = $('#job_exp_amount');
var job_ref_remark = $('#job_ref_remark');

var job_outside_exp_list = $('#job_outside_exp_list');

var jobExpensesDetailsArray = [];

job_oxc_btn.click(function (e) {
    e.preventDefault();
    jobExpensesDetailsArray = [];
    clearInputs([job_exp_name, job_exp_ref, job_exp_amount, job_ref_remark]);
    loadExpences();
});

job_sessionclear_button.click(function (e) {
    e.preventDefault();
    job_add_expenses_button.click();
    job_oxc_btn.click();
    Notiflix.Confirm.Show('Confirmation', 'Are you sure to clear job data?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/job/session/clear",
            success: function (response) {
                Notiflix.Notify.Success('Data Cleared Successfully.');
            }
        });
    }, function () {});
});

job_add_expenses_button.click(function (e) {
    e.preventDefault();
    if (job_exp_name.val() && job_exp_amount.val()) {
        jobExpensesDetailsArray.push([job_exp_name.val(), job_exp_ref.val(), job_exp_amount.val(), job_ref_remark.val()]);
        loadExpences();
        clearInputs([job_exp_name, job_exp_ref, job_exp_amount, job_ref_remark]);
        job_exp_name.focus();
    } else {
        Notiflix.Notify.Warning('Required expences fields cannot be empty.');
    }
});

function loadExpences() {
    clearExpencesTable();
    var index = 0;
    if (jobExpensesDetailsArray.length > 0) {
        jobExpensesDetailsArray.forEach(element => {
            var tr = $('<tr></tr>');
            tr.append($('<td>' + (Number(index) + 1) + '</td>').addClass('py-1 align-middle'));
            tr.append($('<td>' + element[0] + '</td>').addClass('py-1 align-middle'));
            tr.append($('<td>' + ((element[1] != null) ? element[1] : '') + '</td>').addClass('py-1 align-middle'));
            tr.append($('<td>' + element[2] + '</td>').addClass('py-1 align-middle'));
            var div1 = $('<div></div>');
            div1.addClass('input-group flex-nowrap');
            var div2 = $('<div></div>');
            div2.addClass('m-1');
            var btn1 = $('<button style="margin-right:5px;">View</button>').addClass('btn btn-round btn-default btn-sm').attr('title', 'View').attr('onclick', 'viewFromExpenseArray(' + index + ')');
            var btn2 = $('<button>Delete</button>').addClass('btn btn-round btn-default btn-sm').attr('title', 'Remove').attr('onclick', 'removeFromExpenseArray(' + index + ')');
            tr.append($('<td></td>').addClass('py-1 align-middle').append(btn1).append(btn2));
            job_outside_exp_list.append(tr);
            index++;
        });
    } else {
        var tr = $('<tr></tr>');
        tr.append($('<td></td>').attr('colspan', '5').addClass('py-1 align-middle text-center').append($('<small>No Outside Expenses</small>').addClass('text-danger py-3')));
        job_outside_exp_list.append(tr);
    }
}

function removeFromExpenseArray(index) {
    jobExpensesDetailsArray.splice(index, 1);
    loadExpences();
}

function viewFromExpenseArray(index) {
    job_exp_name.val(jobExpensesDetailsArray[index][0]);
    job_exp_ref.val(jobExpensesDetailsArray[index][1]);
    job_exp_amount.val(jobExpensesDetailsArray[index][2]);
    job_ref_remark.val(jobExpensesDetailsArray[index][3]);
}

function clearExpencesTable() {
    job_outside_exp_list.html('');
}

job_add_button.click(function (e) {
    e.preventDefault();
    if (isNotEmpty([
            [job_bin_location, bin_location_suggetion],
            [job_product, job_product_sugg], job_unit_labour_cost, job_qty
        ])) {
        $data = {
            'bin': job_bin_location.val(),
            'product': job_product.val(),
            'lcost': job_unit_labour_cost.val(),
            'qty': job_qty.val(),
            'vat': job_vat.val(),
            'expenses': jobExpensesDetailsArray,
        };

        $.ajax({
            type: "GET",
            url: "/job/session/add",
            data: $data,
            success: function (response) {
                job_jhpc_btn.click();
                job_oxc_btn.click();
                bin_location_suggetion.focus();
                innerJobRecordsDataTable.ajax.reload(null, false);
            },
            error: function (err) {
                if (err.status == 422) {
                    Notiflix.Notify.Warning(err.responseJSON.message);
                } else {
                    Notiflix.Notify.Warning('Something Wrong');
                }
            }
        });
    } else {
        Notiflix.Notify.Warning('Required fields cannot be empty.');
    }
});

var innerJobRecordsDataTable = job_register_product_table.DataTable({
    ajax: {
        url: '/job/session/table/get',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function jobViewEditSession(index) {

    $.ajax({
        type: "GET",
        url: "/job/session/get/" + index,
        success: function (response) {
            var data = JSON.parse(response);
            bin_location_suggetion.val(data[0].bin_location_name);
            job_bin_location.val(data[0].id);
            job_product_sugg.val('(' + data[1].code + ') - ' + data[1].name);
            job_product.val(data[1].id);
            job_unit_labour_cost.val(data[2]);
            job_qty.val(data[3]);
            job_vat.val(data[4]);
            jobExpensesDetailsArray = data[5];
            loadExpences();

            if (job_unit_labour_cost.val() && job_qty.val()) {
                job_sub_total.val((Number(job_unit_labour_cost.val()) * Number(job_qty.val())).toFixed(2));
                if (job_vat.val()) {
                    job_net_total.val(((Number(job_sub_total.val())) * (100 + Number(job_vat.val())) / 100).toFixed(2));
                } else {
                    job_net_total.val(job_sub_total.val());
                }
            } else {
                job_sub_total.val('');
                job_net_total.val('');
            }
        }
    });
}

function jobRemoveSession(index) {
    $.ajax({
        type: "GET",
        url: "/job/session/remove/" + index,
        success: function (response) {
            innerJobRecordsDataTable.ajax.reload(null, false);
        }
    });
}

var job_table = $('#jobDataTable');

var jobRecordsDataTable = job_table.DataTable({
    ajax: {
        url: '/job/table/get',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var job_code = $('#job_code');
var job_date = $('#job_date');
var job_location = $('#job_location_id');
var job_vehicle_sugg = $('#job_vehicle_suggetions');
var job_vehicle_id = $('#job_vehicle');
var job_remark = $('#job_remark');

var job_modal_save_complete = $('#jobsaveandcompletebtn');
var job_modal_delete_all = $('#jobdeleteall');
var job_approve = $('#jobapprove');
var job_refuse = $('#job_refuse');
var jobprintbtn = $('#jobprintbtn');

job_approve.click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/job/approve/" + $('#formkey').val(),
        success: function (response) {
            $("#modal").removeClass("in");
            $(".modal-backdrop").remove();
            $('#modal').modal('toggle');
            jobRecordsDataTable.ajax.reload(null, false);
            Notiflix.Notify.Success('Job Approved Successfully.');
            refreshStatistics();
        }
    });
});

job_refuse.click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/job/refused/" + $('#formkey').val(),
        success: function (response) {
            $("#modal").removeClass("in");
            $(".modal-backdrop").remove();
            $('#modal').modal('toggle');
            jobRecordsDataTable.ajax.reload(null, false);
            Notiflix.Notify.Failure('Job Refused Successfully.');
            refreshStatistics();
        }
    });
});

$('#jonrecords_refresh').click(function (e) {
    e.preventDefault();
    jobRecordsDataTable.ajax.reload(null, false);
});


$('.job_modal_button').click(function (e) {
    e.preventDefault();
    innerJobRecordsDataTable.ajax.reload(null, false);
    $('#job_date').val(todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2));
    job_vehicle_sugg.val('');
    refreshJobCode();
    loadExpences();
    job_vehicle_sugg.removeAttr('readonly');
    job_product_sugg.attr('readonly', true);
    job_vehicle_id.val('');
    job_modal_save_complete.show();
    job_modal_delete_all.show();
    job_approve.hide();
    job_refuse.hide();
    jobprintbtn.hide();
    job_jhpc_btn.click();
    job_oxc_btn.click();

    $.ajax({
        type: "GET",
        url: "/job/session/clear",
        success: function (response) {
            innerJobRecordsDataTable.ajax.reload(null, false);
            $('#modal').modal('show');
        }
    });
});

$('#job_modal_reset_button').click(function (e) {
    e.preventDefault();
    innerJobRecordsDataTable.ajax.reload(null, false);
    $('#job_date').val(todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2));
    job_vehicle_sugg.val('');
    refreshJobCode();
    loadExpences();
    job_vehicle_sugg.removeAttr('readonly');
    job_product_sugg.attr('readonly', true);
    job_vehicle_id.val('');
    job_modal_save_complete.show();
    job_modal_delete_all.show();
    job_approve.hide();
    job_refuse.hide();
    job_jhpc_btn.click();
    job_oxc_btn.click();

    $('formconfig').val('enroll');
    $('formkey').val('enroll');

    $.ajax({
        type: "GET",
        url: "/job/session/clear",
        success: function (response) {
            innerJobRecordsDataTable.ajax.reload(null, false);
        }
    });
});

function viewJob(id) {

    $.ajax({
        type: "GET",
        url: "/job/session/load/" + id,
        success: function (response) {
            $('#job_form').trigger("reset");
            job_code.val(response['code']);
            job_date.val(response['date']);
            job_location.val(response['location']);
            job_vehicle_sugg.attr('readonly', true);
            job_product_sugg.removeAttr('readonly');
            job_vehicle_sugg.val(response['vehicle_data']['model'] + '(' + response['vehicle_data']['brand'] + ')');
            job_vehicle_id.val(response['vehicle']);
            job_remark.val(response['remark']);
            innerJobRecordsDataTable.ajax.reload(null, false);
            job_modal_save_complete.hide();
            job_modal_delete_all.hide();
            jobprintbtn.show();
            jobprintbtn.attr('onclick', 'printJob(' + response['id'] + ')');
            if (response['status'] != 1) {
                job_approve.show();
            } else {
                job_approve.hide();
            }

            if (response['status'] == 1) {
                job_refuse.hide();
            } else {
                job_refuse.show();
            }
            $('#modal').modal('show');
            $('#formconfig').val('update');
            $('#formkey').val(response['id']);
        }
    });
}


function editJob(id) {
    $.ajax({
        type: "GET",
        url: "/job/session/load/" + id,
        success: function (response) {
            $('#job_form').trigger("reset");
            job_code.val(response['code']);
            job_date.val(response['date']);
            job_location.val(response['location']);
            job_vehicle_sugg.attr('readonly', true);
            job_product_sugg.removeAttr('readonly');
            job_vehicle_sugg.val(response['vehicle_data']['model'] + '(' + response['vehicle_data']['brand'] + ')');
            job_vehicle_id.val(response['vehicle']);
            job_remark.val(response['remark']);
            innerJobRecordsDataTable.ajax.reload(null, false);
            job_modal_save_complete.show();
            job_modal_delete_all.show();
            jobprintbtn.hide();
            if (response['status'] != 1) {
                job_approve.show();
            } else {
                job_approve.hide();
            }

            if (response['status'] == 1) {
                job_refuse.hide();
            } else {
                job_refuse.show();
            }
            $('#modal').modal('show');
            $('#formconfig').val('update');
            $('#formkey').val(response['id']);
        }
    });
}

function refreshStatistics() {
    $.ajax({
        type: "GET",
        url: "/job/statistics",
        success: function (response) {
            $('#job_pending_count1').html(response[2][0]);
            $('#job_pending_count11').html(response[2][1]);
            $('#job_pending_count2').html(response[0][0]);
            $('#job_pending_count22').html(response[0][1]);
            $('#job_pending_count3').html(response[1][0]);
            $('#job_pending_count33').html(response[1][1]);
        }
    });
}

function printJob(id) {
    Notiflix.Confirm.Show('Print', 'Do you sure to print this report?', 'Yes', 'No', function () {
        $.ajax({
            type: "GET",
            url: "/job/get/print/" + id,
            success: function (response) {
                if (response == 2) {
                    Notiflix.Notify.Warning('Something Wrong.');
                } else {
                    printReport(response);
                }
            }
        });
    }, function () {});
}

//END Functions - JOB

//START Functions - TRANSFER

$('.transfer_modal_button').click(function (e) {
    e.preventDefault();
    $('#modal').modal('show');
});

var transfer_modal_from = $('#transfer_location_from');
var transfer_modal_to = $('#transfer_location_to');

transfer_modal_from.add(transfer_modal_to).change(function (e) {
    e.preventDefault();
    if (transfer_modal_from.val() == transfer_modal_to.val() && transfer_modal_from.val() !== 'none' && transfer_modal_to.val() !== 'none') {
        $(this).val('none');
        Notiflix.Notify.Failure('Please select deferrent locations.');
    }
});

//END Functions - TRANSFER
