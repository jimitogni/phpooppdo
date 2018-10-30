<?php
#arquivo de configurações
require_once 'config/config.php';

//BUSCANDO AS CLASSES
require_once DIRCLASS. 'Usuario.class.php';

// CLASSE
$objUsuario = new Usuario();
$objFc = new Funcoes();

//VALIDANDO USUARIO
session_start();

if($_SESSION["logado"] == "sim"){
    $objUsuario->usuarioLogado($_SESSION['pk']);//passa a chave para pegar os dados de quem esta logado
}else{
    header("location: ../../");
}
if(isset($_GET['sair']) == "sim"){
    $objUsuario->usuarioLogado();
}

//CADASTRANDO O FUNCIONARIO
if(isset($_POST['btCadastrar'])){
    if($objUsuario->insere($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}


//ALTERANDO OS DADOS DO FUNCIONARIO
if(isset($_POST['btAlterar'])){
    if($objUsuario->updade($_POST) == 'ok'){
        header('location: ?acao=edit&usuario='.$_GET['usuario']);
    }else{
        echo '<script type="text/javascript">alert("Erro em atualizar");</script>';
    }
}

//SELECIONADO O FUNCIONARIO
if(isset($_GET['acaoU'])){
    switch($_GET['acaoU']){
        case 'edit': $usuario = $objUsuario->selecionaUm($_GET['usuario']); break;
        case 'delet':
            if($objUsuario->delete($_GET['usuario']) == 1){
                //echo '<script type="text/javascript">alert("Deletado com sucesso");</script>';
                header('location: ');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}



?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Formulário de cadastro</title>

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

<!-- espaço -->
<br> <br>

<!-- LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->
<div class="container">

<div class="row">
    <div class="col-6">
        <div class="border bg-light panel panel-primary list-group">
        <h3>Lista</h3>
            <?php foreach($objUsuario->selecionaTudo() as $rst){ ?>
            <div class="list-group-item">
                <div><?=$objFc->tratarCaracter($rst['nome'], 2)?></div>

                <div><a href="?acaoU=edit&usuario=<?=$rst['pk']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

                <div><a href="?acaoU=delet&usuario=<?=$rst['pk']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
            </div>
            <?php } ?>
        </div>
    </div>
<!-- FIM LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->

<!-- FORMULARIO PARA CRIAR E ALTERAR USUÁRIOS -->
    <div class="panel panel-primary list-group col-6 border bg-light">
            <form name="formCad" action="" method="post">
                <input class="form-control" name="nome" type="text" required="required"  placeholder="Nome:" value="<?=$objFc->tratarCaracter((isset($usuario['nome']))?($usuario['nome']):(''), 2)?>"><br>

                <input type="mail" name="email" class="form-control" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  placeholder="E-mail:" value="<?=$objFc->tratarCaracter((isset($usuario['email']))?($usuario['email']):(''), 2)?>"><br>

                <?php if(isset($_GET['acao']) <> 'edit'){ ?>
                <input type="password" name="senha" class="form-control" required="required" placeholder="Senha:"><br>
                <?php } ?>

                <? echo "Usuario para ser alterado eh ". $usuario['nome'] ?>


                <button type="submit" name="<?=(isset($_GET['acaoU']) == 'edit')?('btAlterar'):('btCadastrar')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acaoU']) == 'edit')?('Alterar'):('Cadastrar')?></button>

                <input type="hidden" name="func" value="<?=(isset($usuario['pk']))?($objFc->base64($usuario['pk'], 1)):('')?>">
            </form>
    </div>

</div><!-- FECHA A ROW -->


<!-- espaço -->
<br> <br>

</div><!-- FECHA A CONTAINER -->

</body>
</html>
