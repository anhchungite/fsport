var Script = function () {

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#login-form").validate({
        	rules: {
        		userName: {
        			required: true
        		},
        		userPass: {
        			required: true
        		}
        	},
        	messages: {
        		userName: {
        			required: "Vui lòng nhập Tên đăng nhập"
        		},
        		userPass: {
        			required: "Vui lòng nhập Mật khẩu"
        		}
        	},
        	errorPlacement: function(error, element) {
        	    if (element.attr("name") == "userName" || element.attr("name") == "userPass" ) {
        	      //error.insertAfter("p.login-img");
        	    	var html = $("ul:first");
        	      error.appendTo(html);
        	    } else {
        	      error.insertAfter(element);
        	    }
        	  },
        	errorElement: "li"
        });

        // validate signup form on keyup and submit
        $("#register_form").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 6
                },
                address: {
                    required: true,
                    minlength: 10
                },
                username: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {                
                fullname: {
                    required: "Please enter a Full Name.",
                    minlength: "Your Full Name must consist of at least 6 characters long."
                },
                address: {
                    required: "Please enter a Address.",
                    minlength: "Your Address must consist of at least 10 characters long."
                },
                username: {
                    required: "Please enter a Username.",
                    minlength: "Your username must consist of at least 5 characters long."
                },
                password: {
                    required: "Please provide a password.",
                    minlength: "Your password must be at least 5 characters long."
                },
                confirm_password: {
                    required: "Please provide a password.",
                    minlength: "Your password must be at least 5 characters long.",
                    equalTo: "Please enter the same password as above."
                },
                email: "Please enter a valid email address.",
                agree: "Please accept our terms & condition."
            }
        });

    });


}();