<!DOCTYPE HTML>
<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $modeloPlato = new ModeloPlato($bd);
    $p = Leer::get("p");
    $plato = $modeloPlato->get($p);
    $modeloFotos = new ModeloFotos($bd);
    $fotos = $modeloFotos->getList($plato->getIdplato());
    $array['idplato']=$plato->getIdplato();
    $cantidad = $modeloFotos->count("idplato = :idplato", $array );
?>
<html>
  <head>
        <title>Multicusine  Website Template | Gallery :: W3layouts</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
        <script src="js/jquery.min.js"></script>
        <script src="js/lightbox.js"></script>
        <link href="css/lightbox.css" rel="stylesheet" type="text/css"  media="all" />
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
 </head>
	<body>
	 <div class="header">
	     <div class="wrap">
			<div class="top-header">
				<div class="logo">
					<a href="index.html"><img src="images/logo.png" title="logo" /></a>
				</div>
				<div class="social-icons">
					<ul>
						<li><a href="#"><img src="images/facebook.png" title="facebook" /></a></li>
						<li><a href="#"><img src="images/twitter.png" title="twitter" /></a></li>
						<li><a href="#"><img src="images/google.png" title="google pluse" /></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
			<!---start-top-nav---->
			<div class="top-nav">
				<div class="top-nav-left">
					<ul>
						<li><a href="../index.html">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="services.html">Services</a></li>
						<li  class="active"><a href="gallery.php">Menu</a></li>
						<li><a href="contact.html">Contact</a></li>
						<div class="clear"> </div>
					</ul>
				</div>
				<div class="top-nav-right">
					<form>
						<input type="text"><input type="submit" value="" />
					</form>
				</div>
				<div class="clear"> </div>
			</div>
			<!---End-top-nav---->
		</div>
	</div>
   <!----End-header----->
		 <!---start-content---->
		 <div class="content">
		 	<!---start-gallery----->
                    <div class="gallerys">
                            <div class="wrap">
                                <h3><?php echo $plato->getNombre(); ?></h3>
                                <h4>Descripcion: </h4>
                                <?php echo $plato->getDescripcion(); ?>
                                <br><br>
                                <h4>Ingredientes: </h4>
                                <?php echo $plato->getIngredientes(); ?>
                                <br><br>
                                <h4>Precio: </h4>
                                <?php echo $plato->getPrecio(); ?>
                                <br><br>
                                <?php 
                                if($cantidad>0){
                                    foreach ($fotos as $key => $value) {
                                ?>
                                <a href="../img/<?php echo $value->getUrlfoto() ?>" data-lightbox="image-1"><img width="200" src="../img/<?php echo $value->getUrlfoto() ?>" /></a>
                                <?php
                                    }
                                }else{
                                ?>
                                <?php } ?>
                            </div>
                        </div>
		 	<!---End-gallery----->
		 <!---End-content---->
		 <!---start-footer---->
		 <div class="footer">
		<div class="wrap">
			<div class="footer-grid">
				<h3>About us</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a href="#">ReadMore</a>
			</div>
			<div class="footer-grid center-grid">
				<h3>Recent posts</h3>
				<ul>
					<li><a href="#">eiusmod tempor incididunt</a></li>
					<li><a href="#">adipisicing elit, sed</a></li>
					<li><a href="#">mod tempor incididunt ut</a></li>
					<li><a href="#">dipisicing elit, sed do</a></li>
					<li><a href="#">econsectetur adipisicing</a></li>
				</ul>
			</div>
			<div class="footer-grid twitts">
				<h3>Latest Tweets</h3>
				<p><label>@Lorem ipsum</label>dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<span>10 minutes ago</span>
				<p><label>@consectetur</label>dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<span>15 minutes ago</span>
			</div>
			<div class="footer-grid">
				<h3>DID YOU KNOW?</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a href="#">ReadMore</a>
			</div>
			<div class="clear"> </div>
		</div>
		<div class="clear"> </div>
	</div>
	<div class="copy-right">
		<div class="top-to-page">
						<a href="#top" class="scroll"> </a>
						<div class="clear"> </div>
					</div>
		<p>Design by <a href="http://w3layouts.com/"> W3layouts</a></p>
	</div>
		 <!---End-footer---->
	</body>
</html>

