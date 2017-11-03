<?php
echo '<pre>';
print_r($arr_user_profile);
echo '</pre>';

?>
<!-- checkout -->
	<div class="checkout">
		<div class="container">
            <h3>Thay đổi <span>mật khẩu</span></h3>
			<div class="checkout-right member info">
                <div class="row">

                    <div class="col-sm-12">
                        <form class="form-validate form-horizontal" id="user_form" method="post" action="" enctype="multipart/form-data">
                        <div class="form">
                                <div class="form-group ">
                                    <label class="control-label col-lg-3">Mật khẩu cũ</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" name="matkhaucu" type="password" maxlength="100" value="">
                                    </div>
                                    <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('matkhaucu')?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-3">Mật khẩu mới</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" name="matkhaumoi" type="password" maxlength="100" value="">
                                    </div>
                                    <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('matkhaumoi')?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-3">Xác nhận mật khẩu mới</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" name="xn_matkhaumoi" type="password" maxlength="100" value="">
                                    </div>
                                    <div class="col-lg-offset-3 col-lg-6">
                                    <?= form_error('xn_matkhaumoi')?>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 50px">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <input class="btn btn-primary" type="submit" name="btn_save" value="Lưu">
                                        <input class="btn btn-default" type="reset" value="Nhập lại">
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
			</div>
			<div class="checkout-left">

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>


<!-- //checkout -->
