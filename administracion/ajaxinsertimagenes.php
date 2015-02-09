<?php
require '../require/comun.php';
$subir = new Subir("archivo");
$nombres = $subir->subir();
$id = Leer::get("id");
echo $id;
$bd = new BaseDatos();
foreach ($nombres as $key => $urlfoto) {
    $modeloFoto = new ModeloFotos($bd);
    $foto = new Fotos(null, $id, $urlfoto);
    $modeloFoto->add($foto);
}
$bd->closeConexion();