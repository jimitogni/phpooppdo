<?php
#inicia a sessao do usuario
session_start();

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
require_once DIRCLASS. 'Evento.class.php';

//Instanciando
$objEvento = new Evento();


if($_SESSION["logado"] == "sim"){
    $objEvento->usuarioLogado($_SESSION['pk']);//passa a chave para pegar os dados de quem esta logado
}else{
    header("location: ../../");
}
if(isset($_GET['sair']) == "sim"){
    $objEvento->usuarioLogado();
}

//CADASTRANDO O FUNCIONARIO
if(isset($_POST['btCadastrar'])){
    if($objEvento->insere($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

/*//CADASTRANDO O Produto
if(isset($_POST['btCadastrarProduto'])){
    if($objProduto->insereProduto($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}*/

//ALTERANDO OS DADOS DO FUNCIONARIO
if(isset($_POST['btAlterar'])){
    if($objEvento->updade($_POST) == 'ok'){
        header('location: ?acao=edit&usuario='.$_GET['usuario']);
    }else{
        echo '<script type="text/javascript">alert("Erro em atualizar");</script>';
    }
}

//SELECIONADO O FUNCIONARIO
if(isset($_GET['acaoU'])){
    switch($_GET['acaoU']){
        case 'edit': $usuario = $objEvento->selecionaUm($_GET['usuario']); break;
        case 'delet':
            if($objEvento->delete($_GET['usuario']) == 1){
                //echo '<script type="text/javascript">alert("Deletado com sucesso");</script>';
                header('location: ');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}

/*//SELECIONADO UM PRODUTO OU ANUNCI
if(isset($_GET['acaoP'])){
    switch($_GET['acaoP']){
        case 'edit': $produto = $objProduto->selecionaUmProduto($_GET['produto']); break;
        case 'delet':
            if($objProduto->delete($_GET['produto']) == 1){
                header('location: ');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}*/

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

