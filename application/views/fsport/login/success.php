
<?php
$name = "";
$email = "";
$username = "";
$pass = "";
if(isset($post_modal)){
    $name = $post_modal['name'];
    $email = $post_modal['email'];
    $username = $post_modal['username'];
    $pass = $post_modal['password'];
}
?>
<!-- checkout -->
	<div class="checkout">
		<div class="container">

            <div class="checkout-right page-checkout account">
                <h1 class="notify-pg-ss">Success!</h1>
                <h4 class="notify-pg"><?php if($this->session->flashdata('sm_ss')) echo $this->session->flashdata('sm_ss')?></h4>
                <h4 class="notify-pg"><?php if($this->session->flashdata('rs_ss')) echo $this->session->flashdata('rs_ss')?></h4>
            </div>

		</div>
	</div>
	
<!-- //checkout -->
