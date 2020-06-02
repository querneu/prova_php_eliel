<?php 
session_start();
if(isset($_SESSION['usuarioLogado'])){
        header("Location: http://localhost/pages/Gerenciador.php");   
    }

require_once('./model/Usuario.class.php');
require_once('./dao/UsuarioDao.class.php');
$udao= new UsuarioDao;
$usuario = new Usuario;
//Need to fix this later
if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['apelido']) && isset($_POST['senha'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
    $token = md5(uniqid(rand(), true));
    $usuario->setId($token);
    $usuario->setNome($nome);
    $usuario->setSobrenome($sobrenome);
    $usuario->setApelido($apelido);
    $usuario->setSenha($senha);
    $udao->Inserir($usuario);
    if($udao){
        echo    "<script>alert('Cadastrado com sucesso');</script>"; 
    }
}elseif(isset($_POST['senha']) && isset($_POST['apelido'])){
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
    .container-bg {
        background: #8b8b8b;
        min-height: 100%; 
    }
    html, body {
            height: 100%;
            margin: 0;
        }

    </style>
</head>
<body>
    <div class="container-bg">
        <div class="container">
        
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div class="card text-white bg-dark" style="max-width: 40rem;">
                        <div class="card-header">Acesso ao Sistema</div>
                        <div class="card-body">
                            <h5 class="card-title">Autenticação</h5>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="apelido" id="apelido" aria-describedby="apelidoHelp" placeholder="Apelido">
                                    <small id="apelidoHelp" class="form-text text-muted">Digite seu apelido.</small>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="senha" id="senha" aria-describedby="passHelp" placeholder="Senha">
                                    <small id="passHelp" class="form-text text-muted">Digite sua senha.</small>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger">Entrar</button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastro">Cadastro</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-white bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nome" id="nome" aria-describedby="" placeholder="Nome" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="sobrenome" id="sobrenome" aria-describedby="" placeholder="Sobrenome" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="apelido" id="apelido" aria-describedby="apelidoHelp" placeholder="Usuário" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="senha" id="senha" aria-describedby="passHelp" placeholder="Senha" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</body>
<!--Dependencies-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>