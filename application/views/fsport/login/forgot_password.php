
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
                <h3 style="margin: 0 0 1em;">Yêu cầu <span>mật khẩu</span></h3>
                <form class="form-horizontal" method="post" action="">
                    <div class="form-group required">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-5">
                            <input type="text" name="email" class="form-control" placeholder="Email:">
                            <?php echo form_error('email')?>
                            <?php if(isset($mg)) echo $mg?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
<!--                            <button type="submit" name="btn_send" class="btn btn-primary">Gửi yêu cầu</button>-->
                            <input type="submit" name="btn_send" class="btn btn-primary" value="Gửi yêu cầu">
                        </div>
                    </div>
                </form>


            </div>

		</div>
	</div>
	
<!-- //checkout -->
