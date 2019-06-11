var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/informasi/getDataInformasi',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, sortable: false },
        { data: 'judul', name: 'judul' },
        { data: 'isi', name: 'isi' },
        { data: 'tanggal', name: 'tanggal' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ]

});

$("#tambahModal").on("click", function (e) {
    $("#btnSimpan").text("Simpan");
    $(".form").attr("id", "simpan");
    alertDanger.hide();
    alertSukses.hide();
});

function showEditModal(id, e) {
    e.preventDefault();
    $("#btnSimpan").text("Update");
    $(".form").attr("id", "edit");
    $('#modaltambahInformasi').modal('show');
    $('#txtId').val(id);
    
}

$(document).ready(function () {

    $('#btnSimpan').on('click', function (e) {
        e.preventDefault();
        var formID = $('.form').attr('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (formID == 'simpan') {
            simpanData();
        } else if (formID == 'edit') {
            editData();
            alert('oke');
        }


    });

});

function simpanData() {
    var formData = new FormData($('#simpan')[0]);
    $.ajax({
        type: 'POST',
        url: '/informasi/simpanDataInformasi',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    alertSukses.show().html('<p> Berhasil Menambahkan Informasi </p>');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert(errorThrown + xhr + textStatus);
        }

    });
}

function editData() {
    var formData = new FormData($('#edit')[0]);
    $.ajax({
        type: 'POST',
        url: '/informasi/editDataInformasi',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    alert('Berhasil Merubah Data!');
                    clearField();
                    $('#modaltambahInformasi').modal('hide');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert(errorThrown + xhr + textStatus);
        }

    });
}
