
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo TEMPLATES_ADMIN?>/img/favicon.png">
    <title><?php echo $title ?></title>
    <style>
        <?php
        include ('inc/semantic.min.css');
        include ('inc/all.css');
        ?>
        .alert-login{
            webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border: 2px solid #ffd0e1;
            opacity: 0.8;
            padding: 5px;
            width: 100%;
            border-radius: 20px;
            margin: 0 auto 10px auto;
            color: #ff2d55;
        }
        ul.login_error{
            padding: 0px;
            font-size: 12px;
            color: red;
            text-align: left;
        }
        ul.login_error li{
            list-style: circle;
            list-style-position: outside;
        }
    </style>
</head>
<body>
<div class="user-login-page">
    <div class="ui header">Đăng nhập</div>
    <div class="login-container">
        <?php if($this->session->flashdata('flash_er')){?>
            <div class="alert-login"><strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
            </div>
        <?php }?>

    </div>
    <form action="" method="post" accept-charset="utf-8" class="ui form login-container" id="login-form">
        <div class="ui horizontal divider">TÀI KHOẢN</div>
        <ul class="login_error">
            <?php echo form_error('userName','<li>','</li>')?>
        </ul>
        <div class="field">
            <input name="userName" id="username" type="text" value="" placeholder="Username" autocomplete="on" required="" autofocus="" value="<?php echo set_value('userName')?>">
        </div>
        <ul class="login_error">
            <?php echo form_error('userPass', '<li>', '</li>')?>
        </ul>
        <div class="field">
            <input name="userPass" id="password" type="password" value="" placeholder="Password" autocomplete="off" required="">
        </div>

        <div class="field center aligned">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
            <input type="submit" class="ui green button fluid submit" name="btn_login" value="Đăng nhập">
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN?>/js/form-validation-script.js"></script>
</body>
</html>
