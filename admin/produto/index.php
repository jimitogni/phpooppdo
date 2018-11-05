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

//BUSCANDO A CLASSE
require_once DIRCLASS. 'Funcoes.class.php';
require_once DIRCLASS. 'Produto.class.php';

$objProduto = new Produto();
$objFc = new Funcoes();

//CADASTRANDO O Produto
if(isset($_POST['btCadastrarProduto'])){
    if($objProduto->insereProduto($_POST) == 'ok'){
        header('location: ');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

//SELECIONADO UM PRODUTO OU ANUNCI
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
}

?>

<!-- BARRA DE NAVEGACAO -->
<?php
require_once DIRNAV . 'nav.php';
?>
<!-- FIM BARRA DE NAVEGACAO -->

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
    <title>Home</title>

    <!-- bootstrap atual -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>

<body>

<p></p>

<div class="container">

<!-- LISTAR ANUNCIOS -->
<div class="row">
    <div class="col-6">
        <div class="border bg-light panel panel-primary list-group">
        <h3>Listagem de Produtos</h3>
            <?php foreach($objProduto->selecionaTudo() as $rst){ ?>
            <div class="list-group-item">
                <div><?=$rst['nome_produto']?></div>
                <div>Fornecedor: <?echo $rst['fornecedor']?></div>
                <div>Valor: <?echo $rst['valor_produto']?></div>
                <div>Data de Cadastro: <?print date("d/m/Y");?></div>
                <div>Publicado: <?echo $rst['publicado']?></div>
                <div>Imagem: <img src="/php/phpoopdo/img/<?echo $rst['urlimagem']?>" width="100" height="100" alt="Imagem do produto"></div>

                <div><a href="?acaoP=edit&produto=<?=$rst['pk_produto']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

                <div><a href="?acaoP=delet&produto=<?=$rst['pk_produto']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
            </div>
            <?php } ?>
        </div>
    </div>

<!-- FIM LISTAR ANUNCIOS -->
<!-- CRIAR OU ALTERAR ANUNCIOS -->
<!-- FORMULARIO PARA CRIAR E ALTERAR anuncis -->
    <div class="panel panel-primary list-group col-6 border bg-light">
            <form name="formCad" action="" method="post" enctype="multipart/form-data">

                <input class="form-control" name="nomeProduto" type="text" required="required"  placeholder="Produto:" value="<?=$objFc->tratarCaracter((isset($produto['nome_produto']))?($produto['nome_produto']):(''), 2)?>"><br>

                <input class="form-control" name="descricaoProduto" type="text" required="required"  placeholder="Descricao:" value="<?=$objFc->tratarCaracter((isset($produto['descricao_produto']))?($produto['descricao_produto']):(''), 2)?>"><br>

                <input class="form-control" name="fornecedor" type="text" placeholder="Nome do fornecedor:" value="<?=$objFc->tratarCaracter((isset($produto['fornecedor']))?($produto['descricao_produto']):(''), 2)?>"><br>

                <input class="form-control" name="preco" type="text" required="required"  placeholder="Preco:" value="<?=$objFc->tratarCaracter((isset($produto['valor_produto']))?($produto['valor_produto']):(''), 2)?>"><br>

                <input type="file" name="userfile"><br><br>



                <h5>Publicado:</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="publicado" type="radio" id="inlineCheckbox1" value="1">
                  <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="publicado" type="radio" id="inlineCheckbox2" value="2">
                  <label class="form-check-label" for="inlineCheckbox2">Não</label>
                </div>


                <button type="submit" name="<?=(isset($_GET['acaoP']) == 'edit')?('btAlterarProduto'):('btCadastrarProduto')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acaoP']) == 'edit')?('Alterar'):('Cadastrar')?></button>

                <input type="hidden" name="func" value="<?=(isset($produto['pk']))?($objFc->base64($produto['pk'], 1)):('')?>">
            </form>
    </div>
</div> <!-- FIM CRIAR OU ALTERAR ANUNCIOS -->

</div><!-- FECHA A CONTAINER -->

</body>
</html>
