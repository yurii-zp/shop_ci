<?php
	$this->load->view('templates/header');
?>
<section class="home_banner">
	<ul class="main_slider">
		<li style="background-image: url(<?php echo base_url('assets/images/layout/slide.jpg')?>);">
			<div class="banner_wrap">
				<div class="banner_text">
					<h2>Shop the best phones</h2>
					<p>Our extensive and affordable range features the very latest electronics and gadgets including smart phones, cases, headphones.</p>
				</div>
			</div>
		</li>
		<li style="background-image: url(<?php echo base_url('assets/images/layout/slide2.jpg')?>);">
			<div class="banner_wrap">
				<div class="banner_text">
					<h2>
						Samsung Galaxy Note8
						<span>One of the best choise today!</span>
					</h2>
					<ul>
						<li>Infinity Screen</li>
						<li>Dual Camera</li>
						<li>64GB Internal Memory</li>
						<li>Android 7.1 Nougat</li>
					</ul>
					<div>
						<a href="<?php echo site_url('catalog/index'); ?>" class="btn btn-lg btn-success">Buy Now</a>
					</div>
				</div>
			</div>
		</li>
		<li style="background-image: url(<?php echo base_url('assets/images/layout/slide3.jpg')?>);">
			<div class="banner_wrap">
				<div class="banner_text">
					<h2>Get a new iPhone X <br> and save $300</h2>
					<ul>
						<li>5.8" Super Retina HD Display</li>
						<li>12MP Wide-Angle and Telephoto Cameras</li>
						<li>7MP FaceTime HD Camera</li>
						<li>iOS 11</li>
						<li>Bluetooth 5.0</li>
					</ul>
					<div>
						<a href="<?php echo site_url('catalog/index'); ?>" class="btn btn-lg btn-success">Buy Now</a>
					</div>
				</div>
			</div>
		</li>
	</ul>
</section>
<section class="main_content">
	<div class="container">
		<h1 class="text-center"><span>Internet Shop</span>: widest selection of quality products at the wholesale prices online.</h1>
		<div class="catalog">
			<?php
				foreach($items as $key => $item) {
					echo '<div class="col-sm-4 col-xs-6">';
					echo '<a href="'.site_url('catalog/item/'.$item->id).'" target="_blank">';
					echo '<h4>'.$item->item.'</h4>';
					if($img) {
						echo '<div class="item_img" style="background-image: url('.base_url($img[$key]).'); "></div>';
					}
					else {
						echo '<div class="item_img" style="background-image: url('.base_url("assets/images/layout/item_placeholder.png").'); "></div>';
					}
					echo '<h3>$'.$item->pricesale.'</h3>';
					echo '</a>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</section>
<section class="catalog_sec">
	<div class="container">
		<h2 class="text-center">Online Shopping for Mobiles is Safe and Fun</h2>
		<p>With the advent of online shopping portals, purchasing mobiles have become an effortless task. The emergence of these portals have made it convenient for shoppers to have plethora of products on one platform, which makes their job of researching and comparing between various products, then, finally choosing the one that suits them the best easy and quick. In fact, it saves a lot of time! Hence, if you are planning to buy mobile online, 'Online Shop' showcases a huge array of high end smartphone as well as budget mobiles that suits every pocket.</p>
		<p>Many people, now-a-days prefer online shopping site to buy mobile phones. The sole reason to buy mobile online being, just on one platform, you get an easy access of various types of mobile phones. Also, one can check out different mobile phone prices and buy according to one's needs and budget. Every now and then, we have offers, deals, discounts that will make your shopping experience more delightful.</p>
		<p>'Online Shop' logistics ensures that mobiles are delivered safe at your place. Customers can track details of shipping online. What more you expect? Tell us and we will leave no stone unturned to fulfil your demands. Cause, the new mobiles on our site, are waiting to add quotient to your style!</p>
		<div class="text-center">
			<a href="<?php echo site_url('catalog/index'); ?>" class="btn btn-lg btn-success">View Catalog</a>
		</div>
	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>