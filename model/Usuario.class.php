<?php 
class Usuario{
    private $d;
    private $nome;
    private $sobrenome;
    private $apelido;
    private $senha;

    public function getId(){
        return $this->id;
    }
    public function setId($id_){
        $this->id = $id_;
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome_){
        $this->nome = $nome_;
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }
    public function setSobrenome($sobrenome_){
        $this->sobrenome = $sobrenome_;
    }

    public function getApelido(){
        return $this->apelido;
    }
    public function setApelido($apelido_){
        $this->apelido = $apelido_;
    }

    public function getSenha(){
        return $this->senha;
    }
    public function setSenha(senha_){
        $this->senha = $senha_;
    }
}
?>