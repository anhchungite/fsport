<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   Class Ajax_cat extends CI_Controller{
   	protected $_data;
   	public function __construct(){
   		parent::__construct();
   		$this->load->Model('Cat_model');
   	}
   	public function add_cat(){
   		if($this->input->post('aj_add')){
   			 $arrInsert['categoryName'] 		= $this->input->post('aj_name');
   			 $arrInsert['categoryURL'] 			= convertUrl($arrInsert['categoryName']);
   			 $arrInsert['categoryImage'] 		= $this->input->post('aj_img');
   			 $arrInsert['categoryDescription'] 	= $this->input->post('aj_des');
   			 $arrInsert['categorySortOrder'] 	= $this->input->post('aj_sort');
   			 $arrInsert['parentCategoryID'] 	= $this->input->post('aj_parent');
   			$result = $this->Cat_model->add($arrInsert);
   			if($result){
   			$this->_data['arrParent'] = $arrCat = $this->Cat_model->get_parent();
   		foreach ($arrCat as $key => $value){
   			$arr_child = $this->Cat_model->get_child($value['categoryID']);
   			if(count($arr_child) > 0){
   				$arrCat[$key]['child'] = $arr_child;
   			}
   		}
                           foreach ($arrCat as $key => $parent) {
                             $id     	= $parent['categoryID'];
                             $name   	= $parent['categoryName'];
                             $img    	= $parent['categoryImage'];
                             $des    	= $parent['categoryDescription'];
                             $sort   	= $parent['categorySortOrder'];
                             $parentID 	= $parent['parentCategoryID'];
   
                          ?>
						<tr class="odd gradeX">
                            <td style="font-weight: bold" class="txt-ct tdID">
                                <?php echo $id ?>
                            </td>
                            <td style="font-weight: bold" class="txt-l tdName">
                                <?php echo $name ?>
                            </td>
                            <td class="txt-ct tdImg">
                                <?php if($img != ''){ ?><img src="<?php echo FILES_UPLOAD_THUMB.'/images/'.$img ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <td class="txt-ct">--</td>
                            <td class="txt-ct tdSort">
                                <?php echo $sort ?>
                            </td>
                            <td class="txt-ct span2">
                                <button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                                <button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
                            </td>
                            <input type="hidden" class="tdDes" value="<?php echo $des ?>"/>
                            <input type="hidden" class="tdParent" value="<?php echo $parentID ?>"/>
                        </tr>
<?php 
   if(isset($parent['child'])){
   	foreach ($parent['child'] as $key => $child){
   		$id     	= $child['categoryID'];
   		$name   	= $child['categoryName'];
   		$img    	= $child['categoryImage'];
   		$des    	= $child['categoryDescription'];
   		$sort   	= $child['categorySortOrder'];
   		$parentID 	= $child['parentCategoryID'];
   		?>
						<tr class="odd gradeX">
                            <td style="font-style: italic" class="txt-ct tdID">
                                <?php echo $id ?>
                            </td>
                            <td style="font-style: italic" class="txt-l tdName">
                                <?php echo $name ?>
                            </td>
                            <td class="txt-ct tdImg">
                                <?php if($img != ''){ ?><img src="<?php echo FILES_UPLOAD_THUMB.'/images/'.$img ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <td class="txt-ct">--</td>
                            <td class="txt-ct tdSort">
                                <?php echo $sort ?>
                            </td>
                            <td class="txt-ct span2">
                                <button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                                <button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
                            </td>
                            <input type="hidden" class="tdDes" value="<?php echo $des ?>"/>
                            <input type="hidden" class="tdParent" value="<?php echo $parentID ?>"/>
                        </tr>
<?php 
   }
   }
   }

   }else {
   echo 'Lỗi Truy Vấn Dữ Liệu';
   }
   }
   }
   public function edit_cat(){
   	if($this->input->post('aj_edit')){
   			 $categoryID 						= $this->input->post('aj_id');
   			 $arrUpdate['categoryName'] 		= $this->input->post('aj_name');
   			 $arrUpdate['categoryURL'] 			= convertUrl($arrUpdate['categoryName']);
   			 $arrUpdate['categoryImage'] 		= $this->input->post('aj_img');
   			 $arrUpdate['categoryDescription'] 	= $this->input->post('aj_des');
   			 $arrUpdate['categorySortOrder'] 	= $this->input->post('aj_sort');
   			 $arrUpdate['parentCategoryID'] 	= $this->input->post('aj_parent');
   			$result = $this->Cat_model->edit($categoryID, $arrUpdate);
   			if($result){
   			$this->_data['arrParent'] = $arrCat = $this->Cat_model->get_parent();
   		foreach ($arrCat as $key => $value){
   			$arr_child = $this->Cat_model->get_child($value['categoryID']);
   			if(count($arr_child) > 0){
   				$arrCat[$key]['child'] = $arr_child;
   			}
   		}
                           foreach ($arrCat as $key => $parent) {
                             $id     	= $parent['categoryID'];
                             $name   	= $parent['categoryName'];
                             $img    	= $parent['categoryImage'];
                             $des    	= $parent['categoryDescription'];
                             $sort   	= $parent['categorySortOrder'];
                             $parentID 	= $parent['parentCategoryID'];
   
                          ?>
						<tr class="odd gradeX">
                            <td style="font-weight: bold" class="txt-ct tdID">
                                <?php echo $id ?>
                            </td>
                            <td style="font-weight: bold" class="txt-l tdName">
                                <?php echo $name ?>
                            </td>
                            <td class="txt-ct tdImg">
                                <?php if($img != ''){ ?><img src="<?php echo FILES_UPLOAD_THUMB.'/images/'.$img ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <td class="txt-ct">--</td>
                            <td class="txt-ct tdSort">
                                <?php echo $sort ?>
                            </td>
                            <td class="txt-ct span2">
                                <button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                                <button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
                            </td>
                            <input type="hidden" class="tdDes" value="<?php echo $des ?>"/>
                            <input type="hidden" class="tdParent" value="<?php echo $parentID ?>"/>
                        </tr>
<?php 
   if(isset($parent['child'])){
   	foreach ($parent['child'] as $key => $child){
   		$id     	= $child['categoryID'];
   		$name   	= $child['categoryName'];
   		$img    	= $child['categoryImage'];
   		$des    	= $child['categoryDescription'];
   		$sort   	= $child['categorySortOrder'];
   		$parentID 	= $child['parentCategoryID'];
   		?>
						<tr class="odd gradeX">
                            <td style="font-style: italic" class="txt-ct tdID">
                                <?php echo $id ?>
                            </td>
                            <td style="font-style: italic" class="txt-l tdName">
                                <?php echo $name ?>
                            </td>
                            <td class="txt-ct tdImg">
                                <?php if($img != ''){ ?><img src="<?php echo FILES_UPLOAD_THUMB.'/images/'.$img ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <td class="txt-ct">--</td>
                            <td class="txt-ct tdSort">
                                <?php echo $sort ?>
                            </td>
                            <td class="txt-ct span2">
                                <button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                                <button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
                            </td>
                            <input type="hidden" class="tdDes" value="<?php echo $des ?>"/>
                            <input type="hidden" class="tdParent" value="<?php echo $parentID ?>"/>
                        </tr>
<?php 
   }
   }
   }

   }else {
   echo 'Lỗi Truy Vấn Dữ Liệu';
   }
   	}
   }
   public function del_cat(){
   	if($this->input->post('aj_id')){
   			 $categoryID = $this->input->post('aj_id');
   			$result = $this->Cat_model->del($categoryID);
   			if($result){
   			$this->_data['arrParent'] = $arrCat = $this->Cat_model->get_parent();
   		foreach ($arrCat as $key => $value){
   			$arr_child = $this->Cat_model->get_child($value['categoryID']);
   			if(count($arr_child) > 0){
   				$arrCat[$key]['child'] = $arr_child;
   			}
   		}
                           foreach ($arrCat as $key => $parent) {
                             $id     	= $parent['categoryID'];
                             $name   	= $parent['categoryName'];
                             $img    	= $parent['categoryImage'];
                             $des    	= $parent['categoryDescription'];
                             $sort   	= $parent['categorySortOrder'];
                             $parentID 	= $parent['parentCategoryID'];
   
                          ?>
						<tr class="odd gradeX">
                            <td style="font-weight: bold" class="txt-ct tdID">
                                <?php echo $id ?>
                            </td>
                            <td style="font-weight: bold" class="txt-l tdName">
                                <?php echo $name ?>
                            </td>
                            <td class="txt-ct tdImg">
                                <?php if($img != ''){ ?><img src="<?php echo FILES_UPLOAD_THUMB.'/images/'.$img ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <td class="txt-ct">--</td>
                            <td class="txt-ct tdSort">
                                <?php echo $sort ?>
                            </td>
                            <td class="txt-ct span2">
                                <button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                                <button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
                            </td>
                            <input type="hidden" class="tdDes" value="<?php echo $des ?>"/>
                            <input type="hidden" class="tdParent" value="<?php echo $parentID ?>"/>
                        </tr>
<?php 
   if(isset($parent['child'])){
   	foreach ($parent['child'] as $key => $child){
   		$id     	= $child['categoryID'];
   		$name   	= $child['categoryName'];
   		$img    	= $child['categoryImage'];
   		$des    	= $child['categoryDescription'];
   		$sort   	= $child['categorySortOrder'];
   		$parentID 	= $child['parentCategoryID'];
   		?>
						<tr class="odd gradeX">
                            <td style="font-style: italic" class="txt-ct tdID">
                                <?php echo $id ?>
                            </td>
                            <td style="font-style: italic" class="txt-l tdName">
                                <?php echo $name ?>
                            </td>
                            <td class="txt-ct tdImg">
                                <?php if($img != ''){ ?><img src="<?php echo FILES_UPLOAD_THUMB.'/images/'.$img ?>" class="img-thumbnail" />
                                <?php } ?>
                            </td>
                            <td class="txt-ct">--</td>
                            <td class="txt-ct tdSort">
                                <?php echo $sort ?>
                            </td>
                            <td class="txt-ct span2">
                                <button class="btn btn-primary btn-mini btn_edit"><i class="icon_pencil-edit"></i> Sửa</button>
                                <button class="btn btn-danger btn-mini btn_del"><i class="icon_close_alt2"></i> Xóa</button>
                            </td>
                            <input type="hidden" class="tdDes" value="<?php echo $des ?>"/>
                            <input type="hidden" class="tdParent" value="<?php echo $parentID ?>"/>
                        </tr>
<?php 
   }
   }
   }

   }else {
   echo 'Lỗi Truy Vấn Dữ Liệu';
   }
   	}
}
}