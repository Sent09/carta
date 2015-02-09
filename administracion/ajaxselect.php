<?php
header('Content-Type: application/json');
require '../require/comun.php';
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$enlaces = Paginacion::getEnlacesPaginacionJSON($pagina,$modelo->count(),  Configuracion::RPP);
echo "{";
echo '"paginas":'.json_encode($enlaces);
echo ",\n";
echo '"platos":'.$modelo->getListJSON($pagina, Configuracion::RPP);
echo '}';
$bd->closeConexion();