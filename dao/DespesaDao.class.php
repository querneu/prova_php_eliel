<?php 
require_once('../model/Despesa.class.php');

class DespesaDao{
    //função de inserção
    public function Inserir(Despesa $despesa){
        try{
            $sql = "INSERT INTO prova.despesas (id_despesa,usuario,contas,alimentacao,combustivel, mes) VALUES (:id,:usuario,:contas,:alimentacao,:combustivel,:mes)";
            $conexao = new PDO('mysql:host=localhost;','root','');
           
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(":id",$despesa->getId());
            $resultado->bindValue(":usuario",$despesa->getUsuario());
            $resultado->bindValue(":contas",$despesa->getContas());
            $resultado->bindValue(":alimentacao",$despesa->getAlimentacao());
            $resultado->bindValue(":combustivel",$despesa->getCombustivel());
            $resultado->bindValue(":mes",$despesa->getMes());
            $resultado->execute();
            $conexao = null;
            return $resultado;
        }catch(Exception $e){
            print($e->getMessage());
        }
    }   
    public function Buscar($filtro){
        $sql = "SELECT * FROM prova.despesas WHERE usuario = :id_usuario ORDER BY id_despesa";
        $conexao = new PDO('mysql:host=localhost;','root','');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $resultado = $conexao->prepare($sql);
        $resultado->bindValue(":id_usuario",$filtro);
        $resultado->execute();
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        $lista_lateral = (array) new ArrayObject();
        foreach($lista as $linha){
            $lista_lateral[]=$this->populaDespesa($linha);
        }
        return $lista_lateral;
    }
    public function populaDespesa($linha){
        $despesa = new Despesa;
        $despesa->setId($linha['id_despesa']);
        $despesa->setUsuario($linha['usuario']);
        $despesa->setContas($linha['contas']);
        $despesa->setAlimentacao($linha['alimentacao']);
        $despesa->setCombustivel($linha['combustivel']);
        $despesa->setMes($linha['mes']);
        return (object) $despesa;
    }

    public function Alterar(Despesa $despesa){
        try{
            $sql = "UPDATE prova.despesas  SET usuario = :usuario, contas = :contas, alimentacao = :alimentacao, combustivel = :combustivel, mes=:mes where id_despesa = :id";
            $conexao = new PDO('mysql:host=localhost;','root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(":usuario",$despesa->getUsuario());
            $resultado->bindValue(":contas",$despesa->getContas());
            $resultado->bindValue(":alimentacao",$despesa->getAlimentacao());
            $resultado->bindValue(":combustivel",$despesa->getCombustivel());
            $resultado->bindValue(":mes",$despesa->getMes());
            $resultado->bindValue(":id",$despesa->getId());
            $resultado->execute();
            $conexao=null;
            if($resultado == TRUE){
                return $resultado;
            }else{
                return "Erro";
            }
        }catch(Exception $e){
            print("Erro codigo:".$e->getMessage());
        }
    }
    public function Deletar($id){
        try{
            $sql = "DELETE FROM prova.despesas WHERE id_despesa = :id";
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