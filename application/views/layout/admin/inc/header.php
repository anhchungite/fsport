
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?php if(isset($site_info)){echo $site_info['site_favicon'];}?>">
    <title><?php if(isset($title)){echo $title;}?> | <?php if(isset($site_info)){echo $site_info['site_title'];}?></title>
    <meta name="description" content="<?php if(isset($site_info)){echo $site_info['site_des'];}?>" />
    
	<link href="http://bootstrap-confirmation.js.org/assets/css/docs.min.css" rel="stylesheet">
  	<link href="http://bootstrap-confirmation.js.org/assets/css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->

	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo TEMPLATES_ADMIN ?>/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo TEMPLATES_ADMIN ?>/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo TEMPLATES_ADMIN ?>/css/font-awesome.min.css" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="<?php echo TEMPLATES_ADMIN ?>/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="<?php echo TEMPLATES_ADMIN ?>/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo TEMPLATES_ADMIN ?>/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN ?>/css/owl.carousel.css" type="text/css">
	<link href="<?php echo TEMPLATES_ADMIN ?>/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN ?>/css/fullcalendar.css">
	<link href="<?php echo TEMPLATES_ADMIN ?>/css/widgets.css" rel="stylesheet">
    <link href="<?php echo TEMPLATES_ADMIN ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo TEMPLATES_ADMIN ?>/css/style-responsive.css" rel="stylesheet" />
	<link href="<?php echo TEMPLATES_ADMIN ?>/css/xcharts.min.css" rel=" stylesheet">
	<link href="<?php echo TEMPLATES_ADMIN ?>/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
	<!-- Date time picker -->
	<link href="<?php echo TEMPLATES_ADMIN ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet">


	<!-- Select -->

	<link rel="stylesheet" href="<?php echo TEMPLATES_ADMIN ?>/css/bootstrap-select.min.css">
	<!-- Custom -->
	<link href="<?php echo TEMPLATES_ADMIN ?>/css/anhchung-custom.css" rel="stylesheet">
	

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="<?php echo TEMPLATES_ADMIN ?>/js/html5shiv.js"></script>
      <script src="<?php echo TEMPLATES_ADMIN ?>/js/respond.min.js"></script>
      <script src="<?php echo TEMPLATES_ADMIN ?>/js/lte-ie7.js"></script>
    <![endif]-->

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">


      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <!--logo start-->
            <a href="<?php echo base_url('admin')?>" class="logo"><img alt="" src="<?php if(isset($site_info)){echo $site_info['site_logo'];}?>"></a>
            <!--logo end-->



            <div class="top-nav notification-row">
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <?php
                    if($this->session->userdata('user_profile')){
                    	$arrUser = $this->session->userdata('user_profile');
                    	$id_user  = $arrUser['userID'];
                    	$fullname = $arrUser['userFullName'];
                    	$email    = $arrUser['userEmail'];
                    	//$gravatar = md5(strtolower(trim($email)));

                    }
                    ?>
                    <li class="dropdown tooltips" id="task_notificatoin_bar" data-toggle="tooltip " data-placement="bottom" title="" data-original-title="Cài đặt">
                        <a href="<?php echo base_url('admin/admin_site')?>">
                            <i class="icon-setting"></i>
                        </a>
                    </li>
					<li class="dropdown tooltips" id="mail_notificatoin_bar" data-toggle="tooltip " data-placement="bottom" title="" data-original-title="Liên hệ">
                        <a href="<?php echo base_url('admin/admin_contact?select=0')?>">
                            <i class="icon-envelope-l"></i>
                            <?php if(isset($count_unread) && $count_unread > 0):?><span class="badge bg-important"><?php echo $count_unread?></span><?php endif;?>
                        </a>
                    </li>
                    
                    <li class="dropdown">
                        <a href="<?php echo base_url().'admin/admin_user/edit/'?><?php if(isset($id_user))echo $id_user?>">
                            <span class="profile-ava">

                                <img alt="" src="<?php echo FILES_UPLOAD.'/img/'.$this->auth->getInfo()['userAvatar']?>" width="34px" height="34px">
                            </span>
                            <span class="username"><?php if(isset($fullname))echo $fullname?></span>

                        </a>

                    </li>
                    <li class="dropdown tooltips" id="alert_notificatoin_bar" data-toggle="tooltip " data-placement="bottom" title="" data-original-title="Logout">
                        <a href="<?php echo base_url('login/logout')?>">
                            <i class="icon-logout"></i>
                        </a>
                    </li>

                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>
      <!--header end-->
