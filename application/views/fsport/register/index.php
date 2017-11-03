
<?php
$name = "";
$email = "";
$username = "";
$pass = "";
if(isset($post_modal)){
    $name = $post_modal['name'];
    $email = $post_modal['email'];
    $username = $post_modal['username'];
    $pass = $post_modal['password'];
}
?>
<!-- checkout -->
	<div class="checkout">
		<div class="container">


            <form id="form_checkout" action="#" method="post">
            <div class="checkout-right page-checkout account">
                <h3 style="margin: 0 0 1em;">Thông tin <span>đăng ký</span></h3>
                <div class="panel-body"><div class="row">
                        <div class="col-sm-6">
                            <fieldset id="account">
                                <legend>Tài khoản</legend>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-lastname">Tên đăng nhập:</label>

                                    <input type="text" name="reg_username" value="<?php echo set_value('reg_username',$username)?>" placeholder="Tên đăng nhập:" id="input-payment-lastname" class="form-control">
                                    <?php echo form_error('reg_username')?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-email">Mật khẩu:</label>
                                    <input type="password" name="reg_pass" value="<?php echo set_value('reg_pass',$pass)?>" placeholder="Mật khẩu:" id="input-payment-email" class="form-control">
                                    <?php echo form_error('reg_pass')?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-email">Xác nhận mật khẩu:</label>
                                    <input type="password" name="reg_repass" value="<?php echo set_value('reg_repass')?>" placeholder="Mật khẩu:" id="input-payment-email" class="form-control">
                                    <?php echo form_error('reg_repass')?>
                                </div>
                                <legend>Liên hệ</legend>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-lastname">Họ và tên:</label>
                                    <input type="text" name="reg_name" value="<?php echo set_value('reg_name',$name)?>" placeholder="Họ và tên:" id="input-payment-lastname" class="form-control">
                                    <?php echo form_error('reg_name')?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-email">E-mail:</label>
                                    <input type="email" name="reg_email" value="<?php echo set_value('reg_email',$email)?>" placeholder="E-mail:" id="input-payment-email" class="form-control">
                                    <?php echo form_error('reg_email')?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-telephone">Điện thoại:</label>
                                    <input type="text" name="reg_phone" value="<?php echo set_value('reg_phone')?>" placeholder="Điện thoại:" id="input-payment-telephone" class="form-control">
                                    <?php echo form_error('reg_phone')?>
                                </div>

                            </fieldset>

                        </div>
                        <div class="col-sm-6">
                            <fieldset id="address">
                                <legend>Địa chỉ</legend>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-address-1">Địa chỉ:</label>
                                    <input type="text" name="reg_address" value="<?php echo set_value('reg_address')?>" placeholder="VD: 32/70 Lê Thị Hồng" id="input-payment-address-1" class="form-control">
                                    <?php echo form_error('reg_address')?>
                                </div>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-address-1">Quận / Huyện:</label>
                                    <input type="text" name="reg_district" value="<?php echo set_value('reg_district')?>" placeholder="VD: P17 - Gò Vấp" id="input-payment-address-1" class="form-control">
                                    <?php echo form_error('reg_district')?>
                                </div>


                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-zone">Thành phố:</label>
                                    <select name="reg_city" id="input-payment-zone" class="form-control">
                                        <option value="">- Chọn -</option>
                                        <?php
                                        if(isset($arrCity)): foreach ($arrCity as $key => $value):
                                            if($value['cityID'] != 100):
                                                ?>
                                                <option value="<?php echo $value['cityID']?>" <?php echo set_value('reg_city') == $value['cityID']?"selected":""?>><?php echo $value['cityName']?></option>
                                            <?php  endif; endforeach; endif;?>

                                    </select>
                                    <?php echo form_error('reg_city')?>
                                </div>
                            </fieldset>

                        </div>
                    </div>


                </div>

            </div>


                <div class="checkout-left">
                    <hr/>
                    <div class="col-sm-4">


                    </div>
                    <div class="col-sm-4 text-center">
                        <input class="btn btn-danger" type="reset" value="Reset">
                        <input class="btn btn-primary" type="submit" name="btn_send" value="Gửi yêu cầu">

                    </div>
                    <div class="col-sm-4">




                    </div>
                    <div class="clearfix"></div>
                </div>

            </form>
		</div>
	</div>
	
<!-- //checkout -->
