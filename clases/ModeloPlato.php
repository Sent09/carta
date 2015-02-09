<?php

class ModeloPlato{
    private $bd =null;
    private $tabla = "platos";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Plato $plato){
        $consultaSql = "insert into $this->tabla values(null, :nombre, :descripcion, :precio, :ingredientes);";
        $parametros["nombre"] = $plato->getNombre();
        $parametros["descripcion"] = $plato->getDescripcion();
        $parametros["precio"] = $plato->getPrecio();
        $parametros["ingredientes"] = $plato->getIngredientes();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Plato $plato){
        $consultaSql = "delete from $this->tabla where idplato=:idplato";
        $arrayConsulta["idplato"] = $plato->getIdplato();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForIdplato($idplato){
        return $this->delete(new Plato($idplato));
    }
    function edit(Plato $plato, $idplato){        
        $consultaSql = "update $this->tabla set nombre=:nombre, descripcion=:descripcion,
            precio=:precio, ingredientes=:ingredientes where idplato=:idplato;";
        $parametros["nombre"] = $plato->getNombre();
        $parametros["descripcion"] =$plato->getDescripcion();
        $parametros["precio"] = $plato->getPrecio();
        $parametros["ingredientes"] = $plato->getIngredientes();
        $parametros["idplato"] = $idplato;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function get($idplato){
        $consultaSql = "select * from $this->tabla where idplato=:idplato";
        $arrayConsulta["idplato"] = $idplato;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $plato = new Plato();
            $plato->set($this->bd->getFila());
            return $plato;
        }else{
            return null;
        }
    }    
    function count($condicion="1=1", $parametros=array()){
        $sql = "select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            $resultado = $this->bd->getFila();
            return $resultado[0];
        }
        return -1;
    }
    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderby = "1"){
        $pos = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while($datos = $this->bd->getFila()){
            $plato = new Plato();
            $plato->set($datos);
            $r .= $plato->getJSON() . ",";
        }
        $r = substr($r, 0, -1)."]";
        return $r;
    }
    
    function getList($pagina=0, $rpp=10,$condicion="1=1",$parametros=array(), $orderby = "1"){
        $list = array();
        $principio = $pagina*$rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if($r){
            while($datos = $this->bd->getFila()){
                $plato = new Plato();
                $plato->set($datos);
                $list[] = $plato;
            }
        }else{
            return null;
        }
        return $list;
    }    
}