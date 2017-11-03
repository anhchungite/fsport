<link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN.'/lib/select2-bs/css/select2.min.css' ?>">
<link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN.'/lib/select2-bs/css/select2-bootstrap.min.css' ?>">

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
            <h3 class="panel-title">
               <i class="fa fa-pencil"></i> <?php if(isset($title))echo $title?>
            </h3>
         </div>
         <div class="panel-body">

                 <ul class="form_error"
                     style="margin-bottom: 20px">
                     <?php echo form_error('input_ten', '<li>', '</li>') ?>
                     <?php echo form_error('input_chitiet', '<li>', '</li>') ?>
                     <?php echo form_error('input_mota', '<li>', '</li>') ?>
                     <?php echo form_error('input_tukhoa', '<li>', '</li>') ?>
                     <?php echo form_error('input_tag', '<li>', '</li>') ?>
                     <?php echo form_error('input_giagoc', '<li>', '</li>') ?>
                     <?php echo form_error('input_giaban', '<li>', '</li>') ?>
                     <?php echo form_error('input_soluong', '<li>', '</li>') ?>
                     <?php echo form_error('input_nhanhieu', '<li>', '</li>') ?>
                     <?php echo form_error('input_danhmuc[]', '<li>', '</li>') ?>
                     <?php echo form_error('input_type_size', '<li>', '</li>') ?>
                     <?php echo form_error('input_csize[]', '<li>', '</li>') ?>
                     <?php echo form_error('input_nsize[]', '<li>', '</li>') ?>
                     <?php echo form_error('input_mausac[]', '<li>', '</li>') ?>
                     <?php echo form_error('input_image[]', '<li>', '</li>') ?>
                 </ul>

            <form action="" method="post" enctype="multipart/form-data"
               id="form-product" class="form-horizontal">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab-general" data-toggle="tab">Tổng
                     quan</a>
                  </li>
                  <li><a href="#tab-data" data-toggle="tab">Dữ liệu</a></li>
                  <li><a href="#tab-links" data-toggle="tab">Liên kết</a></li>
                  <li><a href="#tab-attribute" data-toggle="tab">Thuộc tính</a></li>
                  <li><a href="#tab-image" data-toggle="tab">Hình ảnh</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="tab-general">
                     <div class="tab-content">
                        <div class="form-group">
                           <label class="col-sm-2 control-label" for="input_name2">Tên sản
                           phẩm <span class="required">*</span>
                           </label>
                           <div class="col-sm-10">
                              <input type="text" name="input_ten" value="<?php echo set_value('input_ten')?>"
                                 placeholder="Tên sản phẩm:" id="input_name2"
                                 class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label" for="input_detail">Mô tả
                           sản phẩm:</label>
                           <div class="col-sm-10">
                              <textarea name="input_chitiet" class="ckeditor"
                                 id="input_description"><?php echo set_value('input_chitiet')?></textarea>
                               <!-- Tag input -->
                               <link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN ?>/lib/tagsinput-bs/bootstrap-tagsinput.css">
                               <link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN ?>/lib/tagsinput-bs/bootstrap-tagsinput-typeahead.css">
                               <div class="input-group" style="margin-top: 10px">
                                   <span class="input-group-addon">Tags:</span>
                                   <input name="input_tag" class="form-control tagsinput-typeahead" type="text" value="<?php echo set_value('input_tag')?>"/>
                               </div>
                           </div>
                            <script src="/assets/templates/admin/js/jquery-2.2.1.min.js"></script>
                            <script src="<?php echo TEMPLATES_ADMIN.'/lib/tagsinput-bs/bootstrap-tagsinput.js'?>"></script>
                            <script src="<?php echo TEMPLATES_ADMIN.'/lib/tagsinput-bs/bootstrap3-typeahead.js'?>"></script>
                            <script>
                                var places = [
                                    <?php
                                    if(isset($arr_all_tag)){
                                    foreach ($arr_all_tag as $key => $value){
                                    ?>
                                    {name: "<?php echo $value['tagName']?>"},
                                    <?php
                                    }
                                    }
                                    ?>
                                ];

                                $('.tagsinput-typeahead').tagsinput({
                                    trimValue: true,
                                    typeahead: {
                                        source: places.map(function(item) { return item.name }),
                                        afterSelect: function() {
                                            this.$element[0].value = '';
                                        }
                                    }
                                })
                            </script>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label"
                              for="input_meta-description2">Mô tả từ khóa:</label>
                           <div class="col-sm-10">
                              <textarea name="input_mota" rows="3"
                                 placeholder="Mô tả từ khóa:" id="input_meta-description2"
                                 class="form-control"><?php echo set_value('input_mota')?></textarea>

                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label" for="input_meta-keyword2">Từ
                           khóa:</label>
                           <div class="col-sm-10">
                              <textarea name="input_tukhoa" rows="2" placeholder="Từ khóa:"
                                 id="input_meta-keyword2" class="form-control"><?php echo set_value('input_tukhoa')?></textarea>
                           </div>
                        </div>


                     </div>
                  </div>
                  <div class="tab-pane" id="tab-data">
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_price">Giá gốc
                        <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                           <input type="number" name="input_giagoc" min="1000" value="<?php echo set_value('input_giagoc')?>"
                              placeholder="Giá gốc (>1000)" id="input_price"
                              class="form-control">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_price">Giá bán
                        <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                           <input type="number" name="input_giaban" min="1000" value="<?php echo set_value('input_giaban')?>"
                              placeholder="Giá bán (>1000)" id="input_price"
                              class="form-control">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_quantity">Số
                        lượng <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                           <input type="number" name="input_soluong" min="1" value="<?php echo set_value('input_soluong', 1)?>"
                              placeholder="Số lượng:" id="input_quantity"
                              class="form-control">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Trạng thái:</label>
                        <div class="col-sm-10">
                           <label class="radio-inline">
                               <input type="radio" name="input_trangthai" value="2" <?php echo set_value('input_trangthai', 2)==2?"checked":""?>> Bật
                           </label>
                            <label class="radio-inline">
                                <input type="radio" name="input_trangthai" value="1" <?php echo set_value('input_trangthai', 2)==1?"checked":""?>> Tắt
                           </label>
                           <label class="radio-inline">
                              <input type="radio" name="input_trangthai" value="0" <?php echo set_value('input_trangthai', 2)==0?"checked":""?>> Hết hàng
                           </label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-sort-order">Thứ
                        tự:</label>
                        <div class="col-sm-10">
                           <input type="number" name="input_thutu" value="<?php echo set_value('input_thutu', 1) ?>"
                              placeholder="Thứ tự:" id="input-sort-order"
                              class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab-links">
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-manufacturer"><span
                           data-toggle="tooltip" title="">Hãng sản xuất </span><span class="required">*</span></label>
                        <div class="col-sm-10">
            
                           <select name="input_nhanhieu" class="selectpicker show-tick"
                              title="Chọn hãng sản xuất..." data-live-search="true">
                              <?php if(isset($arr_all_brand)): foreach ($arr_all_brand as $value):?>
                              <option value="<?php echo $value['brandID']?>" <?php echo set_value('input_nhanhieu')==$value['brandID']?"selected":""?>>
                                  <?php echo $value['brandName']?>
                              </option>
                              <?php endforeach; endif;?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-category"><span
                           data-toggle="tooltip" title="">Danh mục</span> <span class="required">*</span></label>
                        <div class="col-sm-10">

                           <select name="input_danhmuc[]" class="selectpicker" multiple data-actions-box="true" data-selected-text-format="count > 0" title="Chọn danh mục..." data-live-search="true">
                              <?php if(isset($arr_all_cat)) {
                                  function show_cat($arr_all_cat, $parent_id = 0, $char = ""){
                                    foreach ($arr_all_cat as $key => $value){
                                        if($value['parentCategoryID'] == $parent_id){
                               ?>
                                            <option value="<?php echo $value['categoryID']?>" <?php if(set_value('input_danhmuc')){echo in_array($value['categoryID'], set_value('input_danhmuc'))?"selected":"";}?>><?php echo $char.$value['categoryName']?></option>

                               <?php
                                            unset($arr_all_cat[$key]);
                                            show_cat($arr_all_cat, $value['categoryID'], $char."|---");
                                        }
                                    }
                                  }
                                show_cat($arr_all_cat);
                              }

                       ?>

                           </select>

                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab-attribute">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Kích cỡ <span class="required">*</span></label>
                        <div class="col-sm-10">
                           <label class="radio-inline">
                               <input class="type-size" type="radio" name="input_type_size" value="1" <?php echo set_value('input_type_size')=="1"?"checked":""?>> Size chữ
                           </label>
                            <label class="radio-inline">
                                <input class="type-size" type="radio" name="input_type_size" value="0" <?php echo set_value('input_type_size')=="0"?"checked":""?>> Size số
                            </label>
                            <label class="radio-inline">
                                <input class="type-size" type="radio" name="input_type_size" value="2" <?php echo set_value('input_type_size')=="2"?"checked":""?>> Free size
                            </label>
                        </div>
                     </div>

                     <div class="size size-char form-group">
                        <label class="col-sm-2 control-label" for="input_size"></label>
                        <div class="col-sm-10">
                            <select name="input_csize[]" class="selectpicker" multiple data-actions-box="true"
                                    title="Chọn kích cỡ..." data-live-search="true">
                                <?php foreach ($arr_attr->schar as $value):?>
                                    <option value="<?php echo trim($value)?>" <?php if(set_value('input_csize')){echo in_array($value, set_value('input_csize'))?"selected":"";}?>><?php echo $value?></option>
                                <?php endforeach;?>
                            </select>
                            </div>
                     </div>
                      <div class="size size-num form-group">
                        <label class="col-sm-2 control-label" for="input_size"></label>
                        <div class="col-sm-10">
                            <select name="input_nsize[]" class="selectpicker" multiple data-actions-box="true"
                                    title="Chọn kích cỡ..." data-live-search="true">
                                <?php foreach ($arr_attr->snum as $value):?>
                                    <option value="<?php echo trim($value)?>" <?php if(set_value('input_nsize')){echo in_array($value, set_value('input_nsize'))?"selected":"";}?>><?php echo $value?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-manufacturer"><span
                           data-toggle="tooltip" title="">Màu sắc</span> <span class="required">*</span></label>
                        <div class="col-sm-10">
                           <select name="input_mausac[]" class="selectpicker" multiple data-actions-box="true"
                              title="Chọn màu sắc..." data-live-search="true">
                              <?php foreach ($arr_attr->color as $key => $value):?>
                              <option value="<?php echo trim($key)?>" <?php if(set_value('input_mausac')){echo in_array($key, set_value('input_mausac'))?"selected":"";}?>><?php echo $value?></option>
                              <?php endforeach;?>

                           </select>

                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab-image">
                     <div class="table-responsive">
                        <table id="images"
                           class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <td class="text-left">Hình đại diện</td>
                                 <td class="text-left">Đường dẫn</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="text-left">
                                    <div class="img-thumbnail" onclick="BrowseServer('input-img1')" style="cursor: pointer">
                                       <img src="<?php echo FILES_UPLOAD?>/images/img-thumbnail-logo.png"
                                          alt="" title="Chọn hình ảnh">
                                    </div>
                                 </td>
                                 <td class="text-right"><input type="text" id="input-img1"
                                    name="input_image[]" value="<?php echo set_value('input_image[]')?>" class="form-control">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="table-responsive">
                        <table id="images"
                           class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <td class="text-left">Hình ảnh khác</td>
                                 <td class="text-left">Đường dẫn</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="text-left">
                                    <div class="img-thumbnail" onclick="BrowseServer('input-img2')" style="cursor: pointer">
                                       <img src="<?php echo FILES_UPLOAD?>/images/img-thumbnail-logo.png"
                                          alt="" title="Chọn hình ảnh">
                                    </div>
                                 </td>
                                 <td class="text-right"><input type="text" id="input-img2"
                                    name="input_image[]" value="<?php echo set_value('input_image[]')?>" class="form-control">
                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-left">
                                    <div class="img-thumbnail" onclick="BrowseServer('input-img3')" style="cursor: pointer">
                                       <img src="<?php echo FILES_UPLOAD?>/images/img-thumbnail-logo.png"
                                          alt="" title="Chọn hình ảnh">
                                    </div>
                                 </td>
                                 <td class="text-right"><input type="text" id="input-img3"
                                    name="input_image[]" value="<?php echo set_value('input_image[]')?>" class="form-control">
                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-left">
                                    <div class="img-thumbnail" onclick="BrowseServer('input-img4')" style="cursor: pointer">
                                       <img src="<?php echo FILES_UPLOAD?>/images/img-thumbnail-logo.png"
                                          alt="" title="Chọn hình ảnh">
                                    </div>
                                 </td>
                                 <td class="text-right"><input type="text" id="input-img4"
                                    name="input_image[]" value="<?php echo set_value('input_image[]')?>" class="form-control">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="form-group" style="margin-top: 25px">
                  <div class="col-lg-offset-2 col-lg-10">
                     <input class="btn btn-primary" type="submit" name="btn_save" value="Lưu"/>
                     <input class="btn btn-success" type="submit" name="btn_save_add" value="Lưu & thêm"/>
                     <input class="btn btn-default" type="reset" value="Nhập lại"/>
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
<script type="text/javascript"
   src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-1.8.3.min.js"
   charset="UTF-8"></script>
<script
    src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
   var editedField;
   function BrowseServer(field)
      {
      	// You can use the "CKFinder" class to render CKFinder in a page:
      	var finder = new CKFinder();
      	finder.connectorPath = '<?php echo base_url("admin/admin_ckfinder/connector")?>';
      	finder.basePath = '';	// The path for the installation of CKFinder (default = "/ckfinder/").
      	finder.selectActionFunction = SetFileField;
      	finder.popup();
      	editedField = field ;
      }
      
      function SetFileField( fileUrl )
      {
          var temp_fileUrl = fileUrl.split("/");
          fileUrl = temp_fileUrl.pop();

   	   document.getElementById( editedField ).value = fileUrl ;
   	   var link = "<?php echo IMAGES_UPLOAD.'/'?>" + document.getElementById( editedField ).value;
   		$("#"+editedField+"").parents("tr").find('img').attr({"src": link, "width": "100px"});
      }
    for(var i = 1; i <= 4; i++){
        var id = "input-img"+i;
        var name = document.getElementById( id ).value;
        var link = "<?php echo IMAGES_UPLOAD.'/'?>" + name;
        if(name != ""){
            $("#"+id+"").parents("tr").find('img').attr({"src": link, "width": "100px"});
        }
    }

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
<script type="text/javascript">
   $(function(){
       var val = $("input[name='input_type_size']:checked").val();
       //console.log(val);
       if(val == 0){ // Nếu nhập size số
           $('.size-num').show(); // Hiển thị form nhập size số lên.
           $('.size-char').hide(); // Và ẩn form nhập size chữ
           //$('.dis-char').attr('disabled', 'disabled'); // Vô hiệu hóa form nhập size chữ
           //$('.dis-num').removeAttr('disabled'); // Và kích hoạt form nhập size số

       }else if(val == 1){ // Ngược lại, nhập size chữ
           $('.size-char').show(); // Hiển thị form nhập size chữ
           $('.size-num').hide(); // Và ẩn form nhập size số
           //$('.dis-num').attr('disabled', 'disabled'); // Vô hiệu hóa form nhập size số
           //$('.dis-char').removeAttr('disabled'); // Và kích hoạt form nhập size chữ
       }else {
           $('.size-char').hide(); // Và ẩn form nhập size chữ
           $('.size-num').hide(); // Và ẩn form nhập size số
       }
//       $('.size-char').hide(); // Và ẩn form nhập size chữ
//       $('.size-num').hide(); // Và ẩn form nhập size số
   	$(document).on('change', "input[name='input_type_size']", function(){
   		var val = $("input[name='input_type_size']:checked").val();
            if(val == 0){ // Nếu nhập size số
                $('.size-num').slideDown(); // Hiển thị form nhập size số lên.
                $('.size-char').hide(); // Và ẩn form nhập size chữ
                //$('.dis-char').attr('disabled', 'disabled'); // Vô hiệu hóa form nhập size chữ
                //$('.dis-num').removeAttr('disabled'); // Và kích hoạt form nhập size số

            }else if(val == 1){ // Ngược lại, nhập size chữ
                $('.size-char').slideDown(); // Hiển thị form nhập size chữ
                $('.size-num').hide(); // Và ẩn form nhập size số
                //$('.dis-num').attr('disabled', 'disabled'); // Vô hiệu hóa form nhập size số
                //$('.dis-char').removeAttr('disabled'); // Và kích hoạt form nhập size chữ
            }else {
                $('.size-char').slideUp();
                $('.size-num').slideUp();
            }
   		});
   	
   });
   
</script>