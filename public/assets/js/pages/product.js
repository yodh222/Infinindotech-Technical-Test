$(document).ready(function () {
    $(".delete-button").on("click", function () {
        const productId = $(this).data("id");
        const productName = $(this).data("nama");

        $("#delete-product-form").attr("action", "/products/" + productId);
        $("#product-name").text(productName);
    });
});

$(document).on("click", ".edit-button", function () {
    let id = $(this).data("id");
    let nama = $(this).data("nama");
    let harga = $(this).data("harga");
    let stok = $(this).data("stok");

    $("#product-edit-form").attr("action", "/products/" + id);
    $("#edit-id").val(id);
    $("#edit-nama").val(nama);
    $("#edit-harga").val(harga);
    $("#edit-stok").val(stok);
});

$(document).ready(function () {
    function formatNumber(value) {
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function unformatNumber(value) {
        return value.replace(/\./g, "");
    }

    $("#harga, #edit-harga").on("keypress", function (e) {
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    $("#harga, #edit-harga").on("paste", function (e) {
        const clipboardData = e.originalEvent.clipboardData.getData("text");
        if (!/^\d+$/.test(clipboardData.replace(/\./g, ""))) {
            e.preventDefault();
        }
    });

    $("#harga, #edit-harga").on("input", function () {
        let input = $(this);
        let unformatted = unformatNumber(input.val());

        if (!/^\d*$/.test(unformatted)) return;

        let formatted = formatNumber(unformatted);

        input.val(formatted);
    });

    $("form").on("submit", function (e) {
        const hargaInput = $(this).find('input[name="harga"]');
        if (hargaInput.length) {
            hargaInput.val(hargaInput.val().replace(/\./g, ""));
        }
    });
});
