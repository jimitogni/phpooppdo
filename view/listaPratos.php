<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

// Exibe todos os erros PHP (see changelog)
error_reporting(E_ALL);

// Exibe todos os erros PHP
error_reporting(-1);

// Mesmo que error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
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

//BUSCANDO A CLASSE
require_once DIRCLASS. 'Cardapio.class.php';
require_once DIRCLASS. 'Produto.class.php';

$objProduto = new Cardapio();
$objFc = new Funcoes();
?>

<!DOCTYPE html>
<html>
  <head>
    <!--Importa icones do gogle pela WEB-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Importa materialize.css LOCAL-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/customizada.css"  media="screen,projection"/>

    <!--Diz ao navegado que este site é customizado para mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Aulas do framework Materialize</title>
  </head>
<body>

<!-- barra de navegacao com menu lateral MAIS BONITINHA-->
<nav>
   <div class="nav-wrapper">
     <a href="#!" class="brand-logo">Logo</a>
     <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
     <ul class="right hide-on-med-and-down">
        <li><a href="#!"><i class="material-icons left">face</i>Sobre</a></li>
        <li><a href="#!"><i class="material-icons left">photo</i>Galeria</a></li>
        <li><a href="#!"><i class="material-icons left">add_shopping_cart</i></i>Orcamento</a></li>
        <li><a href="#!"><i class="material-icons left">contacts</i>Contato</a></li>
      </ul>

    </div>
  </div>


  <ul id="slide-out" class="side-nav">
      <li><div class="user-view">
       <div class="background">
         <img src="imagens/fundo2.jpg">
       </div>
       <a href="#!"><img class="circle" src="imagens/caveira.jpg"></a>
       <a href="#!"><span class="white-text name">Seu nome</span></a>
       <a href="#!"><span class="white-text email">Seu email</span></a>
      </div></li>
     <li><a href="#!"><i class="material-icons">face</i>Sobre</a></li>
     <li><a href="#!"><i class="material-icons">photo</i>Galeria</a></li>
     <li><a href="#!"><i class="material-icons">add_shopping_cart</i></i>Orcamento</a></li>
     <li><a href="#!"><i class="material-icons">contacts</i>Contato</a></li>
  </ul>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

</nav>
<!-- FIM DA BARRA BONITINHA-->

<!-- CARROSEL-->
<div class="slider">
    <ul class="slides">
      <li>
        <img src="https://lorempixel.com/580/250/nature/1"> <!-- random image -->
        <div class="caption center-align">
          <h3>This is our big Tagline!</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
      <li>
        <img src="https://lorempixel.com/580/250/nature/2"> <!-- random image -->
        <div class="caption left-align">
          <h3>Left Aligned Caption</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
      <li>
        <img src="https://lorempixel.com/580/250/nature/3"> <!-- random image -->
        <div class="caption right-align">
          <h3>Right Aligned Caption</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
      <li>
        <img src="https://lorempixel.com/580/250/nature/4"> <!-- random image -->
        <div class="caption center-align">
          <h3>This is our big Tagline!</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
    </ul>
  </div>
<!-- FIM CARROSEL-->

<!-- CONTEUDO -->
<!-- CARD-->
<section>
<article>

<h1>Listagem de produtos de SEGUNDA FEIRA</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(1) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200" alt="Imagem do produto">
      <span class="card-title"><?=$rst['tituloCard']?></span>
    </div>
    <div class="card-content">
        <?php// print_r($rst); ?>
        <div>Prato: <?=$rst['tituloCard']?></div>
        <div>Publicado: <?= $rst['publicadoCard']?></div>
        <div>Dia da semana: <?= $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?= $rst['tituloCard']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>

<section>
<article>

<h1>Listagem de produtos de TERCA</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(2) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200"alt="Imagem do produto">
      <span class="card-title"><?=$rst['nome_produto']?></span>
    </div>
    <div class="card-content">
        <div>Prato: <?php echo $rst['tituloCard']?></div>
        <div>Publicado: <?php echo $rst['publicadoCard']?></div>
        <div>Dia da semana: <?php echo $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?php echo $rst['valor_produto']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>

<section>
<article>

<h1>Listagem de produtos de QUARTA</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(3) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200"alt="Imagem do produto">
      <span class="card-title"><?=$rst['nome_produto']?></span>
    </div>
    <div class="card-content">
        <div>Prato: <?php echo $rst['tituloCard']?></div>
        <div>Publicado: <?php echo $rst['publicadoCard']?></div>
        <div>Dia da semana: <?php echo $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?php echo $rst['valor_produto']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>

<section>
<article>

<h1>Listagem de produtos de QUINTA</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(4) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200"alt="Imagem do produto">
      <span class="card-title"><?=$rst['nome_produto']?></span>
    </div>
    <div class="card-content">
        <div>Prato: <?php echo $rst['tituloCard']?></div>
        <div>Publicado: <?php echo $rst['publicadoCard']?></div>
        <div>Dia da semana: <?php echo $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?php echo $rst['valor_produto']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>

<section>
<article>

<h1>Listagem de produtos de SEXXTA FEIRA</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(5) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200"alt="Imagem do produto">
      <span class="card-title"><?=$rst['nome_produto']?></span>
    </div>
    <div class="card-content">
        <div>Prato: <?php echo $rst['tituloCard']?></div>
        <div>Publicado: <?php echo $rst['publicadoCard']?></div>
        <div>Dia da semana: <?php echo $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?php echo $rst['valor_produto']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>

<section>
<article>

<h1>Listagem de produtos de SABADO</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(6) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200"alt="Imagem do produto">
      <span class="card-title"><?=$rst['nome_produto']?></span>
    </div>
    <div class="card-content">
        <div>Prato: <?php echo $rst['tituloCard']?></div>
        <div>Publicado: <?php echo $rst['publicadoCard']?></div>
        <div>Dia da semana: <?php echo $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?php echo $rst['valor_produto']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>

<section>
<article>

<h1>Listagem de produtos de DOMINGO</h1>

<div class="row">

<?php foreach($objProduto->selecionaDia(7) as $rst){ ?>
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="200"alt="Imagem do produto">
      <span class="card-title"><?=$rst['nome_produto']?></span>
    </div>
    <div class="card-content">
        <div>Prato: <?php echo $rst['tituloCard']?></div>
        <div>Publicado: <?php echo $rst['publicadoCard']?></div>
        <div>Dia da semana: <?php echo $rst['diadasemana']?></div>
    </div>
    <div class="card-action">
      <a href="#">Valor: <?php echo $rst['valor_produto']?></a>
    </div>
  </div>
</div>
<?php } ?>

</div>

</article>
</section>
<!-- FIM CARD-->
<!-- FIM CONTEUDO -->

<!-- RODAPE-->
<!--FIM RODAPE-->


<!--Importa jQuery e materialize.js LOCAL-->
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>

$(document).ready(function(){
      //Botão do menu para mobile
      $(".button-collapse").sideNav();

      //slider
      $('.slider').slider();
});

</script>

</body>
</html>