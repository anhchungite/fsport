
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

            <div class="checkout-right page-checkout account">
                <h3 style="margin: 0 0 1em;">Khôi phục <span>mật khẩu</span></h3>
                <form class="form-horizontal" method="post" action="">
                    <div class="form-group required">
                        <label class="control-label col-sm-2" for="email">Mật khẩu mới:</label>
                        <div class="col-sm-5">
                            <input type="password" name="pass" class="form-control" placeholder="Nhập mật khẩu mới">
                            <?php echo form_error('pass')?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label col-sm-2" for="pwd">Xác nhận mật khẩu:</label>
                        <div class="col-sm-5">
                            <input type="password" name="repass" class="form-control" placeholder="Xác nhận mật khẩu">
                            <?php echo form_error('repass')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <input type="submit" name="btn_send" class="btn btn-primary" value="Khôi phục">
                        </div>
                    </div>
                </form>
            </div>

		</div>
	</div>
	
<!-- //checkout -->
