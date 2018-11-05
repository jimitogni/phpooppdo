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
require_once DIRCLASS. 'Cardapio.class.php';
require_once DIRCLASS. 'Funcoes.class.php';

$objCardapio = new Cardapio();
$objFc = new Funcoes();

//CADASTRANDO
if(isset($_POST['btCadastrar'])){
    if($objCardapio->insere($_POST) == 1){
        header('location: ');
        echo '<script type="text/javascript">alert("DEU CERTO");</script>';
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

//SELECIONADO UM
if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit': $cardapio = $objCardapio->selecionaUmCard($_GET['cardapio']); break;
        case 'delet':
            if($objCardapio->delete($_GET['cardapio']) == 1){
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

<!-- LISTAGEM DE USUARIOS QUE VEM DO BANCO DE DADOS -->
<div class="container">

<!-- espaço -->
<br> <br>

<!-- LISTAR -->
<div class="row">
    <div class="col-6">
        <div class="border bg-light panel panel-primary list-group">
        <h3>Lista de Cardápios</h3>
            <?php foreach($objCardapio->selecionaTudo() as $rst){ ?>
            <div class="list-group-item">
                <div><?=$rst['tituloCard']?></div>
                <div>valor: <?echo $rst['descricaoCard']?></div>
                <div><a href="?acao=edit&cardapio=<?php echo $rst['idCard']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

                <div><a href="?acao=delet&cardapio=<?php echo $rst['idCard']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
            </div>
            <?php } ?>
        </div>
    </div>

<!-- FIM LISTAR ANUNCIOS -->
<!-- CRIAR OU ALTERAR ANUNCIOS -->
<!-- FORMULARIO PARA CRIAR -->
    <div class="panel panel-primary list-group col-6 border bg-light">
            <form name="formCad" action="" method="post">
                <input class="form-control" name="tituloCard" type="text" required="required"  placeholder="Titulo do Cardápio:" value="<?=$objFc->tratarCaracter((isset($cardapio['tituloCard']))?($cardapio['tituloCard']):(''), 2)?>"><br>

                <input class="form-control" name="descricaoCard" type="text" placeholder="Descricao do Cardápio:" value="<?=$objFc->tratarCaracter((isset($cardapio['descricaoCard']))?($cardapio['descricaoCard']):(''), 2)?>"><br>

                <h5>Publicado:</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publicadoCard" id="publicadoCard" value="1">
                  <label class="form-check-label" for="publicadoCard">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="publicadoCard" type="radio" id="publicadoCard" value="2">
                  <label class="form-check-label" for="publicadoCard">Não</label>
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


                <button type="submit" name="<?=(isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar')?></button>

                <input type="hidden" name="func" value="<?=(isset($cardapio['idCard']))?($objFc->base64($cardapio['idCard'], 1)):('')?>">
            </form>
    </div>
</div> <!-- FIM CRIAR OU ALTERAR ANUNCIOS -->

</div><!-- FECHA A CONTAINER -->

</body>
</html>
