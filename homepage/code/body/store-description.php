<?php
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!-- <div class="row mar-tp-100">
	<div class="col-md-6 slideanim">
		<img src="homepage/img/1banner.jpg">
	</div>
	<div class="col-md-6">
		<div class="short-text">
			<h3>For Seller</h3>
			<div class="teaser-text">                      
                Indigo Carbon supports farmers in their transition to more beneficial practices, delivering technological solutions and sponsor investments to accelerate soil enrichment.                            
            </div>
            <a href="#"><button class="text-button">For Farmers</button></a>
		</div>
	</div>
</div> -->

<!-- <div class="row mar-tp-100">
	<div class="col-md-6">
		<div class="short-text">
			<h3>Biologicals: plant for performance and grow with confidence</h3>
			<div class="teaser-text">                      
                By helping to shield plants from tough conditions and enhancing their use of resources such as water, Indigo Biologicals have the potential to improve yields and increase farm revenue.                            
            </div>
            <a href="#"><button class="text-button">EXPLORE BIOLOGICALS</button></a>
		</div>
	</div>
	<div class="col-md-6 slideanim">
		<img src="homepage/img/carbon.jpeg">
	</div>
</div> -->

<div class="row mar-tp-100">
	<div class="col-md-6 slideanim">
		<img src="homepage/img/banne3.png">
	</div>
	<div class="col-md-6">
		<div class="short-text">
			<h3>Global Marketplace</h3>
			<div class="teaser-text">                      
                Handles all sales and trading activities on the primary and secondary markets (rates, credit, foreign exchange, fixed-income, securitisation and treasury) for products designed for corporates, financial institutions and large issuers.                           
            </div>
            <a href="<?php echo($actual_link.'marketplace/');?>"><button class="text-button">EXPLORE MARKETPLACE</button></a>
		</div>
	</div>
</div>

<div class="row mar-tp-100">
	<div class="col-md-6">
		<div class="short-text">
			<h3>Life Cycle Logistics</h3>
			<div class="teaser-text">                      
                Life Cycle Logistics  is  the planning, development, implementation, and management of a comprehensive, affordable, and effective systems support strategy that encompasses the entire system’s life cycle: acquisition ,, sustainment , and disposal.                            
            </div>
            <a href="#"><button class="text-button">EXPLORE LOGISTICS</button></a>
		</div>
	</div>
	<div class="col-md-6 slideanim">
		<img src="homepage/img/transport.jpg">
	</div>
</div>