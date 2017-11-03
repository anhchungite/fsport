<style>
.lbl-info{
    width: 25%;
    text-align: right;
    font-weight: bold;
}
.txt-info{
    font-style: italic;
}
button[type='button'].btn-default a{
    color: inherit;
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
                          <?php
                          if(isset($arr_user)){
                          $id       = $arr_user['userID'];
                          $name     = $arr_user['userFullName'];
                          $username = $arr_user['userName'];
                          $avatar   = $arr_user['userAvatar'];
                          $email    = $arr_user['userEmail'];
                          $birth    = date('d-m-Y', strtotime($arr_user['userBirthday']));
                          $phone    = $arr_user['userPhone'];
                          $sex      = ($arr_user['userSex'] == 0)? "Nữ":"Nam";
                          $add      = $arr_user['userAddress'];
                          $city     = $arr_user['cityName'];
                          $level    = $arr_user['userLevel'];
                          $create    = date('d M Y', strtotime($arr_user['createDate']));
                          if($arr_user['userLevel'] == 1){$level = "Admin";}else if ($arr_user['userLevel'] == 2){$level = "Support";}else{$level = "Member";};
                          ?>
                          <header class="panel-heading">
                              <?php if(isset($title))echo $title.' '.$name?>
                          </header>
                          <div class="panel-body">
                              <div class="row">
                                  <div class="col-sm-3">
                                      <img src="<?php echo FILES_UPLOAD.'/img/'.$avatar?>" class="img-thumbnail" alt="">
                                      <h3 style="font-weight: bold"><?php echo $name?></h3>
                                      <h4><?php echo $username?></h4>
                                      <hr>
                                      <p><i class="fa fa-clock-o" aria-hidden="true"></i> Tham gia vào <?php echo $create?></p>
                                  </div>
                                  <div class="col-sm-9">

                                              <table class="table table-responsive">
                                                  <tr>
                                                      <td class="lbl-info">ID:</td>
                                                      <td class="txt-info"><?php echo $id ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Họ và tên:</td>
                                                      <td class="txt-info"><?php echo $name ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Tên người dùng:</td>
                                                      <td class="txt-info"><?php echo $username ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Email:</td>
                                                      <td class="txt-info"><?php echo $email ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Ngày sinh:</td>
                                                      <td class="txt-info"><?php echo $birth ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Số điện thoại:</td>
                                                      <td class="txt-info"><?php echo $phone ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Giới tính:</td>
                                                      <td class="txt-info"><?php echo $sex ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Địa chỉ:</td>
                                                      <td class="txt-info"><?php echo $add.'<br/>'.$city ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="lbl-info">Quyền:</td>
                                                      <td class="txt-info"><?php echo $level ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td colspan="2" class="text-center">
                                                          <button type="button" class="btn btn-default"><i class="arrow_back"></i> <a href="<?php echo base_url('admin/admin_user')?>">Trở về</a></button>
                                                          <?php if($this->auth->checkAdmin() || $this->auth->getInfo()['userID'] == $id){?>
                                                          <button type="button" class="btn btn-default"><i class="icon_refresh"></i> <a href="<?php echo base_url('admin/admin_user/edit/'.$id)?>">Cập nhật thông tin</a></button>
                                                          <?php } ?>
                                                      </td>
                                                  </tr>
                                              </table>


                                  </div>
                              </div>
                          </div>

                              <?php
                          }
                          ?>
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