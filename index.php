<?php

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

//BUSCANDO AS CLASSES
require_once DIRCLASS. 'Usuario.class.php';

//echo "<br><br> inserindo classe ususario<br>";
//echo DIRCLASS. 'Usuario.class.php';
//echo "<br><br>";

//CLASSES
$objFunc = new Usuario();

//FAZENDO O LOGIN
if(isset($_POST['btLogar'])){
	$objFunc->logaUsuario($_POST);
}

//echo DIRROOT. "<br>";
//echo DIRADMIN. "<br>";
//echo DIRCLASS. "<br>";
//echo DIRNAV. "<br>";


?>


<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Sistema de login</title>

<!-- bootstrap atual -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container text-center">

      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Faça o login para acessar a área administrativa</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Lembrar
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="btLogar" type="submit">Entrar</button>
      </form>

       <?php if(isset($_GET["login"]) == "error"){ ?>
        <div class="alert alert-danger alert-block alert-aling" role="alert">Ops! E-mail ou Senha estão errado</div>
        <?php } ?>

    </div> <!-- /container -->


</body>
</html>
