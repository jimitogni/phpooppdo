
<?php
//VALIDANDO USUARI'

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

//BUSCANDO AS CLASSES
require_once DIRCLASS. 'Usuario.class.php';

//Instanciando
$objUsuario = new Usuario();


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

    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

</head>

<!-- BARRA DE NAVEGACAO -->
<div class="container-fluid">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
<a class="navbar-brand" href="#">LOGO</a>
    <ul class="navbar-nav mr-auto">
      <li><a class="nav-link nav-item" href='/php/phpoopdo/admin/' >Home</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/admin/usuario/">Usuario</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/admin/produto/">Produtos</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/admin/receita/">Receita</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/admin/video/">Video</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/admin/cardapio/">Cardápio</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/admin/evento/">Evento</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right text-primary">
      
      <li class="text-primary"><i class="fas fa-user"> </i>Email logado <?=$_SESSION['email']?> </li>

      <li class="text-primary"><i class="fas fa-user"> </i>Usuário logado <?=$_SESSION['nome']?></li>

      <li class="text-primary"><i class="fas fa-user"> </i>Nivel de acesso: <?=$_SESSION['nivel']?></li>

      <li><a href="?sair=sim"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
    </ul>

</nav>
</div>
<!-- FIM BARRA DE NAVEGACAO -->
