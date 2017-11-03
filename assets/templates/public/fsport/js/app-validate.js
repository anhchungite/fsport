$(function () {
    // VALIDATE
    // Validate form đăng ký
    $("#form_reg").validate({
        rules: {
            username: {
                required: true,
                pattern: /^[a-z_][a-z0-9_\.\s]{2,31}$/,
                remote: {
                    url: window.location.origin + '/Register_fsport/check_username',
                    type: "post",
                    //async: false,
                    complete: function (data) {
                        console.log(data.responseText)
                    },
                    error: function () {
                        console.log("Có lỗi");
                    }
                }
            },
            name: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: window.location.origin + '/Register_fsport/check_email',
                    type: "post",
                    //async: false,
                    complete: function (data) {
                        console.log(data.responseText)
                    },
                    error: function () {
                        console.log("Có lỗi");
                    }
                }
            }
        },
        messages: {
            username: {
                required: "* Vui lòng nhập tên đăng nhập",
                pattern: "* Tên đăng nhập không hợp lệ",
                remote: "* Tên đăng nhập đã được sử dụng"
            },
            name: {
                required: "* Vui lòng nhập tên"
            },
            password: {
                required: "* Vui lòng nhập mật khẩu",
                minlength: "* Mật khẩu tối thiểu 6 ký tự"
            },
            email: {
                required: "* Vui lòng nhập email",
                email: "* Email không hợp lệ",
                remote: "* Email đã được sử dụng"
            }
        }
    });

    // Validate form đăng nhập
    $("#form_login").validate({
        rules: {
            id: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            id: {
                required: "Vui lòng nhập username hoặc email",
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
            }
        }
    });
});