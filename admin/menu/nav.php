<?php
//BUSCANDO A CLASSE
require_once "../classes/Usuario.class.php";
require_once "../classes/Funcoes.class.php";

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
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

<!-- BARRA DE NAVEGACAO -->
<div class="container-fluid">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
<a class="navbar-brand" href="#">LOGO</a>
    <ul class="navbar-nav mr-auto">
      <li><a class="nav-link nav-item" href="../../admin">Home</a></li>
      <li><a class="nav-link nav-item" href="usuario">Usuario</a></li>
      <li><a class="nav-link nav-item" href="produto">Produtos</a></li>
      <li><a class="nav-link nav-item" href="receita">Receita</a></li>
      <li><a class="nav-link nav-item" href="video">Video</a></li>
      <li><a class="nav-link nav-item" href="cardapio">Cardápio</a></li>
      <li><a class="nav-link nav-item" href="evento">Evento</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['email']?></a></li>

      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['nome']?> nivel de acesso: <?=$_SESSION['nivel']?></a></li>

      <li><a href="?sair=sim"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
    </ul>

</nav>
</div>
<!-- FIM BARRA DE NAVEGACAO -->