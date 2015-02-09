<?php

class Plato {
    private $idplato, $nombre, $descripcion, $precio, $ingredientes;
    function __construct($idplato=null,$nombre=null, $descripcion=null, $precio=null, $ingredientes=null) {
        $this->idplato = $idplato;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->ingredientes = $ingredientes;
    }
    
    function set($datos, $inicio=0){
        $this->idplato = $datos[0+$inicio];
        $this->nombre = $datos[1+$inicio];
        $this->descripcion = $datos[2+$inicio];
        $this->precio = $datos[3+$inicio];
        $this->ingredientes = $datos[4+$inicio];
    }
    function getIdplato(){
        return $this->idplato;
    }
    
    function getNombre() {
        return $this->nombre;
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getIngredientes() {
        return $this->ingredientes;
    }
    function setIdplato($idplato){
        $this->idplato = $idplato;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setIngredientes($ingredientes) {
        $this->ingredientes = $ingredientes;
    }
    
    public function getJSON(){
        $prop = get_object_vars($this);//todas las variables de instancia de esta clase
        $resp = '{';
        foreach ($prop as $key => $value){
            $resp.='"' . $key . '":'.json_encode(htmlspecialchars_decode($value)).',';
        }
        $resp = substr($resp, 0, -1)."}";
        return $resp;
    }

}

?>
