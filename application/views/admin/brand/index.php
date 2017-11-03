<style>
   th{text-align: center}
   td{text-align: center}
</style>
<div class="row">
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
      <section class="panel">
         <header class="panel-heading">
            <?php if(isset($title))echo $title?> <span class="badge bg-warning"><?php if(isset($count))echo $count?> </span>
         </header>
         <div class="panel-body">
            <a class="btn btn-default add-btn" href="<?php echo base_url('admin/admin_brand/add')?>"><span class="fa fa-plus"></span> Thêm mới</a>
            <table class="table table-striped table-advance table-hover">
               <tbody>
                  <tr>
                     <th>ID</th>
                     <th>Tên</th>
                     <th>Logo</th>
                     <th class='col-lg-2'>Chức năng</th>
                  </tr>
                  <?php 
                     if(isset($arrBrand)){
                     	foreach ($arrBrand as $key => $value){
                     		$id 	= $value['brandID'];
                     		$logo 	= $value['brandLogo'];
                     		if($logo == ''){
                     			$logo = 'Không có logo';
                     		}
                     		$name 	= htmlspecialchars($value['brandName']);
                     ?>
                  <tr>
                     <td><?php echo $id ?></td>
                     <td><?php echo $name ?></td>
                     <td><img src="<?php echo $logo ?>" class="img-thumbnail" width="100px"></td>
                     <td>
                        <a href="<?php echo base_url("admin/admin_brand/edit/{$id}")?>">
                        <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
                        </a>
                        <a href="<?php echo base_url("admin/admin_brand/del/{$id}")?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?">
                        <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
                        </a>
                     </td>
                  </tr>
                  <?php
                     }
                     }else{
                        ?>
                        <tr>
                           <td class="text-center" colspan="4">Không có kết quả nào!</td>
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

                  var current_url = '<?php echo current_url()?>';
                  $("#showall").click(function(){
                     $(location).attr("href", current_url);
                  });

               });
            </script>
         </div>
      </section>
   </div>
   <div class="col-lg-12">
      <ul class="pagination pull-right" style="margin: 0px 20px 0px 0px;">
         <?php echo $this->pagination->create_links()?>
      </ul>
   </div>
</div>
</section>
</section>
<!--main content end-->