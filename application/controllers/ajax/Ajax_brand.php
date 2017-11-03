<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Ajax_brand extends CI_Controller{
	protected $_data;
	public function __construct(){
		parent::__construct();
	}
	public function add_brand(){
		$this->load->Model('Brand_model');
		if($this->input->post('aj_add')){
			$arrInsert['brandName'] = $this->input->post()['aj_name'];
			$arrInsert['brandLogo'] = $this->input->post()['aj_img'];
			$result = $this->Brand_model->add($arrInsert);
			if($result){
				$arrBrand = $this->Brand_model->get();
				
				if(isset($arrBrand)){
               			foreach ($arrBrand as $key => $value){?>
                  <tr class="odd gradeX">
                     <td class="txt-ct id" style="font-weight:bold"><?php echo $value['brandID']?></td>
                     <td class="txt-ct name" style="font-weight:bold"><?php echo $value['brandName']?></td>
                     <td class="txt-ct"><img style="height: 50px" alt="" src="<?php echo $value['brandLogo']?>"></td>
                     <td class="txt-ct span2">
                     	<button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                     	<button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
					</td>
                  </tr>
                  <?php }
               			}
               			
				
			}else {
				echo 'Lỗi';
			}
		}
	}
	public function edit_brand(){
		$this->load->Model('Brand_model');
		if($this->input->post('aj_edit')){
			$brandID = $this->input->post()['aj_id'];
			$arrUpdate['brandName'] = $this->input->post()['aj_name'];
			$arrUpdate['brandLogo'] = $this->input->post()['aj_img'];
			$result = $this->Brand_model->edit($brandID,$arrUpdate);
			if($result){
				$arrBrand = $this->Brand_model->get();
	
				if(isset($arrBrand)){
               			foreach ($arrBrand as $key => $value){?>
                  <tr class="odd gradeX">
                     <td class="txt-ct id" style="font-weight:bold"><?php echo $value['brandID']?></td>
                     <td class="txt-ct name" style="font-weight:bold"><?php echo $value['brandName']?></td>
                     <td class="txt-ct"><img style="height: 50px" alt="" src="<?php echo $value['brandLogo']?>"></td>
                     <td class="txt-ct span2">
                     	<button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                     	<button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
					</td>
                  </tr>
                  <?php }
               			}
	               			
					
				}else {
					echo 'Lỗi';
				}
			}
		}
		public function del_brand(){
			$this->load->Model('Brand_model');
			if($this->input->post('aj_id')){
				$brandID = $this->input->post()['aj_id'];
				$result = $this->Brand_model->del($brandID);
				if($result){
					$arrBrand = $this->Brand_model->get();
		
					if(isset($arrBrand)){
						foreach ($arrBrand as $key => $value){?>
		                  <tr class="odd gradeX">
		                     <td class="txt-ct id" style="font-weight:bold"><?php echo $value['brandID']?></td>
		                     <td class="txt-ct name" style="font-weight:bold"><?php echo $value['brandName']?></td>
		                     <td class="txt-ct"><img style="height: 50px" alt="" src="<?php echo $value['brandLogo']?>"></td>
		                     <td class="txt-ct span2">
		                     	<button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
		                     	<button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
							</td>
		                  </tr>
		                  <?php }
		               			}
			               			
							
						}else {
							echo 'Lỗi';
						}
					}
				}
}