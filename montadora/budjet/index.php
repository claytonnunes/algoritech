<?php
require_once('../controller/budjetController.php');
pesquisaBudjet($_REQUEST['id_negocio']);
?>
    <div class="form-group col-md-12">
        <p><h4>COTAÇÃO COD: <?php echo $_REQUEST['id_negocio']; ?> </h4></p>
        <div class="form-group col-md-2" align="left">Data</div>
        <div class="form-group col-md-4" align="left">Fornecedor</div>
        <div class="form-group col-md-3" align="left">Valor</div>
        <div class="form-group col-md-3" align="left">Visualizar</div>
    </div>
    <?php	
    if ($budjets) : 
        foreach ($budjets as $budjet) :
            $valorCusto = $budjet['valor_custo'];
    ?>  
    <div class="form-group col-md-12">
        <div class="form-group col-md-2" align="left"><?php echo $budjet['modified']; ?></div>
        <div class="form-group col-md-4" align="left"><?php echo $budjet['modified']; ?></div>
        <div class="form-group col-md-3" align="left"><?php echo number_format($valorCusto, 2, ',', '.'); ?></div>
        <div class="form-group col-md-3" align="left">
            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#custoModal<?php echo $budjet['id']; ?>"><i class="fa fa-eye"></i></button>
        </div>
    </div>
    <?php include('#../cotacao/modalCotacao.php');?>
    <?php
        endforeach; 
    endif; 
    ?>
    <div class="panel-heading">
        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalNovoCusto" 
        data-send-id="<?php echo $idEmpresa; ?>"> <i class="fa fa-money"></i> Novo custo</button>
</div>