<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_order extends CI_Controller
{
	protected $_data;
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->checkAdmin())
		{
			redirect('admin/login');
			exit();
		}
		$this->_data['site_info'] = $this->Site_model->get('admin');
		$this->_data['title'] = 'Quản lý hóa đơn';
		$this->_data['name'] = 'Hóa đơn';
		$this->load->Model(array('Order_model', 'User_model'));
		$this->_data['arrOrderStatus'] = $this->Order_model->getOrderStatus();
	}
	public function index($page = 1)
	{
	    $id = "";
	    $status = "";
	    $customer = "";
	    $total = "";
	    $pur_date = "";
	    $chan_date = "";
        if($this->input->get())
        {
            $arrGet = $this->input->get();
            if(isset($arrGet['per_page']))
            {
                $page = $arrGet['per_page'];
            }
            if (isset($arrGet['filter_id']))
            {
                $id = $arrGet['filter_id'];
            }
            if (isset($arrGet['filter_customer']))
            {
                $customer = $arrGet['filter_customer'];
            }
            if (isset($arrGet['filter_total']))
            {
                $total = $arrGet['filter_total'];
            }
            if (isset($arrGet['filter_status']))
            {
                $status = $arrGet['filter_status'];
            }
            if (isset($arrGet['filter_pur_date']))
            {
                $pur_date = $arrGet['filter_pur_date'];
            }
            if (isset($arrGet['filter_chan_date']))
            {
                $chan_date = $arrGet['filter_chan_date'];
            }
        }
        $array_filter = array('id' => $id,'status' => $status,'customer' => $customer,'total' => $total, 'pur_date' => $pur_date, 'chan_date' => $chan_date);
        $rows_page = $this->_data['site_info']['site_num_page']; // Số dòng / trang
        $this->_data['offset'] = $page * $rows_page - $rows_page;
        $total_rows = $this->_data['count'] = $this->Order_model->num_rows($array_filter); // Tổng số dòng
        if($total_rows > 0)
        {
            $this->_data['max_page'] = $maxpage = ceil($total_rows / $rows_page);
            // Kiểm tra số trang hợp lệ
            if($page < 1)$page = 1;
            if($page > $maxpage)$page = $maxpage;
            $this->_data['arrOrder'] = $this->Order_model->show($page, $rows_page, $array_filter);
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['page_query_string'] = TRUE;
            //$config['uri_segment'] = 3;
            $config['base_url'] = base_url("admin/admin_order/index");

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
                $result = $this->Order_model->multiDelete($arrID); // Thực thi xóa
                if($result){
                    $this->session->set_flashdata('flash_ss', 'Đã xóa các mục đã chọn');
                    redirect(current_full_url());
                    exit();
                }else{
                    $this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi xóa các mục này');
                    redirect(current_full_url());
                    exit();
                }
            }
            if(is_numeric($arrInput['tacvu'])) {
                $arrUpdate = array('orderStatusID' => $arrInput['tacvu']);
                $result = $this->Order_model->update($arrID, $arrUpdate);
                if ($result) {
                    $this->session->set_flashdata('flash_ss', 'Đã cập nhật trạng thái các mục đã chọn');
                    redirect(current_full_url());
                    exit();
                } else {
                    $this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi cập nhật trạng thái các mục đã chọn');
                    redirect(current_full_url());
                    exit();
                }
            }
        }

		$this->_data['title'] = "Đơn hàng";
		$this->load->view("layout/admin/layout", $this->_data);
	}

    public function detail($id)
    {
        $this->load->Model('Order_product_model');
        $this->_data['arrOrder'] = $this->Order_model->getOrder($id);
        if(count($this->_data['arrOrder']) <= 0){
            redirect(base_url('admin/admin_order'));
            exit();
        }
        $this->_data['arrOrderProduct'] = $this->Order_product_model->getOrderProduct($id);
        $this->_data['title'] = "Chi tiết đơn hàng";
        $this->load->view("layout/admin/layout", $this->_data);
    }

	public function edit($id)
	{
	    $this->load->Model('Order_product_model');
        $this->_data['arrOrder'] = $this->Order_model->getOrder($id);
        $this->_data['arrOrderProduct'] = $this->Order_product_model->getOrderProduct($id);
        if($this->input->post('btn_save')){
            if($this->form_validation->run('admin_order')){
                $arrInput = $this->input->post();
                $arrUpdateProduct = array();
                $arrUpdateOrder = array();

                foreach ($arrInput['product']['delete'] as $key => $flag){
                    if($flag == 1){
                        // Thuc hien xoa SP
                        $this->Order_product_model->delete($key);
                    }else{
                        $arrUpdateProduct['productSize']        = $arrInput['product']['size'][$key];
                        $arrUpdateProduct['productColor']       = $arrInput['product']['color'][$key];
                        $arrUpdateProduct['productQuantity']    = $arrInput['product']['quantity'][$key];
                        //Thuc hien update SP
                        $this->Order_product_model->update($key, $arrUpdateProduct);
                    }
                }
                // Update Don hang
                $arrUpdateOrder['payMethod']        = $arrInput['pay_method'];
                $arrUpdateOrder['orderStatusID']    = $arrInput['order_status'];
                $arrUpdateOrder['orderNote']        = $arrInput['order_note'];
                $arrUpdateOrder['payName']          = $arrInput['pay_name'];
                $arrUpdateOrder['payPhone']         = $arrInput['pay_phone'];
                $arrUpdateOrder['payEmail']         = $arrInput['pay_email'];
                $arrUpdateOrder['payAddress']       = $arrInput['pay_addr'];
                $arrUpdateOrder['payDistrict']      = $arrInput['pay_dist'];
                $arrUpdateOrder['payCity']          = $arrInput['pay_city'];
                $arrUpdateOrder['shipName']         = $arrInput['ship_name'];
                $arrUpdateOrder['shipPhone']        = $arrInput['ship_phone'];
                $arrUpdateOrder['shipAddress']      = $arrInput['ship_addr'];
                $arrUpdateOrder['shipDistrict']     = $arrInput['ship_dist'];
                $arrUpdateOrder['shipCity']         = $arrInput['ship_city'];
                $result = $this->Order_model->update($id, $arrUpdateOrder);
                if($result){
                    $this->session->set_flashdata('flash_ss', 'Đã cập nhật đơn hàng');
                    redirect('admin/admin_order');
                    exit();
                }
                $this->session->set_flashdata('flash_er', 'Lỗi cập nhật đơn hàng');
                redirect('admin/admin_order');
                exit();
            }

        }

		$this->_data['title'] = "Sửa đơn hàng";
		$this->load->view("layout/admin/layout", $this->_data);
	}

	public function del($id)
	{
		$arrContact = $this->Order_model->detail($id_contact); // Lấy thông tin
		// Kiểm tra tồn tại
		if(count($arrContact) <=0){
			redirect('admin/admin_contact');
			exit();
		}
		$result = $this->Order_model->del($id_contact);
		if($result)
		{
			$this->session->set_flashdata('flash_ss', 'Đã xóa đơn hàng');
			redirect('admin/admin_contact');
			exit();
		}else {
			$this->session->set_flashdata('flash_er', 'Lỗi xóa đơn hàng');
			redirect('admin/admin_contact');
			exit();
		}
	}
	public function invoice($id)
	{

		$this->_data['title'] = "Hóa đơn";
		$this->load->view("admin/order/invoice", $this->_data);
	}
}