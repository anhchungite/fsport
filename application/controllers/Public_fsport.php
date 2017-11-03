<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Public_fsport extends AC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
        $this->session->set_userdata('redirectURL', current_url());




	}

	public function index()
	{
        $this->load->Model(array('Brand_model', 'Product_model','Cat_model'));
		$arr_new_product = $this->Product_model->new_product();
		foreach ($arr_new_product as $key => $value)
		{
			$arr_new_product[$key]['list_image'] = $this->Product_model->get_product_image_by_id($value['productID']);
		}
		$this->_data['arr_new_product'] = $arr_new_product;
// 		$this->_data['arr_new_product']['list_image'] = $this->Product_model->get_product_image_by_id($id);
// 		$this->_data['arr_new_product']['list_cat'] = $this->Product_model->get_product_category_by_id($id);
// 		$this->_data['arr_new_product']['list_tag'] = $this->Product_model->get_product_tag_by_id($id);

        $arr_cat = $this->Cat_model->tab_cat(array(32,15,16,17));
        foreach ($arr_cat as $key => $value){
            $id_cat = $value['categoryID'];
            $arr_cat[$key]['product'] = $this->Product_model->tab_product($id_cat);
        }
        $this->_data['arr_product'] = $arr_cat;

//		echo '<pre>';
//		print_r($this->_data['arr_product']);
//		echo '</pre>';
		$this->_data['arr_brand'] = $this->Brand_model->get();
		$this->load->view('layout/public/layout', $this->_data);
	}
	public function category()
	{
		$this->load->view('layout/public/layout', $this->_data);
	}
	public function detail($id)
	{
        $this->load->Model(array('User_model', 'Brand_model', 'Product_model','Cat_model','Tag_model','Review_model'));
        $this->_data['arr_product'] = $this->Product_model->get_by_id($id);
		if(count($this->_data['arr_product']) <=0)
		{
            $this->load->view('layout/404/layout');
            
		}else{
            $this->_data['arr_review'] = $this->Review_model->publicView($id);
            $this->_data['arr_brand'] = $this->Brand_model->get_by_id($this->_data['arr_product']['brandID']);
            $this->_data['arr_tag_name'] = $this->Tag_model->publicTagByProduct($id);
            $this->_data['arr_relate_product'] = $this->Product_model->getRelateProducts($id);
            $this->_data['arr_cat_id'] = $this->Cat_model->get_by_product($id);
            //$this->_data['arr_img'] = $this->User_model->getUserInfo(array('userAvatar'), 'one', array('userEmail'));
            $this->load->view('layout/public/layout', $this->_data);
        }  
	}
	public function about()
	{
		$this->load->view('layout/public/layout', $this->_data);
	}
	public function contact()
	{
		$this->load->view('layout/public/layout', $this->_data);
	}
	public function faq()
	{
		$this->load->view('layout/public/layout', $this->_data);
	}
	public function search()
    {
       $this->load->library("zend_search");
       if(isset($_POST['term'])){
               $index = $this->zend_search->_index_connect();
            // Set limit 100
            Zend_Search_Lucene::setResultSetLimit(100);
            // Gan kieu du lieu tim kiem
            Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');
            // Thuc hien tim kiem
            $key = $this->input->post('term');
            $query = 'name: '.$key.' OR name_en: '.$key.' OR key:'.$key.' OR key_en:'.$key;
 
            $hits = $index->find($query);
            //$hits là kết quả sau khi tìm kiếm
            $result = array();
            foreach ($hits as $i => $hit)
            {
                $row = new stdClass();
				$document = $hit->getDocument();
                foreach ($document->getFieldNames() as $f)
                {
                    $row->{$f} = $document->getFieldValue($f);
                }
                $result[] = $row;
            }
            //print_r($result);
            $json = array();
            foreach ($result as $row)
            {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $json[] = $item;
            }
            $output = json_encode($json);
            //dữ liệu trả về dạng Json để sử dụng trong Jquery Autocomplete
            echo $output ;
      }else if(isset($_GET['keyword'])){
			echo $_GET['keyword'];
	  }else{
          redirect();
      }
    }


}
