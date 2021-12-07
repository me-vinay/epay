<?php
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light header-bar">
  <div class="container-fluid">
  	<div class ="col-md-5">
	    <div class="collapse navbar-collapse" id="navbarText">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo($actual_link.'sellers/supplier/account/login');?>">For Sellers</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo($actual_link.'buyers/');?>">For Buyers</a>
	        </li>
	        <!-- <li class="nav-item">
	          <a class="nav-link" href="#">Feature of Ag</a>
	        </li> -->
	         <li class="nav-item">
	          <a class="nav-link" href="#">Resources</a>
	        </li>
	      </ul>
	    </div>
	</div>
	<div class ="col-md-2 logo">
		<a href="<?php echo($actual_link);?>"><img src="homepage/img/ePayerz.png" width="150" height="auto"></a>
	</div>
	<div class ="col-md-5">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0 right-menu">
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo($actual_link.'marketplace/');?>">Marketplace</a>
	        </li>
	         <li class="nav-item">
	          <a class="nav-link" href="#">Logistic</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo($actual_link.'/main/about-us');?>">About</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#">Careers</a>
	        </li>
	      </ul>
	</div>
  </div>
</nav>
