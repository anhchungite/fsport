<?php
$config = array(
		'login' => array(
						array(
								'field'	=>	'userName',
								'label'	=>	'Tên đăng nhập',
								'rules'	=>	'required|trim'
						),
						array(
								'field'	=>	'userPass',
								'label'	=>	'Mật khẩu',
								'rules'	=>	'required'
						)
				
		),
        'admin_user' => array(
                        array(
                            'field' => 'fullname',
                            'label' => 'Họ và tên',
                            'rules' => 'required|trim',
                        ),
                        array(
                            'field' => 'username',
                            'label' => 'Tên người dùng',
                            'rules' => 'required|trim|callback_regex_username|is_unique[tbl_user.userName]'
                        ),
                        array(
                            'field' => 'password',
                            'label' => 'Mật khẩu',
                            'rules' => 'required|trim|callback_regex_password',
                        ),
                        array(
                            'field' => 're-password',
                            'label' => 'Xác nhận mật khẩu',
                            'rules' => 'required|trim|matches[password]',
                        ),
                        array(
                            'field' => 'email',
                            'label' => 'Email',
                            'rules' => 'required|trim|callback_regex_email|is_unique[tbl_user.userEmail]',
                        ),
                        array(
                            'field' => 'quyen',
                            'label' => 'Quyền',
                            'rules' => 'required|trim',
                        ),
//                        array(
//                            'field' => 'dienthoai',
//                            'label' => 'Số điện thoại',
//                            'rules' => 'required|numeric',
//                        ),
//                        array(
//                            'field' => 'diachi',
//                            'label' => 'Địa chỉ',
//                            'rules' => 'required|trim|alpha_numeric_spaces',
//                        ),
//
//                        array(
//                            'field' => 'gioitinh',
//                            'label' => 'Giới tính',
//                            'rules' => 'required|trim',
//                        ),
//                        array(
//                            'field' => 'thanhpho',
//                            'label' => 'Thành phố',
//                            'rules' => 'required|trim',
//                        )

        ),
        'admin_user/edit' => array(
            array(
                'field' => 'fullname',
                'label' => 'Họ và tên',
                'rules' => 'required|trim',
            ),
//            array(
//                'field' => 'email',
//                'label' => 'Email',
//                'rules' => 'required|trim|callback_regex_email|is_unique[tbl_user.userEmail]',
//            ),
            array(
                'field' => 'quyen',
                'label' => 'Quyền',
                'rules' => 'required|trim',
            ),
            array(
                'field' => 'dienthoai',
                'label' => 'Số điện thoại',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'diachi',
                'label' => 'Địa chỉ',
                'rules' => 'trim|alpha_numeric_spaces',
            ),

            array(
                'field' => 'gioitinh',
                'label' => 'Giới tính',
                'rules' => 'trim',
            ),
            array(
                'field' => 'thanhpho',
                'label' => 'Thành phố',
                'rules' => 'trim',
            )

        ),
        'admin_cat' => array(
            array(
                'field' => 'name',
                'label' => 'Tên Danh mục',
                'rules' => 'required|trim|prep_for_form|max_length[200]'
            ),
            array(
                'field' => 'image',
                'label' => 'Hình ảnh',
                'rules' => 'required|trim|prep_for_form|max_length[200]'
            ),
            array(
                'field' => 'des',
                'label' => 'Mô tả',
                'rules' => 'trim|prep_for_form|max_length[200]'
            ),

        ),
    'admin_product' => array(
        array(
            'field' => 'input_ten',
            'label' => 'Tên sản phẩm',
            'rules' => 'trim|required|max_length[255]'
        ),
        array(
            'field' => 'input_chitiet',
            'label' => 'Chi tiết sản phẩm',
            'rules' => 'trim'
        ),
        array(
            'field' => 'input_mota',
            'label' => 'Mô tả từ khóa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'input_tukhoa',
            'label' => 'Từ khóa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'input_tag[]',
            'label' => 'Tag sản phẩm',
            'rules' => 'trim'
        ),
        array(
            'field' => 'input_giagoc',
            'label' => 'Giá gốc',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_giaban',
            'label' => 'Giá bán',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_soluong',
            'label' => 'Số lượng',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_nhanhieu',
            'label' => 'Thương hiệu',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_danhmuc[]',
            'label' => 'Danh mục',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_type_size',
            'label' => 'Kích cỡ',
            'rules' => 'required'
        ),
        array(
            'field' => 'input_csize[]',
            'label' => 'Kích cỡ',
            'rules' => 'trim'
        ),
        array(
            'field' => 'input_nsize[]',
            'label' => 'Kích cỡ',
            'rules' => 'trim'
        ),
        array(
            'field' => 'input_mausac[]',
            'label' => 'Màu sắc',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_image[]',
            'label' => 'Hình ảnh',
            'rules' => 'trim|required'
        ),
    ),
    'register' => array(
        array(
            'field' => 'reg_username',
            'label' => 'Tên đăng nhập',
            'rules' => 'required|is_unique[tbl_user.userName]|regex_match[/^[a-z_][a-z0-9_\.\s]{2,31}$/]',
            'errors' => array(
                'is_unique' => '%s đã tồn tại',
                'regex_match' => '%s phải bắt đầu bằng 1 ký tự <li> Chỉ chứa chữ, số, dấu chấm (.), dấu gạch dưới (_)</li><li>Độ dài từ 3 - 32 ký tự</li>'
            )
        ),
        array(
            'field' => 'reg_pass',
            'label' => 'Mật khẩu',
            'rules' => 'required|min_length[6]'
        ),
        array(
            'field' => 'reg_repass',
            'label' => 'Xác nhận mật khẩu',
            'rules' => 'required|matches[reg_pass]'
        ),
        array(
            'field' => 'reg_name',
            'label' => 'Họ và Tên',
            'rules' => 'required|prep_for_form'
        ),
        array(
            'field' => 'reg_email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[tbl_user.userEmail]',
            'errors' => array(
                'is_unique' => '%s đã tồn tại'
            )
        ),
        array(
            'field' => 'reg_phone',
            'label' => 'Số điện thoại',
            'rules' => 'required|is_natural|min_length[10]|max_length[11]',
            'errors' => array(
                'is_natural' => '%s phải là số'
            )
        ),
        array(
            'field' => 'reg_address',
            'label' => 'Địa chỉ',
            'rules' => 'required'
        ),
        array(
            'field' => 'reg_district',
            'label' => 'Huyện / Quận',
            'rules' => 'required'
        ),
        array(
            'field' => 'reg_city',
            'label' => 'Thành phố',
            'rules' => 'required'
        )

    ),
    'member_login' => array(
        array(
            'field' => 'id',
            'label' => 'Tên đăng nhập',
            'rules' => 'required',

        ),
        array(
            'field' => 'password',
            'label' => 'Mật khẩu',
            'rules' => 'required',

        )
    ),
    'checkout_pay' => array(
        array(
            'field' => 'pay_name',
            'label' => 'Họ & tên',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'pay_telephone',
            'label' => 'Số điện thoại',
            'rules' => 'required|is_natural|min_length[10]|max_length[11]'
        ),
        array(
            'field' => 'order_note',
            'label' => 'Ghi chú',
            'rules' => 'prep_for_form'
        ),
        array(
            'field' => 'pay_address',
            'label' => 'Địa chỉ',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_district',
            'label' => 'Quận / Huyện',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_city',
            'label' => 'Thành phố',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_method',
            'label' => 'Phương thức vận chuyển',
            'rules' => 'required'
        ),

    ),
    'checkout' => array(
        array(
            'field' => 'pay_name',
            'label' => 'Họ & tên',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'pay_telephone',
            'label' => 'Số điện thoại',
            'rules' => 'required|is_natural|min_length[10]|max_length[11]'
        ),
        array(
            'field' => 'order_note',
            'label' => 'Ghi chú',
            'rules' => 'prep_for_form'
        ),
        array(
            'field' => 'pay_address',
            'label' => 'Địa chỉ',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_district',
            'label' => 'Quận / Huyện',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_city',
            'label' => 'Thành phố',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_method',
            'label' => 'Phương thức thanh toán',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_name',
            'label' => 'Họ & tên',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_telephone',
            'label' => 'Số điện thoại',
            'rules' => 'required|is_natural|min_length[10]|max_length[11]'
        ),
        array(
            'field' => 'ship_address',
            'label' => 'Địa chỉ',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_district',
            'label' => 'Quận / Huyện',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_city',
            'label' => 'Thành phố',
            'rules' => 'required'
        ),


    ),
    'admin_order' => array(
        array(
            'field' => 'pay_name',
            'label' => 'Họ & tên',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'pay_phone',
            'label' => 'Số điện thoại',
            'rules' => 'required|is_natural|min_length[10]|max_length[11]'
        ),
        array(
            'field' => 'order_note',
            'label' => 'Ghi chú',
            'rules' => 'prep_for_form'
        ),
        array(
            'field' => 'order_status',
            'label' => 'Trạng thái',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_addr',
            'label' => 'Địa chỉ',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_dist',
            'label' => 'Quận / Huyện',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_city',
            'label' => 'Thành phố',
            'rules' => 'required'
        ),
        array(
            'field' => 'pay_method',
            'label' => 'Phương thức thanh toán',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_name',
            'label' => 'Họ & tên',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_phone',
            'label' => 'Số điện thoại',
            'rules' => 'required|is_natural|min_length[10]|max_length[11]'
        ),
        array(
            'field' => 'ship_addr',
            'label' => 'Địa chỉ',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_dist',
            'label' => 'Quận / Huyện',
            'rules' => 'required'
        ),
        array(
            'field' => 'ship_city',
            'label' => 'Thành phố',
            'rules' => 'required'
        ),
        array(
            'field' => 'product[quantity][]',
            'label' => 'Số lượng',
            'rules' => 'required'
        ),
        
//        array(
//            'field' => 'product[size][]',
//            'label' => 'Kích cỡ',
//            'rules' => 'required'
//        ),
//        array(
//            'field' => 'product[color][]',
//            'label' => 'Màu sắc',
//            'rules' => 'required'
//        ),
    ),
    'Member_fsport/update_profile' => array(
            array(
                'field' => 'fullname',
                'label' => 'Họ và tên',
                'rules' => 'required|trim',
            ),
        //    array(
        //        'field' => 'email',
        //        'label' => 'Email',
        //        'rules' => 'required|trim|callback_regex_email[id]',
        //    ),
            array(
                'field' => 'dienthoai',
                'label' => 'Số điện thoại',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'diachi',
                'label' => 'Địa chỉ',
                'rules' => 'trim',
            ),
            array(
               'field' => 'ngaysinh',
               'label' => 'Ngày sinh',
               'rules' => 'required|trim|callback_regex_date',
           ),
            array(
                'field' => 'quanhuyen',
                'label' => 'Quận huyện',
                'rules' => 'trim|alpha_numeric_spaces',
            ),
            array(
                'field' => 'gioitinh',
                'label' => 'Giới tính',
                'rules' => 'trim',
            ),
            array(
                'field' => 'thanhpho',
                'label' => 'Thành phố',
                'rules' => 'trim',
            )

        ),

);