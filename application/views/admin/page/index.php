
              
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
                      <section class="panel">
                          <header class="panel-heading">
                              Danh sách trang
                          </header>
                          <div class="panel-body">
							<a class="btn btn-default add-btn" href="<?php echo base_url('admin/admin_page/add')?>"><span class="fa fa-plus"></span> Thêm mới</a>
							  <table class="table table-striped table-advance table-hover">
							   <tbody>
								  <tr>
									 <th>ID</th>
									 <th>Tên trang</th>
									 <th>Trạng thái</th>
									 <th class='col-lg-2'>Chức năng</th>
								  </tr>
								  <?php
								  if(isset($arrPage)){
								  	foreach ($arrPage as $key => $value){
								  		$id_page 		= $value['id_page'];
								  		$name_page		= $value['name_page'];
								  		$status_page	= $value['status_page'];
								  ?>	
								  
								  <tr>
									 <td><?php echo $id_page ?></td>
									 <td><?php echo $name_page ?></td>
									 <td>
									 <?php 
									 if($status_page == 1){
									 ?>
									<i class="fa fa-eye" aria-hidden="true"></i> Hiển thị
									 <?php 
									 }else {
									 ?>
									 <i class="fa fa-eye-slash" aria-hidden="true"></i> Không hiển thị
									 <?php 
									 }
									 ?>
									 </td>
									 <td>
				                        <a href="<?php echo base_url("admin/admin_page/edit/{$id_page}")?>">
				                        <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
				                        </a>
				                        <a href="<?php echo base_url("admin/admin_page/del/{$id_page}")?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?">
				                        <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
				                        </a>
				                     </td>
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
	</script>        
							   </tbody>
							</table>
						</div>
                      </section>
                  </div>
              </div>

          </section>
      </section>
      <!--main content end-->