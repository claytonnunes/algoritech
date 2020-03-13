<?php
require_once('../controller/cotacaoController.php');
pesquisaNumeroCotacao('numero_cotacao', 'id_pai', $_SESSION['id_pai'], 'id_grupo_produto', $_REQUEST['id_negocio'], 'deleted', '0', 'ORDER BY id_cotacao ASC');
?>
    <div class="form-group col-md-12">
        <p><h4>COTAÇÃO COD: <?php echo $_REQUEST['id_negocio']; ?></h4></p>
        <div class="form-group col-md-2" align="left">Data</div>
        <div class="form-group col-md-3" align="left">Nome</div>
        <div class="form-group col-md-2" align="left">Valor total</div>
        <div class="form-group col-md-5" align="left">Visualizar</div>
    </div>
    <?php	
    if ($cotacoes) : 
        foreach ($cotacoes as $cotacao) :
    ?>  
    <div class="form-group col-md-12">
        <div class="form-group col-md-2" align="left"><?php echo $cotacao_dois['modified']; ?></div>
        <div class="form-group col-md-3" align="left"><?php echo "cotacao".$_REQUEST['id_negocio']."-".$cotacao['numero_cotacao']; ?></div>
        <div class="form-group col-md-2" align="left"><?php echo number_format($somaTotalCobrado2, 2, ',', '.'); ?></div>
        <div class="form-group col-md-5" align="left">
            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#cotacaoModal<?php echo $cotacao['numero_cotacao']; ?>"><i class="fa fa-eye"></i></button>
        </div>
    </div>
    <?php include('../cotacao/modalCotacao.php');?>
    <?php
        endforeach; 
    endif; 
    ?>
    <a class="btn btn-success" href="<?php echo BASEURL."cotacao/carrinho.php?acao=novoCarrinho&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_negocio'].""; ?>">
    <i class="fa fa-shopping-cart"></i> Iniciar carrinho</a>