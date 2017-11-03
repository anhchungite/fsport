/**
 * Created by Tran Anh Chung on 6/24/2017.
 */
function updateTotal(key) {
    var tr_item = $('tr.product'+key+'');
    var qty = tr_item.find('input.in-quantity').val();
    var prc = tr_item.find('input.in-price').val();
    tr_item.find('td.td-total').text((qty * prc).toLocaleString());
}

function removeProduct(key) {
    $('tr.product'+key+'').remove();
    $('input[name="product[delete]['+key+']"]').val(1);
}