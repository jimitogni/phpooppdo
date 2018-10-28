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

	<!-- bootstrap atual -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</head>

<body>
<!-- BARRA DE NAVEGACAO -->
<?php
require_once "menu/nav.php";
?>
<!-- FIM BARRA DE NAVEGACAO -->
</body>
</html>
