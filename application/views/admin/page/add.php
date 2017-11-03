
              
            <div class="row">
				<div class="col-lg-12">
					<?php if($this->session->flashdata('flash_ss')){?>
					  <div class="alert alert-success fade in">
						  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_ss')?>.
					  </div>
					  <?php }?>
					  <?php if($this->session->flashdata('flash_er')){?>
					  <div class="alert alert-danger fade in">
						  <strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
					  </div>
					  <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                              <?php if(isset($title))echo $title?>
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
									<form class="form-validate form-horizontal" id="page_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('tieude')?>
                                              <input class="form-control" name="tieude" type="text" value="<?php echo set_value('tieude')?>" required />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Nội dung <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <?php echo form_error('noidung')?>
                                              <textarea class="form-control ckeditor" name="noidung" rows="5"><?php echo set_value('noidung')?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Hiển thị </label>
                                          <div class="col-lg-5">
                                              <input class="form-control" style="display: inline; width: 20px;margin: 0px;" name="trangthai" type="radio" value="1" checked> Yes 
                                              <input class="form-control" style="display: inline; width: 20px;margin: 0px;" name="trangthai" type="radio" value="0"> No
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="btn_save" value="Lưu"/>
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