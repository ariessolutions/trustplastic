var tempAjaxRun = true;

Notiflix.Loading.Init({
    fontFamily: "Quicksand",
    useGoogleFont: true,
});

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
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
                url: "/vehicles/next",
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
                url: "/vehicles/next",
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

function productsCodeFetch(proNameVal){
    if (proNameVal && proNameVal.replace('-','').replace(' ','').toUpperCase().length > 1 && $('#products_vehicle_code_result').val()) {
        $.ajax({
            type: "GET",
            url: "/vehicles/next/data/"+$('#products_vehicle_code_result').val(),
            success: function (response) {
                $('#product_code').val(response.code + '/' + proNameVal.replace('-','').replace(' ','').toUpperCase().substring(0, 2) + '/' + pad(response.id, 3));
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
