
$(document).ready(function () {
    $('.btn-plus').on('click', function (e) {
        e.preventDefault();

        var inc_value = $(this).closest('.quy-input').find('.qty').val();
        // var artAmt = $(this).closest('.quy-input').find('.qty').data('art-amt');
        // console.log(artAmt);
        // var maxval = parseInt(artAmt,10);
        var value = parseInt(inc_value,10);
        value = isNaN(value) ? 0 : value;
        if(value < 10 )
        {
            value++;
            $(this).closest('.quy-input').find('.qty').val(value);
        var artAmt = $(this).closest('.quy-input').find('.qty').data('art-amt');
        
        var artId = $(this).closest('.quy-input').find('.qty').data('art-id');
            
        updateCartItem(artId, value, artAmt);
        }
    });
});
$(document).ready(function () {
    $('.btn-minus').on('click', function (e) {
        e.preventDefault();

        var decvl = $(this).closest('.quy-input').find('.qty').val();
        var val = parseInt(decvl,10);
        newval = isNaN(val) ? 0 : val;
        var minvl = 1;
        if (newval > minvl){
        newval--;
        $(this).closest('.quy-input').find('.qty').val(newval);
        var artId = $(this).closest('.quy-input').find('.qty').data('art-id');
        var artAmt = parseFloat($(this).closest('.quy-input').find('.qty').data('art-amt'));
            
        updateCartItem(artId, newval, artAmt);
        }
    });
});



// function incrementQty(artId, artAmt) {
//     var qtyInput = document.getElementById('art_qty_' + artId);
//     var currentQty = parseInt(qtyInput.value);
//     var maxQty = parseInt(qtyInput.getAttribute('max'));

//     if (currentQty < maxQty) {
//         qtyInput.value = currentQty + 1;
//         updateCartItem(artId, currentQty + 1, artAmt);
//     }
// }

// function decrementQty(artId, artAmt) {
//     var qtyInput = document.getElementById('art_qty_' + artId);
//     var currentQty = parseInt(qtyInput.value);

//     if (currentQty > 1) {
//         qtyInput.value = currentQty - 1;
//         updateCartItem(artId, currentQty - 1, artAmt);
//     }
// }

function updateCartItem(artId, newQty, artAmt) {
    // 
    var total = newQty * artAmt;

    $.ajax({
        url: 'update_cart.php',
        method: 'POST',
        data: {
            'art_id': artId,
            'qty': newQty
        },
        dataType: 'json',
        success: function(data) {
            
            $('#total_price_' + artId).text(total),

            
            $('#subtotal').text('₹' + data.subtotal),
            $('#shipping').text('₹' + data.shipping),
            $('#total').text('₹' + data.total)
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
