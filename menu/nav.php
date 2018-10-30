
<!-- BARRA DE NAVEGACAO -->
<div class="container-fluid">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
<a class="navbar-brand" href="#">LOGO</a>
    <ul class="navbar-nav mr-auto">
      <li><a class="nav-link nav-item" href="index.php?pg=home">Home</a></li>
      <li><a class="nav-link nav-item" href="index.php?pg=usuario">Usuario</a></li>
      <li><a class="nav-link nav-item" href="index.php?pg=produto">Produtos</a></li>
      <li><a class="nav-link nav-item" href="index.php?pg=receita">Receita</a></li>
      <li><a class="nav-link nav-item" href="index.php?pg=video">Video</a></li>
      <li><a class="nav-link nav-item" href="index.php?pg=cardapio">Cardápio</a></li>
      <li><a class="nav-link nav-item" href="index.php?pg=evento">Evento</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['email']?></a></li>

      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['nome']?> nivel de acesso: <?=$_SESSION['nivel']?></a></li>

      <li><a href="?sair=sim"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
    </ul>

</nav>
</div>
<!-- FIM BARRA DE NAVEGACAO -->
