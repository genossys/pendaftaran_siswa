$("#tambahModal").on("click", function() {
    $("#btnSimpan").text("Simpan");
    $(".form").attr("id", "simpan");
});

$("#editModal").on("click", function() {
    $("#btnSimpan").text("Update");
    $(".form").attr("id", "edit ");
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
