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
      <section class="panel">
         <header class="panel-heading">
            <?php if(isset($title))echo $title?> <span class="badge bg-warning"><?php if(isset($count))echo $count?></span>
         </header>
         <div class="panel-body">
            <a class="btn btn-default add-btn" href="<?php echo base_url('admin/admin_cat/add')?>"><span class="fa fa-plus"></span> Thêm mới</a>
            <table class="table table-advance table-hover">
               <tbody>
                  <tr>
                     <th>ID</th>
                     <th>Tên</th>
                     <th>Đường dẫn</th>
                     <th>Sắp xếp</th>
                     <th>Sản phẩm</th>
                     <th class='col-lg-2'>Chức năng</th>
                  </tr>
                   <?php
                   if(isset($arr_all_cat))
                   {
                      function show_cat($arr_all_cat, $parent_id=0, $char="")
                      {
                         foreach ($arr_all_cat as $key => $value) {
                            $id = $value['categoryID'];
                            $name = htmlspecialchars($value['categoryName']);
                            $img = $value['categoryImage'];
                            $url = $value['categoryURL'];
                            $sort = $value['categorySortOrder'];
                            $count = $value['countSP'];
                            $parentID = $value['parentCategoryID'];
                            if($value['parentCategoryID'] == $parent_id){
                            ?>
                               <tr>
                                  <td><?php echo $id ?></td>
                                  <td class="txt-l"><?php echo $char.$name ?></td>
                                  <td class="txt-l"><?php echo $url ?></td>
                                  <td><?php echo $sort ?></td>
                                  <td><em><?php echo $count ?></em></td>
                                  <td>
                                     <a href="<?php echo base_url('admin/admin_cat/edit').'/'.$id ?>">
                                        <div class="btn btn-primary btn-sm"><i class="icon_pencil-edit"></i></div>
                                     </a>
                                     <a href="<?php echo base_url('admin/admin_cat/del').'/'.$id ?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?">
                                        <div class="btn btn-danger btn-sm"><i class="icon_close_alt2"></i></div>
                                     </a>
                                  </td>
                               </tr>
                               <?php
                               if(count($arr_all_cat) <= 0) {
                                  ?>
                                  <tr>
                                     <td colspan="5">Không có kết quả nào</td>
                                  </tr>
                                  <?php
                               }
                               ?>

                            <?php
                               unset($arr_all_cat[$key]);
                               show_cat($arr_all_cat, $id, $char."|---");
                            }
                         }

                      }
                      show_cat($arr_all_cat);
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
   <div class="col-lg-12">
      <ul class="pagination pull-right" style="margin: 0px 20px 0px 0px;">
         <?php echo $this->pagination->create_links()?>
      </ul>
   </div>
</div>
</section>
</section>
<!--main content end-->