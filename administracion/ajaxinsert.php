<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$plato = new Plato();
$plato->setNombre(Leer::get("nombre"));
$plato->setDescripcion(Leer::get("descripcion"));
$plato->setPrecio(Leer::get("precio"));
$plato->setIngredientes(Leer::get("ingredientes"));
$r = $modelo->add($plato);
echo '{"result":'.$r.', "id":'.$bd->getAutonumerico().'}';
$bd->closeConexion();