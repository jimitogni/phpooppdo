<?php
#arquivo de configurações
require_once '../config/config.php';

//BUSCANDO AS CLASSES
require_once DIRCLASS. 'Usuario.class.php';
require_once DIRCLASS. 'Funcoes.class.php';

//Instanciando
$objUsuario = new Usuario();
$objFc = new Funcoes();

//VALIDANDO USUARI'
session_start();

if($_SESSION["logado"] == "sim"){
	$objUsuario->usuarioLogado($_SESSION['pk']);
}else{
	header("location: ".DIRROOT);
}

if(isset($_GET['sair']) == "sim"){
	$objUsuario->sairusuarios();
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
require_once DIRNAV . 'nav.php';
?>
<!-- FIM BARRA DE NAVEGACAO -->

<!-- Conteúdo -->

<?php

if ($_GET['pg']=='usuario'){
	require_once DIRADMIN . 'usuario/usuario.php';
}
elseif ($_GET['pg']=='produto'){
	require_once DIRADMIN . 'produto/produto.php';
}
elseif ($_GET['pg']=='receita'){
	require_once DIRADMIN . 'receita/receita.php';
}
elseif ($_GET['pg']=='video'){
	require_once DIRADMIN . 'video/video.php';
}
elseif ($_GET['pg']=='evento'){
	require_once DIRADMIN . 'evento/evento.php';
}
elseif ($_GET['pg']=='cardapio'){
	require_once DIRADMIN . 'cardapio/cardapio.php';
}else{
	echo '<p><h1 class="center form-signin-heading"> Área administrativa </h1></p>';
}



?>

<!-- Conteúdo -->

</body>
</html>
