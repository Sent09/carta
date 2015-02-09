<?php
header('Content-Type: application/json');
require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$plato = $modelo->get($id);
echo '{"nombre":"'.$plato->getNombre().'", "descripcion": "'.$plato->getDescripcion().'", "precio": "'.$plato->getPrecio().'", "ingredientes": "'.$plato->getIngredientes().'"}';