<?php
//BUSCANDO A CLASSE
require_once "classes/Funcoes.class.php";
require_once "classes/Produto.class.php";

//ESTANCIANDO A CLASSE
$objProduto = new Produto();
$objFc = new Funcoes();

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

<!-- LISTAR ANUNCIOS -->
<div class="row">
<div class="col-6">
    <div class="border bg-light panel panel-primary list-group">
    <h3>Lista Anuncios</h3>
        <?php foreach($objProduto->selecionaTudo() as $rst){ ?>
        <div class="list-group-item">
            <div><?=$rst['nome_produto']?></div>
            <div>valor: <?echo $rst['valor_produto']?></div>
            <div><a href="?acaoP=edit&produto=<?=$rst['pk_produto']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

            <div><a href="?acaoP=delet&produto=<?=$rst['pk_produto']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
        </div>
        <?php } ?>
    </div>
</div>

</div>
</body>
