<?php
#arquivo de configurações
require_once '../config/config.php';

//BUSCANDO AS CLASSES
require_once DIRCLASS. 'Usuario.class.php';

echo DIRCLASS. 'Usuario.class.php';

//CLASSE
$objUsuario = new Usuario();

$objFunc->imprime();

//$objFunc->usuarioLogado($_SESSION['pk']);


/* 
//VALIDANDO USUARIO
session_start();

if($_SESSION["logado"] == "sim"){
	$objFunc->usuarioLogado($_SESSION['pk']);
}else{
	header("location: ".DIRROOT); 
}

if(isset($_GET['sair']) == "sim"){
	$objFunc->sairusuarios();


}*/
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
require_once DIRNAV . 'nav.php';
?>
<!-- FIM BARRA DE NAVEGACAO -->
</body>
</html>
