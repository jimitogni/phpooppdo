
<?php
#arquivo de configurações
include_once '../config/config.php';
include_once '../../config/config.php';

//BUSCANDO AS CLASSES
require_once DIRCLASS. 'Usuario.class.php';

//Instanciando
$objUsuario = new Usuario();

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


<!-- BARRA DE NAVEGACAO -->
<div class="container-fluid">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
<a class="navbar-brand" href="#">LOGO</a>
    <ul class="navbar-nav mr-auto">
      <li><a class="nav-link nav-item" href='' >Home</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/amin/usuario/">Usuario</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/amin/produtos/">Produtos</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/amin/receita/">Receita</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/amin/video/">Video</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/amin/cardapio/">Cardápio</a></li>
      <li><a class="nav-link nav-item" href="/php/phpoopdo/amin/evento/">Evento</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['email']?></a></li>

      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['nome']?> nivel de acesso: <?=$_SESSION['nivel']?></a></li>

      <li><a href="?sair=sim"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
    </ul>

</nav>
</div>
<!-- FIM BARRA DE NAVEGACAO -->
