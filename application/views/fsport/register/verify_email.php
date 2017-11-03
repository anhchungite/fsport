

<!-- checkout -->
	<div class="checkout">
		<div class="container">

            <div class="checkout-right page-checkout account">
                <?php
                if ($message == 1){
                ?>
                    <h1 class="notify-pg-ss">Success!</h1>
                    <h4 class="notify-pg">Địa chỉ Email của bạn đã được xác thực.</h4>
                <?php
                }else{
                 ?>
                    <h1 class="notify-pg-er">Error!</h1>
                    <h4 class="notify-pg">Lỗi xác thực địa chỉ Email.</h4>
                <?php
                }
                ?>
            </div>


		</div>
	</div>
	
<!-- //checkout -->
