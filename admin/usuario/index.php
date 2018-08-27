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
        header('location: ?acao=edit&usuario='.$_GET['usuario']);
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
                header('location: ');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<!-- BARRA DE NAVEGACAO -->
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
<!-- FIM BARRA DE NAVEGACAO -->

<!-- LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->
<div class="container-fluid">
<div class="row">
  <div class="col-6">
    <div id="lista">
        <div class="panel panel-primary col-sm">
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
</div>

<!-- FIM LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->

<!-- FORMULARIO PARA CRIAR E ALTERAR USUÁRIOS -->
<div id="formulario col-sm">
<div class="row">
  <div class="col-6">
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
</div>
</div>
</div>

<!-- FORMULARIO PARA CRIAR E ALTERAR USUÁRIOS -->


<!-- Colunas sempre com metade da largura disponível, em dispositivos móveis e desktop -->
<div class="row">
  <div class="col-6">.col-6</div>
  <div class="col-6">.col-6</div>
</div>


<!-- LISTAR ANUNCIOS -->

<!-- FIM LISTAR ANUNCIOS -->

<!-- CRIAR OU ALTERAR ANUNCIOS -->
<div class="container-fluid">
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>
<!-- FIM CRIAR OU ALTERAR ANUNCIOS -->
 
</body>
</html>
