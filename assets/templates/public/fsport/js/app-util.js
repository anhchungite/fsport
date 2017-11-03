var util = {};
util.func = {};
util.func.ucFirst = function(string) {
    return string[0].toUpperCase() + string.slice(1);
};
$(function () {
    // Notification
    $.notify.defaults({
        autoHideDelay: 3000,
        globalPosition: 'bottom right',
        style: 'bootstrap',
        // default class (string or [string])
        className: 'success',
        // showAnimation: 'slideDown',
        // // show animation duration
        // showDuration: 00,
        // hide animation
        hideAnimation: 'fadeOut',
        // hide animation duration
        hideDuration: 400,
    });

    if (!$("input#shipping_address").prop('checked')) {
        $('div.shipping').find('.ship').removeAttr('disabled')
        $('div.shipping').show();
    } else {
        $('div.shipping').find('.ship').attr('disabled', 'disabled')
        $('div.shipping').hide();
    }
    $(document).on('click', "input#shipping_address", function () {
        if (!$("input#shipping_address").prop('checked')) {
            $('div.shipping').find('.ship').removeAttr('disabled')
            $('div.shipping').show('slow');
        } else {
            $('div.shipping').find('.ship').attr('disabled', 'disabled')
            $('div.shipping').hide('slow');
        }
        // $('div.shipping').toggle('slow');
        // console.log($('div.shipping').css('display'));
        // if($('div.shipping').show()){
        //     $('div.shipping').find('.ship').removeAttr('disabled')
        // }else {
        //     $('div.shipping').find('.ship').attr('disabled','disabled')
        // }
        // $('div.shipping').find('.ship').attr('disabled',function (index, attr) {
        //     return attr == 'disabled'? null:'disabled';
        //
        // });
    });
    // Autocomplete
    $("#search_input").keyup(function () {
        var txtLength = $("#search_input").val().length;
        if (txtLength >= 2) {
            $.ajax({
                url: "/search",
                dataType: "json",
                type: 'post',
                data: {
                    term: $("#search_input").val()
                },
                success: function (data) {
                    if (data.length > 0) {
                        $(".search_result").fadeIn();
                        var html = "";
                        for (x in data) {
                            html += "<li><a href='#" + data[x]['id'] + "'>" + data[x]['label'] + "</a></li>";
                        }
                        $(".search_result ul").html(html);

                    } else {
                        $(".search_result").hide();
                    }
                },
                error: function () {
                    alert("Lỗi tìm kiếm!");
                }
            });
        } else {
            $(".search_result").hide();
        }
    });
});