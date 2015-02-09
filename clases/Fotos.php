<?php

class Fotos {
    private $id, $idplato, $urlfoto;
    function __construct($id=null, $idplato=null, $urlfoto=null) {
        $this->id = $id;
        $this->idplato = $idplato;
        $this->urlfoto = $urlfoto;
    }
    function set($datos, $inicio=0){
        $this->id = $datos[0+$inicio];
        $this->idplato = $datos[1+$inicio];
        $this->urlfoto = $datos[2+$inicio];
    }
    function getId() {
        return $this->id;
    }

    function getIdplato() {
        return $this->idplato;
    }

    function getUrlfoto() {
        return $this->urlfoto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdplato($idplato) {
        $this->idplato = $idplato;
    }

    function setUrlfoto($urlfoto) {
        $this->urlfoto = $urlfoto;
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
