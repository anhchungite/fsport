
              
            <div class="row">
				<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              <?php if(isset($title))echo $title?>
                          </header>
                          
                          <div class="panel-body">
                          <style>
                          .form-group {padding-bottom: 0px !important}
                          .content {border: 1px solid #cccccc; min-height: 300px;padding: 20px;}
                          </style>
                              <div class="form">
                              <?php 
                              if(isset($arrContact)){
						  		$id_contact	= $arrContact['id_contact'];
						  		$name		= $arrContact['name'];
						  		$email		= $arrContact['email'];
						  		$date		= $arrContact['date'];
						  		$phone		= $arrContact['phone'];
						  		$content	= strip_tags($arrContact['content']);
						  		
                              }
                              ?>
									<form class="form-validate form-horizontal" id="page_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Họ và tên:</label>
                                          <div class="col-lg-6">
                                           <?php if(isset($name))echo $name?>  
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Email:</label>
                                          <div class="col-lg-6">
                                          <?php if(isset($email))echo $email?>
                                          </div>   
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Ngày gửi:</label>
                                          <div class="col-lg-6">
                                          <?php if(isset($date))echo $date?>  
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Số điện thoại:</label>
                                          <div class="col-lg-6">
                                           <?php if(isset($phone))echo $phone?>  
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Nội dung:</label>
                                          <div class="col-lg-10">
                                          		<div class="content"><?php if(isset($content))echo $content?></div>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <a class="btn btn-primary" href="<?php echo $this->agent->referrer()?>">Trở về</a>
                                              <a class="btn btn-danger" href="<?php echo base_url().'admin/admin_contact/del/'.$id_contact?>">Xóa</a>
                                          </div>
                                      </div>
                                 </form>
                              </div>
                          </div>
                      </section>
                  </div>
				</div>

          </section>
      </section>
      <!--main content end-->