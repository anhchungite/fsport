

<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="col-md-5 wthree_banner_bottom_left">
				<div class="video-img">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
						<span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
					</a>
				</div>
				<!-- pop-up-box -->    
						<link href="<?php echo TEMPLATES_PUBLIC?>/css/popuo-box.css" rel="stylesheet" type="text/css" property="" media="all" />
						<script src="<?php echo TEMPLATES_PUBLIC?>/js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!--//pop-up-box -->
					<div id="small-dialog" class="mfp-hide">
                        <iframe width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
					</div>
					<script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
					</script>
			</div>
            <?php if(isset($arr_product)) { ?>
			<div class="col-md-7 wthree_banner_bottom_right">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<?php
                            foreach ($arr_product as $key => $value) {
                                $id_cat = $value['categoryID'];
                                $name_cat = $value['categoryName'];
                                $active = "";
                                if($key < 1){
                                    $active = "active";
                                }
                                //$id_cat = $value['categoryID'];
                                ?>
                                <li role="presentation" class="<?php echo $active?>"><a href="#t<?php echo $id_cat?>" role="tab" id="tab-<?php echo $id_cat?>"
                                                                          data-toggle="tab" aria-controls="t<?php echo $id_cat?>"><?php echo $name_cat?></a>
                                </li>

                                <?php
                            }
                        ?>
					</ul>
					<div id="myTabContent" class="tab-content">
                        <?php
                        foreach ($arr_product as $key => $value) {
                        $id_cat = $value['categoryID'];
                        $name_cat = $value['categoryName'];
                            $active = "";
                            if($key < 1){
                                $active = "active";
                            }
                        ?>
						<div role="tabpanel" class="tab-pane fade <?php echo $active?> in" id="t<?php echo $id_cat?>" aria-labelledby="tab-<?php echo $id_cat?>">
							<div class="agile_ecommerce_tabs">
                                <?php foreach ($value['product'] as $key  => $value){
                                    $value['productID'];
                                    $value['productName'];
                                    $value['productDiscount'];
                                    $value['productPrice'];
                                    $value['productDescription'];
                                    $arr_img = json_decode($value['productImage']);

                                ?>
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
                                        <?php foreach ($arr_img as $img){ ?>
										<img src="<?php echo IMAGES_UPLOAD?>/<?php echo $img?>" alt=" " class="img-responsive" />
										<?php } ?>
                                        <?php foreach ($arr_img as $img){ ?>
                                            <img src="<?php echo IMAGES_UPLOAD?>/<?php echo $img?>" alt=" " class="img-responsive" />
                                        <?php } ?>
										<div class="w3_hs_bottom">
											<ul>
												<li>
													<a href="#" data-toggle="modal" data-target="#myModal<?php echo $value['productID'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="simpleCart_shelfItem">
										<div class="item_idsp hid"><?php echo $value['productID']?></div>
                                        <div class="item_arrsize hid"><?php echo $value['productSize']?></div>
                                        <div class="item_arrcolor hid"><?php echo $value['productColor']?></div>
                                        <div class="item_thumb hid"><?php echo IMAGES_UPLOAD?>/<?php echo $arr_img[0]?></div>
                                        <h5><a href="/<?=$value['productURL']?>-p<?=$value['productID']?>"><div class="item_name"><?php echo $value['productName'];?></div></a></h5>
										<p><?php echo $value['productDiscount'] > 1000?"<span>{$value['productDiscount']}</span>":""?> <i class="item_price"><?php echo number_format($value['productPrice'])?></i></p>
										<p><a class="item_add" href="javascript:void(0)">Thêm vào giỏ</a></p>
									</div>

								</div>
                                <?php }?>

								<div class="clearfix"> </div>
							</div>
						</div>
                            <?php
                        }
                        ?>


					</div>
				</div>
                <!--modal-video-->
                <?php
                foreach ($arr_product as $key => $value){
                    foreach ($value['product'] as $value){
                        $value['productID'];
                        $value['productName'];
                        $value['productDiscount'];
                        $value['productPrice'];
                        $value['productDescription'];
                        $arr_img = json_decode($value['productImage']);
						$color = json_decode($value['productColor']);
						//var_dump($color) ;
                        $size = json_decode($value['productSize']);
						$attr_color = json_decode(attr())->color;
						//var_dump($attr_color);

                ?>
                <div class="modal video-modal fade" id="myModal<?php echo $value['productID']?>" tabindex="-1" role="dialog" aria-labelledby="myModal<?php echo $value['productID']?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <section>
                                <div class="modal-body simpleCart_shelfItem">
                                    <div class="col-md-5 modal_body_left">
										<div class="item_idsp hid"><?php echo $value['productID']?></div>
										<div class="item_arrsize hid"><?php echo $value['productSize']?></div>
										<div class="item_arrcolor hid"><?php echo $value['productColor']?></div>
                                        <img src="<?php echo IMAGES_UPLOAD?>/<?php echo $arr_img[0]?>" alt=" " class="img-responsive" />
                                        <div class="item_thumb hid"><?php echo IMAGES_UPLOAD?>/<?php echo $arr_img[0]?></div>
                                    </div>
                                    <div class="col-md-7 modal_body_right">
                                        <h4 class="item_name"><?php echo $value['productName'];?></h4>
                                        <p><?php echo $value['productDescription'];?></p>
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
                                        <div class="modal_body_right_cart">
                                            <p><?php echo $value['productDiscount'] > 0?"<span>{$value['productDiscount']}</span>":""?> <i class="item_price"><?php echo number_format($value['productPrice'])?> ₫</i></p>


                                        <h5>Màu sắc</h5>
                                        <div class="select-color">
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
                                        <h5>Kích cỡ</h5>
                                        <div class="select-size">
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
										<p><a class="item_add" href="javascript:void(0)">Thêm vào giỏ</a></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
			</div>
            <?php }?>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //banner-bottom -->


<!-- new-products -->
	<div class="new-products">
		<div class="container">
			<h3>Sản phẩm mới</h3>
			
			<div class="agileinfo_new_products_grids">
			<?php 
			if($arr_new_product):
				foreach ($arr_new_product as $value)
				{
			?>
				<div class="col-md-3 agileinfo_new_products_grid">
					<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
						<div class="hs-wrapper hs-wrapper1">
							<img src="<?php echo $value['productImage']?>" alt=" " class="img-responsive" />
							
							<?php foreach ($value['list_image'] as $image):?>
							<img src="<?php echo $image['image']?>" alt=" " class="img-responsive" />
							<?php endforeach;?>
							<img src="<?php echo $value['productImage']?>" alt=" " class="img-responsive" />
							<?php foreach ($value['list_image'] as $image):?>
							<img src="<?php echo $image['image']?>" alt=" " class="img-responsive" />
							<?php endforeach;?>
							<div class="w3_hs_bottom w3_hs_bottom_sub">
								<ul>
									<li>
										<a href="#" data-toggle="modal" data-target="#myModal<?php echo $value['productID']?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</li>
								</ul>
							</div>
						</div>
						<h5><a href="single.html"><?php echo $value['productName']?></a></h5>
						<div class="simpleCart_shelfItem">
							<p><span><?php if($value['productDiscount'] > 0)echo number_format($value['productDiscount'])?></span> <i class="item_price"><?php echo number_format($value['productPrice'])?></i></p>
							<p><a class="item_add" href="#">Thêm vào giỏ</a></p>
						</div>
					</div>
				</div>
				<div class="modal video-modal fade" id="myModal<?php echo $value['productID']?>" tabindex="-1" role="dialog" aria-labelledby="myModal6">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
										<img src="<?php echo $value['productImage']?>" alt=" " class="img-responsive" />
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo $value['productName']?></h4>
										<p><?php echo $value['productDescription']?></p>
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
											<p><span><?php if($value['productDiscount'] > 0)echo number_format($value['productDiscount'])?></span> <i class="item_price"><?php echo number_format($value['productPrice'])?></i></p>
											<p><a class="item_add" href="#">Thêm vào giỏ</a></p>
										</div>
										<h5>Color</h5>
										<div class="color-quality">
											<ul>
												<?php 
												$arr_color = explode(', ', $value['productColor']);
													foreach ($arr_color as $color)
													{
														foreach ($define_color as $key => $value)
														{
															if($color == $value)
															{
												?>
												<li><a href="#" class="<?php echo $key?>"><span></span><?php echo $color?></a></li>
												<?php 
															}
														}
													}
												?>
												
											</ul>
										</div>
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
						</div>
					</div>
				</div>
				<?php 
				}
				endif;
				?>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //new-products -->
<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>Thương hiệu</h3>
			<div class="sliderfig">
				<ul id="flexiselDemo1">	
				<?php if (isset($arr_brand))
				{ 
					foreach ($arr_brand as $value)
					{?>		
					<li>
						<img src="<?php echo $value['brandLogo']?>" alt=" " class="img-responsive" width="100px"/>
					</li>
				<?php }
					}?>	
				
				</ul>
			</div>
			
					<script type="text/javascript">
							$(window).load(function() {
								$("#flexiselDemo1").flexisel({
									visibleItems: 4,
									animationSpeed: 1000,
									autoPlay: true,
									autoPlaySpeed: 3000,    		
									pauseOnHover: true,
									enableResponsiveBreakpoints: true,
									responsiveBreakpoints: { 
										portrait: { 
											changePoint:480,
											visibleItems: 1
										}, 
										landscape: { 
											changePoint:640,
											visibleItems:2
										},
										tablet: { 
											changePoint:768,
											visibleItems: 3
										}
									}
								});
								
							});
					</script>
					<script type="text/javascript" src="<?php echo TEMPLATES_PUBLIC?>/js/jquery.flexisel.js"></script>
		</div>
	</div>
<!-- //top-brands -->