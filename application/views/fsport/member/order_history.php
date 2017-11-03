
<!-- checkout -->
<!-- Date time picker -->
<link href="/assets/templates/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<div class="checkout">
		<div class="container">
            <h3>Lịch sử <span>giao dịch</span></h3>
			<div class="checkout-right member info">
                <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-right">ID đơn hàng</th>
                                    <th class="text-left">Trạng thái</th>
                                    <th class="text-right">Tổng</th>
                                    <th class="text-left">Ngày tạo</th>
                                    <th class="text-left"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($arrOrder){
                                    foreach ($arrOrder as $key => $value) {
                                    ?>
                                <tr>
                                    </td><td class="text-right"><?= $value['orderID'] ?></td>
                                    <td class="text-left"><?= get_order_status($value['orderStatusID'])?></td>
                                    <td class="text-right"><?= number_format($value['total'] + $value['cost'])?> VND</td>
                                    <td class="text-left"><?= date_format(date_create($value['purchaseDate']), 'H:i:s d/m/Y') ?></td>
                                    <td class="text-center">
                                        <a href='<?= base_url("member/order-detail/{$value['orderID']}")?>'>
                                            <div class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Chi tiết</div>
                                        </a>
                                    </td>
                                </tr> 
                                    <?php
                                    }
                                }else{
                                    ?>
                                     <tr>
                                        <td class="text-center" colspan="5">Không có đơn hàng nào!</td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                </div>
			</div>
			<div class="checkout-left">

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<script src="/assets/templates/admin/js/bootstrap-datetimepicker.js"></script>

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

<!-- //checkout -->
