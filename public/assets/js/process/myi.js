$('#added_material_list').DataTable();

$('#mr_modal').click(function (e) {
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/mr/init",
        success: function (response) {

            $('#mr_created_jobs').html('');

            var row_data = '';
            for (let i = 0; i < response["products"].length; i++) {

                row_data += '<div>' +
                    '<div class="list-group-item d-flex ps-3 border-0 shadow-sm mb-3">' +
                    '<div class="me-3">' +
                    '<i class="fa fa-cube fa-fw fa-lg" style="color:#212121" ></i>' +
                    '</div>' +
                    '<div class="flex-fill">' +
                    '<div class="font-weight-600 text-dark">' + response["products"][i]['code'] + '</div>' +
                    '<div class="fs-13px text-muted mb-2">' +
                    '<span>' + response["products"][i]['name'] + '</span>' +
                    '<br>' +
                    '<span>Brand : ' + response["products"][i]['brand'] + ' (' + response["products"][i]['model'] + ') ' + '</span>' +
                    '</div>' +
                    '<div class="mb-1">' +
                    '<div class="input-group flex-nowrap">' +
                    '<div>' +
                    '<button class="btn btn-primary btn-sm" onclick="mr_loadProductDetails(' + response["products"][i]['id'] + ')">' +
                    '<i class="fa fa-share-square-o" aria-hidden="true"></i> Add Materials </button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

            }

            $('#mr_code').val(response["mr_code"]);
            $('#mr_job_code').html(response["job_code"]);
            $('#mr_created_jobs').html(row_data);

        }

    });

});

function mr_loadProductDetails(id) {

    $.ajax({
        type: "GET",
        url: "/mr/loadProduct",
        data: {
            id: id
        },
        success: function (response) {

            Notiflix.Notify.Info('Selected ' + response.code + ' product');

            $('#mr_selected_prodcut_code').val(response.code);
            $('#mr_selected_prodcut_id').val(response.id);

        }
    });
}

$('#mr_item_save_session_button').click(function (e) {
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/mr/itemSaveSession",
        data: {
            product_id: $('#mr_selected_prodcut_id').val(),
            item_id: $('#mr_item_id').val(),
            qty: $('#mr_item_qty').val(),
        },
        success: function (response) {

            if ($.isEmptyObject(response.error)) {
                mr_clearFields();
                mr_Table.ajax.reload(null, false);
                Notiflix.Notify.Success('Item successfully saved to session ');
            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });

});

var mr_Table = $('#mr_session_added_list').DataTable({
    ajax: {
        url: '/mr/materialsTableView',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function mr_removeItemInSession(index) {

    $.ajax({
        type: "GET",
        url: "/mr/removeItemFromSession",
        data: {
            index: index
        },
        success: function (response) {

            if (response === '1') {
                mr_Table.ajax.reload(null, false);
                Notiflix.Notify.Success('Item removed successfully from session');
            } else {
                Notiflix.Notify.Danger('Item removing error');
            }
        }
    });

}

$('#mr_save_to_db_button').click(function (e) {
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/mr/saveMaterialRequest",
        success: function (response) {
            if (response === '1') {
                $('#mr_selected_prodcut_code').val('');
                $('#mr_selected_prodcut_id').val('');
                mr_clearFields();
                mr_closeModal();
                mr_Table.ajax.reload(null, false);
                Notiflix.Notify.Success('Successfully saved material request');
            } else if (response === '2') {
                Notiflix.Danger.Danger('Invalid material request number');
            }
        }
    });

});

$('#mr_fields_delete').click(function (e) {
    e.preventDefault();

    mr_clearFields();

});

//Delete Later
$('#mr_session_product_clear').click(function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Notiflix Confirm', 'Do you agree with me?', 'Yes', 'No',
        function () {

            $.ajax({
                type: "GET",
                url: "/mr/productItemSessionClear",
                success: function (response) {
                    Notiflix.Notify.Success('Material item session successfully cleared ');
                    mr_clearFields();
                }
            });

        },
        function () {
            Notiflix.Notify.Warning('Ignored material item session remove');
        });



});

function mr_closeModal() {
    $('#modal').modal('hide');
    $("#modal").removeClass("in");
    $('#modal').modal('toggle');
}

function mr_clearFields() {
    $('#mr_item_code').val('');
    $('#mr_item_id').val('');
    $('#mr_item_qty').val('');
}

var mr_itemsDataArray = {};

var mrItemsTypeHead = $('#mr_item_code').typeahead({
    source: function (query, process) {
        return $.get("/mr/loaditem", {
            query: query,
        }, function (data) {
            mr_itemsDataArray = {};
            data.forEach(element => {
                mr_itemsDataArray[element['name']] = element['id'];
            });
            return process(data);
        });
    },
});

mrItemsTypeHead.change(function (e) {
    var tempId = mr_itemsDataArray[$('#mr_item_code').val()];
    if (tempId != undefined) {
        $('#mr_item_id').val(tempId);
    }
});



