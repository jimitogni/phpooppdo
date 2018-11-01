<?php
//BUSCANDO A CLASSE
require_once DIRCLASS. 'Video.class.php';

$objVideo = new Video();

//CADASTRANDO O FUNCIONARIO
if(isset($_POST['btCadastrar'])){
    if($objVideo->insere($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

//ALTERANDO OS DADOS DO FUNCIONARIO
if(isset($_POST['btAlterar'])){
    if($objVideo->updade($_POST) == 'ok'){
        header('location: ?acao=edit&usuario='.$_GET['usuario']);
    }else{
        echo '<script type="text/javascript">alert("Erro em atualizar");</script>';
    }
}

//SELECIONADO O FUNCIONARIO
if(isset($_GET['acaoU'])){
    switch($_GET['acaoU']){
        case 'edit': $usuario = $objVideo->selecionaUm($_GET['usuario']); break;
        case 'delet':
            if($objVideo->delete($_GET['usuario']) == 1){
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
require_once "../menu/nav.php";
?>
<!-- FIM BARRA DE NAVEGACAO -->
