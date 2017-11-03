<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo TEMPLATES_ADMIN?>/img/favicon.png">

    <title><?php echo $title ?></title>

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
<?php 
$imgRand = rand(1, 13);
?>
  <body class="login-img-body" style="background: url('<?php echo TEMPLATES_ADMIN?>/img/bg-<?php echo $imgRand?>.jpg') no-repeat center center fixed; ">

    <div class="container">