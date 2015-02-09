<!DOCTYPE HTML>
<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $modeloPlato = new ModeloPlato($bd);
    $p = Leer::get("p");
    $platos=$modeloPlato->getList($p, 9);
    $numeroRegistros = $modeloPlato->count();
    $modeloFotos = new ModeloFotos($bd);
    $lista = Util::getEnlacesPaginacion($p, 9, $numeroRegistros);
?>
<html>
  <head>
	  <title>Multicusine  Website Template | Gallery :: W3layouts</title>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	  <link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
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
					<h3>Menu</h3>
                                        <?php 
                                            foreach ($platos as $key => $value) {
                                                $array['idplato']=$value->getIdplato();
                                                $cantidad = $modeloFotos->count("idplato = :idplato", $array );
                                        ?>
                                            <div class="gallery-grid">
                                                <?php if($cantidad>0){
                                                    $foto = $modeloFotos->getList($value->getIdplato());
                                                ?>
                                                <a href="#"><img width="300" height="200" src="../img/<?php echo $foto[0]->getUrlfoto(); ?>" alt=""><span><?php echo $value->getPrecio(); ?></span></a>
                                                <?php                                                 
                                                }else{                                                     
                                                ?>
                                                <a href="#"><img width="300" height="200" src="../img/no-pick.png" alt=""><span><?php echo $value->getPrecio(); ?></span></a>
                                                <?php } ?>
                                                <h4><?php echo $value->getNombre(); ?></h4>
                                                <div class="gallery-button"><a href="verplato.php?p=<?php echo $value->getIdplato(); ?>">Leer mas</a></div>
                                            </div>
                                        
                                        <?php } ?>
										
				    <div class="clear"> </div>
				    <div class="projects-bottom-paination">
						<ul>
                                                    <?php 
                                                        echo $lista["inicio"];
                                                        echo $lista["anterior"];
                                                        echo $lista["primero"];
                                                        echo $lista["segundo"]; 
                                                        echo $lista["actual"]; 
                                                        echo $lista["cuarto"];
                                                        echo $lista["quinto"]; 
                                                        echo $lista["siguiente"];
                                                        echo $lista["ultimo"];
                                                        $bd->closeConexion();
                                                    ?>  
						</ul>
					</div>
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

