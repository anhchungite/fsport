<?php
$pay_name = "";
$pay_email = "";
$pay_phone = "";
$pay_district = "";
$pay_address = "";
$pay_city = "";
$pay_method = "";
$ship_name = "";
$ship_email = "";
$ship_telephone = "";
$ship_district = "";
$ship_address = "";
$ship_city = "";
$order_note = "";
$shipping_address = 0;
if(isset($user_profile)){
    $pay_name = $user_profile['userFullName'];
    $pay_email = $user_profile['userEmail'];
    $pay_phone = $user_profile['userPhone'];
    $pay_district = $user_profile['userDistrict'];
    $pay_address = $user_profile['userAddress'];
    $pay_city = $user_profile['cityID'];
}
if(isset($customer)){
    if(isset($customer['shipping_address'])){
        $pay_name = $customer['pay_name'];
        $pay_email = $customer['pay_email'];
        $pay_telephone = $customer['pay_telephone'];
        $pay_district = $customer['pay_district'];
        $pay_address = $customer['pay_address'];
        $pay_city = $customer['pay_city'];
        $pay_method = $customer['pay_method'];
        $order_note = $customer['order_note'];
        $shipping_address = $customer['shipping_address'];
    }else{
        $pay_name = $customer['pay_name'];
        $pay_email = $customer['pay_email'];
        $pay_telephone = $customer['pay_telephone'];
        $pay_district = $customer['pay_district'];
        $pay_address = $customer['pay_address'];
        $pay_city = $customer['pay_city'];
        $pay_method = $customer['pay_method'];
        $order_note = $customer['order_note'];

        $ship_name = $customer['ship_name'];
        $ship_telephone = $customer['ship_telephone'];
        $ship_district = $customer['ship_district'];
        $ship_address = $customer['ship_address'];
        $ship_city = $customer['ship_city'];
    }
}
?>

<!-- checkout -->
	<div class="checkout">
		<div class="container">

                <?php
                if(!$this->auth->checkLogged()){
                    ?>
                <h3>Quý khách vui lòng <span>đăng nhập</span></h3>

                <div class="checkout-right">
                    <div class="checkout-left-basket">
                        <a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>Đăng nhập</a>

                    </div>
                    <script>
                        $('#myModal88').modal('show');
                    </script>
                <div class="clearfix"></div>
            </div>
                <?php
                }
                ?>

            <?php
            if ($this->auth->checkLogged()) {
                ?>

            <form id="form_checkout" action="<?php //echo base_url('cart/checkout') ?>" method="post">
            <div class="checkout-right page-checkout account">
                <h3 style="margin: 0 0 1em;">Thông tin <span>thanh toán</span></h3>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset id="account">
                                <legend>Tài khoản</legend>


                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-lastname">Họ và tên:</label>
                                    <input type="text" name="pay_name" value="<?php echo set_value('pay_name', $pay_name)?>" placeholder="Họ và tên:" id="input-payment-lastname" class="form-control">
                                    <?php echo form_error('pay_name')?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-email">E-Mail:</label>
                                    <input type="text" name="pay_email" value="<?php echo set_value('pay_email',$pay_email)?>" placeholder="E-Mail:" id="input-payment-email" class="form-control">
                                    <?php echo form_error('pay_email')?>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-telephone">Điện thoại:</label>
                                    <input type="text" name="pay_telephone" value="<?php echo set_value('pay_telephone',$pay_phone)?>" placeholder="Điện thoại:" id="input-payment-telephone" class="form-control">
                                    <?php echo form_error('pay_telephone')?>
                                </div>


                            </fieldset>

                        </div>
                        <div class="col-sm-6">
                            <fieldset id="address">
                                <legend>Địa Chỉ</legend>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-address-1">Địa chỉ:</label>
                                    <input type="text" name="pay_address" value="<?php echo set_value('pay_address', $pay_address)?>" placeholder="VD: 32/70 Lê Thị Hồng" id="input-payment-address-1" class="form-control">
                                    <?php echo form_error('pay_address')?>
                                </div>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-address-1">Quận / Huyện:</label>
                                    <input type="text" name="pay_district" value="<?php echo set_value('pay_district', $pay_district)?>" placeholder="VD: P17 - Gò Vấp" id="input-payment-address-1" class="form-control">
                                    <?php echo form_error('pay_district')?>
                                </div>


                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-zone">Thành phố:</label>
                                    <select name="pay_city" id="input-payment-zone" class="form-control">
                                        <option value=""> --- Chọn --- </option>
                                        <?php
                                        if(isset($arrCity)){
                                            foreach ($arrCity as $key => $value){
                                                ?>
                                                <option value="<?php echo $value['cityID']?>" <?php echo set_value('pay_city', $pay_city) == $value['cityID']?"selected":""?>><?php echo $value['cityName']?></option>
                                                <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                    <?php echo form_error('pay_city')?>
                                </div>
                            </fieldset>

                        </div>
                    </div>




                </div>
                <h3 style="margin: 2em 0 1em;">Phương thức <span>Thanh toán</span></h3>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="pay_method" value="ck" <?php echo set_value('pay_method', $pay_method) == 'ck'?"checked":""?>>
                                        Chuyển khoản</label><br/>
                                    <label>
                                        <input type="radio" name="pay_method" value="cod" <?php echo set_value('pay_method', $pay_method) == 'cod'?"checked":""?>>
                                        Giao hàng và thu tiền tận nơi (COD)</label>
                                    <?php echo form_error('pay_method')?>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="shipping_address" id="shipping_address" value="1" <?php echo set_value('shipping_address', $shipping_address)==1?"checked":""?>>
                                        Thông tin giao hàng và thông tin thanh toán của tôi giống nhau.</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-payment-lastname">Ghi chú đơn hàng (nếu có):</label>
                                    <textarea rows="4" style="resize: vertical" name="order_note" placeholder="Ghi chú" class="form-control"><?php echo set_value('order_note', $order_note)?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="checkout-right page-checkout shipping">
                <h3 style="margin: 2em 0 1em;">Thông tin <span>giao hàng</span></h3>
                <div class="panel-body"><div class="row">
                        <div class="col-sm-6">
                            <fieldset id="account">
                                <legend>Khách hàng</legend>


                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-lastname">Họ và tên:</label>
                                    <input type="text" name="ship_name" value="<?php echo set_value('ship_name', $ship_name)?>" placeholder="Họ và tên:" id="input-payment-lastname" class="ship form-control">
                                    <?php echo form_error('ship_name')?>
                                </div>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-telephone">Điện thoại:</label>
                                    <input type="text" name="ship_telephone" value="<?php echo set_value('ship_telephone', $ship_telephone)?>" placeholder="Điện thoại:" id="input-payment-telephone" class="ship form-control">
                                    <?php echo form_error('ship_telephone')?>
                                </div>

                            </fieldset>

                        </div>
                        <div class="col-sm-6">
                            <fieldset id="address">
                                <legend>Địa Chỉ</legend>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-address-1">Địa chỉ:</label>
                                    <input type="text" name="ship_address" value="<?php echo set_value('ship_address', $ship_address)?>" placeholder="VD: 32/70 Lê Thị Hồng" id="input-payment-address-1" class="ship form-control">
                                    <?php echo form_error('ship_address')?>
                                </div>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-address-1">Quận / Huyện:</label>
                                    <input type="text" name="ship_district" value="<?php echo set_value('ship_district', $ship_district)?>" placeholder="VD: P17 - Gò Vấp" id="input-payment-address-1" class="ship form-control">
                                    <?php echo form_error('ship_district')?>
                                </div>


                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-zone">Thành phố:</label>
                                    <select name="ship_city" id="input-payment-zone" class="ship form-control">
                                        <option value=""> --- Chọn --- </option>
                                        <?php
                                        if(isset($arrCity)){
                                            foreach ($arrCity as $key => $value){
                                        ?>
                                                <option value="<?php echo $value['cityID']?>" <?php echo set_value('ship_city', $ship_city) == $value['cityID']?"selected":""?>><?php echo $value['cityName']?></option>
                                        <?php
                                            }
                                        }

                                        ?>

                                    </select>
                                    <?php echo form_error('ship_city')?>
                                </div>
                            </fieldset>

                        </div>

                    </div>

                </div>

            </div>


                <div class="checkout-left">
                    <hr/>
                    <div class="checkout-left-basket">
                        <a href="<?php echo base_url('cart') ?>"><span
                                    class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Quay lại</a>

                    </div>
                    <div class="checkout-right-basket">
                        <button type="submit" name="btn_checkout" value="submit">Tiếp tục <span
                                    class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
            }
            ?>
            </form>
		</div>
	</div>
	
<!-- //checkout -->
