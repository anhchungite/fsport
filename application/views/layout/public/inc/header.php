
<!DOCTYPE html>
<html>
<head>
<title><?= (isset($tdk) && $tdk['title'] != '')? $tdk['title'] : (isset($site_info)? $site_info['site_title'] : '')?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?= (isset($tdk) && $tdk['keyword'] != '')? $tdk['keyword'] : (isset($site_info)? $site_info['site_key'] : '')?>" />
<meta name="description" content="<?= (isset($tdk) && $tdk['description'] != '')? $tdk['description'] : (isset($site_info)? $site_info['site_des'] : '')?>" />
<script type="application/x-javascript"> 
// 		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
// 		function hideURLbar(){ window.scrollTo(0,1); } 
</script>
<!-- //for-mobile-apps -->
<link href="<?php echo TEMPLATES_PUBLIC?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo TEMPLATES_PUBLIC?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo TEMPLATES_PUBLIC?>/css/f4sport.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo TEMPLATES_PUBLIC?>/css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo TEMPLATES_PUBLIC?>/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo TEMPLATES_PUBLIC?>/css/bootstrap-social.css" rel="stylesheet" >
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- countdown -->
<link rel="stylesheet" href="<?php echo TEMPLATES_PUBLIC?>/css/jquery.countdown.css" />
<!-- //countdown -->
<link rel="stylesheet" href="/vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css" />
<link rel="stylesheet" href="/vendor/kartik-v/bootstrap-star-rating/css/star-rating.min.css" />

<script src="<?php echo TEMPLATES_PUBLIC?>/js/jquery.min.js"></script>
<style type="text/css">
.color-quality ul li a.brown span
{
 background: brown none repeat scroll 0 0;
}
.color-quality ul li a.white span
{
 background: white none repeat scroll 0 0;
}
.color-quality ul li a.yellow span
{
 background: yellow none repeat scroll 0 0;
}
.color-quality ul li a.orange span
{
 background: orange none repeat scroll 0 0;
}
.color-quality ul li a.pink span
{
 background: pink none repeat scroll 0 0;
}
.color-quality ul li a.red span
{
 background: red none repeat scroll 0 0;
}
.color-quality ul li a.blue span
{
 background: blue none repeat scroll 0 0;
}
.color-quality ul li a.violet span
{
 background: violet none repeat scroll 0 0;
}
.color-quality ul li a.black span
{
 background: black none repeat scroll 0 0;
}
.color-quality ul li a.gray span
{
 background: gray none repeat scroll 0 0;
}

</style>
</head>
	
<body>
<!-- header -->
	<div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;</button>
					<h4 class="modal-title" id="myModalLabel">
						Đăng nhập ngay bây giờ!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">	
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item" aria-controls="tab_item-0"><span>Đăng nhập</span></li>
										<li class="resp-tab-item" aria-controls="tab_item-1"><span>Đăng ký</span></li>
									</ul>		
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">
												<form action="<?php echo base_url('login')?>" method="post" id="form_login">
													<input name="id" id="login_id" placeholder="Email hoặc tên đăng nhập" type="text" required>
													<input name="password" id="login_pass" placeholder="Mật khẩu" type="password" required>
													<div class="sign-up">
                                                        <p class="lost_pass">
                                                            <a href="<?php echo base_url('login/forgot-password')?>"><span class="glyphicon glyphicon-info-sign"></span> Quên mật khẩu?</a>
                                                        </p>
<!--                                                        <button type="submit" name="btn_login">Đăng nhập</button>-->
														<input type="submit" name="btn_login_modal" value="Đăng nhập"/>
													</div>
												</form>
											</div>
										</div> 
									</div>	

									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
												<form id="form_reg" action="<?php echo base_url('register')?>" method="post">
													<input placeholder="Họ và tên" name="name" type="text" required>
													<input placeholder="Email" name="email" type="email" required>
													<input placeholder="Tên đăng nhập" name="username" type="text" required>
													<input placeholder="Mật khẩu" class="password" name="password" type="password" required>

													<div class="sign-up">
														<input type="submit" name="btn_reg" value="Tạo tài khoản"/>
													</div>
												</form>
											</div>
										</div>
									</div> 			        					            	      
								</div>	
							</div>
							<script src="<?php echo TEMPLATES_PUBLIC?>/js/easyResponsiveTabs.js" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function () {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true   // 100% fit in a container
									});
								});
							</script>
							<div id="OR" class="hidden-xs">
								OR</div>
						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<div class="row text-center sign-with">

								<div class="col-md-12">
                                    <a class="btn btn-block btn-social btn-facebook" href="<?php echo base_url('login/facebook')?>">
                                        <span class="fa fa-facebook"></span>Đăng nhập với Facebook
                                    </a>
                                    <a class="btn btn-block btn-social btn-google" href="<?php echo base_url('login/google')?>">
                                        <span class="fa fa-google"></span>Đăng nhập với Google
                                    </a>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		//$('#myModal88').modal('show');
	</script>
	<div class="header">
		<div class="container">
			<div class="w3l_login" style="margin-right: 10px;">
				<a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>

			</div>
            <?php
            if(!$this->auth->checkLogged()) {


                ?>
                <div class="customer">
                    <h3>Chào, Khách</h3>
                    <p><a href="#" data-toggle="modal" data-target="#myModal88">Đăng nhập</a></p>
                </div>
                <?php
            }else{
            ?>
                <div class="customer">
                    <h3><?php
                        if($this->auth->checkLogged()){
                            echo $this->auth->getInfo()['userFullName'];
                        }
                        ?></h3>
                    <p><?= anchor(base_url('member'),'Tài khoản của tôi')?> | <a class="logout" href="<?php echo base_url('login/logout') ?>">Đăng
                            xuất</a></p>
                </div>
            <?php

            }
            ?>
			<div class="w3l_logo">
				<h1><a href="<?php echo base_url()?>"><?php if(isset($site_info)){echo "<img class='img-responsive' src='{$site_info['site_logo']}' width='70%'/>";}else {echo $site_info['site_name'];}?></a></h1>
			</div>
			<div class="search">
				<input class="search_box" type="checkbox" id="search_box" onclick="!$(this).prop('checked')? $('.search_result').hide():'';">
				<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
                <div class="search_form">
					<form action="<?php echo base_url('search')?>" method="get">
						<input type="text" name="keyword" id="search_input" placeholder="Search...">
						<input type="submit" value="Send">
					</form>

				</div>
                <div class="search_result">
                	<ul></ul>
				</div>
			</div>
			<div class="cart box_1">
				<a href="<?php echo base_url("cart")?>">
					<div class="total">
					<span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> sản phẩm)</div>
					<img src="<?php echo TEMPLATES_PUBLIC?>/images/bag.png" alt="" />
				</a>
				<p><a href="javascript:;" class="simpleCart_empty">Xóa giỏ hàng</a></p>
				<div class="clearfix"> </div>
			</div>	
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/" class="act">Trang chủ</a></li>	
						<!-- Mega Menu -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sản phẩm <b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="col-sm-3">
										<ul class="multi-column-dropdown">
											<h6>Quần áo thể thao</h6>
											<li><a href="">Bóng đá<span>New</span></a></li>
											<li><a href="">Bóng rổ</a></li>
											<li><a href=""> Body,Gym</a></li>
											<li><a href=""><i>Shop Nam &rarr;</i></a></li>
										</ul>
									</div>
									<div class="col-sm-3">
										<ul class="multi-column-dropdown">
											<h6>Thương hiệu</h6>
											<li><a href="#">Nike</a></li>
											<li><a href="#">Adidas<span>New</span></a></li>
											<li><a href="#"><i>Shop Nữ &rarr;</i></a></li>
										</ul>
									</div>
									<div class="col-sm-2">
										<ul class="multi-column-dropdown">
											<h6>Dụng cụ</h6>
											<li><a href="#">Bóng đá</a></li>
											<li><a href="#">Bóng rổ</a></li>
											<li><a href="#">Cầu lông</a></li>
											<li><a href="#">Tennis</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<div class="w3ls_products_pos">
											<h4>50%<i>Off/-</i></h4>
											<img src="<?php echo TEMPLATES_PUBLIC?>/images/1.jpg" alt=" " class="img-responsive" />
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
						</li>
						<li><a href="/cart">Giỏ hàng</a></li>
						<li><a href="/about">Giới thiệu</a></li>
						<li><a href="/contact">Liên hệ</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
<!-- //header -->
<div id="home" class="banner" style="<?php if($controller != 'public')echo 'display:none'?>">
		<div class="container">
			<h3>fashions fade, <span>style is eternal</span></h3>
		</div>
	</div>
<div class="breadcrumb_dress">
		<div class="container">

			<ul>
				<li><a href="<?php echo base_url()?>"><span aria-hidden="true" class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
                <?php 
				if(!isset($tdk)){
					$tdk = [];
				}
				echo create_breadcrumb($tdk); 
				?>
			</ul>
		</div>
	</div>
