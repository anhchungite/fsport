simpleCart.ready(function () {
    //$('.simpleCart_items table').addClass("table");
    simpleCart.bind("afterCreate", function () {
        $cart_table = $(".simpleCart_items table")
        $cart_table.find('th.item-quantity').attr({
            'colspan': '3',
            'style': 'text-align: center'
        });
        $cart_table.find('td.item-increment').attr({
            'style': 'text-align: center'
        });
        $cart_table.find('td.item-quantity').attr({
            'style': 'text-align: center'
        });
        $cart_table.find('td.item-decrement').attr({
            'style': 'text-align: center'
        });
        $cart_table.find('td.item-remove').attr({
            'style': 'text-align: center'
        });
        $cart_table.find('td.item-thumb img').addClass('img-responsive img-rounded');
        $cart_table.find('a.simpleCart_increment').addClass('entry value-plus active');
        $cart_table.find('a.simpleCart_decrement').addClass('entry value-plus active');


    });
    simpleCart.bindInputs([{
        selector: 'select',
        event: 'change',
        callback: function () {
            var $input = simpleCart.$(this),
                $parent = $input.parent(),
                classList = $parent.attr('class').split(" ");
            simpleCart.each(classList, function (klass) {
                if (klass.match(/item-.+/i)) {
                    var field = klass.split("-")[1];
                    var ud = simpleCart.find($parent.closest('.itemRow').attr('id').split("_")[1]).set(field, $input.val());
                    simpleCart.update();
                    simpleCart.load();
                    return;
                }
            });

        }
    }]);
    

});

$(function(){
    simpleCart.currency({
        code: "VND",
        name: "Viet nam dong",
        symbol: " VND",
        delimiter: ".",
        decimal: " ",
        after: true,
        accuracy: 0
    });
    simpleCart({
        checkout: {
            type: "SendForm",
            url: window.location.origin + '/cart',
            method: "POST",
            //success: "checkout.html"
        },
        cartStyle: "table",
        cartColumns: [{
                view: function () {
                    var rows = $('tr.itemRow');
                    return rows.length;
                },
                attr: "stt",
                label: "STT"
            },
            {
                view: 'image',
                attr: 'thumb',
                label: "Sản phẩm"
            },
            {
                attr: "name",
                label: "Tên sản phẩm"
            },
            {
                view: function select(item, column) {

                    var html = "";
                    html += "<select class='" + "simpleCart_select form-control'>";
                    var size = item.get('arrsize');
                    size = JSON.parse(size);
                    if (item.get(column.attr) == undefined) {
                        item.set(column.attr, size[1]);
                    }

                    for (x in size) {
                        if (x > 0) {
                            var selected = "";
                            if (size[x] == item.get(column.attr)) {
                                selected = " selected";
                            }
                            html += "<option value='" + size[x] + "'" + selected + ">";
                            html += size[x];
                            html += "</option>";
                        }
                    }
                    html += "</select>";

                    return html;

                },

                attr: "size",
                label: "Kích cỡ"
            },
            {
                view: function select(item, column) {

                    var html = "";
                    html += "<select class='" + "simpleCart_select form-control'>";
                    var color = item.get('arrcolor');
                    color = JSON.parse(color);
                    if (item.get(column.attr) == undefined) {
                        item.set(column.attr, color[0]);
                    }

                    for (x in color) {

                        // if(x > 0){
                        var selected = "";
                        if (color[x] == item.get(column.attr)) {
                            selected = " selected";
                        }
                        html += "<option value='" + color[x] + "'" + selected + ">";
                        html += util.func.ucFirst(color[x]);
                        html += "</option>";
                        //x}
                    }
                    html += "</select>";

                    return html;

                },
                attr: "color",
                label: "Màu sắc"
            },
            {
                attr: "price",
                label: "Đơn giá",
                view: 'currency'
            },
            {
                view: "decrement",
                label: false,
                text: "-"
            },
            {
                attr: "quantity",
                label: "Số lượng"
            },
            {
                view: "increment",
                label: false,
                text: "+"
            },
            {
                attr: "total",
                label: "Tổng",
                view: 'currency'
            },
            {
                view: "remove",
                text: "Xóa",
                label: false
            },

        ]
    });
})