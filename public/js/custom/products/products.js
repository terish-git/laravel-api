function fetch_data(page) {
    var page = page == null ? $("#hidden_page").val() : page;
    $.ajax({
        url: "/products/fetch_data?page=" + page,
        success: function (data) {
            $("tbody").html("");
            $("tbody").html(data);
        },
    });
}

$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    var page = $(this).attr("href").split("page=")[1];
    $("li").removeClass("active");
    $(this).parent().addClass("active");
    fetch_data(page);
});

if ($("#updateProductsForm").length > 0) {
    validator = $("#updateProductsForm").validate({
        rules: {
            name: {
                required: true,
            },
            sku: {
                required: true,
            },
            price: {
                required: true,
                // digits:true,
                priceFormat: true,
            },
        },
        messages: {
            name: {
                required: "Please enter product name",
            },
            sku: {
                required: "Please enter product sku",
            },
            price: {
                required: "Please enter product price",
                digits: "Please enter a valid input",
            },
        },
    });
}

jQuery.validator.addMethod(
    "priceFormat",
    function (value, element) {
        return this.optional(element) || /^\d+(\.\d{1,2})?$/gim.test(value);
    },
    "Please enter a valid price"
);

$(document).on("click", ".delete-product", function (e) {
    e.preventDefault();
    var productId = $(this).data("id");
    swal({
        title: "Do you want to delete product?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: "products" + "/" + productId,
                success: function (data) {
                    if (data.error == true) {
                        swal({ text: data.message, icon: "error" });
                    } else {
                        swal(data.message);
                        setTimeout(function () {
                            location.reload();
                          }, 1000);
                        
                    }
                },
                error: function (data) {
                    alert("Error!");
                },
            });
        }
    });
});