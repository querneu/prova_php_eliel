<?php 
class Despesa{
    private $id;
    private $usuario;
    private $contas;
    private $alimentacao;
    private $combustivel;
    private $data;

    public function getId(){
        return $this->id;
    }
    public function setId($id_){
        $this->id=$id_;
    }

    public function getUsuario(){
        return $this->id;
    }
    public function setUsuario($usuario_){
        $this->usuario = $usuario_;
    }

    public function getContas(){
        return $this->contas;
    }
    public function setContas($contas_){
        $this->contas = $contas_;
    }

    public function getAlimentacao(){
        return $this->alimentacao;
    }
    public function setAlimentacao($alimentacao_){
        $this->alimentacao=$alimentacao_;
    }

    public function getCombustivel(){
        return $this->combustivel;
    }
    public function setCombustivel($combustivel_){
        $this->combustivel = $combustivel_;
    }

    public function getData(){
        return $this->data;
    }
    public function setData($data_){
        $this->data=$data_;
    }
}
?>