
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
                              <?php if(isset($title))echo ucwords($title)?>
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
									<form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                        <div class="form-group ">
                                            <label class="control-label col-lg-2">Họ và tên <span class="required">*</span></label>
                                            <div class="col-lg-6">
                                                <?php echo form_error('fullname')?>
                                                <input class="form-control" name="fullname" type="text"  value="<?php echo set_value('fullname')?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label col-lg-2">Tên người dùng <span class="required">*</span></label>
                                            <div class="col-lg-6">
                                                <?php echo form_error('username')?>
                                                <input class="form-control" name="username" type="text" value="<?php echo set_value('username')?>"/>
                                            </div>
                                        </div>

                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mật khẩu <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('password')?>
                                              <input class="form-control" name="password" type="password" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Xác nhận mật khẩu <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('re-password')?>
                                              <input class="form-control" name="re-password" type="password" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Email <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('email')?>
                                              <input class="form-control" name="email" type="email"  value="<?php echo set_value('email')?>" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Phân quyền <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <?php echo form_error('quyen')?>
                                          		<?php
                                          		if(isset($arr_level)){
	                                          		foreach ($arr_level as $key => $value){
                                                        if($key != 3) {
                                                            ?>
                                                                <input type="radio" name="quyen"
                                                                       value="<?php echo $key ?>" <?php echo set_radio('quyen', $key)?>> <?php echo ucfirst($value) ?>
                                                            <?php
                                                        }
													}
                                          		}
                                          		
	                                            ?>	
                                             </div>
                                      </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">

                                            <input class="btn btn-primary" type="submit" name="btn_save_admin" value="Lưu"/>
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
      <script type="text/javascript" src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">

	$('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		format: 'yyyy-mm-dd',

    });

</script>
      <!--main content end-->