<?php $this->load->view("layout/login/inc/header"); ?>
<style>
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
}
ul.login_error li{
	list-style: circle;
	list-style-position:inside;
}
</style>

	
	<form class="login-form" action="" method="post" id="login-form">
	    
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            
            <?php if($this->session->flashdata('flash_er')){?>
            <div class="alert-login"><strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
					  </div>
			<?php }?>
			<ul class="login_error">
			<?php echo form_error('userName','<li>','</li>')?> 
			</ul>   
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="userName" value="<?php echo set_value('userName')?>" autofocus>
            </div>
            <ul class="login_error">
            <?php echo form_error('userPass', '<li>', '</li>')?> 
            </ul>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="userPass" >

            </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" name="btn_login" value="Đăng nhập"/>

        </div>
      </form>
<?php $this->load->view("layout/login/inc/footer"); ?>