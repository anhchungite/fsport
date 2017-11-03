<style>
    .panel {
        margin-bottom: 55px!important;
</style>

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
                <h3 class="panel-title"><i class="fa fa-list"></i> Danh sách đơn hàng</h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-order-id">ID Đơn hàng</label>
                                <input type="text" name="filter_id" value="<?php if(isset($_GET['filter_id']))echo $_GET['filter_id']?>" placeholder="ID Đơn hàng" id="input-order-id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-customer">Khách hàng:</label>
                                <input type="text" name="filter_customer" value="<?php if(isset($_GET['filter_customer']))echo $_GET['filter_customer']?>" placeholder="Khách hàng:" id="input-customer" class="form-control" autocomplete="off">
                                <ul class="dropdown-menu"></ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-order-status">Tình trạng đơn hàng:</label>
                                <select name="filter_status" id="input-order-status" class="form-control">
                                    <option value="*"></option>
                                    <?php
                                    if(isset($arrOrderStatus)){
                                        foreach ($arrOrderStatus as $value){
                                            $select = "";
                                            if($_GET['filter_status'] == $value['orderStatusID']){
                                                $select = "selected";
                                            }
                                    ?>
                                    <option value="<?php echo $value['orderStatusID']?>" <?php echo $select?>><?php echo $value['orderStatusDes']?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-total">Tổng</label>
                                <input type="text" name="filter_total" value="<?php if(isset($_GET['filter_total']))echo $_GET['filter_total']?>" placeholder="Tổng" id="input-total" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-date-added">Ngày đặt hàng</label>
                                <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" name="filter_pur_date" type="text" placeholder="Ngày đặt hàng" value="<?php if(isset($_GET['filter_pur_date']))echo $_GET['filter_pur_date']?>">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-date-modified">Ngày sửa lại</label>
                                <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" name="filter_chan_date" type="text" placeholder="Ngày sửa lại" value="<?php if(isset($_GET['filter_chan_date']))echo $_GET['filter_chan_date']?>">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Lọc dữ liệu</button>
                        </div>
                    </div>
                </div>
                <form method="post" action="" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></td>
                                <td class="text-right">ID dơn hàng</td>
                                <td class="text-left">Khách hàng</td>
                                <td class="text-left">Trạng thái</td>
                                <td class="text-right">Tổng</td>
                                <td class="text-left">Ngày nhập</td>
                                <td class="text-left">Ngày thay đổi</td>
                                <td class="text-center">Thao tác</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($arrOrder)){
                                foreach ($arrOrder as $key => $value){
                             ?>

                            <tr>
                                <td class="text-center"> <input type="checkbox" name="selected[]" value="<?php echo $value['orderID']?>">
                                <td class="text-right"><?php echo $value['orderID']?></td>
                                <td class="text-left"><?php echo $value['userFullName']?></td>
                                <td class="text-left"><?php echo get_order_status($value['orderStatusID'])?></td>
                                <td class="text-right">
                                    <?php echo number_format($value['total'])?>
                                </td>
                                <td class="text-left"><?php echo $value['purchaseDate']?></td>
                                <td class="text-left"><?php echo $value['changeDate']?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url("admin/admin_order/detail/{$value['orderID']}")?>">
                                        <div class="btn btn-info btn-sm"><i class="fa fa-eye"></i></div>
                                    </a>
                                    <a href="<?php echo base_url("admin/admin_order/edit/{$value['orderID']}")?>">
                                        <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
                                    </a>
                                    <a href="<?php echo base_url("admin/admin_order/del/{$value['orderID']}")?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?">
                                        <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                            <!-- <tr>
              <td class="text-center" colspan="8">Không có đơn hàng nào!</td>
            </tr>-->
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <select class="form-control m-bot15" name="tacvu" required>
                                        <option value="">- Tác vụ -</option>
                                        <?php
                                        if(isset($arrOrderStatus)) {
                                            foreach ($arrOrderStatus as $value) {
                                                ?>
                                                <option value="<?php echo $value['orderStatusID']?>">Đánh dấu: <?php echo $value['orderStatusDes']?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <option value="delete">Xóa</option>
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <input type="submit" class="btn btn-default" name="apdung" value="Áp dụng" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="pagination" style="margin: 0px !important">
                                <?php echo $this->pagination->create_links()?>
                            </ul>
                        </div>

                    </div>
                </form>

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
    $('#button-filter').on('click', function() {
        var url = '<?php echo base_url('admin/admin_order/index?')?>';

        var filter_id = $('input[name=\'filter_id\']').val();
        if (filter_id) {
            url += '&filter_id=' + encodeURIComponent(filter_id);
        }

        var filter_customer = $('input[name=\'filter_customer\']').val();
        if (filter_customer) {
            url += '&filter_customer=' + encodeURIComponent(filter_customer);
        }

        var filter_status = $('select[name=\'filter_status\']').val();
        if (filter_status != '*') {
            url += '&filter_status=' + encodeURIComponent(filter_status);
        }

        var filter_total = $('input[name=\'filter_total\']').val();
        if (filter_total) {
            url += '&filter_total=' + encodeURIComponent(filter_total);
        }

        var filter_pur_date = $('input[name=\'filter_pur_date\']').val();
        if (filter_pur_date) {
            url += '&filter_pur_date=' + encodeURIComponent(filter_pur_date);
        }

        var filter_chan_date = $('input[name=\'filter_chan_date\']').val();
        if (filter_chan_date) {
            url += '&filter_chan_date=' + encodeURIComponent(filter_chan_date);
        }

        location = url;
    });
</script>