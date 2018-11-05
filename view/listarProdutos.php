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

<div class="row">
<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="imagens/logo_cps.png">
      <span class="card-title black-text">EPA</span>
    </div>
    <div class="card-content">
      <p>EPA - Etec de Portas Abertas.</p>
    </div>
    <div class="card-action">
      <a href="#">Saiba mais</a>
    </div>
  </div>
</div>

<div class="col s12 m6">
  <div class="card">
    <div class="card-image">
      <img src="imagens/etec-itu.jpg">
      <span class="card-title">Competição de robótica</span>
    </div>
    <div class="card-content">
      <p>Venham participar e prestigiar a competição de carrinhos seguidores de linha.</p>
    </div>
    <div class="card-action">
      <a href="#">Saiba mais</a>
    </div>
  </div>
</div>

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