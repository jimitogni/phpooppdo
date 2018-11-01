<?php
#inicia a sessao do usuario
session_start();
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

<!-- BARRA DE NAVEGACAO Menus -->
<?php
#inicia a sessao do usuario

#arquivo de configurações
$include0 = 'config/config.php';
$include1 = '../config/config.php';
$include2 = '../../config/config.php';
$include3 = '../../../config/config.php';

#arquivo de configurações
if(file_exists($include0)){
  include_once 'config/config.php';
}elseif (file_exists($include1)){
  include_once '../config/config.php';
}elseif (file_exists($include2)){
  include_once '../../config/config.php';
}elseif (file_exists($include3)){
  include_once '../../../config/config.php';
}else{
  echo "NÃO INCLUIU NADA DAS CONFIGS";
}

//inclue o menu
require_once DIRNAV. 'nav.php';
?>


<!-- FIM BARRA DE NAVEGACAO -->

<!-- Conteúdo -->

<?php
/*

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
*/
echo "<p class='text-center text-primary '><h1>Area administrativa </h1></p>";
?>

<!-- Conteúdo -->

</body>
</html>
