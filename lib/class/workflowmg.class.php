<?php
require_once PATH_CLASS.DS.'conexion.php';
class Workflowmg {
//Workflow_migracion
    var $id;
    var $causal;
    var $id_user;
    var $id_imagen;
    var $documento;
    var $id_client;
    var $lote;
    var $estado;
    var $fecha_creacion;

    public function getId(){
        return $this->id;
    }
    public function getCausal(){
        return $this->causal;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function getId_imagen(){
        return $this->id_imagen;
    }
    public function getDocumento(){
        return $this->documento;
    }
    public function getId_client(){
        return $this->id_client;
    }
    public function getLote(){
        return $this->lote;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getFecha_creacion(){
        return $this->fecha_creacion;
    }
    //MODIFICADORES
    public function setId($id){
        $this->id = trim($id);
    }
    public function setCausal($causal){
        $this->causal = trim($causal);
    }
    public function setId_user($id_user){
        $this->id_user = trim($id_user);
    }
    public function setId_imagen($id_imagen){
        $this->id_imagen = trim($id_imagen);
    }
    public function setDocumento($documento){
        $this->documento = trim($documento);
    }
    public function setId_client($id_client){
        $this->id_client = trim($id_client);
    }
    public function setLote($lote){
        $this->lote = trim($lote);
    }
    public function setEstado($estado){
        $this->estado = trim($estado);
    }
    public function setFecha_creacion($fecha_creacion){
        $this->fecha_creacion = trim($fecha_creacion);
    }

    public function setAtributos($atributos){
        if(is_array($atributos)){
            $this->setId((isset($atributos["id"]) ? $atributos["id"] : "NULL"));
            $this->setCausal((isset($atributos["causal"]) ? $atributos["causal"] : "NULL"));
            $this->setId_user((isset($atributos["id_user"]) ? $atributos["id_user"] : "NULL"));
            $this->setId_imagen((isset($atributos["id_imagen"]) ? $atributos["id_imagen"] : "NULL"));
            $this->setDocumento((isset($atributos["documento"]) ? $atributos["documento"] : "NULL"));
            $this->setId_client((isset($atributos["id_client"]) ? $atributos["id_client"] : "NULL"));
            $this->setLote((isset($atributos["lote"]) ? $atributos["lote"] : "NULL"));
            $this->setEstado((isset($atributos["estado"]) ? $atributos["estado"] : "NULL"));
            $this->setFecha_creacion((isset($atributos["fecha_creacion"]) ? $atributos["fecha_creacion"] : "NULL"));            
        }
    }
    public function registrar(){
        $conexion = new Conexion();
        $SQL = "INSERT INTO workflow_migracion 
                (
                    causal, id_user, id_imagen, documento, id_client, lote
                )
                VALUES
                (
                    '".$this->getCausal()."', ".$this->getId_user().", ".$this->getId_imagen().", 
                    '".$this->getDocumento()."', ".$this->getId_client().", '".$this->getLote()."')";
        //echo $SQL;
        //exit();
        if($conexion->ejecutar($SQL)){
            $this->setId($conexion->ultimaId());
            $conexion->desconectar();
            return true;
        }else{
            $conexion->desconectar();
            return false;
        }
    }
    public function desactivarClientMG(){
        $conexion = new Conexion();
        $SQL = "UPDATE clientes_migracion SET estado = 3 WHERE id =".$this->getId_client();
        if($conexion->ejecutar($SQL)){
            $conexion->desconectar();
            return true;
        }else{
            $conexion->desconectar();
            return false;
        }
    }
    public function activarClientMG(){
        $conexion = new Conexion();
        $SQL = "UPDATE clientes_migracion SET estado = 0 WHERE id =".$this->getId_client();
        if($conexion->ejecutar($SQL)){
            $conexion->desconectar();
            return true;
        }else{
            $conexion->desconectar();
            return false;
        }
    }
    public function desactivarImageMG(){
        $conexion = new Conexion();
        $SQL = "UPDATE migra_images SET status = 3 WHERE id_client = ".$this->getId_client();
        if($conexion->ejecutar($SQL)){
            $conexion->desconectar();
            return true;
        }else{
            $conexion->desconectar();
            return false;
        }
    }
}
?>