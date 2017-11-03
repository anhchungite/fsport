
<script type="text/javascript">
   function BrowseServer()
   {
   	// You can use the "CKFinder" class to render CKFinder in a page:
   	var finder = new CKFinder();
   	finder.connectorPath = '<?php echo base_url("admin/admin_ckfinder/connector")?>';
   	finder.basePath = '';	// The path for the installation of CKFinder (default = "/ckfinder/").
   	finder.selectActionFunction = SetFileField;
   	finder.popup();
   
   }
   
   function SetFileField( fileUrl )
   {
	var arr_name = fileUrl.split('/');
	var name = arr_name.pop();
   	document.getElementById( 'link_logo' ).value = fileUrl;
   	var url = "<?php echo FILES_UPLOAD_THUMB?>/images/"+name;
   	$(".logo-prev").css({'margin-top': '5px'});
   	$(".logo-prev").html('<img src="'+url+'" class="img-thumbnail"/>');
   }
   
   	
</script>
<style>
.form-control{display: inline!important}
</style>
              
            <div class="row">
				<div class="col-lg-12">
					<?php if($this->session->flashdata('flash_er')){?>
					<div class="alert alert-danger fade in">
						  <strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
					 </div>
					  <?php }?>
					  <?php if($this->session->flashdata('flash_ss')){?>
					<div class="alert alert-success fade in">
						  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_ss')?>.
					 </div>
					  <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                              <?php if(isset($title))echo $title?>
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
									<form class="form-validate form-horizontal" id="cat_form" method="post" action="">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('name')?>
                                              <input class="form-control" name="name" type="text" value="<?php echo set_value('name')?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Hình ảnh <span class="required">*</span></label>
                                          <div class="col-lg-6">

                                          <?php echo form_error('image')?>

                                          <div class="btn btn-default pull-left" style="margin-right: 5px;" onclick="BrowseServer()">Duyệt...</div>
                                          <span class="pull-left" style="width: 85%"><input class="form-control" id="link_logo" name="image" type="text" value="<?php echo set_value('image')?>"/>
                                          <div class="logo-prev"></div> 
                                          </span>
                                            
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mô tả</label>
                                          <div class="col-lg-10">

                                          <?php echo form_error('des')?>

                                              <textarea class="form-control" name="des" rows="2"><?php echo set_value('des')?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
										  <label class="control-label col-lg-2">Cha</label>
										  <div class="col-lg-3">
											  <select class="form-control m-bot15" name="parent">
												  <option value="0">- Không -</option>
												  <?php
                                                  function show_cat($arr_all_cat, $parent_id = 0, $char=""){
                                                      foreach ($arr_all_cat as $key => $value){
                                                          if($value['parentCategoryID'] == $parent_id){
                                                              $arrow = $parent_id==0?"+ ":"";
                                                              ?>

                                                              <option value="<?php echo $value['categoryID']?>" <?php echo set_value('parent')==$value['categoryID']?"selected":""?>>
                                                              <?php echo $arrow.$char.$value['categoryName'] ?>
                                                              </option>
                                                              <?php
                                                              unset($arr_all_cat[$key]);
                                                              show_cat($arr_all_cat, $value['categoryID'], $char."|---");

                                                          }
                                                      }
                                                  }
                                                  show_cat($arr_all_cat);
												  ?>
											  </select>
										  </div>
									  </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Thứ tự </label>
                                          <div class="col-lg-5">
                                              <input type="number" min="1" max="100" value="1" name="sort" required/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="btn_save" value="Lưu lại"/>
                                              <input class="btn btn-success" type="submit" name="btn_save_add" value="Lưu & thêm"/>
                                              <input class="btn btn-default" type="reset" value="Nhập lại"/>
                                          </div>
                                      </div>
                                 </form>
                              </div>
                          </div>

                      </section>
                  </div>
				</div>

          </section>
      </section>
      <!--main content end-->