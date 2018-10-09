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
<!-- BARRA DE NAVEGACAO -->
<?php
require_once "menu/nav.php";
?>
<!-- FIM BARRA DE NAVEGACAO -->
</body>
</html>
