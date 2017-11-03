

<!-- checkout -->
	<div class="checkout">
		<div class="container">

            <div class="checkout-right page-checkout account">
                <?php
                if (isset($email)) {
                    ?>
                    <h1 class="notify-pg-ss">Hoàn tất đăng ký!</h1>
                    <h4 class="notify-pg">Một email xác nhận đã được gửi về: <a href="mailto:<?php echo $email?>"><?php echo $email?></a>. Hãy vào mail để kiểm tra và ấn vào link xác nhận
                        tài khoản nhé. Nếu không thấy mail xác nhận vui lòng chờ trong trong 5 - 10 phút vì có thể đường
                        truyền internet bị chậm, đồng thời có thể kiểm tra thư mục Spam (Thư rác) của email.</h4>
                    <?php
                }
                ?>
            </div>


		</div>
	</div>
	
<!-- //checkout -->
