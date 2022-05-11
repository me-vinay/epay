<?php
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="mainbanner-container">
	<img id ="background-image" src="homepage/img/transparent.png" >
	<!-- <div>
		<img id ="video-bg" src="homepage/graphics/urban-line-514.png">
		<video id ="video-bg" src="homepage/video/mainbanner.mp4" autoplay="" muted="" loop="" playsinline="">
	</div> -->
	<div id="banner-text">
		<div class="banner-box">
			<img id ="video-bg" src="homepage/graphics/urban-line-514.png">
			<img id ="shop-bg" src="homepage/graphics/flame-1102.png" >
			<img id ="shop-board" src="homepage/graphics/a.png" >
			<a class="content" href="<?php echo($actual_link.'sellers/supplier/account/login');?>">
			<img id ="shop-sell" src="homepage/graphics/b.png" >
		</a>
		<a class="content" href="<?php echo($actual_link.'buyers/');?>">
			<img id ="shop-buy" src="homepage/graphics/c.png" >
		</a>
		</div>
		<!-- <div class="banner-left">

			<div class="box">
			<span class="content" >
				Online Shop
			</span>
		</div>
		</div>

		<div class="banner-text-a ">
			<div class="box">
				<a class="content" href="<?php echo($actual_link.'sellers/supplier/account/login');?>">
					For Sellers
					
				</a>
			</div>
		</div>
		<div class="banner-text-b">
			<div class="box">
				<a class="content" href="<?php echo($actual_link.'buyers/');?>">
					For Buyers
					
				</a>
			</div>
		</div> -->
	</div>
</div>
