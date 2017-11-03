<div class="row">
   <div class="col-lg-12">
       <?php if($this->session->flashdata('flash_success')){?>
				<div class="alert alert-success fade in">
			<strong>Success!</strong> <?php echo $this->session->flashdata('flash_ss')?>.
					  </div>
					  <?php }?>
					  <?php if($this->session->flashdata('flash_error')){?>
				<div class="alert alert-danger fade in">
			<strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
					  </div>
					  <?php }?>
      <div class="row">
         <div class="col-md-12">
            <div class="form-group" style="margin-bottom: 45px;">
               <div class="col-md-2">
               		<?php
               		
               		if(isset($_GET['select'])){
               			$status = $_GET['select'];
               		}
               			
               			?>
                  <select id="select_status" class="form-control input-sm m-bot15">
                     <option value="all" <?php if (isset($status) && $status == 'all')echo 'selected'?>>Tất cả</option>
                     <option value="0" <?php if (isset($status) && $status == '0')echo 'selected'?>>Chưa xem</option>
                     <option value="1" <?php if (isset($status) && $status == '1')echo 'selected'?>>Đã xem</option>
                  </select>
               </div>
            </div>
         </div>
      </div>
      <script
         src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
      <script type="text/javascript">
         $("#select_status").change(function(){
         	var status = $("#select_status").val();
         	$(location).attr('href', '?select='+status);
         });
         
      </script>
      <form action="" method="post">
         <section class="panel">
            <header class="panel-heading">
               <?php if(isset($title))echo $title?> <span class="badge bg-warning"><?php if(isset($count))echo $count?></span>
            </header>
            <div class="panel-body">
               <table class="table table-striped table-advance table-hover">
                  <tbody>
                     <tr>
                        <th><input type="checkbox" class="check_all"/></th>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Ngày liên hệ</th>
                        <th>Trạng thái</th>
                         <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>
                        <th>Chức năng</th>
                        <?php }?>
                     </tr>
                     <?php
                        if(isset($arrContact)){
                        	
                        	foreach ($arrContact as $key => $value){
                        		$id_contact 	= $value['id_contact'];
                        		$name			= $value['name'];
                        		$email			= $value['email'];
                        		$date			= $value['date'];
                        		$status			= $value['status'];
                        ?>	
                     <tr>
                        <td><input type="checkbox" class="check_item" name="checklist[]" value="<?php echo $id_contact ?>"/></td>
                        <td><?php echo $id_contact ?></td>
                        <td><a href="<?php echo base_url()?>admin/admin_contact/view/<?php echo $id_contact ?>"><?php echo $name ?></a></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $date ?></td>
                        <td>
                           <?php 
                              if($status == 1){
                              ?>
                           <i class="fa fa-eye" aria-hidden="true"></i> Đã xem
                           <?php 
                              }else {
                              ?>
                           <i class="fa fa-eye-slash" aria-hidden="true"></i> Chưa xem
                           <?php 
                              }
                              ?>
                        </td>
                        <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>
                        <td class="col-lg-1">
                           <a class="btn btn-danger btn-sm" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?" href="<?php echo base_url()?>admin/admin_contact/del/<?php echo $id_contact ?>"><i class="icon_close_alt2"></i> Xóa</a>
                        </td>
                        <?php }?>
                     </tr>
                     <?php
                        	}
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
                        $(".check_all").click(function(){
                			$(".check_item").prop('checked', this.checked);
                         });
                     </script>        
                  </tbody>
               </table>
            </div>
         </section>
         <div class="col-lg-12" style="margin-bottom: 50px">
	         <div class="form-group">
	            <div class="col-lg-2">
	               <select class="form-control m-bot15" name="tacvu" required>
	                  <option value="">- Tác vụ -</option>
	                  <option value="read">Đánh dấu đã xem</option>
	                  <option value="unread">Đánh dấu chưa xem</option>
	                  <option value="delete">Xóa</option>
	               </select>
	            </div>
	            <div class="col-lg-1">
	               <input type="submit" class="btn btn-default" name="apdung"
	                  value="Áp dụng" />
	            </div>
	            <div class="col-lg-9 text-right">
	               <ul class="pagination" style="margin: 0px 20px 0px 0px;">
	                  <?php echo $this->pagination->create_links();?>
	               </ul>
	            </div>
	         </div>
         </div>
      </form>
   </div>
</div>
</section>
</section>
<!--main content end-->