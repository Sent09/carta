<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$idfoto = Leer::post("fotos");
$modelofotos = new ModeloFotos($bd);

foreach($idfoto as $key => $value) {
    $foto = $modelofotos->get($value);
    $ruta = "../img/".$foto->getUrlfoto();
    unlink($ruta);
    $modelofotos->deleteForId($value);
}
echo '{"result":"ok"}';
$bd->closeConexion();