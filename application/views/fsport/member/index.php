<?php
echo '<pre>';
print_r($arr_user_profile);
echo '</pre>';
?>
<!-- checkout -->
	<div class="checkout">
		<div class="container">
            <h3>Thông tin <span>thành viên</span></h3>
			<div class="checkout-right member info">
                <div class="row">

                    <div class="col-sm-3">
                        <div class="block_avatar">
                            <div class="bg_avatar" style="background-image: url('<?= IMG_UPLOAD.'/'.$arr_user_profile['userAvatar']?>')"></div>
                            <div class="sub_bg_avatar"></div>

                                <div class="img_avatar">
                                    <div class="avatar">
                                        <div class="avatar_placeholder"></div>
                                        <img src="<?= IMG_UPLOAD.'/'.$arr_user_profile['userAvatar']?>" class="thumb-avatar" alt="">
                                    </div>
                                </div>

                        </div>
                        <h3><?= $arr_user_profile['userFullName']?></h3>
                        <h4><?= $arr_user_profile['userName']?></h4>

                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> Tham gia vào <?= $arr_user_profile['createDate']?></p>
                        <hr>
                        <ul>
                            <li><a href="<?= base_url('member/update-profile')?>">Cập nhật thông tin</a></li>
                            <li> <a href="<?= base_url('member/order-history')?>">Lịch sử mua hàng</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-9">

                        <table class="table table-striped table-responsive">
                            <tbody>

                            <tr>
                                <td class="lbl-info">Họ và tên:</td>
                                <td class="txt-info"><?= $arr_user_profile['userFullName']?></td>
                            </tr>
                            <tr>
                                <td class="lbl-info">Tên người dùng:</td>
                                <td class="txt-info"><?= $arr_user_profile['userName']?></td>
                            </tr>
                            <tr>
                                <td class="lbl-info">Email:</td>
                                <td class="txt-info"><?= $arr_user_profile['userEmail']?></td>
                            </tr>
                            <tr>
                                <td class="lbl-info">Ngày sinh:</td>
                                <td class="txt-info"><?= $arr_user_profile['userBirthday']?></td>
                            </tr>
                            <tr>
                                <td class="lbl-info">Số điện thoại:</td>
                                <td class="txt-info"><?= $arr_user_profile['userPhone']?></td>
                            </tr>
                            <tr>
                                <td class="lbl-info">Giới tính:</td>
                                <td class="txt-info"><?= $arr_user_profile['userSex']==1? 'Nam':'Nữ'?></td>
                            </tr>
                            <tr>
                                <td class="lbl-info">Địa chỉ:</td>
                                <td class="txt-info"><?= $arr_user_profile['userAddress'].' - '.$arr_user_profile['userDistrict'].' - '.$arr_user_profile['cityName']?></td>
                            </tr>

                            </tbody></table>


                    </div>
                </div>
			</div>
			<div class="checkout-left">



				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

<!-- //checkout -->
