<?php
//BUSCANDO A CLASSE
require_once "../../classes/Cardapio.class.php";
include_once "../../classes/Funcoes.class.php";

//ESTANCIANDO A CLASSE
$objCardapio = new Cardapio();
$objFc = new Funcoes();

//VALIDANDO USUARIO
session_start();

if($_SESSION["logado"] == "sim"){
    $objCardapio->usuarioLogado($_SESSION['pk']);//passa a chave para pegar os dados de quem esta logado
}else{
    header("location: ../../");
}
if(isset($_GET['sair']) == "sim"){
    $objCardapio->usuarioLogado();
}


//CADASTRANDO
if(isset($_POST['btCadastrar'])){
    if($objCardapio->insere($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

//ALTERANDO OS DADOS DO FUNCIONARIO
if(isset($_POST['btAlterar'])){
    if($objCardapio->updade($_POST) == 'ok'){
        header('location: ?acao=edit&usuario='.$_GET['usuario']);
    }else{
        echo '<script type="text/javascript">alert("Erro em atualizar");</script>';
    }
}

//SELECIONADO O FUNCIONARIO
if(isset($_GET['acaoU'])){
    switch($_GET['acaoU']){
        case 'edit': $usuario = $objCardapio->selecionaUm($_GET['usuario']); break;
        case 'delet':
            if($objCardapio->delete($_GET['usuario']) == 1){
                //echo '<script type="text/javascript">alert("Deletado com sucesso");</script>';
                header('location: ');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}

//SELECIONADO UM PRODUTO OU ANUNCI
if(isset($_GET['acaoP'])){
    switch($_GET['acaoP']){
        case 'edit': $produto = $objCardapio->selecionaUmProduto($_GET['produto']); break;
        case 'delet':
            if($objCardapio->delete($_GET['produto']) == 1){
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

    <link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

<!-- BARRA DE NAVEGACAO -->

<!-- BARRA DE NAVEGACAO -->
<?php
include_once "../menu/nav.php";
?>
<!-- FIM BARRA DE NAVEGACAO -->
<!-- FIM BARRA DE NAVEGACAO -->

<!-- LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->
<div class="container">

<!-- espaço -->
<br> <br>

<!-- LISTAR -->
<div class="row">
    <div class="col-6">
        <div class="border bg-light panel panel-primary list-group">
        <h3>Lista Anuncios</h3>
            <?php foreach($objCardapio->selecionaTudo() as $rst){ ?>
            <div class="list-group-item">
                <div><?=$rst['nome_produto']?></div>
                <div>valor: <?echo $rst['valor_produto']?></div>
                <div><a href="?acaoP=edit&produto=<?=$rst['pk_produto']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

                <div><a href="?acaoP=delet&produto=<?=$rst['pk_produto']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
            </div>
            <?php } ?>
        </div>
    </div>

<!-- FIM LISTAR ANUNCIOS -->
<!-- CRIAR OU ALTERAR ANUNCIOS -->
<!-- FORMULARIO PARA CRIAR -->
    <div class="panel panel-primary list-group col-6 border bg-light">
            <form name="formCad" action="" method="post">
                <input class="form-control" name="tituloCard" type="text" required="required"  placeholder="Produto:" value="<?=$objFc->tratarCaracter((isset($produto['nome_produto']))?($produto['nome_produto']):(''), 2)?>"><br>

                <input class="form-control" name="itensCard" type="text" required="required"  placeholder="Descricao:" value="<?=$objFc->tratarCaracter((isset($produto['descricao_produto']))?($produto['descricao_produto']):(''), 2)?>"><br>

                <input class="form-control" name="descricaoCard" type="text" required="required"  placeholder="Descricao:" value="<?=$objFc->tratarCaracter((isset($produto['descricao_produto']))?($produto['descricao_produto']):(''), 2)?>"><br>

                <input class="form-control" name="dataCard" type="text" required="required"  placeholder="Descricao:" value="<?=$objFc->tratarCaracter((isset($produto['descricao_produto']))?($produto['descricao_produto']):(''), 2)?>"><br>

                <input class="form-control" name="publicadoCard" type="text" required="required"  placeholder="Preco:" value="<?=$objFc->tratarCaracter((isset($produto['valor_produto']))?($produto['valor_produto']):(''), 2)?>"><br>


                <button type="submit" name="<?=(isset($_GET['acaoP']) == 'edit')?('btAlterarProduto'):('btCadastrarProduto')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acaoP']) == 'edit')?('Alterar'):('Cadastrar')?></button>

                <input type="hidden" name="func" value="<?=(isset($produto['pk']))?($objFc->base64($produto['pk'], 1)):('')?>">
            </form>
    </div>
</div> <!-- FIM CRIAR OU ALTERAR ANUNCIOS -->

</div><!-- FECHA A CONTAINER -->

</body>
</html>
