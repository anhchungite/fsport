<style>
   th{text-align: center}
   td{text-align: center}
   
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="margin-bottom: 40px;">
		<form action="" method="get">
		
							<div class="col-sm-3">
								
									<div class="input-group">
										<input type="search" name="search" class="form-control input-sm" placeholder="Nhập từ khóa..."> 
										<span class="input-group-btn">
											<input type="submit" name="btn_search" class="btn btn-default btn-sm" value="Tìm kiếm">
										</span>
									</div>
							</div>
							</form>
		
							<a class="btn btn-default btn-sm" id="showall">Hiển thị tất cả</a>
		                                  
						</div>
	</div>
   <div class="col-lg-12">
      <?php if($this->session->flashdata('flash_er')){?>
		<div class="alert alert-danger fade in">
			  <strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
		 </div>
		  <?php }?>
		  <?php if($this->session->flashdata('flash_ss')){?>
		<div class="alert alert-success fade in">
			  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_ss')?>.
		 </div>
		  <?php }?>
	<form action="" method="post">
      <section class="panel">
         <header class="panel-heading">
            <?php if(isset($title))echo $title?> <span class="badge bg-warning"><?php if(isset($count))echo $count?></span>
         </header>
         <div class="panel-body">
            <a class="btn btn-default add-btn" href="<?php echo base_url('admin/admin_tag/add')?>"><span class="fa fa-plus"></span> Thêm mới</a>
            <table class="table table-striped table-advance table-hover">
               <tbody>
                  <tr>
                     <th><input type="checkbox" class="ck_all"></th>
                     <th class="txt-l">ID</th>
                     <th>Tên</th>
                     <th>Đường dẫn</th>
                     <th>Mô tả</th>
                     <th>Sản phẩm</th>
                     <th class='col-lg-2'>Chức năng</th>
                  </tr>
                   <?php if(isset($arrTag))
                   {
                        foreach ($arrTag as $key => $value) 
                        {
                          $id     	= $value['tagID'];
                          $name   	= htmlspecialchars($value['tagName']);
                          $des    	= htmlspecialchars($value['tagDes']);
                          $url    	= $value['tagURL'];
                          $count    	= $value['countSP'];
                       ?>
                  <tr style="background-color: #f5f5f5">
                     <td><input type="checkbox" class="ck_item" name="ck_item[]" value="<?php echo $id?>"></td>
                     <td class="txt-l"><?php echo $id ?></td>
                     <td class="txt-l"><?php echo $name ?></td>
                     <td class="txt-l"><?php echo $url ?></td>
                     <td class="txt-l"><?php echo $des ?></td>
                     <td class="txt-ct"><em><?php echo $count ?></em></td>
                     <td>
                        <a href="<?php echo base_url('admin/admin_tag/edit').'/'.$id ?>">
                        <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
                        </a>
                        <a href="<?php echo base_url('admin/admin_tag/del').'/'.$id ?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?">
                        <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
                        </a>
                     </td>
                  </tr>
                   <?php
                        }
                   }else{
                       ?>
                       <tr>
                           <td class="text-center" colspan="5">Không có kết quả nào!</td>
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
      <div class="col-lg-12" style="margin-bottom: 50px">
	   	<div class="form-group">
					<div class="col-lg-2">
						<select class="form-control m-bot15" name="tacvu" required>
							<option value="">- Tác vụ -</option>
							<option value="delete">Xóa</option>
						</select>
					</div>
					<div class="col-lg-1">
					<input type="submit" class="btn btn-default" name="btn_apdung"
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