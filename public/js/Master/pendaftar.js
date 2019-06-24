var alertSukses = $(".alert-success");
var alertDanger = $(".alert-danger");

var template = Handlebars.compile($("#details-template").html());
var table = $("#example2").DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: "/pendaftaran/getDataPendaftar",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            searchable: false,
            orderable: false,
            sortable: false
        },
        { data: "username", name: "username" },
        { data: "email", name: "email" },
        { data: "nama", name: "nama" },
        { data: "status", name: "status" },
        { data: "action", name: "action", searchable: false, orderable: false }
    ]
});

$("#example2 tbody").on("click", "td a.details-control", function(e) {
    var tr = $(this).closest("tr");
    var row = table.row(tr);

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass("shown");
    } else {
        row.child(template(row.data())).show();
        tr.addClass("shown");
    }
    e.preventDefault();
});

$(document).ready(function() {
    $("#btnSimpan").on("click", function(e) {
        e.preventDefault();
        alertSukses.hide();
        alertDanger.hide();
        var formID = $(".form").attr("id");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        if (formID == "simpan") {
            simpanData();
        } else if (formID == "edit") {
            editData();
            alert("oke");
        }
    });
});

function simpanData() {
    var formData = new FormData($("#simpan")[0]);
    formData.append("idForm", "simpan");
    $.ajax({
        type: "POST",
        url: "/pendaftaran/simpanDataPendaftar",
        dataType: "JSON",
        // data: new FormData($('#simpan')[0]),
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response.valid) {
                if (response.sqlResponse) {
                    clearField();
                    alertSukses
                        .show()
                        .html(
                            "<p> Username " +
                                response.data.username +
                                " Berhasil Di Tambahkan </p>"
                        );
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                $.each(response.errors, function(key, value) {
                    alertDanger.show().append("<p>" + value + "</p>");
                });
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            alert(errorThrown + xhr + textStatus);
        }
    });
}

function editData() {
    var formData = new FormData($("#edit")[0]);
    formData.append("idForm", "edit");
    $.ajax({
        type: "POST",
        url: "/pendaftaran/editDataPendaftar",
        dataType: "JSON",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    alert("Berhasil Merubah Data!");
                    clearField();
                    $("#modaltambahSiswa").modal("hide");
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                $.each(response.errors, function(key, value) {
                    alertDanger.show().append("<p>" + value + "</p>");
                });
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            alert(errorThrown + xhr + textStatus);
        }
    });
}

$("#FormStatus").on("submit", function(e) {
    var url = $(this).attr("action");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        url: url,
        method: "POST",
        data: new FormData($("#FormStatus")[0]),
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response.sqlResponse) {
                table.draw();
                $("#modalStatus").modal("hide");
            } else {
                alert(response.sqlResponse);
            }
        },
        error: function(respoxhr, textStatus, errorThrownnse) {
            alert(respoxhr + textStatus + errorThrownnse);
        }
    });
    e.preventDefault();
});

function hapus(username, e) {
    e.preventDefault();
    if (confirm("Apakah Anda Yakin Menghapus Data " + username)) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            type: "POST",
            url: "/pendaftaran/hapusDataPendaftar",
            data: {
                _method: "DELETE",
                _token: $("input[name=_token]").val(),
                username: username
            },
            success: function(response) {
                if (response.sqlResponse) {
                    alert("Data Berhasil Di Hapus");
                    table.draw();
                } else {
                    alert(response.sqlResponse);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                alert(xhr + textStatus + errorThrown);
            }
        });
    }
}

function showStatus(user, e) {
    e.preventDefault();
    $("#txtUser").val(user);
    $("#modalStatus").modal("show");
}

function showEditModal(
    username,
    email,
    nama,
    alamat,
    tglLahir,
    cmbJenis,
    namaOrtu,
    noHp,
    e
) {
    e.preventDefault();
    $("#btnSimpan").text("Update");
    $(".form").attr("id", "edit");
    $("#modaltambahSiswa").modal("show");
    $("#txtOldUsername").val(username);
    $("#txtUsername").val(username);
    $("#txtEmail").val(email);
    $("#txtNama").val(nama);
    $("#txtAlamat").val(alamat);
    $("#dateTanggalLahir").val(tglLahir);
    if (cmbJenis == "Laki-Laki") {
        $("#cmbJenis").val("L");
    } else {
        $("#cmbJenis").val("P");
    }

    $("#txtNamaOrtu").val(namaOrtu);
    $("#txtNoTelp").val(noHp);
}

function clearField() {
    $("#txtOldUsername").val("");
    $("#txtUsername").val("");
    $("#txtEmail").val("");
    $("#txtNama").val("");
    $("#txtAlamat").val("");
    $("#dateTanggalLahir").val("");
    $("#cmbJenis").val("L");
    $("#txtNamaOrtu").val("");
    $("#txtNoTelp").val("");
    $("#txtPasswordUser").val("");
    $("#txtConPasswordUser").val("");
    $("#fileFoto").val("");
}

$("#tambahModal").on("click", function() {
    $("#btnSimpan").text("Simpan");
    $(".form").attr("id", "simpan");
    clearField();
    alertDanger.hide();
    alertSukses.hide();
});
