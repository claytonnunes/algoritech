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
salvarContatoTwo();
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

    <h2>Informa&ccedil;&otilde;es do Contato</h2>

    <form id="formContato" name="formContato" action="add2.php" method="post">
        <!-- area de campos do form -->
        <hr />       
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="contato['nome']">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Fun&ccedil;&atilde;o</label>
                 <input type="text" class="form-control" name="contato['funcao']">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Email</label>
                 <input type="text" class="form-control" name="contato['email']">
            </div>
              <div class="form-group col-md-2">
                <label for="name">Fone</label>
                <input type="tel" id="campoFONE" class="form-control" name="contato['fone2']" placeholder="(00)00000-0000">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Celular</label>
                <input type="text" id="campoCEL" class="form-control" name="contato['celular']" placeholder="(00)00000-0000">
                
                <input type="hidden" id="id_empresa" name="contato['id_empresa']" value="<?php echo $_REQUEST['id_empresa']; ?>"  class="form-control" />
                <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id']; ?>"  class="form-control" />
                <input type="hidden" id="id_company" name="id_company" value="<?php echo $_REQUEST['id_company']; ?>"  class="form-control" />
                <input type="hidden" id="id_atendimento" name="id_atendimento" value="<?php echo $_REQUEST['id_atendimento']; ?>"  class="form-control" />
                
                
                  <input type="hidden" id="tipo_conta" name="usuario['tipo_conta']" value="0"  class="form-control" />
                  <input type="hidden" id="status" name="usuario['id_atendimento']" value="0"  class="form-control" />
                    <br>

            </div>
            

        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                <a href="index.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>