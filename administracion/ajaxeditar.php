<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$id = Leer::get("id");
$nombre = Leer::get("nombre");
$descripcion = Leer::get("descripcion");
$precio = Leer::get("precio");
$ingredientes = Leer::get("ingredientes");
$plato = $modelo->get($id);
$plato->setNombre($nombre);
$plato->setDescripcion($descripcion);
$plato->setPrecio($precio);
$plato->setIngredientes($ingredientes);
$r = $modelo->edit($plato, $id);
echo '{"result":'.$r.'}';
$bd->closeConexion();