<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/eventosController.php');
editarEvento();
?>

    <script>
        jQuery(function($){
            $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
        });
    </script>

    <h2>Atualizar Evento</h2>

    <form action="edit.php?id=<?php echo $evento['id']; ?>" method="post">
        <hr />
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome Evento</label>
                <input type="text" class="form-control" name="evento['nome_evento']" value="<?php echo $evento['nome_evento']; ?>">         
            </div>
        </div>    
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>