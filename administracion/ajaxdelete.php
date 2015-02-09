<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$id=Leer::get("id");
$modelofotos = new ModeloFotos($bd);
$fotos = $modelofotos->getList($id);
foreach($fotos as $key => $value) {
    $ruta = "../img/".$value->getUrlfoto();
    unlink($ruta);
}
$modelofotos->deleteForIdPlato($id);
$r = $modelo->deleteForIdplato($id);
echo '{"result":'.$r.'}';
$bd->closeConexion();