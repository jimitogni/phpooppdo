<?php
//BUSCANDO AS CLASSES
require_once '../classes/Usuario.class.php';
//ESTANCIANDO 
$objFunc = new Usuario();
//VALIDANDO USUARIO
session_start();

if($_SESSION["logado"] == "sim"){
	$objFunc->usuarioLogado($_SESSION['pk']);
}else{
	header("location: /phpoopdo/"); 
}

if(isset($_GET['sair']) == "sim"){
	$objFunc->sairusuarios();


}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
	<title>Home</title>
	<link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="../bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/estilo-index.css" rel="stylesheet" type="text/css" media="all">
	<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-radius">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="usuario">Usuários</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['nome']?> nivel de acesso: <?=$_SESSION['nivel']?></a></li>
      <li><a href="?sair=sim"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
    </ul>
  </div>
</nav>
</body>
</html>
