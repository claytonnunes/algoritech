<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/usuarioController.php');
editarUsuario();
findUsuario();
?>
    <script>
        jQuery(function($){
            $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
        });
    </script>
     <?php if ($usuarios) : ?>
                <?php foreach ($usuarios as $usuario) : ?>

    <form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post">
        <hr />
        <h2>Dados do Usuário: <?php echo $usuario['nome_usuario']; ?></h2>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome p/ assinatura:</label>
                <input type="text" class="form-control" name="usuario['nome_usuario']" value="<?php echo $usuario['nome_usuario']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Cargo: </label>
                <input type="text" class="form-control" name="usuario['cargo']" value="<?php echo $usuario['cargo']; ?>" placeholder="Ex: Financeiro">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Fone empresa: </label>
                <input type="text" class="form-control" id="fone" name="fone" value="<?php echo $usuario['fone']; ?>" placeholder="(99)9999-9999">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Fone/Whatsapp: </label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $usuario['celular']; ?>" placeholder="(99)9 9999-9999">
            </div>
			<div class="form-group col-md-3">
                <label for="name">E-mail: </label>
                <input type="text" class="form-control" name="usuario['email']" value="<?php echo $usuario['email']; ?>" placeholder="seu e-mail">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Instagram da empresa: </label>
                <input type="text" class="form-control" name="usuario['instagram_empresa']" value="<?php echo $usuario['instagram_empresa']; ?>" placeholder="Ex: @instagramempresa">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Site da empresa: </label>
                <input type="text" class="form-control" name="usuario['site_empresa']" value="<?php echo $usuario['site_empresa']; ?>" placeholder="Ex: www.nomeempresa.com.br">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Usuário:</label>
                <input type="text" class="form-control" value="<?php echo $usuario['usuario']; ?>" disabled>
            </div>
            <div class="form-group col-md-3">Senha: 
                  <input type="password" class="form-control" name="usuario['senha']" value="<?php echo $usuario['senha']; ?>">
             </div> 
        </div>     
        <?php if (0==1): ?>  
        
        
        <div class="row">
        	<div class="form-group col-md-4">Conta Criada: <?php echo $usuario['created']; ?></div>
            <div class="form-group col-md-4">Conta Modificada: <?php echo $usuario['modified']; ?></div>
            </div>   
        </div>
        <?php endif; ?>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </form>
      <?php endforeach; ?>
      <?php endif; ?>
      <script>
        jQuery(function($){  
		    $("#fone").mask("(99) 9999-9999");
			$("#celular").mask("(99) 9 9999-9999");
        });
    </script>

<?php include(FOOTER_TEMPLATE); ?>