<?php
pr_r($arr_product);
pr_r($arr_review);
pr_r($arr_tag_name);
pr_r($arr_relate_product);
$images = array_slice(json_decode($arr_product['productImage']), 1);
$color = json_decode($arr_product['productColor']);
//var_dump($color) ;
$size = json_decode($arr_product['productSize']);
$attr_color = json_decode(attr())->color;
?>
<!-- single -->
<div class="single">
	<div class="container">
		<div class="col-md-4 single-left">
			<div class="flexslider">
				<ul class="slides">
					<?php
					foreach ($images as $value) {
					?>
						<li data-thumb="<?=IMAGES_UPLOAD?>/<?=$value?>">
							<div class="thumb-image"> <img src="<?=IMAGES_UPLOAD?>/<?=$value?>" data-imagezoom="true" class="img-responsive"> </div>
						</li>
					<?php
					}
					?>
				</ul>
			</div>
			<!-- flixslider -->
			<script defer src="<?php echo TEMPLATES_PUBLIC?>/js/jquery.flexslider.js"></script>
			<link rel="stylesheet" href="<?php echo TEMPLATES_PUBLIC?>/css/flexslider.css" type="text/css" media="screen" />
			<script>
				// Can also be used with $(document).ready()
				$(window).load(function () {
					$('.flexslider').flexslider({
						animation: "hide",
						controlNav: "thumbnails",

					});
				});
			</script>
			<!-- flixslider -->
			<!-- zooming-effect -->
			<script src="<?php echo TEMPLATES_PUBLIC?>/js/imagezoom.js"></script>
			<!-- //zooming-effect -->
		</div>
		<div class="col-md-8 single-right">
			<h3><?=$arr_product['productName']?></h3>
			<div class="rating1">
				<span class="starRating">
				<?php
				$totalScore = 0;
				$avgScore = 0;
				if($arr_review){
					foreach ($arr_review as $key => $value) {
						$totalScore += $value['reviewScore'];
					}
					$avgScore = ceil($totalScore / count($arr_review));
				}
				?>
				<?php
				$i = 1;
				while($i <= 5){
					$ck = '';
					if($i <= $avgScore) $ck = 'checked';
				?>
				<span class="<?=$ck?>"></span>
				<?php
					$i++;
				}
				?>
						
					</span>
			</div>
			<div class="description">
				<h5><i>Mô tả</i></h5>
				<p><?=$arr_product['productDescription']?></p>
			</div>
			<div class="color-quality">
				<div class="color-quality-left">
					<h5>Màu sắc : </h5>
					<div class="btn-group" data-toggle="buttons">
						<?php
							foreach ($color as $key => $class){
								$checked = "";
								$active = '';
								if($key < 1) {
									$checked = 'checked = "checked"';
									$active = 'active';
								}
									?>
									<label class="btn btn-default <?=$active?>">
										<input type="radio" name="item_color" class="item_color" autocomplete="off" value="<?php echo $class?>" <?php echo $checked?>>
										<?php echo $attr_color->$class?><span class="glyphicon glyphicon-ok"></span>
									</label>
									
						<?php
							}

						?>
					</div>
				</div>
				<div class="color-quality-right">
					<h5>Số lượng :</h5>
					<div class="quantity">
						<div class="quantity-select">
							<div class="entry value-minus1">&nbsp;</div>
							<div class="entry value1 item_qty"><span>1</span></div>
							<div class="entry value-plus1 active">&nbsp;</div>
						</div>
					</div>
					<!--quantity-->
					<script>
						$('.value-plus1').on('click', function () {
							var divUpd = $(this).parent().find('.value1'),
								newVal = parseInt(divUpd.text(), 10) + 1;
							divUpd.text(newVal);
						});

						$('.value-minus1').on('click', function () {
							var divUpd = $(this).parent().find('.value1'),
								newVal = parseInt(divUpd.text(), 10) - 1;
							if (newVal >= 1) divUpd.text(newVal);
						});
					</script>
					<!--quantity-->

				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="color-quality" style="margin-top: 3em">
				<div class="color-quality-left">
					<h5>Kích cỡ :</h5>
					<div class="btn-group" data-toggle="buttons">
						<?php
						foreach ($size as $key => $sz){
							$checked = '';
							$active = '';
							if($key > 0) {
								if ($key == 1) {
									$checked = 'checked = "checked"';
									$active = 'active';
								}
								?>
								<label class="btn btn-default <?=$active?>">
									<input type="radio" name="item_size" class="item_size" autocomplete="off" value="<?php echo $sz?>" <?php echo $checked?>>
									<?php echo $sz?><span class="glyphicon glyphicon-ok"></span>
								</label>
								<?php
							}
						}

						?>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="occasional">
				<h5>Thương hiệu :</h5>
				<div class="colr ert">
					<a href="<?=base_url('thuong-hieu')?>/<?=$arr_brand['brandURL']?>">
						<img src="<?=$arr_brand['brandLogo']?>" alt="<?=$arr_brand['brandName']?>" class="img-responsive">
					</a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="simpleCart_shelfItem">
			<p>
				<?php 
				if(!empty($arr_product['productDiscount'])) {
					?>
					<span>
						<?=number_format($arr_product['productPrice'])?> VNĐ
					</span> 
					<i>
						<?=number_format($arr_product['productPrice'] - ($arr_product['productPrice'] * $arr_product['productDiscount'] / 100))?> VNĐ
					</i>
				<?php } else {?>
					<i>
						<?=number_format($arr_product['productPrice'])?> VNĐ
					</i>
				<?php }?>
			</p>
				<p><a class="item_add" href="#">Thêm vào giỏ</a></p>
			</div>

		</div>
		<div class="clearfix"> </div>
	</div>
</div>

<div class="additional_info">
	<div class="container">
		<div class="sap_tabs">
			<div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
				<ul>
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Thông tin sản phẩm</span></li>
					<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Đánh giá</span></li>
				</ul>
				<div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
					<h3><?=$arr_product['productName']?></h3>
					<p><?=$arr_product['productDetail']?></p>
				</div>

				<div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1">
					<h4>(<?=count($arr_review)?>) Đánh giá</h4>
					<?php
					foreach ($arr_review as $key => $value) {
						$avatar = 'default-avatar.png';
						if($value['member'] == 1){
							$avatar = getUserInfo(array('userAvatar'), 'one', array('userEmail' => $value['reviewEmail']));
						}
					?>
					<div class="additional_info_sub_grids">
						<div class="col-xs-2 additional_info_sub_grid_left">
							<img src="<?=IMG_UPLOAD?>/<?=$avatar?>" alt=" " class="img-responsive avatar-reviewer">
						</div>
						<div class="col-xs-10 additional_info_sub_grid_right">
							<div class="additional_info_sub_grid_rightl">
								<a href="#"><?=$value['reviewName']?></a>
								<h5><?=date('d-m-Y', $value['reviewDate'])?></h5>
								<p><?=$value['reviewText']?></p>
							</div>
							<div class="additional_info_sub_grid_rightr">
								<div class="rating">
									<?php
									$i = 1;
									while($i <= 5){
										$ck = '';
										if($i <= $value['reviewScore']){
											$ck = '-';
										}
									?>
									<div class="rating-left">
										<img src="<?php echo TEMPLATES_PUBLIC?>/images/star<?=$ck?>.png" alt=" " class="img-responsive">
									</div>
									<?php
										$i++;
									}
									?>
									<div class="clearfix"> </div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<?php
					}
					?>
					<div class="review_grids">
						<h5>Thêm đánh giá</h5>
						<div class="row">
							<form method="post" action="#" id="frm_rate">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<input type="number" id="input-1" name="rscore" class="rating rating-loading" data-size="xs" data-min="0" data-max="5" data-step="1" required>
										<div class="error-rscore"></div>
									</div>
								</div>
								<?php
								if($this->auth->checkLogged()){
								?>
								<input type="hidden" name="rname" value="<?=$this->auth->getInfo()['userFullName']?>" required>								
								<input type="hidden" name="remail" value="<?=$this->auth->getInfo()['userEmail']?>" required>								
								<?php
								}else{
								?>
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<input type="text" name="rname" placeholder="Họ và tên" class="form-control" required>
										<div class="error-rname"></div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<input type="email" name="remail" placeholder="Email" class="form-control" required>
										<div class="error-remail"></div>
									</div>
								</div>
								<?php
								}
								?>
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<textarea name="rtext" placeholder="Nội dung" class="form-control" required></textarea>
										<div class="error-rtext"></div>
									</div>
									<input type="submit" name="btn_rate" value="Submit">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo TEMPLATES_PUBLIC?>/js/app-product.js" type="text/javascript"></script>
		<script src="<?php echo TEMPLATES_PUBLIC?>/js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#horizontalTab1').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true // 100% fit in a container
				});
			});
		</script>
	</div>
</div>
<div class="w3l_related_products">
	<div class="container">
		<h3>Sản phẩm liên quan</h3>
		<ul id="flexiselDemo2">
			<li>
				<div class="w3l_related_products_grid">
					<div class="agile_ecommerce_tab_left dresses_grid">
						<div class="hs-wrapper hs-wrapper3">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss1.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss2.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss3.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss4.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss5.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss6.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss7.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss8.jpg" alt=" " class="img-responsive">
							<div class="w3_hs_bottom">
								<div class="flex_ecommerce">
									<a href="#" data-toggle="modal" data-target="#myModal6"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
								</div>
							</div>
						</div>
						<h5><a href="single.html">Pink Flared Skirt</a></h5>
						<div class="simpleCart_shelfItem">
							<p class="flexisel_ecommerce_cart"><span>$312</span> <i class="item_price">$212</i></p>
							<p><a class="item_add" href="#">Add to cart</a></p>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="w3l_related_products_grid">
					<div class="agile_ecommerce_tab_left dresses_grid">
						<div class="hs-wrapper hs-wrapper3">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss2.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss3.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss4.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss5.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss6.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss9.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss7.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss8.jpg" alt=" " class="img-responsive">
							<div class="w3_hs_bottom">
								<div class="flex_ecommerce">
									<a href="#" data-toggle="modal" data-target="#myModal6"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
								</div>
							</div>
						</div>
						<h5><a href="single.html">Red Pencil Skirt</a></h5>
						<div class="simpleCart_shelfItem">
							<p class="flexisel_ecommerce_cart"><span>$432</span> <i class="item_price">$323</i></p>
							<p><a class="item_add" href="#">Add to cart</a></p>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="w3l_related_products_grid">
					<div class="agile_ecommerce_tab_left dresses_grid">
						<div class="hs-wrapper hs-wrapper3">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss3.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss4.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss5.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss6.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss7.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss8.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss9.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss1.jpg" alt=" " class="img-responsive">
							<div class="w3_hs_bottom">
								<div class="flex_ecommerce">
									<a href="#" data-toggle="modal" data-target="#myModal6"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
								</div>
							</div>
						</div>
						<h5><a href="single.html">Yellow Cotton Skirt</a></h5>
						<div class="simpleCart_shelfItem">
							<p class="flexisel_ecommerce_cart"><span>$323</span> <i class="item_price">$310</i></p>
							<p><a class="item_add" href="#">Add to cart</a></p>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="w3l_related_products_grid">
					<div class="agile_ecommerce_tab_left dresses_grid">
						<div class="hs-wrapper hs-wrapper3">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss4.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss5.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss6.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss7.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss8.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss9.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss1.jpg" alt=" " class="img-responsive">
							<img src="<?php echo TEMPLATES_PUBLIC?>/images/ss2.jpg" alt=" " class="img-responsive">
							<div class="w3_hs_bottom">
								<div class="flex_ecommerce">
									<a href="#" data-toggle="modal" data-target="#myModal6"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
								</div>
							</div>
						</div>
						<h5><a href="single.html">Black Short</a></h5>
						<div class="simpleCart_shelfItem">
							<p class="flexisel_ecommerce_cart"><span>$256</span> <i class="item_price">$200</i></p>
							<p><a class="item_add" href="#">Add to cart</a></p>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<script type="text/javascript">
			$(window).load(function () {
				$("#flexiselDemo2").flexisel({
					visibleItems: 4,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed: 3000,
					pauseOnHover: true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: {
						portrait: {
							changePoint: 480,
							visibleItems: 1
						},
						landscape: {
							changePoint: 640,
							visibleItems: 2
						},
						tablet: {
							changePoint: 768,
							visibleItems: 3
						}
					}
				});

			});
		</script>
		<script type="text/javascript" src="<?php echo TEMPLATES_PUBLIC?>/js/jquery.flexisel.js"></script>
	</div>
</div>
<div class="modal video-modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModal6">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<section>
				<div class="modal-body">
					<div class="col-md-5 modal_body_left">
						<img src="<?php echo TEMPLATES_PUBLIC?>/images/39.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="col-md-7 modal_body_right">
						<h4>a good look women's Long Skirt</h4>
						<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
							irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
							cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						<div class="rating">
							<div class="rating-left">
								<img src="<?php echo TEMPLATES_PUBLIC?>/images/star-.png" alt=" " class="img-responsive" />
							</div>
							<div class="rating-left">
								<img src="<?php echo TEMPLATES_PUBLIC?>/images/star-.png" alt=" " class="img-responsive" />
							</div>
							<div class="rating-left">
								<img src="<?php echo TEMPLATES_PUBLIC?>/images/star-.png" alt=" " class="img-responsive" />
							</div>
							<div class="rating-left">
								<img src="<?php echo TEMPLATES_PUBLIC?>/images/star.png" alt=" " class="img-responsive" />
							</div>
							<div class="rating-left">
								<img src="<?php echo TEMPLATES_PUBLIC?>/images/star.png" alt=" " class="img-responsive" />
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="modal_body_right_cart simpleCart_shelfItem">
							<p><span>$320</span> <i class="item_price">$250</i></p>
							<p><a class="item_add" href="#">Add to cart</a></p>
						</div>
						<h5>Color</h5>
						<div class="color-quality">
							<ul>
								<li><a href="#"><span></span>Red</a></li>
								<li><a href="#" class="brown"><span></span>Yellow</a></li>
								<li><a href="#" class="purple"><span></span>Purple</a></li>
								<li><a href="#" class="gray"><span></span>Violet</a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- //single -->
<script src="/vendor/kartik-v/bootstrap-star-rating/js/star-rating.min.js" type="text/javascript"></script>
<script src="/vendor/kartik-v/bootstrap-star-rating/js/locales/es.js"></script>