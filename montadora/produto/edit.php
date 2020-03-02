<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/negocioController.php');
if (isset($_REQUEST['acao'])) {
    if ($_REQUEST['acao']=='editar_negociacao') {
        editarNegociacao();
    }
}
?>
    <h2>EDITAR NEGOCIAÇÃO</h2>

    <form action="<?php echo "edit.php?acao=editar_negociacao&id_negociacao=".$_REQUEST['id_negociacao']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."";?>" method="post">
        <hr />
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome da negociação</label>
                <input type="text" class="form-control" name="nome_negociacao" value="">
            </div>
           
        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="../atendimentos/index.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>