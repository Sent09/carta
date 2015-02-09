<?php
header('Content-Type: application/json');
require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloFotos($bd);
echo "{";
echo '"fotos":'.$modelo->getListJSON($id);
echo '}';