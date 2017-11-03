
<!-- checkout -->
	<div class="checkout">
		<div class="container">
            <h3>Thông tin <span>đơn hàng</span></h3>

			<div class="checkout-right">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">

                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <?php
                    if(isset($arrCustomer)){
                        if(isset($arrCustomer['shipping_address'])){
                            $payName       = $shipName      = $arrCustomer['payName'];
                            $payPhone      = $shipPhone     = $arrCustomer['payPhone'];
                            $payAddress    = $shipAddress   = $arrCustomer['payAddress'];
                            $payDistrict   = $shipDistrict  = $arrCustomer['payDistrict'];
                            //$payCity       = $shipCity      = $arrCustomer['pay_city'];
                            $payEmail                       = $arrCustomer['payEmail'];
                            $payMethod                      = $arrCustomer['payMethod'];
                            $orderNote                      = $arrCustomer['orderNote'];
                        }else{
                            $payName     = $arrCustomer['payName'];
                            $payPhone    = $arrCustomer['payPhone'];
                            $payAddress  = $arrCustomer['payAddress'];
                            $payDistrict = $arrCustomer['payDistrict'];
                            //$payCity     = $arrCustomer['pay_city'];
                            $payEmail    = $arrCustomer['payEmail'];
                            $payMethod   = $arrCustomer['payMethod'];
                            $orderNote   = $arrCustomer['orderNote'];
                            $shipName    = $arrCustomer['shipName'];
                            $shipPhone   = $arrCustomer['shipPhone'];
                            $shipAddress = $arrCustomer['shipAddress'];
                            $shipDistrict= $arrCustomer['shipDistrict'];
                            //$shipCity    = $arrCustomer['ship_city'];
                        }
                    ?>
                    <div class="row invoice-info">
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Khách hàng:
                            <address>
                                <strong><?php echo $payName?></strong><br>
                                <?php echo $payAddress ?><br>
                                <?php echo $payDistrict?>, <?php echo isset($payCity)?$payCity['cityName']:""?><br>
                                Số điện thoại: <?php echo $payPhone?><br>
                                Email: <?php echo $payEmail?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Địa chỉ giao hàng:
                            <address>
                                <strong><?php echo $shipName?></strong><br>
                                <?php echo $shipAddress ?><br>
                                <?php echo $shipDistrict?>, <?php echo isset($shipCity)?$shipCity['cityName']:""?><br>
                                Số điện thoại: <?php echo $shipPhone?><br>
                            </address>
                        </div>
                        <?php
                        }
                        ?>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Kích cỡ</th>
                                    <th>Màu sắc</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng </th>
                                    <th>Tổng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($arrProduct)){
                                    $i = 1;
                                    $subTotal = 0;
                                    foreach ($arrProduct as $value){
                                    $subTotal += $value['productPrice'] * $value['productQuantity'];

                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $value['productName'] ?></td>
                                    <td><?php echo $value['productSize'] ?></td>
                                    <td><?php echo $value['productColor'] ?></td>
                                    <td><?php echo number_format($value['productPrice']) ?> vnđ</td>
                                    <td><?php echo $value['productQuantity'] ?></td>
                                    <td><?php echo number_format($value['productPrice'] * $value['productQuantity']) ?> vnđ</td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Ghi chú:</p>


                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                <?php echo $orderNote != ""? $orderNote: "Không có ghi chú"?>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Thành tiền:</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody><tr>
                                        <th style="width:50%">Tổng phụ:</th>
                                        <td><?php echo number_format($subTotal)?> VNĐ</td>
                                    </tr>
                                    <tr>
                                        <th>Phí vận chuyển:</th>
                                        <?php
                                        $cost = $arrCustomer['cost'];
                                        ?>
                                        <td><?php echo number_format($cost)?> VNĐ</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng:</th>
                                        <td><?php echo number_format($subTotal + $cost)?> VNĐ</td>
                                    </tr>
                                    </tbody></table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
			</div>
			<div class="checkout-left">


				<div class="checkout-left-basket">
                    <a href="<?php echo base_url('cart/checkout')?>"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Quay lại</a>

				</div>
				<div class="checkout-right-basket">
                    <form action="#" method="post">
                        <button type="submit" name="btn_order_info" value="OrderInfo" class="simpleCart_empty"> </span>Hoàn tất <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></button>
                    </form>

				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	
<!-- //checkout -->
