var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');



$("#btnEdit").on("click", function () {
    $("#btnSimpan").text("Update");
    $(".form").attr("id", "edit ");
    alertDanger.hide();
    alertSukses.hide();
});

$("#txtConPasswordUser").on("blur", function() {
    var psw = document.getElementById("txtPasswordUser").value;
    var pswcnf = document.getElementById("txtConPasswordUser").value;
    if ((psw == pswcnf)) {
        $("#passwordHelp").attr("hidden", true);
    } else {
        $("#passwordHelp").attr("hidden", false);
    }
});
