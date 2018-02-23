<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="INNOVALED Perú ofrece soluciones en los siguientes productos y sectores : iluminacion led, digital signage, pantallas led, reflectores led, luminarias led, paneles led, tubos led, luces de emergencia led, paneles solares, cintas led y modulos led">
	<meta name="keywords" content="5 años de experiencia brindando soluciones en tecnologia LED,2 años realizando proyectos de pantallas led y  digital signage,luminarias led,reflectores led,cintas led,modulos led,tubos led,bombillas led,luces de emergencia led,paneles led,dicroicos led,transformadores led,energia solar,paneles fotovoltaicos,baterias solares,inversores solares,conversores solares,pantallas led,videowalls">
	<META NAME="revisit-after" content="30 days">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/web/hamburgers.min.css">
	<?php if(isset($css)) echo $css; ?>

	<link rel="stylesheet" href="assets/css/site/font.css">
	<link rel="stylesheet" href="assets/css/site/template.css">
	<link rel="stylesheet" href="assets/css/site/dev.css">
	<link href='assets/img/web/icon.png' rel='shortcut icon' type='image/png'>
	<title><?php if(isset($title)) echo $title; ?></title>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-93916245-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-93916245-1');
</script>

</head>
<body>

<div class="loaderPage" class="">
	<div class="cSVG">
		<img src="assets/img/web/loader.svg" alt="">
	</div>
</div>

<a href="" class="cart">
	<i class="fa fa-shopping-cart" aria-hidden="true"></i>
	<span class="noItems"><?=$noItemsOnCart;?></span>
</a>

<div id="Menu">
	<div>
		<div class="col-xs-12 text-center containerLogo">
			<div class="col-xs-3 text-center nopadding">
				<button class="hamburger hamburger--slider is-active" type="button">
				  	<span class="hamburger-box">
				  	  	<span class="hamburger-inner"></span>
				  	</span>
				</button>
			</div>
			<div class="col-xs-9 text-center logoContent">
				<img src="assets/img/logo_grey.png" alt="" class="col-xs-12 centered logo">
			</div>
		</div>
		<div class="col-xs-12 containerOptions">
			<ul>
				<li><a href="Productos" class="<?php if(isset($onProductos)) echo $onProductos; ?>" to="productos">PRODUCTOS</a></li>
				<li><a href="Home#Nosotros" toId="Nosotros" class="<?php if(isset($onHomeSect)) echo $onHomeSect; ?> 1 <?php if(isset($onHome)) echo $onHome; ?>" to="1">NOSOTROS</a></li>
				<li><a href="Home#NuestrosClientes" class="<?php if(isset($onHomeSect)) echo $onHomeSect; ?> 2" to="2">NUESTROS CLIENTES</a></li>
				<li><a href="Home#Servicios" class="<?php if(isset($onHomeSect)) echo $onHomeSect; ?> 3" to="3">SERVICIOS</a></li>
				<li><a href="Home#Proyectos" class="<?php if(isset($onHomeSect)) echo $onHomeSect; ?> 4" to="4">PROYECTOS</a></li>
				<li><a href="Home#Contactanos" class="<?php if(isset($onHomeSect)) echo $onHomeSect; ?> 5" to="5">CONTACTENOS</a></li>
			</ul>
		</div>
		<div class="col-xs-12 containerContact">
			<div class="col-xs-7">
				<a href="#">ventas@innovaled.pe</a>
			</div>
			<div class="col-xs-5">
				<a href="#">01 393 4964</a>
			</div>
		</div>
		<a href="Admin" class="col-xs-12 text-center containerSession">
			<i class="fa fa-user-circle" aria-hidden="true"></i>
			<span>INICIAR SESIÓN</span>
		</a>
	</div>
</div>

<div class="wrapper">
	<div class="main">
