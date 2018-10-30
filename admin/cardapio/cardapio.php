<?php
//BUSCANDO A CLASSE
require_once DIRCLASS. 'Cardapio.class.php';

$objCardapio = new Cardapio();

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
                <div><a href="?acaoP=edit&cardapio=<?=$rst['pk_cardapio']?>" title="Editar dados"><img src="../../img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>

                <div><a href="?acaoP=delet&cardapio=<?=$rst['pk_cardapio']?>" title="Excluir esse dado"><img src="../../img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
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

                <input class="form-control" name="itensCard" type="text" required="required"  placeholder="Itens do Cardápio:" value="<?=$objFc->tratarCaracter((isset($cardapio['itensCard']))?($cardapio['itensCard']):(''), 2)?>"><br>

                <input class="form-control" name="descricaoCard" type="text" placeholder="Descricao do Cardápio:" value="<?=$objFc->tratarCaracter((isset($cardapio['descricaoCard']))?($cardapio['descricaoCard']):(''), 2)?>"><br>

                <input class="form-control" name="dataCard" type="text" placeholder="Data do Cardápio:" value="<?=$objFc->tratarCaracter((isset($cardapio['dataCard']))?($cardapio['dataCard']):(''), 2)?>"><br>

                <h5>Publicado:</h5>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="publicadoCard" id="publicadoCard" value="1">
                  <label class="form-check-label" for="publicadoCard">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="publicadoCard" type="checkbox" id="publicadoCard" value="2">
                  <label class="form-check-label" for="publicadoCard">Não</label>
                </div>


                <button type="submit" name="<?=(isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" class="btn btn-primary btn-block"><?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar')?></button>

                <input type="hidden" name="func" value="<?=(isset($cardapio['idCard']))?($objFc->base64($cardapio['idCard'], 1)):('')?>">
            </form>
    </div>
</div> <!-- FIM CRIAR OU ALTERAR ANUNCIOS -->

</div><!-- FECHA A CONTAINER -->

</body>
</html>
