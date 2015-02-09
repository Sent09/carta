<?php

class ModeloFotos {
    private $bd =null;
    private $tabla = "fotos";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    
    function add(Fotos $fotos){
        $consultaSql = "insert into $this->tabla values(null, :idplato, :urlfoto);";
        $parametros["idplato"] = $fotos->getIdplato();
        $parametros["urlfoto"] = $fotos->getUrlfoto();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Fotos $fotos){
        $consultaSql = "delete from $this->tabla where id=:id";
        $arrayConsulta["id"] = $fotos->getId();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForIdPlato($idplato){
        $consultaSql = "delete from $this->tabla where idplato=:idplato";
        $arrayConsulta["idplato"] = $idplato;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForId($id){
        return $this->delete(new Fotos($id));
    }
    function edit(Fotos $fotos, $idpk){        
        $consultaSql = "update $this->tabla set idplato=:idplato, urlfoto=:urlfoto,
            destacada=:destacada where id=:idpk;";
        $parametros["idplato"] = $fotos->getIdplato();
        $parametros["urlfoto"] = $fotos->getUrlfoto();
        $parametros["destacada"] = $fotos->getDestacada();
        $parametros["idpk"] = $idpk;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function get($id){
        $consultaSql = "select * from $this->tabla where id=:id";
        $arrayConsulta["id"] = $id;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $foto = new Fotos();
            $foto->set($this->bd->getFila());
            return $foto;
        }else{
            return null;
        }
    }

    
     function count($condicion="1=1", $parametros=array()){
        $sql = "select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            $cantidad = $this->bd->getFila();
            return $cantidad[0];
        }
        return -1;
    }
    
    function getList($idplato, $orderby = "1"){
        $list = array();
        $sql = "select * from $this->tabla where idplato=:idplato order by $orderby";
        $parametros["idplato"] = $idplato;
        $r = $this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila = $this->bd->getFila()){
                $foto = new Fotos();
                $foto->set($fila);
                $list[] = $foto;
            }
        }else{
            return null;
        }
        return $list;
    } 
    
    function getListJSON($idplato){
        $sql = "select * from $this->tabla where idplato=:idplato";
        $parametros["idplato"] = $idplato;
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while($datos = $this->bd->getFila()){
            $foto = new Fotos();
            $foto->set($datos);
            $r .= $foto->getJSON() . ",";
        }
        $r = substr($r, 0, -1)."]";
        return $r;
    }

}