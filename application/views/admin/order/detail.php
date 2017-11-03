<?php
$id = "";
$user = "";
$user_email = "";
$user_phone = "";
$total = 0;
$status = -1;
$pur_date = "";
$chan_date = "";
$cost = 0;
$orderNote = "";

$pay_name = "";
$pay_addr = "";
$pay_phone = "";
$pay_email = "";
$pay_city = "";
$pay_method = "";

$ship_name = "";
$ship_phone = "";
$ship_addr = "";
$ship_city = "";

if(isset($arrOrder)){
    $id = $arrOrder['orderID'];
    $user = $arrOrder['userFullName'];
    $user_email = $arrOrder['userEmail'];
    $user_phone = $arrOrder['userPhone'];
    $total =$arrOrder['total'];
    $status = $arrOrder['orderStatusID'];
    $pur_date = $arrOrder['purchaseDate'];
    $chan_date = $arrOrder['changeDate'];
    $cost = $arrOrder['cost'];
    $note = $arrOrder['orderNote'];

    $pay_name = $arrOrder['payName'];
    $pay_addr = $arrOrder['payAddress'];
    $pay_dist = $arrOrder['payDistrict'];
    $pay_phone = $arrOrder['payPhone'];
    $pay_email = $arrOrder['payEmail'];
    $pay_city = $arrOrder['payCity'];
    $pay_method = $arrOrder['payMethod'];

    $ship_name = $arrOrder['shipName'];
    $ship_phone = $arrOrder['shipPhone'];
    $ship_addr = $arrOrder['shipAddress'];
    $ship_dist = $arrOrder['shipDistrict'];
    $ship_city = $arrOrder['shipCity'];

}
echo '<pre>';
print_r($arrOrderProduct);
echo '</pre>';
?>
<div class="row">
    <div class="col-lg-12">
        <?php if($this->session->flashdata('flash_ss')){?>
            <div class="alert alert-success fade in">
                <strong>Success!</strong>
                <?php echo $this->session->flashdata('flash_ss')?>.
            </div>
        <?php }?>
        <?php if($this->session->flashdata('flash_er')){?>
            <div class="alert alert-danger fade in">
                <strong>Error!</strong>
                <?php echo $this->session->flashdata('flash_er')?>.
            </div>
        <?php }?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i>
                    <?php if(isset($title))echo $title?>
                </h3>

            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-order" data-toggle="tab">Chi tiết</a></li>
                    <li class=""><a href="#tab-payment" data-toggle="tab">Thanh toán</a></li>
                    <li class=""><a href="#tab-shipping" data-toggle="tab">Vận chuyển</a></li>
                    <li class=""><a href="#tab-product" data-toggle="tab">Sản phẩm</a></li>
                    <span class="col-lg-3 pull-right text-right">
          <a href="<?php echo base_url("admin/admin_order/invoice/{$id}")?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> In</a>
          <a href="<?php echo base_url("admin/admin_order/edit/{$id}")?>" title="" class="btn btn-info"><i class="fa fa-pencil"></i> Sửa</a>
          </span>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-order">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>Mã đơn hàng:</td>
                                <td>#<?php echo $id ?></td>
                            </tr>
                            <tr>
                                <td>Khách hàng:</td>
                                <td><?php echo $user ?></td>
                            </tr>
                            <tr>
                                <td>E-Mail:</td>
                                <td><a href="mailto:<?php echo $user_email ?>"><?php echo $user_email ?></a></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td><?php echo $user_phone ?></td>
                            </tr>
                            <tr>
                                <td>Tổng:</td>
                                <td>
                                    <?php echo number_format($total)?> VNĐ</td>
                            </tr>
                            <tr>
                                <td>Trạng thái:</td>
                                <td id="order-status"><?php echo get_order_status($status)?></td>
                            </tr>

                            <tr>
                                <td>Ngày lập:</td>
                                <td><?php echo $pur_date ?></td>
                            </tr>
                            <tr>
                                <td>Ngày sửa:</td>
                                <td><?php echo $chan_date ?></td>
                            </tr>
                            <tr>
                                <td>Ghi chú:</td>
                                <td>
                                    <textarea rows="3" style="width:100%;resize: none" readonly><?php echo $note? $note:'Không có ghi chú'?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-payment">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>Họ và tên:</td>
                                <td><?php echo $pay_name ?></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td><?php echo $pay_phone ?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo $pay_email ?></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ:</td>
                                <td><?php echo $pay_addr.', '.$pay_dist ?></td>
                            </tr>
                            <tr>
                                <td>Thành phố:</td>
                                <td><?php echo get_city($pay_city, true) ?>, VN</td>
                            </tr>

                            <tr>
                                <td>Phương thức thanh toán:</td>
                                <td><?php echo get_pay_method($pay_method) ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-shipping">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>Họ và tên:</td>
                                <td><?php echo $ship_name ?></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td><?php echo $ship_phone ?></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ:</td>
                                <td><?php echo $ship_addr.', '.$ship_dist ?></td>
                            </tr>
                            <tr>
                                <td>Thành phố:</td>
                                <td><?php echo get_city($ship_city, true) ?>, VN</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-product">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-left">Sản phẩm</td>
                                <td class="text-right">Kích cỡ</td>
                                <td class="text-right">Màu sắc</td>
                                <td class="text-right">Số lượng</td>
                                <td class="text-right">Đơn giá</td>
                                <td class="text-right">Tổng</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($arrOrderProduct)){
                                foreach ($arrOrderProduct as $value){
                            ?>

                            <tr>
                                <td class="text-left">
                                    <?php echo $value['productName']?>
                                </td>
                                <td class="text-right"><?php echo $value['productSize']?></td>
                                <td class="text-right"><?php echo $value['productColor']?></td>
                                <td class="text-right"><?php echo $value['productQuantity']?></td>
                                <td class="text-right">
                                    <?php echo number_format($value['productPrice'])?> VNĐ
                                </td>
                                <td class="text-right">
                                    <?php echo number_format($value['productQuantity'] * $value['productPrice'])?> VNĐ
                                </td>
                            </tr>
                            <?php

                                }
                            }
                            ?>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Phí vận chuyển:</strong></td>
                                <td class="text-right">
                                    <strong><?php echo number_format($cost)?> VNĐ</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Tổng:</strong></td>
                                <td class="text-right">
                                    <strong><?php echo number_format($total + $cost)?> VNĐ</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
</section>
<!--main content end-->
<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    var editedField;

    function BrowseServer(field) {
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.connectorPath = '<?php echo base_url("admin/admin_ckfinder/connector")?>';
        finder.basePath = ''; // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = SetFileField;
        finder.popup();
        editedField = field;
    }

    function SetFileField(fileUrl) {
        document.getElementById(editedField).value = fileUrl;
        var link = document.getElementById(editedField).value;
        $("#" + editedField + "").parents("tr").find('img').attr({
            "src": link,
            "width": "100px"
        });
    }
    for (var i = 0; i <= 3; i++) {
        var url = $("#input-img" + i + "").parents("tr").find('img').attr('src');
        $("#input-img" + i + "").val(url);
    }
</script>
<script type="text/javascript">
    var fullDate = new Date()
    $('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: 'yyyy-mm-dd'

    });
</script>
<script type="text/javascript">
    $(function() {

        var val = $("input[name='input-type-size']:checked").val();
        if (val == 0) {
            $('.size-char').hide();
            $('.size-num').show();
        } else {
            $('.size-char').show();
            $('.size-num').hide();
        }

    });
    $(document).on('click', '.type-size', function() {
        var val = $("input[name='input-type-size']:checked").val();
        if (val == 0) {
            $('.size-char').hide();
            $('.size-num').show();
        } else {
            $('.size-char').show();
            $('.size-num').hide();
        }
    });
</script>