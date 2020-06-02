<?php 
require_once('./model/Usuario.class.php');
class UsuarioDao{
    //Função de logar
    public function Logar($login, $senha){
        try{
            if((isset($login) && isset($senha)) && ($login<> ""&& $senha<> "")){
                $sql = "SELECT * FROM prova.usuarios WHERE apelido = :apelido AND senha = :senha";
            }
            else{
                throw new Exception("<p>Está faltando informações, verifique se seu 
                                        login e senha informados estão corretos e tente
                                        novamente</p>");
            }
            $conexao = new PDO('mysql:host=localhost;','root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(":apelido",$login);
            $resultado->bindValue(":senha", $senha);
            $resultado->execute();
            $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $conexao=null;
            $lista_lateral = (array) new ArrayObject();
            foreach($lista as $linha){
                $lista_lateral[]=$this->populaUsuarios($linha);
            }
            return $lista_lateral;
        }catch(Exception $e){
            print($e->getMessage());
        }
    }


    //função de inserção
    public function Inserir(Usuario $usuario){
        try{
            $sql = "INSERT INTO prova.usuarios (id,nome,sobrenome,apelido,senha) VALUES (:id,:nome,:sobrenome,:apelido,:senha)";
            $conexao = new PDO('mysql:host=localhost;','root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(":id",$usuario->getId());
            $resultado->bindValue(":nome",$usuario->getNome());
            $resultado->bindValue(":sobrenome",$usuario->getSobrenome());
            $resultado->bindValue(":apelido",$usuario->getApelido());
            $resultado->bindValue(":senha",$usuario->getSenha());
            $resultado->execute();
            $conexao = null;
            return $resultado;
        }catch(Exception $e){
            print($e->getMessage());
        }
    }
    public function Buscar($filtro){
        if(isset($filtro) && $filtro<> ""){
            $sql = "SELECT * FROM prova.usuarios WHERE nome LIKE :nome OR apelido LIKE :apelido ORDER BY id";
        }else{
            $sql = "SELECT * FROM prova.usuarios ORDER BY id";
        }
        $conexao = new PDO('mysql:host=localhost;','root','');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $resultado = $conexao->prepare($sql);
        $resultado->bindValue(":nome",$filtro);
        $resultado->bindValue(":apelido",$filtro);
        $resultado->execute();
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        $lista_lateral = (array) new ArrayObject();
        foreach($lista as $linha){
            $lista_lateral[]=$this->populaUsuarios($linha);
        }
        return $lista_lateral;
    }
    public function populaUsuarios($linha){
        $usuario = new Usuario;
        $usuario->setId($linha['id']);
        $usuario->setNome($linha['nome']);
        $usuario->setSobrenome($linha['sobrenome']);
        $usuario->setApelido($linha['apelido']);
        $usuario->setSenha($linha['senha']);
        return (object) $usuario;
    }

    public function Alterar(Usuario $usuario){
        try{
            $sql = "UPDATE FROM prova.usuarios SET nome = :nome, sobrenome = :sobrenome, usuario = :usuario, senha = :senha WHERE id = :id";
            $conexao = new PDO('mysql:host=localhost;','root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(":nome",$usuario->getNome());
            $resultado->bindValue(":sobrenome",$usuario->getSobrenome());
            $resultado->bindValue(":apelido",$usuario->getApelido());
            $resultado->bindValue(":senha",$usuario->getSenha());
            $resultado->bindValue(":id",$usuario->getId());
            $resultado->execute();
            $conexao=null;
            if($resultado == TRUE){
                return $resultado;
            }else{
                return "Erro";
            }
        }catch(Exception $e){
            print("Erro codigo:".$e->getCode());
        }
    }
    public function Deletar($id){
        try{
            $sql = "DELETE FROM prova.usuarios WHERE id = :id";
            $conexao = new PDO('mysql:host=localhost;','root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue("id", $id);
            $resultado->execute();
            $conexao= null;
            return $resultado;
        }catch(Exception $e){
            print($e->getMessage());
        }
    }
}
?>