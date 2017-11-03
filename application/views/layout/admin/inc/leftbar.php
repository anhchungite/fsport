<!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse" style="">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" style="">                
                  <li class="active">
                      <a class="" href="<?php echo base_url('admin')?>">
                          <i class="icon_house_alt"></i>
                          <span>HOME</span>
                      </a>
                  </li>
				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_plus_alt2"></i>
                          <span>Sản phẩm</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" style="">
                          <li><a class="" href="<?php echo base_url().'admin/admin_product/add'; ?>"><i class="arrow_carrot-right"></i>Sản phẩm mới</a></li>
                           <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>                          
                          <li><a class="" href="<?php echo base_url().'admin/admin_product'; ?>"><i class="arrow_carrot-right"></i>Tất cả sản phẩm</a></li>
                          <li><a class="" href="<?php echo base_url().'admin/admin_brand'; ?>"><i class="arrow_carrot-right"></i>Thương hiệu</a></li>
						  <li><a class="" href="<?php echo base_url().'admin/admin_cat'; ?>"><i class="arrow_carrot-right"></i>Danh mục</a></li>
						  <li><a class="" href="<?php echo base_url().'admin/admin_tag'; ?>"><i class="arrow_carrot-right"></i>Thẻ</a></li>
						  <?php }?>
                      </ul>
                  </li>
                  <?php if($this->auth->checkAdmin()){ ?>
                  <li>                     
                      <a class="" href="<?php echo base_url('admin/admin_page'); ?>">
                          <i class="icon_documents_alt"></i>
                          <span>Trang</span>
                          
                      </a>                   
                  </li>
                  <?php } ?>
				  <li class="">
                      <a class="" href="<?php echo base_url('admin/admin_user'); ?>">
                          <i class="icon_id"></i>
                          <span>Người dùng</span>
                      </a>

                  </li>
                  <li>                     
                      <a class="" href="<?php echo base_url().'admin/admin_file'; ?>">
                          <i class="icon_images"></i>
                          
                          <span>Quản lý file</span>
                          
                      </a>                   
                  </li>
                
              </ul>
              <!-- sidebar menu end-->
              
              <div style="color: #d0d8df;margin: 20px 0 20px 10px;font-style: italic;font-size: 12px">Copyright &copy; <?php echo date('Y')?> <?php if(isset($site_info)){echo $site_info['site_name'];}?></div>
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
			  <?php 
					$link = $this->router->fetch_class();
					$method = ucfirst($this->router->fetch_method());
					$arrClass = explode('_', $link);
					$class = ucfirst(array_pop($arrClass));
					$link = base_url()."admin/{$link}";
					
					$arrLink = array("$link" => "$class", "javascript:void(0)" => "$method");
					
					?>
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> <?php if(isset($name))echo $name?></h3>
					<?php 
					if($class != "Index"){
						?>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="<?php echo base_url('admin')?>">Home</a></li>
					
					<?php 
						foreach ($arrLink as $key => $value){?>
						<li><a href="<?php echo $key ?>"><?php echo $value?></a></li>
					<?php 
						}
					?>				  	
					</ol>
					<?php }
					?>		
				</div>
			</div>
			