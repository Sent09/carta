<?php
    require '../require/comun.php';
    /*
     * Comprueba que el usuario sea administrador
     */
    $baseDatos = new BaseDatos();
    $modeloUsuario =  new ModeloUsuario($baseDatos);
    $sesion->administrador("../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - Bootstrap Admin Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="../css/font-awesome.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/pages/dashboard.css" rel="stylesheet">
<link href="../js/toast/toastr.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="admin.php">Restaurante </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> Cuenta <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="phpcerrarsesion.php">Desconectar</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="admin.php"><i class="icon-list-alt"></i><span>La carta</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<div class="main">	
    <div class="main-inner">
        <div class="container">	
          <div class="row">	      	
            <div class="span12">                          		
                    <div class="widget ">	      			
                        <div class="widget-header">
                            <i class="icon-list"></i>
                            <h3>Ver platos</h3>
                        </div> <!-- /widget-header -->					
                        <div class="widget-content"><!-- contenido de la web -->
                            <?php include ("modal/modal.php"); ?>
                            <input type="button" id="botoninsertar" value="Insertar plato nuevo" class="btn btn-success"><br><br>
                            <div id="divajax">
                                
                            </div>
                            <div class="row">	      	
                                <div class="span11">                          		
                                        <div class="widget ">	      			
                                            <div class="widget-header">
                                                <i class="icon-search"></i>
                                                <h3>Ver datos del plato</h3>
                                            </div> <!-- /widget-header -->					
                                            <div class="widget-content" id="divver"><!-- contenido de la web -->

                                            </div> <!-- /widget-content -->						
                                        </div> <!-- /widget -->	      		
                                    </div> <!-- /span8 -->
                            </div> <!-- /row -->	
                        </div> <!-- /widget-content -->						
                    </div> <!-- /widget -->	      		
                </div> <!-- /span8 -->
          </div> <!-- /row -->	
        </div> <!-- /container -->	    
    </div> <!-- /main-inner -->    
</div>
<div class="extra">
  <div class="extra-inner">
    <div class="container">
    </div>
    <!-- /container --> 
  </div>
  <!-- /extra-inner --> 
</div>
<!-- /extra -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin Template</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/toast/toastr.js"></script>
<script src="../js/excanvas.min.js"></script> 
<script src="../js/chart.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="../js/full-calendar/fullcalendar.min.js"></script> 
<script src="../js/base.js"></script>
<script src="script/codigo.js"></script>
</body>
</html>
