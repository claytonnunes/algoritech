<?php
require_once('functions.php');
view($_GET['id']);
?>

<?php include(HEADER_TEMPLATE); ?>

    <h2>Expositor <?php echo $expositor['id']; ?></h2>
    <hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

    <dl class="dl-horizontal">
        <dt>CNPJ:</dt>
        <dd><?php echo $expositor['cnpj']; ?></dd>
        <dt>Empresa:</dt>
        <dd><?php echo $expositor['empresa']; ?></dd>
        <dt>Nome Fantasia:</dt>
        <dd><?php echo $expositor['nome_fantasia']; ?></dd>
        <dt>Cargo:</dt>
        <dd><?php echo $expositor['cargo']; ?></dd>
        <dt>País:</dt>
        <dd><?php echo $expositor['pais']; ?></dd>
        <dt>CEP:</dt>
        <dd><?php echo $expositor['cep']; ?></dd>
        <dt>Endereço:</dt>
        <dd><?php echo $expositor['endereco']; ?></dd>
        <dt>Cidade:</dt>
        <dd><?php echo $expositor['cidade']; ?></dd>
        <dt>Estado:</dt>
        <dd><?php echo $expositor['estado']; ?></dd>
        <dt>WebSite:</dt>
        <dd><?php echo $expositor['website']; ?></dd>
        <dt>Fone:</dt>
        <dd><?php echo $expositor['fone']; ?></dd>
        <dt>Fax:</dt>
        <dd><?php echo $expositor['fax']; ?></dd>
        <dt>Celular:</dt>
        <dd><?php echo $expositor['celular']; ?></dd>
        <dt>Observação:</dt>
        <dd><?php echo $expositor['observacao']; ?></dd>
    </dl>

    <div id="actions" class="row">
        <div class="col-md-12">
            <a href="edit.php?id=<?php echo $expositor['id']; ?>" class="btn btn-primary">Editar</a>
            <a href="index.php" class="btn btn-default">Voltar</a>
        </div>
    </div>

<?php include(FOOTER_TEMPLATE); ?>