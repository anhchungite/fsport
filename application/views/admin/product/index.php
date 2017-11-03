
<div class="row">
   <div class="col-lg-12">
      <?php if($this->session->flashdata('flash_ss')){?>
      <div class="alert alert-success fade in">
         <strong>Success!</strong> <?php echo $this->session->flashdata('flash_ss')?>.
      </div>
      <?php }?>
      <?php if($this->session->flashdata('flash_er')){?>
      <div class="alert alert-danger fade in">
         <strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
      </div>
      <?php }?>
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Danh sách sản phẩm</h3>
         </div>
         <div class="panel-body">
            <div class="well">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="control-label" for="input-name">Tên sản phẩm:</label>
                        <input type="text" name="filter_name" value="<?php if (isset($_GET['filter_name']))echo $_GET['filter_name']?>" placeholder="Tên sản phẩm:" id="input-name" class="form-control" autocomplete="off">
                        <ul class="dropdown-menu"></ul>
                     </div>
                     <div class="form-group">
                        <label class="control-label" for="input-quantity">Số lượng:</label>
                        <input type="text" name="filter_quantity" value="<?php if (isset($_GET['filter_quantity']))echo $_GET['filter_quantity']?>" placeholder="Số lượng:" id="input-quantity" class="form-control">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="control-label" for="input-price">Giá:</label>
                        <input type="text" name="filter_price" value="<?php if (isset($_GET['filter_price']))echo $_GET['filter_price']?>" placeholder="Giá:" id="input-price" class="form-control">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="control-label" for="input-status">Trạng thái:</label>
                        <select name="filter_status" id="input-status" class="form-control">
                           <option value="*"></option>

                           <option value="2" <?php echo (isset($_GET['filter_status']) == 1 && $_GET['filter_status'] == 2)?"selected":""?>>Bật</option>
                           <option value="1" <?php echo (isset($_GET['filter_status']) == 1 && $_GET['filter_status'] == 1)?"selected":""?>>Tắt</option>
                           <option value="0" <?php echo (isset($_GET['filter_status']) == 1 && $_GET['filter_status'] == 0)?"selected":""?>>Hết hàng</option>
                        </select>
                     </div>
                     <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Lọc dữ liệu</button>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
            	<a class="btn btn-primary add-btn" href="<?php echo base_url('admin/admin_product/add')?>"><span class="fa fa-plus"></span> Thêm mới</a>
            </div>
     
            <div class="col-sm-3 pull-right">
             			<select id="sort_order" name="sort_order" class="form-control"
                              title="Sắp xếp..." data-live-search="true">
             			
                           <option value="">Sắp xếp: mặc định</option>
                           <option value="sort_by=productName&sort_order=ASC" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'productName' && isset($_GET['sort_order']) && $_GET['sort_order'] == 'ASC')echo 'style="font-weight: bold"'.' selected'?>>Tên: tăng dần</option>
                           <option value="sort_by=productName&sort_order=DESC" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'productName' && isset($_GET['sort_order']) && $_GET['sort_order'] == 'DESC')echo 'style="font-weight: bold"'.' selected'?>>Tên: giảm dần</option>
                           <option value="sort_by=productPrice&sort_order=ASC" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'productPrice' && isset($_GET['sort_order']) && $_GET['sort_order'] == 'ASC')echo 'style="font-weight: bold"'.' selected'?>>Giá: tăng dần</option>
                           <option value="sort_by=productPrice&sort_order=DESC" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'productPrice' && isset($_GET['sort_order']) && $_GET['sort_order'] == 'DESC')echo 'style="font-weight: bold"'.' selected'?>>Giá: giảm dần</option>
                           <option value="sort_by=productQuantity&sort_order=ASC" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'productQuantity' && isset($_GET['sort_order']) && $_GET['sort_order'] == 'ASC')echo 'style="font-weight: bold"'.' selected'?>>Số lượng: tăng dần</option>
                           <option value="sort_by=productQuantity&sort_order=DESC" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'productQuantity' && isset($_GET['sort_order']) && $_GET['sort_order'] == 'DESC')echo 'style="font-weight: bold"'.' selected'?>>Số lượng: giảm dần</option>
                        </select>
           </div>
           
            <form action="" method="post" enctype="multipart/form-data" id="form-product">
               <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></td>
                           <td class="text-center">ID</td>
                           <td class="text-center">Hình ảnh</td>
                           <td class="text-left">Tên sản phẩm</td>
                           <td class="text-right">Giá</td>
                           <td class="text-right">Số lượng</td>
                           <td class="text-left">Trạng thái</td>
                           <td class="text-center">Chức năng</td>
                        </tr>
                     </thead>
                     <tbody>

                     <?php if(isset($arrProduct)): foreach ($arrProduct as $value):
                     	$id 		= $value['productID'];
                     	$name 		= $value['productName'];
                     	$discount 	= $value['productDiscount'];
                     	$price 		= $value['productPrice'];
                     	$image 		= json_decode($value['productImage'])[0];
                     	$status 	= $value['productStatus'];
                     	if($status == 2)
                     	{
                     		$status = "Bật";
                     	}else if($status == 1){
                     		$status = "Tắt";
                     	}else{
                            $status = "Hết hàng";
                        }
                     	$quantity 	= $value['productQuantity'];
                     
                     ?>
                        <tr>
                           <td class="text-center">                    <input type="checkbox" name="selected[]" value="<?php echo $id?>">
                           </td>
                           <td class="text-center">                    <?php echo $id ?>
                           </td>
                           <td class="text-center">                    <img src="<?php echo IMAGES_UPLOAD.'/'.$image?>" alt="<?php echo $name?>" class="img-thumbnail" width="100px">
                           </td>
                           <td class="text-left"><?php echo $name?></td>
                           <td class="text-right">
                              <span style="<?php echo $discount?'text-decoration: line-through':''?>"><?php echo number_format($price)?></span><br>
                              <div class="<?php echo $discount?'text-danger':'text-right'?>"><?php echo $discount? number_format(discount_price($price, $discount)):''?></div>
                           </td>
                           <td class="text-right">                    <span class="label label-success"><?php echo $quantity?></span>
                           </td>
                           <td class="text-left"><?php echo $status?></td>
                           <td class="text-center">
                              <a href="<?php echo base_url("admin/admin_product/edit/{$id}")?>">
                              <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
                              </a>
                              <a href="<?php echo base_url("admin/admin_product/del/{$id}")?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?">
                              <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
                              </a>
                           </td>
                        </tr>
                        <?php endforeach; endif;?>
                        <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.min.js"></script>
                        <script src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap.min.js"></script>
                        <script src="<?php echo TEMPLATES_ADMIN ?>/js/docs.min.js"></script>
                        <script src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap-confirmation.min.js"></script>
                        <script>
                           $('[data-toggle=confirmation]').confirmation();
                           $('[data-toggle=confirmation-singleton]').confirmation({ singleton: true });
                           $('[data-toggle=confirmation-popout]').confirmation({ popout: true });
                           
                           $('[data-toggle=confirmation-custom]').confirmation({
                             buttons: [
                               {
                                 label: 'Approved',
                                 class: 'btn btn-xs btn-success',
                                 icon: 'glyphicon glyphicon-ok'
                               },
                               {
                                 label: 'Rejected',
                                 class: 'btn btn-xs btn-danger',
                                 icon: 'glyphicon glyphicon-remove'
                               },
                               {
                                 label: 'Need review',
                                 class: 'btn btn-xs btn-warning',
                                 icon: 'glyphicon glyphicon-search'
                               },
                               {
                                 label: 'Decide later',
                                 class: 'btn btn-xs btn-default',
                                 icon: 'glyphicon glyphicon-time'
                               }
                             ]
                           });
                        </script>                 
                     </tbody>
                  </table>
               </div>
               <div class="row">
                  <div class="col-sm-6 text-left">
                     <div class="form-group">
                        <div class="col-sm-4">
                           <select class="form-control m-bot15" name="tacvu" required>
                              <option value="">- Tác vụ -</option>
                              <option value="2">Trạng thái: Bật</option>
                              <option value="1">Trạng thái: Tắt</option>
                              <option value="0">Trạng thái: Hết hàng</option>
                              <option value="delete">Xóa</option>
                           </select>
                        </div>
                        <div class="col-sm-1">
                           <input type="submit" class="btn btn-default" name="apdung"
                              value="Áp dụng" />
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
            <div class="row">
               <div class="col-sm-6 text-left"></div>
               <div class="col-sm-6 text-right">
               Hiển thị từ <?php if(isset($offset))echo $offset+1?> 
               đến <?php if (isset($site_info['site_num_page']) && isset($offset) && isset($count)){if(($site_info['site_num_page'] + $offset) > $count){echo $count;}else{echo $site_info['site_num_page'] + $offset;}} ?> 
               trong tổng số <?php if (isset($count))echo $count?> (<?php if(isset($max_page))echo $max_page?> trang)</div>
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

	
</script>
<script type="text/javascript">
	var url = '<?php echo base_url('admin/admin_product/index?')?>';
   $('#button-filter').on('click', function() {
   	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}


	var filter_price = $('input[name=\'filter_price\']').val();

	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}

	var filter_quantity = $('input[name=\'filter_quantity\']').val();

	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	location = url;

   });

   $("#sort_order").change(function(){
		var sort_order = $("#sort_order").val();
		if(sort_order)
		{
			url += '&'+sort_order;
		}
		
		location = url;
		});
</script>