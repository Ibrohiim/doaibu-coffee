<section class="slide1">
	<div class="wrap-slick1">
		<div class="slick1">
			<?php $no = 1 ?>
			<?php foreach ($slider as $sl) : ?>
				<?php if ($sl->is_active == 1) { ?>
					<div class="item-slick1 item1-slick1" style="background-image: url(<?= base_url('assets/img/') ?>configuration/slider/<?= $sl->image ?>);">
						<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
							<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15 bo7" data-appear="fadeInDown">
								<?= $sl->title; ?>
							</span>
							<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
								<?= $sl->caption; ?>
							</h2>
							<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
								<a href="<?= base_url($sl->link); ?>" class="flex-c-m size2 bo-rad-10 s-text2 bgwhite hov1 trans-0-4">
									<?= $sl->text_link; ?>
								</a>
							</div>
						</div>
					</div>
				<?php } else {
				} ?>
				<?php $no++ ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Banner Offers -->
<section class="banner2 bg5 p-t-45 p-b-45">
	<?php if ($offers != null) { ?>
		<div class="container">
			<div class="wrap-slick4">
				<div class="slick4">
					<?php
					foreach ($offers as $off) :
						$date = date('d-M-Y', strtotime($off['expired']));
					?>
						<div class="item-slick4 p-l-15 p-r-15">
							<div class="bgwhite hov-img-zoom pos-relative">
								<img src="<?= base_url('assets/img/') ?>offers/<?= $off['image']; ?>" alt="IMG-OFFERS">
								<div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
									<div class="offers">
										<div class="flex-col-c-m bo1 bg4 p-l-5 -r-5">
											<span class="m-text9 fs-20-sm">
												<?= $off['name']; ?>
											</span>
										</div>
										<p class="s-text27">
											<?= $off['description']; ?>
										</p>
										<p class="s-text27  ">
											<?= $off['information']; ?>
										</p>
									</div>
									<div class="flex-c-m p-t-44 p-t-30-xl">
										<div class="flex-col-c-m bg11 m-l-5 m-r-5 p-2">
											<span class="m-text28 p-b-1">
												Expired : <?= $date; ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="header-footer">
			<div class="container">
				<div class="py-4 align-items-center">
					<div class="text-center mb-md-0">
						<h6 class="mb-0">There are no offers for today</h6>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</section>

<!-- Our product -->
<section class="bgwhite p-t-45 p-b-58">
	<div class="container">
		<div class="sec-title p-b-22">
			<h3 class="m-text5 t-center">
				Favorite Products
			</h3>
		</div>
		<div class="wrap-slick2">
			<div class="slick2">
				<?php foreach ($product as $pro) {
					$price = $pro['price'];
					$discount = $pro['discount'];
					$total_discount = ($discount / 100) * $price;
					$fixed_price = $price - $total_discount;
				?>
					<div class="item-slick2 p-l-15 p-r-15">
						<div class="bo9 bo-rad-5 block2 pos-relative" style="background-color: #FAAF40;">
							<?php if ($pro['stock'] == 'Sold-Out') { ?>
								<div class="overlay-slick"></div>
								<div class="ribbon-slick">
									<div class="ribbon-slick-content">
										<div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
									</div>
								</div>
							<?php } ?>
							<div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $pro['stock'] !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
								<img src="<?= base_url('assets/img/') ?>product/<?= $pro['image']; ?>" alt="<?= $pro['name'] ?>">
								<?php if ($pro['stock'] !== 'Sold-Out') { ?>
									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>
										<div class="block2-btn-addcart-slick w-size30 trans-0-4">
											<div class="add_qty_cart_slick flex-w of-hidden">
												<button class="btn-num-product-down btn-qty-slick color1 flex-c-m bg8 eff4"><i class="fs-12 fa fa-minus" aria-hidden="true"></i>
												</button>
												<input class="qty-num-product-slick m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $pro['id_product']; ?>">
												<button class="btn-num-product-up btn-qty-slick color1 flex-c-m bg8 eff4"><i class="fs-12 fa fa-plus" aria-hidden="true"></i>
												</button>
											</div>
											<button class="add-cart add_to_cart_slick flex-c-m hov7 s-text26 trans-0-4" data-productid="<?= $pro['id_product']; ?>" data-productname="<?= $pro['name']; ?>" data-productprice="<?= $fixed_price; ?>" data-producttime="<?= $pro['bursttime']; ?>" data-action="add">
												Add to Cart
											</button>
										</div>
									</div>
								<?php } else { ?>
									<div class="block2-btn-notavailable w-size2 trans-0-4">
										<button class="btn_notavailable flex-c-m size26 bg11 bo-rad-10 s-text21 trans-0-4" disabled>
											Item Not Available
										</button>
									</div>
								<?php } ?>
							</div>
							<div class="block3-txt p-b-10 text-center">
								<h4>
									<a href="<?= base_url('homepage/detail/' . $pro['id_product']); ?>" class="block2-product-name">
										<?= $pro['name'] ?>
									</a>
								</h4>
								<?php if ($discount !== '0') { ?>
									<span class="block2-oldprice m-text7 p-r-5">
										RP <?= number_format($price, '0', ',', '.') ?>
									</span>
									<span class="block2-newprice m-text8 p-r-5">
										RP <?= number_format($fixed_price, '0', ',', '.') ?>
									</span>
								<?php } else { ?>
									<span class="block2-product-price">
										RP <?= number_format($fixed_price, '0', ',', '.') ?>
									</span>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<!-- Instagram -->
<section class="instagram p-t-20">
	<div class="sec-title p-b-52 p-l-15 p-r-15">
		<h3 class="m-text5 t-center">
			@ follow us on Instagram
		</h3>
	</div>
	<div class="wrap-slick5">
		<div class="slick5">
			<?php foreach ($gallery as $gal) { ?>
				<div class="block4 wrap-pic-w">
					<div class="item-slick5">
						<img src="<?= base_url('assets/img/') ?>gallery/<?= $gal['image']; ?>" alt="IMG-INSTAGRAM">
						<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
							<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
								<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
								<span class="p-t-2"><?= $gal['likegallery']; ?></span>
							</span>
							<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
								<p class="s-text10 m-b-15 h-size1 of-hidden">
									<?= $gal['captions']; ?>
								</p>
								<span class="s-text9">
									Photo by @doaibucoffee
								</span>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<!-- Service -->
<section class="shipping bgwhite p-t-62 p-b-46">
	<div class="flex-w p-l-15 p-r-15">
		<?php foreach ($service as $ser) { ?>
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					<?= $ser['title']; ?>
				</h4>
				<a href="#" class="s-text11 t-center">
					<?= $ser['description']; ?>
				</a>
			</div>
		<?php } ?>
	</div>
</section>