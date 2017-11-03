<!-- newsletter -->
<div class="newsletter">
	<div class="container">
		<div class="col-md-6 w3agile_newsletter_left">
			<h3>Newsletter</h3>
			<p>Excepteur sint occaecat cupidatat non proident, sunt.</p>
		</div>
		<div class="col-md-6 w3agile_newsletter_right">
			<form action="#" method="post">
				<input type="email" name="Email" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}"
				    required="">
				<input type="submit" value="" />
			</form>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //newsletter -->
<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="w3_footer_grids">
			<div class="col-md-3 w3_footer_grid">
				<h3>Liên hệ</h3>
				<p>Công ty may mặc & thời trang thể thao AnC.</p>
				<ul class="address">
					<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>69 Hùng Vương, <span>Đà Nẵng.</span></li>
					<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:chunglamht@gmail.com">chunglamht@gmail.com</a></li>
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>01665.26.36.46</li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>Thông tin</h3>
				<ul class="info">
					<li><a href="about.html">About Us</a></li>
					<li><a href="mail.html">Contact Us</a></li>
					<li><a href="short-codes.html">Short Codes</a></li>
					<li><a href="faq.html">FAQ's</a></li>
					<li><a href="products.html">Special Products</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>Danh mục</h3>
				<ul class="info">
					<li><a href="dresses.html">Dresses</a></li>
					<li><a href="sweaters.html">Sweaters</a></li>
					<li><a href="shirts.html">Shirts</a></li>
					<li><a href="sarees.html">Sarees</a></li>
					<li><a href="skirts.html">Shorts & Skirts</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>Tài khoản của tôi</h3>
				<ul class="info">
					<li><a href="products.html">Summer Store</a></li>
					<li><a href="checkout.html">My Cart</a></li>
				</ul>
				<h4>Follow Us</h4>
				<div class="agileits_social_button">
					<ul>
						<li><a href="#" class="facebook"> </a></li>
						<li><a href="#" class="twitter"> </a></li>
						<li><a href="#" class="google"> </a></li>
						<li><a href="#" class="pinterest"> </a></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-copy">
		<div class="footer-copy1">
			<div class="footer-copy-pos">
				<a href="#home" class="scroll"><img src="<?php echo TEMPLATES_PUBLIC?>/images/arrow.png" alt=" " class="img-responsive" /></a>
			</div>
		</div>
		<div class="container">
			<p>&copy; 2016
				<?php if (isset($site_name))echo $site_name?>. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
		</div>
	</div>
</div>


<!-- //footer -->
<!-- js -->
<script src="<?php echo TEMPLATES_PUBLIC?>/js/jquery-ui.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<!-- //js -->
<!-- cart -->
<script src="<?php echo TEMPLATES_PUBLIC?>/js/simpleCart.js"></script>
<!-- cart -->
<!-- bootstrap -->
<script type="text/javascript" src="<?php echo TEMPLATES_PUBLIC?>/js/bootstrap-3.1.1.min.js"></script>
<!-- // bootstrap -->
<!-- notify -->
<script type="text/javascript" src="<?php echo TEMPLATES_PUBLIC?>/js/notify.min.js"></script>
<!-- notify -->
<!-- app -->
<script src="<?php echo TEMPLATES_PUBLIC?>/js/app-util.js"></script>
<script src="<?php echo TEMPLATES_PUBLIC?>/js/app-cart.js"></script>
<script src="<?php echo TEMPLATES_PUBLIC?>/js/app-validate.js"></script>
<!-- app -->
<!-- start-smooth-scrolling -->
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".scroll").click(function (event) {
			event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->
</body>

</html>