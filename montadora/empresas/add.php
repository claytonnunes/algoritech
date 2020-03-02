<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/empresasController.php');
require_once('../controller/eventosController.php');
salvarDadosEmpresa();
findEvento();
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

    <h2>Informa&ccedil;&otilde;es da Empresa</h2>

    <form id="formEmpresa" name="formEmpresa" action="add.php" method="post">
        <!-- area de campos do form -->
        <hr />
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">* Nome Fantasia</label>
                <input type="text" class="form-control" name="nome_fantasia" autofocus required >
            </div>            
            <div class="form-group col-md-3">
                <label for="name">Raz&atilde;o Social</label>
                <input type="text" id="razaoSocial" class="form-control" name="razao_social">
            </div>
            <div class="form-group col-md-2">
                <label for="name">CNPJ</label>
                <input type="text" id="campoCNPJ" class="form-control" name="cnpj" placeholder="00.000.000/0000-00">
            </div>
            <div class="form-group col-md-2">
                <label for="name">* Fone</label>
                <input type="tel" id="campoFONE" class="form-control" name="fone" placeholder="(00)00000-0000"required >
            </div>
            <div class="form-group col-md-2">
                <label for="name">CEP</label>
                <input type="text" id="campoCEP" class="form-control" name="cep" placeholder="00000-000">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Endere&ccedil;o</label>
                <input type="text" class="form-control" name="endereco">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Complemento</label>
                <input type="text" class="form-control" name="complemento">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Bairro</label>
                <input type="text" class="form-control" name="bairro">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Cidade</label>
                <input type="text" class="form-control" name="cidade">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Estado</label>
                <!--                <input type="text" class="form-control" name="empresa['estado']">-->
                <select class="form-control" name="empresa['estado']">
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AM">AM</option>
                    <option value="AP">AP</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MG">MG</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PE" selected="selected">PE</option>
                    <option value="PI">PI</option>
                    <option value="PR">PR</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SE">SE</option>
                    <option value="SP">SP</option>
                    <option value="TO">TO</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="name">WebSite</label>
                <input type="text" class="form-control" name="website">
            </div>            
        </div>
        
         <h2>Informa&ccedil;&otilde;es do Contato</h2>
        <!-- area de campos do form -->
        <hr />
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">* Nome</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
             <div class="form-group col-md-2">
                <label for="name">Fun&ccedil;&atilde;o</label>
                <input type="text" class="form-control" name="funcao">
            </div>
            
            <div class="form-group col-md-3">
                <label for="name">E-mail</label>
                <input type="text" class="form-control" name="email">
            </div>       	
            <div class="form-group col-md-2">
                <label for="name">Fone</label>
                <input type="tel" id="campoFONE2" class="form-control" name="fone2" placeholder="(00)00000-0000">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Celular</label>
                <input type="text" id="campoCEL" class="form-control" name="celular" placeholder="(00)00000-0000">
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