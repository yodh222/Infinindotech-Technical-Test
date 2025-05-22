$(document).ready(function () {
    function getAllSelectedProductIds() {
        const ids = [];
        $('.custom-select-hidden input[name="product_id[]"]').each(function () {
            ids.push($(this).val());
        });
        return ids;
    }

    window.initCustomSelect = function ($container, enableTagging = true) {
        const $input = $container.find(".custom-select-input");
        const $dropdown = $container.find(".custom-select-dropdown");
        const $tags = $container.find(".custom-select-tags");
        const $hidden = $container.find(".custom-select-hidden");
        const inputName = $container.data("name");

        let selected = [];

        function renderTags() {
            if (!enableTagging) return;

            $tags.empty();
            $hidden.empty();

            selected.forEach((item) => {
                $tags.append(`
                    <span class="flex items-center gap-1 px-2 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 shadow-sm">
                        ${item.text}
                        <button type="button" class="text-blue-500 hover:text-red-500 dark:hover:text-red-400 dark:text-blue-300 remove-tag" data-id="${item.id}">
                            &times;
                        </button>
                    </span>
                `);
                $hidden.append(
                    `<input type="hidden" name="${inputName}" value="${item.id}">`
                );
            });
        }

        $input.on("input focus", function () {
            const query = $(this).val().toLowerCase();
            const globalSelected = getAllSelectedProductIds();
            $dropdown.removeClass("hidden");

            $dropdown.children("li").each(function () {
                const text = $(this).text().toLowerCase();
                const id = $(this).data("id").toString();

                const alreadySelected = selected.find((item) => item.id === id);
                const globallySelected =
                    globalSelected.includes(id) && !alreadySelected;

                $(this).toggle(
                    text.includes(query) &&
                        (!enableTagging || !alreadySelected) &&
                        !globallySelected
                );
            });
        });

        $dropdown.on("click", "li", function () {
            const text = $(this).text().trim();
            const id = $(this).data("id").toString();

            if (enableTagging) {
                if (!selected.find((item) => item.id === id)) {
                    selected.push({ id, text });
                    renderTags();
                }
                $input.val("");
            } else {
                $input.val(text);
                $hidden.html(
                    `<input type="hidden" name="${inputName}" value="${id}">`
                );
            }

            $dropdown.addClass("hidden");
        });

        $tags.on("click", ".remove-tag", function () {
            const id = $(this).data("id");
            selected = selected.filter((item) => item.id !== id);
            renderTags();
        });

        $(document).on("click", function (e) {
            if (!$(e.target).closest($container).length) {
                $dropdown.addClass("hidden");
            }
        });
    };

    // Init awal
    $("[data-select-tag]").each(function () {
        initCustomSelect($(this), true);
    });

    $("[data-select-search]").each(function () {
        initCustomSelect($(this), false);
    });

    // Duplikasi Row Input Produk
    const $container = $("#product-container");

    function addRow() {
        const newRow = $container
            .children("[data-product-row]")
            .first()
            .clone();

        newRow.find("input").val("");
        newRow.find(".custom-select-tags, .custom-select-hidden").empty();

        newRow.find('input[name="jumlah_dibeli[]"]').removeAttr("required");

        $container.append(newRow);

        newRow
            .find("[data-select-tag], [data-select-search]")
            .each(function () {
                const isTagging = $(this).is("[data-select-tag]");
                initCustomSelect($(this), isTagging);
            });
    }

    function checkLastRowAndAdd() {
        const $lastRow = $container.children("[data-product-row]").last();
        const productFilled = $lastRow
            .find('.custom-select-hidden input[name="product_id[]"]')
            .val();
        const qty = $lastRow.find('input[name="jumlah_dibeli[]"]').val();

        if (productFilled && qty) {
            addRow();
        }
    }

    $container.on("input", "input", function () {
        checkLastRowAndAdd();
    });
});

$(document).ready(function () {
    $(".delete-button").on("click", function () {
        const productId = $(this).data("id");
        const productName = $(this).data("no_faktur");

        $("#delete-order-form").attr("action", "/orders/" + productId);
        $("#order-name").text(productName);
    });
});

$(document).on("click", ".edit-button", function () {
    let id = $(this).data("id");
    let nama = $(this).data("no_faktur");

    $("#edit-order-form").attr("action", "/orders/" + id);
    $("#order-edit-name").text(nama);
});
