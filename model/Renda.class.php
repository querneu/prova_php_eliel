<?php 
class Renda{
    private $id;
    private $usuario;
    private $trabalho;
    private $rendimento;
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
    
    public function getTrabalho(){
        return $this->trabalho;
    }
    public function setTrabalho($trabalho_){
        $this->trabalho = $trabalho_;
    }

    public function getRendimento(){
        return $this->rendimento;
    }
    public function setRendimento($rendimento_){
        $this->rendimento = $rendimento_;
    }

    public function getData(){
        return $this->data;
    }
    public function setData($data_){
        $this->data=$data_;
    }
}
?>