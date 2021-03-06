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
require_once DIRCLASS. 'Produto.class.php';
require_once DIRCLASS. 'Funcoes.class.php';

$objProduto = new Produto();
$objFc = new Funcoes();

//CADASTRANDO
if(isset($_POST['btCadastrar'])){
    if($objProduto->insereProduto($_POST) == 1){
        //header('location: ');
        //header ("location: /phpooppdo/admin/produto/");
        echo '<script type="text/javascript">alert("DEU CERTO");</script>';
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

//ALTERANDO OS DADOS
if(isset($_POST['btAlterar'])){
      if($objProduto->updateProduto($_POST) == 1){
        
        echo '<script type="text/javascript">alert("Cardapio alterado com sucesso");</script>';
        
        //header ("location: /phpooppdo/admin/produto/");

    }else{
        echo '<script type="text/javascript">alert("Erro em atualizar Cardapio");</script>';
    }
}

//SELECIONADO UM
if(isset($_GET['acao'])){
    switch($_GET['acao']){
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
include_once DIRNAV . 'nav.php';
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

<!-- LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->
<div class="container">

<!-- espaço -->
<br> <br>

<!-- LISTAR -->
<div class="row">
    <div class="col-6">
        <div class="border bg-light panel panel-primary list-group">
        <h3>Listagem de Produtos</h3>
            <?php foreach($objProduto->selecionaTudo() as $rst){ ?>
            <div class="list-group-item">
                <div><b>Nome:</b> <?php echo $rst['nome_produto']?></div>
                <div><b>Descrição:</b> <?php echo $rst['descricao_produto']?></div>
                <div><b>Fornecedor:</b> <?php echo $rst['fornecedor']?></div>
                <div><b>Valor:</b> <?php echo $rst['valor_produto']?></div>
                <div><b>Data de Cadastro:</b> <?php print date("d/m/Y");?></div>
                <div><b>Publicado:</b> <?php echo $rst['publicado']?></div>
                <div><b>Dia da semana:</b> <?php echo $rst['diadasemana']?></div>
                <div>Imagem: <img src="/phpooppdo/img/<?php echo $rst['urlimagem']?>" width="100" height="100" alt="Imagem do produto"></div>

                <div><a href="?acao=edit&produto=<?=$rst['pk_produto']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

                <div><a href="?acao=delet&produto=<?=$rst['pk_produto']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
            </div>
            <?php } ?>
        </div>
    </div>

<!-- FIM LISTAR ANUNCIOS -->
<!-- CRIAR OU ALTERAR ANUNCIOS -->
<!-- FORMULARIO PARA CRIAR -->
    <div class="panel panel-primary list-group col-6 border bg-light">
            <form enctype="multipart/form-data" name="formCad" action="" method="post" >

                <input type="hidden" name="id" value="<?=$objFc->tratarCaracter((isset($produto['pk_produto']))?($produto['pk_produto']):(''), 2)?>"><br>

                <input class="form-control" name="nomeProduto" type="text" required="required"  placeholder="Produto:" value="<?=$objFc->tratarCaracter((isset($produto['nome_produto']))?($produto['nome_produto']):(''), 2)?>"><br>

                <input class="form-control" name="descricaoProduto" type="text" required="required"  placeholder="Descricao:" value="<?=$objFc->tratarCaracter((isset($produto['descricao_produto']))?($produto['descricao_produto']):(''), 2)?>"><br>

                <input class="form-control" name="fornecedor" type="text" placeholder="Fornecedor:" value="<?=isset($produto['fornecedor'])?($produto['fornecedor']):('')?>"><br>

                <input class="form-control" name="preco" type="text" required="required"  placeholder="Preco:" value="<?=$objFc->tratarCaracter((isset($produto['valor_produto']))?($produto['valor_produto']):(''), 2)?>"><br>

                <input type="file" name="userfile"><br><br>


                <h5>Publicado:</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publicado" id="publicado" value="1">
                  <label class="form-check-label" for="publicado">Sim</label>

                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="publicado" type="radio" id="publicado" value="2">
                  <label class="form-check-label" for="publicado">Não</label>
                </div>
                </br></br>

                <h5>Dias da Semana:</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="1">
                  <label class="form-check-label" for="diaDaSemana">Segunda</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="2">
                  <label class="form-check-label" for="diaDaSemana">Terça</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="3">
                  <label class="form-check-label" for="diaDaSemana">Quarta</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="4">
                  <label class="form-check-label" for="diaDaSemana">Quinta</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="5">
                  <label class="form-check-label" for="diaDaSemana">Sexta</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="6">
                  <label class="form-check-label" for="diaDaSemana">Sabado</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="diaDaSemana" type="checkbox" id="diaDaSemana" value="7">
                  <label class="form-check-label" for="diaDaSemana">Domingo</label>
                </div>


                <button type="submit" name="<?= (isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar')?></button>

                <input type="hidden" name="func" value="<?= (isset($produto['pk_produto']))?($produto['pk_produto']):('')?>">
            </form>
    </div>
</div> <!-- FIM CRIAR OU ALTERAR ANUNCIOS -->

</div><!-- FECHA A CONTAINER -->

</body>
</html>


