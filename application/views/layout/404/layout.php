<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(isset($title))echo $title?></title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo TEMPLATES_ADMIN?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo TEMPLATES_ADMIN?>/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo TEMPLATES_ADMIN?>/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo TEMPLATES_ADMIN?>/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo TEMPLATES_ADMIN?>/css/style.css" rel="stylesheet">
    <link href="<?php echo TEMPLATES_ADMIN?>/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="<?php echo TEMPLATES_ADMIN?>/js/html5shiv.js"></script>
    <script src="<?php echo TEMPLATES_ADMIN?>/js/respond.min.js"></script>
    <![endif]-->
</head>

  <body>
   <div class="page-404">
    <p class="text-404">404</p>

    <h2>Aww Snap!</h2>
    <p>Trang bạn yêu cầu đã bị sai hoặc không tồn tại. <br><a href="<?php echo base_url()?>">Về Trang Chủ</a></p>
  </div>
  
  </body>
</html>
