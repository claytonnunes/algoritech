<?php
/**
 * Created by Algoritech.
 * User: clayton.nunes
 * Date: 19/01/2017
 * Time: 23:59
 */
?>

<?php
require_once('../controller/contatosController.php');
salvarContato();
?>
<?php
require_once ('../config.php');
require_once ("../inc/visibilidade-header.php");
?>
    <script>
        jQuery(function($){  
		    $("#campoFONE").mask("(99) 9 9999-9999");
			$("#campoFONE2").mask("(99) 9 9999-9999");
            $("#campoCEL").mask("(99) 9 9999-9999");
		    $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");

        });
    </script>

    <h2>Informações do Contato</h2>

    <form id="formContato" name="formContato" action="add.php" method="post">
        <!-- area de campos do form -->
        <hr />       
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="contato['nome']">
            </div>
            
            <div class="form-group col-md-2">
                <label for="name">Gênero</label>
                <!--                <input type="text" class="form-control" name="contato['genero']">-->
                <select class="form-control" name="contato['genero']">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>
        	<div class="form-group col-md-2">
                <label for="name">Fone</label>
                <input type="tel" id="campoFONE" class="form-control" name="contato['fone']" placeholder="(00)00000-0000">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Fone2</label>
                <input type="tel" id="campoFONE2" class="form-control" name="contato['fone2']" placeholder="(00)00000-0000">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Celular</label>
                <input type="text" id="campoCEL" class="form-control" name="contato['celular']" placeholder="(00)00000-0000">
                
                <input type="hidden" id="id_empresa" name="contato['id_empresa']" value="<?php $_REQUEST['id_empresa']; ?>"  class="form-control" />
                  <input type="hidden" id="tipo_conta" name="usuario['tipo_conta']" value="0"  class="form-control" />
                  <input type="hidden" id="status" name="usuario['status']" value="0"  class="form-control" />
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