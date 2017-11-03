<style>
.modal-dialog {left: 0px !important}
</style>

<style>
    .col-md-3.quyen{
        text-align: center;
    }
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
                              <?php if(isset($arrUser)){
                              	$id_user 		= $arrUser['userID'];
                              	$username 		= $arrUser['userName'];
                              	$email 			= $arrUser['userEmail'];
                              	$fullname 		= ucwords($arrUser['userFullName']);
                              	$level 			= $arrUser['userLevel'];
                              	$birth 			= $arrUser['userBirthday'];
                              	$phone 			= $arrUser['userPhone'];
                              	$avatar 		= $arrUser['userAvatar'];
                              	$address 		= $arrUser['userAddress'];
                              	$city 			= $arrUser['cityID'];
                              	$sex 			= $arrUser['userSex'];

                              	
                              }?>
									<form class="form-validate form-horizontal" id="user_form" method="post" action="" enctype="multipart/form-data">
										<div class="form-group ">
                                          <label class="control-label col-lg-2">Tên người dùng <span class="required">*</span></label>
                                          <div class="col-lg-4">
                                          <?php echo form_error('username')?>
                                              <input class="form-control" name="username" type="text" value="<?php echo $username ?>" disabled />
                                          </div>
                                          <div class="col-lg-2">
                                              <a class="form-control btn btn-default" href="<?php echo base_url('admin/admin_user/change_password/'.$id_user)?>"><span class="fa fa-pencil"></span> Đổi mật khẩu</a>
                                             
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                      	<label class="control-label col-lg-2">Avatar </label>
                                          <div class="col-lg-4">
                                              <input class="form-control" name="hinhanh" type="file" />
                                              <div class="logo-prev" style="margin-top:5px"><img class="img-thumbnail" alt="" src="<?php echo IMG_UPLOAD.'/'.$avatar?>" width="100px" height="100px"></div>
                                          </div>
                                          <div class="col-lg-2">
                                              <input class="form-control btn btn-default" type="submit" name="btn_upload" value="Upload"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Email <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('email')?>
                                              <input class="form-control" name="email" type="email"  value="<?php echo set_value('email', $email)?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Họ và tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="fullname" type="text"  value="<?php echo set_value('fullname', $fullname)?>"/>
                                          </div>
                                      </div>
                                        <?php //if($this->auth->checkAdmin()){?>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Phân quyền <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                          	<div class="row">
                                          		<?php
                                          		if(isset($arr_level)){
	                                          		foreach ($arr_level as $key => $value){
	                                          		?>
	                                          			<div class="col-md-3 quyen" <?php echo !$this->auth->checkAdmin() && $key != $this->auth->getInfo()['userLevel'] || $id_user == 1 && $key > 1?"style='display: none'":""?>>
	                                          				<input type="radio" name="quyen" value="<?php echo $key ?>" <?php echo set_value('quyen', $level)==$key?"checked":""?>><?php echo ucfirst($value)?>
		                                            	</div>
		                                            <?php 
													}
                                          		}
                                          		
	                                            ?>	
                                             </div>
                                           </div>
                                      </div>
                                    <?php //} ?>
                                  
					    			<div class="form-group ">
                                          <label class="control-label col-lg-2">Ngày sinh</label>
                                         
                                          <div class="input-group date form_date col-lg-6" style="padding: 0 15px !important;" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							                    <input class="form-control" name="ngaysinh" type="text" value="<?php echo $birth ?>" readonly>
							                   
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							                </div>
                                         
                                      </div>
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Số điện thoại</label>
                                          <div class="col-lg-6">
                                          
                                              <input class="form-control" name="dienthoai" type="text" maxlength="20" value="<?php echo $phone?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Giới tính</label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('gioitinh')?>
                                              <input type="radio" name="gioitinh" value="1" <?php echo set_value('gioitinh',$sex)==1?"checked":""?>> Nam
                                              <input type="radio" name="gioitinh" value="0" <?php echo set_value('gioitinh',$sex)==0?"checked":""?>> Nữ
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Địa chỉ</label>
                                          <div class="col-lg-6">
                                          
                                              <input class="form-control" name="diachi" type="text"  maxlength="100" value="<?php echo $address?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tỉnh thành</label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('thanhpho')?>
                                              <select class="form-control" name="thanhpho">
	                                              <option value="">- Chọn - </option>
	                                              <?php 
	                                              if(isset($arrCity)): foreach ($arrCity as $key => $value):
	                                              	if($value['cityID'] != 100):
//                                                        $select = "";
//                                                        if($city == $value['cityID']){
//                                                            $select = "selected";
//                                                        }
	                                              ?>
	                                              <option value="<?php echo $value['cityID']?>" <?php echo set_value('thanhpho', $city)==$value['cityID']?"selected":"" ?>><?php echo $value['cityName']?></option>
	                                              <?php  endif; endforeach; endif;?>
                                              </select>
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
		format: 'yyyy-mm-dd'
    });

</script>
      <!--main content end-->