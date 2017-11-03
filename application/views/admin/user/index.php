
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
            <h3 class="panel-title"><i class="fa fa-list"></i> <?php if (isset($title))echo $title?> <span class="badge bg-warning"><?php if (isset($countUser))echo $countUser?></span></h3>
         </div>
         <div class="panel-body">
            <div class="well">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="control-label" for="input-username">Tên người dùng:</label>
                        <input type="text" name="filter_username" value="<?php if (isset($_GET['filter_username']))echo $_GET['filter_username']?>" placeholder="Tên người dùng:" id="input-username" class="form-control" autocomplete="off">
                        <ul class="dropdown-menu"></ul>
                     </div>
                     <div class="form-group">
                        <label class="control-label" for="input-fullname">Tên đầy đủ:</label>
                        <input type="text" name="filter_fullname" value="<?php if (isset($_GET['filter_fullname']))echo $_GET['filter_fullname']?>" placeholder="Tên đầy đủ:" id="input-fullname" class="form-control">
                     </div>
                  </div>
                  <div class="col-sm-4">
                  	<div class="form-group">
                        <label class="control-label" for="select-sex">Giới tính:</label>
                        <select name="filter_sex" id="select-sex" class="form-control">
                           <option value="*"></option>
                           <option value="1" <?php if (isset($_GET['filter_sex']) && $_GET['filter_sex'] == 1)echo 'selected'?>>Nam</option>
                           <option value="0" <?php if (isset($_GET['filter_sex']) && $_GET['filter_sex'] == 0)echo 'selected'?>>Nữ</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="control-label" for="input-birthday">Ngày sinh:</label>
                        <div class="input-group date form_date" data-date=""
                              data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                              data-link-format="yyyy-mm-dd">
                              <input class="form-control" name="filter_birthday" type="text"
                                 placeholder="Ngày sinh"
                                 value=""> <span
                                 class="input-group-addon"><span
                                 class="glyphicon glyphicon-calendar"></span></span>
                           </div>
                     </div>
                  </div>
                  <div class="col-sm-4">

                     <div class="form-group">
                        <label class="control-label" for="select-level">Quyền:</label>
                        <select name="filter_level" id="select-level" class="form-control">
                           <option value="*"></option>
                           <?php
                           foreach ($arr_level as $key => $value){
                              $selected = "";
                              if(isset($_GET['filter_level']) && $_GET['filter_level'] == $key){
                                 $selected = "selected";
                              }
                           ?>
                              <option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo ucfirst($value) ?></option>
                           <?php
                           }
                           ?>

                        </select>
                     </div>

                     <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Lọc dữ liệu</button>
                  </div>
               </div>
            </div>
             <?php if($this->auth->checkAdmin()){?>
            <div class="col-sm-6">
            	<a class="btn btn-primary add-btn" href="<?php echo base_url('admin/admin_user/add')?>"><span class="fa fa-plus"></span> Thêm mới</a>
            </div>
             <?php } ?>
     
      <form action="" method="post">
         <section class="panel">
     
            <div class="panel-body">
            <div class="table-responsive">
               <table class="table table-bordered table-hover">
                  <tbody>
                     <tr>
                        <th><input type="checkbox" class="ck_all"></th>
                        <th>ID <span class="glyphicon glyphicon-sort-by-attributes-alt pull-right"></span></th>
                        <th>Tên người dùng <span class="glyphicon glyphicon-sort pull-right"></span></th>
                        <th>Tên đầy đủ <span class="glyphicon glyphicon-sort pull-right"></span></th>
                        <th>Email <span class="glyphicon glyphicon-sort pull-right"></span></th>
                        <th>Quyền </th>
                        <th class="text-center">Chức năng</th>
                     </tr>
                     <?php 
                        if(isset($arrUser) && count($arrUser) > 0)
                        {
                        	foreach ($arrUser as $key => $value)
                        	{
                        		$id_user 		= $value['userID'];
                        		$username 		= $value['userName'];
                        		$email 			= $value['userEmail'];
                        		$fullname 		= $value['userFullName'];
                        		$level 			= $value['userLevel'];

                              ?>
                              <tr>
                                 <td><input type="checkbox" class="ck_item" name="ck_item[]"
                                            value="<?php echo $id_user ?>"></td>
                                 <td><?php echo $id_user ?></td>
                                 <td><?php echo $username ?></td>
                                 <td><?php echo $fullname ?></td>
                                 <td><?php echo $email ?></td>
                                 <td><?php echo $level ?></td>
                                 <td class="text-center">
                                    <a href="<?php echo base_url("admin/admin_user/view/{$id_user}") ?>">
                                       <div class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                    </a>
                                    <a href="<?php echo base_url("admin/admin_user/edit/{$id_user}") ?>">
                                       <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
                                    </a>
                                    <a href="<?php echo base_url("admin/admin_user/del/{$id_user}") ?>"
                                       data-toggle="confirmation" data-popout="true" data-placement="left"
                                       data-singleton="true" data-title="Bạn chắc chắn xóa?">
                                       <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
                                    </a>
                                 </td>
                              </tr>
                              <?php
                        }
                        }else{
                           ?>
                           <tr>
                              <td class="text-center" colspan="8">Không có kết quả nào!</td>
                           </tr>
                     <?php
                        }
                        ?>
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
               <script type="text/javascript">
                  $(function(){
                  	$(".ck_all").click(function(){
                  		$('.ck_item').prop('checked', this.checked);
                  	});
                  	var current_url = '<?php echo current_url()?>';
                  	$("#showall").click(function(){
                  		$(location).attr("href", current_url);
                  	});
                  	
                  });
                          
               </script>
            </div>
         </section>
         <div class="row">
                  <div class="col-sm-6 text-left">
                     <div class="form-group">
                            <div class="col-sm-4">
                               <select class="form-control m-bot15" name="tacvu" required>
                                  <option value="">- Tác vụ -</option>
                                  <option value="delete">Xóa</option>
                               </select>
                            </div>
                            <div class="col-sm-1">
                               <input type="submit" class="btn btn-default" name="btn_apdung"
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
               đến <?php if (isset($site_setting['site_num_page']) && isset($offset) && isset($countUser)){if(($site_setting['site_num_page'] + $offset) > $countUser){echo $countUser;}else{echo $site_setting['site_num_page'] + $offset;}} ?>
               trong tổng số <?php if (isset($countUser))echo $countUser?> (<?php if(isset($max_page))echo $max_page?> trang)</div>
            </div>
         </div>
      </div>
   </div>
</div>
</section>
</section>
<!--main content end-->
<script type="text/javascript"
   src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-1.8.3.min.js"
   charset="UTF-8"></script>
<script
   src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
	var url = '<?php echo base_url('admin/admin_user/index?')?>';
   $('#button-filter').on('click', function() {
   	var filter_username = $('input[name=\'filter_username\']').val();

	if (filter_username) {
		url += '&filter_username=' + encodeURIComponent(filter_username);
	}


	var filter_fullname = $('input[name=\'filter_fullname\']').val();

	if (filter_fullname) {
		url += '&filter_fullname=' + encodeURIComponent(filter_fullname);
	}

	var filter_status = $('input[name=\'filter_status\']').val();

	if (filter_status) {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	var filter_birthday = $('input[name=\'filter_birthday\']').val();

	if (filter_birthday != '') {
		url += '&filter_birthday=' + encodeURIComponent(filter_birthday);
	}
	
	var filter_level = $('select[name=\'filter_level\']').val();

	if (filter_level != '*') {
		url += '&filter_level=' + encodeURIComponent(filter_level);
	}
	
	var filter_sex = $('select[name=\'filter_sex\']').val();

	if (filter_sex != '*') {
		url += '&filter_sex=' + encodeURIComponent(filter_sex);
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
<script type="text/javascript">
   var fullDate = new Date()
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