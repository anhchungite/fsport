
<!-- checkout -->
<!-- Date time picker -->
<div class="checkout">
    <div class="container">
        <h3>Chi tiết <span>đơn hàng</span></h3>
        <div class="checkout-right member info">
            <div class="row">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td colspan="2">
                            <h4>Mã đơn hàng: <?= isset($arrOrder) ? $arrOrder['orderID'] : '' ?></h4>
                            <h4>Ngày lập: <?= isset($arrOrder) ? date_format(date_create($arrOrder['purchaseDate']), 'H:i:s d/m/Y') : '' ?></h4>
                            <h4>Trạng thái: <?= isset($arrOrder) ? get_order_status($arrOrder['orderStatusID']) : '' ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;"><b>Thanh toán</b></td>
                        <td style="width: 50%;"><b>Vận chuyển đến</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><address>
                                <?= $arrOrder['payName']?><br><?= $arrOrder['payAddress']?><br><?= get_city($arrOrder['payCity'], true)?>, VN </address></td>
                        <td><address>
                                <?= $arrOrder['shipName']?><br><?= $arrOrder['shipAddress']?><br><?= get_city($arrOrder['shipCity'], true)?>, VN </address></td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td><b>STT</b></td>
                        <td><b>Sản phẩm</b></td>
                        <td class="text-right"><b>Kích cỡ</b></td>
                        <td class="text-right"><b>Màu sắc</b></td>
                        <td class="text-right"><b>Số lượng</b></td>
                        <td class="text-right"><b>Đơn giá</b></td>
                        <td class="text-right"><b>Tổng phụ</b></td>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($arrOrderProduct){
                            foreach ($arrOrderProduct as $key => $value) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $key+1?></td>
                        <td><a href="<?= base_url(convertUrl($value['productName'])."-p{$value['productID']}.html")?>"><?=$value['productName']?></a></td>
                        <td class="text-right"><?= $value['productSize']?></td>
                        <td class="text-right"><?= $value['productColor']?></td>
                        <td class="text-right"><?= $value['productQuantity']?></td>
                        <td class="text-right"><?= number_format($value['productPrice'])?> VND</td>
                        <td class="text-right"><?= number_format($value['productQuantity'] * $value['productPrice'])?> VND</td>

                    </tr>
                    <?php            
                            }
                        }
                    ?>
                    
                    <tr>
                        <td class="text-right" colspan="6"><b>Tổng</b></td>
                        <td class="text-right"><?= number_format($arrOrder['total'])?> VND</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="6"><b>Phí vận chuyển</b></td>
                        <td class="text-right"><?= number_format($arrOrder['cost'])?> VND</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="6"><b>Thành tiền</b></td>
                        <td class="text-right"><?= number_format($arrOrder['total'] + $arrOrder['cost'])?> VND</td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td><b>Ghi chú:</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $arrOrder['orderNote'] != '' ? $arrOrder['orderNote'] : 'Không có ghi chú' ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="checkout-left">

            <div class="clearfix"> </div>
        </div>
    </div>
</div>


<!-- //checkout -->
