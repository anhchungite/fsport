
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
   	document.getElementById( 'link_logo' ).value = fileUrl;
   	$(".logo-prev").css({'margin-top': '5px'});
   	$(".logo-prev").html('<img src="'+fileUrl+'" class="img-thumbnail" width="100px"/>');
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
                              <?php if(isset($arrBrand))
                              {
                              	$name = $arrBrand['brandName'];
                              	$logo = $arrBrand['brandLogo'];
                              }?>
									<form class="form-validate form-horizontal" id="cat_form" method="post" action="">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('name')?>
                                              <input class="form-control" name="name" type="text" value="<?php echo set_value('name', $name)?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Logo <span class="required">*</span></label>
                                          <div class="col-lg-6">

                                          <?php echo form_error('logo')?>

                                          <div class="btn btn-default pull-left" style="margin-right: 5px;" onclick="BrowseServer();">Duyệt...</div>
                                          <span class="pull-left" style="width: 85%"><input class="form-control" id="link_logo" name="logo" type="text" value="<?php echo set_value('logo', $logo)?>"/>
                                          <div class="logo-prev" style="margin-top: 5px"><img src="<?php echo $logo?>" class="img-thumbnail" width="100px"></div> 
                                          </span>
                                            
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