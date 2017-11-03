
<script type="text/javascript">
	var editerField; 
   function BrowseServer(field)
   {
   	// You can use the "CKFinder" class to render CKFinder in a page:
   	var finder = new CKFinder();
   	finder.connectorPath = '<?php echo base_url("admin/admin_ckfinder/connector")?>';
   	finder.basePath = '';	// The path for the installation of CKFinder (default = "/ckfinder/").
   	finder.selectActionFunction = SetFileField;
   	finder.popup();
   	editerField = field;
   }
   
   function SetFileField( fileUrl )
   {

   	document.getElementById( editerField ).value = fileUrl;
   	var link = $("#"+editerField+"").val();
 	$("#"+editerField+"").parents("div.form-group").find("img").attr({'src':link, 'style': 'max-width: 100px'});
   }

</script>
              
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
                             <?php if(isset($title))echo $title?> Admin
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
                              <?php 
                              if(isset($arr_site_admin)){
                              	$name 		= $arr_site_admin['site_name'];
                              	$logo 		= $arr_site_admin['site_logo'];
                              	$favicon 	= $arr_site_admin['site_favicon'];
                              	$site_title 		= $arr_site_admin['site_title'];
                              	$des 		= $arr_site_admin['site_des'];
                              	$rows_page 	= $arr_site_admin['site_num_page'];
                              }
                              ?>
									<form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <input class="form-control" name="name" type="text" value="<?php if(isset($name))echo $name?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="title" type="text"  value="<?php if(isset($site_title))echo $site_title?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mô tả </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <textarea class="form-control" name="des" rows="2"><?php echo $des?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Logo <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                          <?php echo form_error('logo', '<li>', '</li>')?>
                                          </ul>
                                          <div class="btn btn-default pull-left" style="margin-right: 5px;" onclick="BrowseServer('logo-admin')">Duyệt...</div>
                                          <span class="pull-left" style="width: 85%"><input class="form-control" id="logo-admin" name="logo" type="text"/>
                                          <div class="logo-prev" style="margin-top: 5px"><img src="<?php echo $logo?>" class="img-thumbnail" style="max-width: 100px"></div> 
                                          </span>
                                            
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Shortcut icon <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                          <?php echo form_error('logo', '<li>', '</li>')?>
                                          </ul>
                                          <div class="btn btn-default pull-left" style="margin-right: 5px;" onclick="BrowseServer('icon-admin')">Duyệt...</div>
                                          <span class="pull-left" style="width: 85%"><input class="form-control" id="icon-admin" name="icon" type="text"/>
                                          <div class="icon-prev" style="margin-top: 5px"><img src="<?php echo $favicon?>" class="img-thumbnail" style="max-width: 100px"></div> 
                                          </span>
                                            
                                          </div>
                                      </div>
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Phân trang </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="rows_page" type="number" min="5" max="100" value="<?php if(isset($rows_page))echo $rows_page?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="btn_save_admin" value="Lưu"/>
                                              <input class="btn btn-default" type="reset" value="Nhập lại"/>
                                          </div>
                                      </div>
                                 </form>
                              </div>
                          </div>
                      </section>
                      <section class="panel">
                          <header class="panel-heading">
                             <?php if(isset($title))echo $title?> Public
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
                              <?php 
                              if(isset($arr_site_public)){
                              	$name 		= $arr_site_public['site_name'];
                              	$logo 		= $arr_site_public['site_logo'];
                              	$favicon 	= $arr_site_public['site_favicon'];
                              	$site_title 		= $arr_site_public['site_title'];
                              	$des 		= $arr_site_public['site_des'];
                              	$key 		= $arr_site_public['site_key'];
                              	$rows_page 	= $arr_site_public['site_num_page'];
                              }
                              ?>
									<form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <input class="form-control" name="name" type="text" value="<?php if(isset($name))echo $name?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="title" type="text"  value="<?php if(isset($site_title))echo $site_title?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mô tả </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <textarea class="form-control" name="des" rows="2"><?php echo $des?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Từ khóa </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <textarea class="form-control" name="key" rows="2"><?php echo $key?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Logo <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                          <?php echo form_error('logo', '<li>', '</li>')?>
                                          </ul>
                                          <div class="btn btn-default pull-left" style="margin-right: 5px;" onclick="BrowseServer('logo-public')">Duyệt...</div>
                                          <span class="pull-left" style="width: 85%"><input class="form-control" id="logo-public" name="logo" type="text"/>
                                          <div class="logo-prev" style="margin-top: 5px"><img src="<?php echo $logo ?>" class="img-thumbnail" style="max-width: 100px"></div> 
                                          </span>
                                            
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Shortcut icon <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                          <?php echo form_error('logo', '<li>', '</li>')?>
                                          </ul>
                                          <div class="btn btn-default pull-left" style="margin-right: 5px;" onclick="BrowseServer('icon-public')">Duyệt...</div>
                                          <span class="pull-left" style="width: 85%"><input class="form-control" id="icon-public" name="icon" type="text"/>
                                          <div class="icon-prev" style="margin-top: 5px"><img src="<?php echo $favicon?>" class="img-thumbnail" style="max-width: 100px"></div> 
                                          </span>
                                            
                                          </div>
                                      </div>
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Phân trang </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="rows_page" type="number" min="5" max="100" value="<?php if(isset($rows_page))echo $rows_page?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="btn_save_public" value="Lưu"/>
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