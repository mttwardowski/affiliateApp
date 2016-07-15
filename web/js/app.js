/**
 * jQuery Handler for dynamic changes in Affiliate App
 *
 * @version 1.0
 * @author Matt Twardowski <mttwardowski@gmail.com>
 */




$(function(){
    $('#productModal').modal({
        keyboard: true,
        backdrop: "static",
        show: false,

    }).on('show.bs.modal', function(e){ //subscribe to show method
        console.log("HEREEEE");
        var getIdFromRow = e.relatedTarget.dataset.id;
        $(this).find('#productDetails').html($('<p> Product Invoice Page: http://localhost:8000/invoice/' + getIdFromRow  + '</p>'))
    });
});

function delete_product(product_id) {
    $.ajax({
        type: "POST",
        url: "/delete_product/" + product_id,
        error: function(e) {
            console.log(e);
            $.notify("Something Went Wrong", "error");
        },
        success: function(response) {
            $.notify("Product Deleted", "success");
        }
    });
}

function acceptAffiliateRequest(request_id) {
    $.ajax({
        type: "POST",
        url: "/accept_request/" + request_id,
        error: function(e) {
            console.log(e);
            $.notify("Something Went Wrong", "error");
        },
        success: function(response) {
            $.notify("Request Accepted", "success");
        }
    });
}

function denyAffiliateRequest(request_id) {
    $.ajax({
        type: "POST",
        url: "/deny_request/" + request_id,
        error: function(e) {
            console.log(e);
            $.notify("Something Went Wrong", "error");
        },
        success: function(response) {
            $.notify("Request Denied", "success");
        }
    });
}