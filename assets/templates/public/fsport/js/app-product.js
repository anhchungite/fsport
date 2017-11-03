$(function(){
    $("#frm_rate").validate({
        messages: {
            rscore: {
                required: "Vui lòng cho điểm đánh giá!",
                digits: "Điểm đánh giá phải là số!"
            },
            rname: {
                required: "Vui lòng nhập Họ và tên!",
                maxlength: "Họ và tên tối đa 50 ký tự!",
            },
            rtext: {
                required: "Vui lòng nhập Nội dung!",
                minlength: "Nội dung tối thiểu 50 ký tự!",
                maxlength: "Nội dung tối đa 500 ký tự!"
            },
            remail: {
                required: "Vui lòng nhập Email!",
                email: "Email không hợp lệ"
            }
        },
        errorPlacement: function(error, element) {
            var n = element.attr("name");
            switch(n){
                case "rname":
                case "rscore":
                case "rtext":
                case "remail":
                    $(".error-"+n).append(error);
                    break;
            }
        },
        // highlight: function(element) {
        //     $(element).addClass('has_error');
        // },
        // unhighlight: function(element) {
        //     $(element).removeClass('has_error');
        // },
        submitHandler: function(form){
            $.ajax({
                data: {
                    rproduct: window.location.pathname,
                    rscore : $('input[name=rscore]').val(),
                    rname : $('input[name=rname]').val(),
                    remail : $('input[name=remail]').val(),
                    rtext : $('textarea[name=rtext]').val(),
                    btn_rate : $('input[name=btn_rate]').val()
                },
                url: "ajax/ajax_review/create",
                type: "post",
                dataType: "json",
                success: function(data){
                    if(Object.keys(data.error).length > 0){
                        for(x in data.error){
                            $(".error-"+x).addClass('error');
                            $(".error-"+x).html('<label id="'+x+'-error" class="error" for="'+x+'">'+data.error[x]+'</label>');
                        }
                    }
                    if(data.success){
                        alert(data.success);
                        $(form)[0].reset();
                    }
                },
                error: function(err){
                    alert("Lỗi khi gửi đánh giá");
                }
            });
        },
        
    });
    
});