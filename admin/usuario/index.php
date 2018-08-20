<?php
//BUSCANDO A CLASSE
require_once "../../classes/Usuario.class.php";
require_once "../../classes/Funcoes.class.php";

//ESTANCIANDO A CLASSE
$objUsuario = new Usuario();
$objFc = new Funcoes();

//VALIDANDO USUARIO
session_start();

if($_SESSION["logado"] == "sim"){
    $objUsuario->usuarioLogado($_SESSION['pk']);//passa a chave para pegar os dados de quem esta logado
}else{
    header("location: ../../"); 
}
if(isset($_GET['sair']) == "sim"){
    $objUsuario->usuarioLogado();
}

//CADASTRANDO O FUNCIONARIO
if(isset($_POST['btCadastrar'])){
    if($objUsuario->insere($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

//ALTERANDO OS DADOS DO FUNCIONARIO
if(isset($_POST['btAlterar'])){
    if($objUsuario->updade($_POST) == 'ok'){
        header('location: ?acao=edit&func='.$_GET['func']);
    }else{
        echo '<script type="text/javascript">alert("Erro em atualizar");</script>';
    }
}

//SELECIONADO O FUNCIONARIO
if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit': $usuario = $objUsuario->selecionaUm($_GET['usuario']); break;
        case 'delet': 
            if($objUsuario->delete($_GET['usuario']) == 'ok'){
                header('location: usuario');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Formulário de cadastro</title>
    <link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/estilo-funcionario.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-radius">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="../../admin">Home</a></li>
      <li class="active"><a href="#x">Usuario</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['email']?></a></li>

      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['nome']?> nivel de acesso: <?=$_SESSION['nivel']?></a></li>

      <li><a href="?sair=sim"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
    </ul>
  </div>
</nav>

<div id="lista">
    <div class="panel panel-primary">
        <div class="panel-heading"> <h3 class="panel-title">Lista</h3> </div>
        <div class="panel-body">
            <?php foreach($objUsuario->selecionaTudo() as $rst){ ?>
            <div class="funcionario">
                <div class="nome"><?=$objFc->tratarCaracter($rst['nome'], 2)?></div>
                
                <div class="editar"><a href="?acao=edit&usuario=<?=$rst['pk']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>
                
                <div class="excluir"><a href="?acao=delet&usuario=<?=$rst['pk']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div id="formulario">
    <form name="formCad" action="" method="post">
        <input class="form-control" name="nome" type="text" required="required"  placeholder="Nome:" value="<?=$objFc->tratarCaracter((isset($usuario['nome']))?($usuario['nome']):(''), 2)?>"><br>        
        
        <input type="mail" name="email" class="form-control" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  placeholder="E-mail:" value="<?=$objFc->tratarCaracter((isset($usuario['email']))?($usuario['email']):(''), 2)?>"><br>

        <?php if(isset($_GET['acao']) <> 'edit'){ ?>
        <input type="password" name="senha" class="form-control" required="required" placeholder="Senha:"><br>
        <?php } ?>

        <? echo "Usuario para ser alterado eh ". $usuario['nome'] ?>

        
        <button type="submit" name="<?=(isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar')?></button>        
        
        <input type="hidden" name="func" value="<?=(isset($usuario['pk']))?($objFc->base64($usuario['pk'], 1)):('')?>">
    </form>
</div>
 
</body>
</html>
