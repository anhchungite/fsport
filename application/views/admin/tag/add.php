
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
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mô tả</label>
                                          <div class="col-lg-10">
                                          <?php echo form_error('mota')?>
                                              <textarea class="form-control" name="des" rows="2"><?php echo set_value('des')?></textarea>
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