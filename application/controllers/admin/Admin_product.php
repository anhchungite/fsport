<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin_product extends CI_Controller
{
	protected $_data;
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->checkLogged())
		{
			redirect('admin/login');
			exit();
		}
        date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->_data['site_info'] = $this->Site_model->get('admin');
		$this->_data['name'] = 'Sản phẩm';
		$this->_data['title'] = 'Quản lý sản phẩm';
		$this->load->Model(array('Product_model','Brand_model','Cat_model','Tag_model'));
        $this->load->library("zend_search");


        $obj_json = file_get_contents('./assets/attr.json');
        $this->_data['arr_attr'] = json_decode($obj_json);


	}
	// PHƯƠNG THỨC INDEX
	public function index($page = 1)
	{
        $this->load->helper(array('calc_shipping','tinh_tien'));
		//$this->output->enable_profiler(true);
		$sort_by 			=	"";
		$sort_order 		=	"";
		$filter_name		=	"";
		$filter_price		=	"";
		$filter_quantity	=	"";
		$filter_status		=	"";
 		if($this->input->get())
 		{
 			$arrGet = $this->input->get();
			if(isset($arrGet['per_page']))
			{
 				$page = $arrGet['per_page'];
			}
			if(isset($arrGet['sort_by']))
			{
				$sort_by = $arrGet['sort_by'];
			}
			if(isset($arrGet['sort_order']))
			{
				$sort_order = $arrGet['sort_order'];
			}
			if (isset($arrGet['filter_name']))
			{
				$filter_name = $arrGet['filter_name'];
			}
			if (isset($arrGet['filter_price']))
			{
				$filter_price = $arrGet['filter_price'];
			}
			if (isset($arrGet['filter_quantity']))
			{
				$filter_quantity = $arrGet['filter_quantity'];
			}
			if (isset($arrGet['filter_status']))
			{
				$filter_status = $arrGet['filter_status'];
			}
			//echo $filter_status;
 		}

		$rows_page = $this->_data['site_info']['site_num_page']; // Số dòng / trang
		$this->_data['offset'] = $page * $rows_page - $rows_page;
		$total_rows = $this->_data['count'] = $this->Product_model->num_rows($filter_name,$filter_price,$filter_quantity,$filter_status); // Tổng số dòng
		if($total_rows > 0)
		{
			$this->_data['max_page'] = $maxpage = ceil($total_rows / $rows_page);
			// Kiểm tra số trang hợp lệ
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->_data['arrProduct'] = $this->Product_model->show($page, $rows_page, $sort_by, $sort_order, $filter_name,$filter_price,$filter_quantity,$filter_status);
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['page_query_string'] = TRUE;
			//$config['uri_segment'] = 3;
			$config['base_url'] = base_url("admin/admin_product/index");

			$config['total_rows'] = $total_rows;
			$config['per_page'] = $rows_page;
			
			$this->pagination->initialize($config);
		}
		if($this->input->post('apdung'))
		{
			$arrInput = $this->input->post();
			$arrID = $arrInput['selected'];
			if($arrInput['tacvu'] == 'delete')
			{
				$result = $this->Product_model->del_all($arrID); // Thực thi xóa
				if($result){
					$this->session->set_flashdata('flash_ss', 'Đã xóa các mục đã chọn');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}else{
					$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi xóa các mục này');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}
			}
			if($arrInput['tacvu'] == 2) {
                $arrUpdate = array('productStatus' => 2);
                $result = $this->Product_model->update_status_all($arrID, $arrUpdate); // Thực thi cập nhật
                if ($result) {
                    $this->session->set_flashdata('flash_ss', 'Đã cập nhật trạng thái các mục đã chọn: Bật');
                    redirect(base_url() . ltrim($_SERVER['REQUEST_URI'], '/'));
                    exit();
                } else {
                    $this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi cập nhật trạng thái các mục đã chọn');
                    redirect(base_url() . ltrim($_SERVER['REQUEST_URI'], '/'));
                    exit();
                }
            } elseif($arrInput['tacvu'] == 1){
				$arrUpdate = array('productStatus' => 1);
				$result = $this->Product_model->update_status_all($arrID, $arrUpdate); // Thực thi cập nhật
				if($result)
				{
					$this->session->set_flashdata('flash_ss', 'Đã cập nhật trạng thái các mục đã chọn: Tắt');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}else{
					$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi cập nhật trạng thái các mục đã chọn');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}
			} else {
                $arrUpdate = array('productStatus' => 0);
                $result = $this->Product_model->update_status_all($arrID, $arrUpdate); // Thực thi cập nhật
                if($result)
                {
                    $this->session->set_flashdata('flash_ss', 'Đã cập nhật trạng thái các mục đã chọn: Hết hàng');
                    redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
                    exit();
                }else{
                    $this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi cập nhật trạng thái các mục đã chọn');
                    redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
                    exit();
                }
            }
		}
		
		$this->load->view("layout/admin/layout", $this->_data);
	}

	// PHƯƠNG THỨC ADD
	public function add()
	{

        //$this->output->enable_profiler(true);
        $this->_data['arr_all_brand'] = $this->Brand_model->get();
        $this->_data['arr_all_tag'] = $this->Tag_model->get();
        $this->_data['arr_all_cat'] = $this->Cat_model->get();
        $flag = false;
		if($this->form_validation->run('admin_product')){
            if($this->input->post('btn_save')) {
                $flag = true;
                $arr_insert = array();
                $arr_input = $this->input->post();
                // Mảng insert vào tbl_product
                $arr_insert['product']['productName'] = $arr_input['input_ten'];
                $arr_insert['product']['productURL'] = convertUrl($arr_input['input_ten']);
                $arr_insert['product']['productDetail'] = $arr_input['input_chitiet'];
                $arr_insert['product']['productDescription'] = $arr_input['input_mota'];
                $arr_insert['product']['productKeyword'] = $arr_input['input_tukhoa'];
                $arr_insert['product']['productOriginalPrice'] = $arr_input['input_giagoc'];
                $arr_insert['product']['productPrice'] = $arr_input['input_giaban'];
                $arr_insert['product']['productQuantity'] = $arr_input['input_soluong'];
                $arr_insert['product']['productStatus'] = $arr_input['input_trangthai'];
                $arr_insert['product']['productSort'] = $arr_input['input_thutu'];
                $arr_insert['product']['brandID'] = $arr_input['input_nhanhieu'];
                $arr_insert['product']['productDateAdded'] = date('Y-m-d');
                $arr_insert['product']['productDateUpdate'] = date('Y-m-d');
                if($arr_input['input_type_size'] == 0){
                    array_unshift($arr_input['input_nsize'],$arr_input['input_type_size']);
                    $arr_insert['product']['productSize'] = json_encode($arr_input['input_nsize']);
                }else if($arr_input['input_type_size'] == 1){
                    array_unshift($arr_input['input_csize'],$arr_input['input_type_size']);
                    $arr_insert['product']['productSize'] = json_encode($arr_input['input_csize']);
                }else{
                    $arr_insert['product']['productSize'] = json_encode(array(2,"Free size"));
                }
                $arr_insert['product']['productColor'] = json_encode($arr_input['input_mausac']);
                $arr_insert['product']['productImage'] = json_encode($arr_input['input_image']);
                // Mảng insert vào tbl_product_category
                $arr_insert['product_category'] = $arr_input['input_danhmuc'];
                // Mảng insert vào tbl_product_tag
                $arr_insert['product_tag'] = explode(',',$arr_input['input_tag']);

                $result = $this->Product_model->add($arr_insert['product'], $arr_insert['product_category'], $arr_insert['product_tag']);
            }

            if($this->input->post('btn_save_add')) {
                $arr_insert = array();
                $arr_input = $this->input->post();
                // Mảng insert vào tbl_product
                $arr_insert['product']['productName'] = $arr_input['input_ten'];
                $arr_insert['product']['productURL'] = convertUrl($arr_input['input_ten']);
                $arr_insert['product']['productDetail'] = $arr_input['input_chitiet'];
                $arr_insert['product']['productDescription'] = $arr_input['input_mota'];
                $arr_insert['product']['productKeyword'] = $arr_input['input_tukhoa'];
                $arr_insert['product']['productOriginalPrice'] = $arr_input['input_giagoc'];
                $arr_insert['product']['productPrice'] = $arr_input['input_giaban'];
                $arr_insert['product']['productQuantity'] = $arr_input['input_soluong'];
                $arr_insert['product']['productStatus'] = $arr_input['input_trangthai'];
                $arr_insert['product']['productSort'] = $arr_input['input_thutu'];
                $arr_insert['product']['brandID'] = $arr_input['input_nhanhieu'];
                $arr_insert['product']['productDateAdded'] = date('Y-m-d');
                $arr_insert['product']['productDateUpdate'] = date('Y-m-d');
                if($arr_input['input_type_size'] == 0){
                    array_unshift($arr_input['input_nsize'],$arr_input['input_type_size']);
                    $arr_insert['product']['productSize'] = json_encode($arr_input['input_nsize']);
                }else if($arr_input['input_type_size'] == 1){
                    array_unshift($arr_input['input_csize'],$arr_input['input_type_size']);
                    $arr_insert['product']['productSize'] = json_encode($arr_input['input_csize']);
                }else{
                    $arr_insert['product']['productSize'] = json_encode(array(2,"Free size"));
                }
                $arr_insert['product']['productColor'] = json_encode($arr_input['input_mausac']);
                $arr_insert['product']['productImage'] = json_encode($arr_input['input_image']);
                // Mảng insert vào tbl_product_category
                $arr_insert['product_category'] = $arr_input['input_danhmuc'];
                // Mảng insert vào tbl_product_tag
                $arr_insert['product_tag'] = explode(',',$arr_input['input_tag']);

                $result = $this->Product_model->add($arr_insert['product'], $arr_insert['product_category'], $arr_insert['product_tag']);
                
            }
            if($result){
                $pro = array(
                    'idpro'    => mysqli_insert_id(),
                    'name'     => $arr_insert['product']['productName'],
                    'name_en'  => convert_vi_to_en($arr_insert['product']['productName']),
                );
                $this->zend_search->save_item($pro, $option = array('task' => 'add'));
            }
            if($flag == true && $result == true){
                $this->session->set_flashdata('flash_ss', 'Đã thêm sản phẩm');
                redirect('admin/admin_product');
                exit();
            }elseif ($flag == false && $result == true){
                $this->session->set_flashdata('flash_ss', 'Đã thêm sản phẩm');
                redirect(current_url());
                exit();
            }else{
                $this->session->set_flashdata('flash_er', 'Lỗi thêm sản phẩm');
                redirect('admin/admin_product');
                exit();
            }

        }


		$this->_data['title'] = "Thêm sản phẩm mới";
		$this->load->view("layout/admin/layout", $this->_data);
	}

	// PHƯƠNG THỨC EDIT
	public function edit($id)
	{
		//$this->output->enable_profiler(true);
        $this->_data['arr_product'] = $this->Product_model->get_by_id($id);
		// Kiểm tra tồn tại
		if(count($this->_data['arr_product']) <=0)
		{
			redirect('admin/admin_product');
			exit();
		}
        $this->_data['arr_all_brand'] = $this->Brand_model->get();
        $this->_data['arr_all_tag'] = $this->Tag_model->get();
        $this->_data['arr_all_cat'] = $this->Cat_model->get();
        // Lấy danh sách tên tags và id category theo product
        $this->_data['arr_tag_name'] = $this->Tag_model->get_by_product($id);
        $this->_data['arr_cat_id'] = $this->Cat_model->get_by_product($id);

		if($this->form_validation->run('admin_product')){
            if($this->input->post('btn_update')){
                $arr_update = array();
                $arr_input = $this->input->post();
                // Mảng insert vào tbl_product
                $arr_update['product']['productName'] = $arr_input['input_ten'];
                $arr_update['product']['productURL'] = convertUrl($arr_input['input_ten']);
                $arr_update['product']['productDetail'] = $arr_input['input_chitiet'];
                $arr_update['product']['productDescription'] = $arr_input['input_mota'];
                $arr_update['product']['productKeyword'] = $arr_input['input_tukhoa'];
                $arr_update['product']['productOriginalPrice'] = $arr_input['input_giagoc'];
                $arr_update['product']['productPrice'] = $arr_input['input_giaban'];
                $arr_update['product']['productQuantity'] = $arr_input['input_soluong'];
                $arr_update['product']['productStatus'] = $arr_input['input_trangthai'];
                $arr_update['product']['productSort'] = $arr_input['input_thutu'];
                $arr_update['product']['brandID'] = $arr_input['input_nhanhieu'];
                $arr_update['product']['productDateUpdate'] = date('Y-m-d');
                if($arr_input['input_type_size'] == 0){
                    array_unshift($arr_input['input_nsize'],$arr_input['input_type_size']);
                    $arr_update['product']['productSize'] = json_encode($arr_input['input_nsize']);
                }else if($arr_input['input_type_size'] == 1){
                    array_unshift($arr_input['input_csize'],$arr_input['input_type_size']);
                    $arr_update['product']['productSize'] = json_encode($arr_input['input_csize']);
                }else{
                    $arr_update['product']['productSize'] = json_encode(array(2, "Free size"));
                }
                $arr_update['product']['productColor'] = json_encode($arr_input['input_mausac']);
                $arr_update['product']['productImage'] = json_encode($arr_input['input_image']);
                // Mảng insert vào tbl_product_category
                $arr_update['product_category'] = $arr_input['input_danhmuc'];
                // Mảng insert vào tbl_product_tag
                $arr_update['product_tag'] = explode(',',$arr_input['input_tag']);

                $result = $this->Product_model->edit($id, $arr_update['product'], $arr_update['product_category'], $arr_update['product_tag']);
                if($result){
                    $pro = array(
                        'idpro'    => $id,
                        'name'     => $arr_update['product']['productName'],
                        'name_en'  => convert_vi_to_en($arr_update['product']['productName']),
                    );
                    $this->zend_search->save_item($pro, $option = array('task' => 'update'));
                    $this->session->set_flashdata('flash_ss', 'Đã cập nhật sản phẩm');
                    redirect('admin/admin_product');
                    exit();
                }
                $this->session->set_flashdata('flash_er', 'Lỗi cập nhật sản phẩm');
                redirect('admin/admin_product');
                exit();
            }
        }
		
		$this->_data['title'] = "Sửa sản phẩm";
		$this->load->view("layout/admin/layout", $this->_data);
	}

	// PHƯƠNG THỨC DEL
	public function del($id)
	{
		$arrProduct = $this->Product_model->get_by_id($id); // Lấy thông tin
		// Kiểm tra tồn tại
		if(count($arrProduct) <=0)
		{
			redirect('admin/admin_product');
			exit();
		}
		$result = $this->Product_model->del($id);
		if($result)
		{
            $pro['idpro'] = $id;
            $this->zend_search->save_item($pro, $option = array('task' => 'delete'));
			$this->session->set_flashdata('flash_ss', 'Đã xóa sản phẩm');
			redirect('admin/admin_product');
			exit();
		}else {
			$this->session->set_flashdata('flash_er', 'Lỗi xóa sản phẩm');
			redirect('admin/admin_product');
			exit();
		}
	}
}