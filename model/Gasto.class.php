<?php 
class Gasto{
    private $id;
    private $usuario;
    private $saude;
    private $lazer;
    private $mes;

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

    public function getSaude(){
        return $this->saude;
    }
    public function setSaude($saude_){
        $this->saude = $saude_;
    }

    public function getLazer(){
        return $this->lazer;
    }
    public function setLazer($lazer_){
        $this->lazer = $lazer_;
    }

    public function getMes(){
        return $this->mes;
    }
    public function setMes($mes_){
        $this->mes=$mes_;
    }
}
?>