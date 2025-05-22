$(document).ready(function () {
    $(".delete-button").on("click", function () {
        const customerId = $(this).data("id");
        const customerName = $(this).data("name");

        $("#delete-customer-form").attr("action", "/customers/" + customerId);
        $("#customer-name").text(customerName);
    });
});

$(document).on("click", ".edit-button", function () {
    let id = $(this).data("id");
    let nama = $(this).data("nama");
    let no_telp = $(this).data("no_telp");
    let email = $(this).data("email");
    let alamat = $(this).data("alamat");

    $("#customer-edit-form").attr("action", "/customers/" + id);
    $("#edit-id").val(id);
    $("#edit-nama").val(nama);
    $("#edit-no_telp").val(no_telp);
    $("#edit-email").val(email);
    $("#edit-alamat").val(alamat);
});
