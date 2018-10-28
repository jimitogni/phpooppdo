<?php
//BUSCANDO AS CLASSES
require_once 'classes/Usuario.class.php';
//ESTANCIANDO A CLASSES
$objFunc = new Usuario();
//FAZENDO O LOGIN
if(isset($_POST['btLogar'])){
	$objFunc->logaUsuario($_POST);
}
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
	<div id="areaLogin">
    	<form action="" method="post">
        	<div class="form-group">
            	<div class="input-group">
                	<span class="input-group-addon">@</span>
                	<input type="text" name="email" class="form-control" placeholder="E-mail" required="required">
              	</div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                </div> 
            </div>
            <div class="form-group">
            	<button type="submit" name="btLogar" class="btn btn-primary btn-block">Logar</button> 
            </div>
        </form>
        <?php if(isset($_GET["login"]) == "error"){ ?>
        <div class="alert alert-danger alert-block alert-aling" role="alert">Ops! E-mail ou Senha estão errado</div>
        <?php } ?>
	</div>
</body>
</html>
