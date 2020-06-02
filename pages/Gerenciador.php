<?php
session_start();
require_once('../model/Despesa.class.php');
require_once('../dao/DespesaDao.class.php');
$dDao= new DespesaDao;
$despesa = new Despesa;

if($_SESSION['usuarioLogado']){
    
    

    $usuario = $_SESSION['usuarioLogado'];
    if(isset($_POST['contas']) && isset($_POST['alimentacao']) &&  isset($_POST['combustivel']) && isset($_POST['mes'])){
        $contas = $_POST['contas'];
        $alimentacao = $_POST['alimentacao'];
        $combustivel = $_POST['combustivel'];//
        $id_usuario = $usuario['id_usuario'];
        $mes = $_POST['mes'];
        $token = md5(uniqid(rand(), true));
        $despesa->setId($token);
        $despesa->setContas($contas);
        $despesa->setUsuario($id_usuario);
        $despesa->setAlimentacao($alimentacao);
        $despesa->setCombustivel($combustivel);
        $despesa->setMes($mes);
       
        
    }
    }else{
    header("Location: ../");
}

if(isset($_POST['action'])){
    if(isset($_POST['contas']) && isset($_POST['alimentacao']) &&  isset($_POST['combustivel']) && isset($_POST['mes'])){
    $valor = $_POST['action'];
    switch($valor){
        case "cadastrar":
            try{
                $dDao->Inserir($despesa);
                if($dDao){
                    echo "<script>alert('Inserido com sucesso');</script>"; 
                }
            }catch(Exception $e){
                print($e->getMessage());
            }
        break;
        case "deletar":
            try{
                $dDao->Deletar($_POST['id_conta_edit']);
                if($dDao){
                    echo "<script>alert('Inserido com sucesso');</script>"; 
                }
            }catch(Exception $e){
                print($e->getMessage());
            }
        break;
        case "alterar":
            try{
                $despesa->setId($_POST['id_conta_edit']);
                $dDao->Alterar($despesa);
            }catch(Exception $e){
                print($e->getMessage());
            }
        break;
    }
}}
?>
<?php 
    if(isset($_GET['logout'])){
        session_destroy(); 
        header("Location: ../");
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <!--<meta http-equiv="refresh" content="60">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    html, body {
            height: 100%;
            margin: 0;
            background: #8b8b8b;
        }

    </style>
</head>
<body>  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white  ">
        <a class="navbar-brand" href="#">Olá,   
            <?php 
                print($usuario['apelido']);
            ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inserir
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropDown">
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalDeContaCadastro">Despesas</a>
                        <a class="dropdown-item" href="">Gastos</a>
                        <a class="dropdown-item" href="">Rendas</a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">   
                <li>
                    <a class="nav-link" href="?logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></a>
                </li>
            </ul>
        </div>
    </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php 
                        $array_despesas = $dDao->Buscar($usuario['id_usuario']);
                    ?>
                    <form action="" method="post">
                    <table class="table table-hover table-dark" id="contas">
                    <thead>
                        <th>
                            ID
                        </th>
                        <th>
                            Contas
                        </th>
                        <th>
                            Alimentação
                        </th>
                        <th>
                            Combustível
                        </th>
                        <th>
                            Mês
                        </th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($array_despesas as $despesa_linha){
                                echo "<tr class='valores'>";
                                    echo "<td  class='idConta' id='idConta'>";
                                        print( $despesa_linha->getId());
                                    echo "</td>";
                                    echo "<td id='Conta'>";
                                        print($despesa_linha->getContas());
                                    echo "</td>";
                                    echo "<td id='Alimentacao'>";
                                        print($despesa_linha->getAlimentacao());
                                    echo "</td>";
                                    echo "<td id='Combustivel'>";
                                        print($despesa_linha->getCombustivel());
                                    echo "</td id='mes'>";
                                    echo "<td>";
                                        print($despesa_linha->getMes());
                                    echo "</td>";
                                    echo "<tr>";
                            }
                        ?>
                    </tbody>
                    </table>
                    </form>
                </div>
            </div>
    </div>
  
    </body>



    <!-- Modal de Contas -->
    <div class="modal fade" id="ModalDeContaCadastro" tabindex="-1" role="dialog" aria-labelledby="ModalDeContaCadastroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-white bg-dark">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalDeContaCadastroLabel">Inserir Despesas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Usuario</span>
                    </div>
                    <input type="text" class="form-control" name="id_usuario" id="usuario" aria-describedby="" value="<?php print($usuario['id_usuario']);?>" disabled>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gasto em Contas</span>
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" class="form-control" name="contas" id="contas" aria-describedby="" placeholder="Digite o total gasto em Contas no mês" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gasto em Alimentação</span>
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" class="form-control" name="alimentacao" id="alimentacao" aria-describedby="" placeholder="Digite o total gasto em Alimentação no mês" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gasto em Combustível</span>
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" class="form-control" name="combustivel" id="combustivel" aria-describedby="" placeholder="Digite o total gasto em Combustível no mês" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="date" class="form-control" name="mes" id="mes" aria-describedby="">
                </div>
                <div class="text-center">
                    <input type="submit" name="action" class="btn btn-primary" value="cadastrar">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
    </div>


    <!-- Modal de Alteração Contas -->
    <div class="modal fade" id="AlterarConta" tabindex="-1" role="dialog" aria-labelledby="AlterarContaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-white bg-dark">
        <div class="modal-header">
            <h5 class="modal-title" id="AlterarContaLabel">Alterar Despesa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form  method="post">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">ID</span>
                    </div>
                    <input type="text" class="form-control" name="id_conta_edit" id="idContaUp" aria-describedby="" readonly>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Usuario</span>
                    </div>
                    <input type="text" class="form-control" name="id_usuario" id="usuario" aria-describedby="" value="<?php print($usuario['id_usuario']);?>" disabled>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gasto em Contas</span>
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" class="form-control" name="contas" id="contas" aria-describedby="" placeholder="Digite o total gasto em Contas no mês" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gasto em Alimentação</span>
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" class="form-control" name="alimentacao" id="alimentacao" aria-describedby="" placeholder="Digite o total gasto em Alimentação no mês" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gasto em Combustível</span>
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" class="form-control" name="combustivel" id="combustivel" aria-describedby="" placeholder="Digite o total gasto em Combustível no mês" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="date" class="form-control" name="mes" id="mes" aria-describedby="">
                </div>
                <div class="text-center">
                    <input type='submit' name='action' value='deletar' class='btn btn-warning'>
                    <input type="submit" name="action" value='alterar' name="del"class="btn btn-primary">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
    </div>


    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="app.js"></script>
</html>