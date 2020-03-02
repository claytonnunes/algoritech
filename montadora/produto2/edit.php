<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/contatosController.php');
editarContato();
?>
    <script>
        jQuery(function($){
            $("#campoFONE").mask("(99) 9999-9999");
			$("#campoFONE2").mask("(99) 9999-9999");
            $("#campoCEL").mask("(99) 9 9999-9999");
		    $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
        });
    </script>
    

    <h2>Atualizar produto</h2>

    <form action="edit.php?acao=editarProduto&id_produto=<?php echo $produto['id']; ?>" method="post">
        <hr />
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo utf8_encode($contato['nome']); ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Função</label>
                <input name="funcao" type="text" class="form-control" id="funcao" value="<?php echo utf8_encode($contato['funcao']); ?>">
            </div>        
            <div class="form-group col-md-3">
              <label for="name">E-mail</label>
                <input type="text" id="email" class="form-control" name="email" value="<?php echo utf8_encode($contato['email']); ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Fone</label>
                <input type="text" id="campoFONE2" class="form-control" name="contato['fone2']" value="<?php echo $contato['fone2']; ?>">
            </div>
          	<div class="form-group col-md-2">
            <label for="name">Celular</label>
             <input type="text" id="campoCEL" class="form-control" name="contato['celular']" value="<?php echo $contato['celular']; ?>">             
            </div>
        </div>
        <div class="row">
        	<div class="form-group col-md-4"></div>
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-2"><!--                <input type="text" class="form-control" name="empresa['estado']" value="--><!--">--></div>            
        </div>
        <div class="row">
        	<div class="form-group col-md-4"></div>
        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="../atendimentos/index.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>