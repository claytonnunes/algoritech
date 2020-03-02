<?php
require_once('../controller/eventosController.php');
visualizarEvento($_GET['id']);
?>

<?php
require_once ('../config.php');
require_once ("../inc/visibilidade-header.php");
?>

    <h2>Evento <?php echo $evento['id']; ?></h2>
    <hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

    <dl class="dl-horizontal">
        <dt>Nome Fantasia:</dt>
        <dd><?php echo $evento['nome_evento']; ?></dd>
        <dt>Criado:</dt>
        <dd><?php echo $evento['created']; ?></dd>
        <dt>Modificado:</dt>
        <dd><?php echo $evento['modified']; ?></dd>
        
    </dl>

    <div id="actions" class="row">
        <div class="col-md-12">
            <a href="edit.php?id=<?php echo $evento['id']; ?>" class="btn btn-primary">Editar</a>
            <a href="index.php" class="btn btn-default">Voltar</a>
        </div>
    </div>

<?php include(FOOTER_TEMPLATE); ?>