<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/contasController.php');
salvarConta();
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
    <h3>Nova conta <br><br></h3>
    <form id="formConta" name="formConta" action="add.php?acao=add" method="post">
        <!-- area de campos do form -->
        <h4>DADOS OBRIGATÓRIOS</h4>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">*Nome Conta</label>
                <input type="text" class="form-control" name="conta['nome_conta']" autofocus required placeholder="Ex: SuaEmpresa SP" >
            </div>
			<div class="form-group col-md-2">
                <label for="name">*Tipo</label>
                <select class="form-control" name="conta['tipo']" autofocus required >
					<option value="" selected="selected">Selecione</option>
                    <option value="1">Filial</option>
                    <option value="2">Matriz</option>
                </select>
            </div>
			<div class="form-group col-md-2">
                <label for="name">*Cidade</label>
                <input type="text" class="form-control" name="conta['cidade']" autofocus required >
            </div>
            <div class="form-group col-md-2">
                <label for="name">*Estado</label>
                <!--                <input type="text" class="form-control" name="empresa['estado']">-->
                <select class="form-control" name="conta['estado']" autofocus required >
					<option value="" selected="selected">Selecione</option>
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
                    <option value="PE">PE</option>
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
		 <hr />
		<h4>DADOS NÃO OBRIGATÓRIOS</h4>

        <div class="row">
			
			<div class="form-group col-md-3">
                <label for="name">Nome Fantasia</label>
                <input type="text" class="form-control" name="conta['nome_fantasia']">
            </div>            
            <div class="form-group col-md-3">
                <label for="name">Raz&atilde;o Social</label>
                <input type="text" id="razaoSocial" class="form-control" name="conta['razao_social']">
            </div>
            <div class="form-group col-md-2">
                <label for="name">CNPJ</label>
                <input type="text" id="campoCNPJ" class="form-control" name="conta['cnpj']" placeholder="00.000.000/0000-00">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Fone</label>
                <input type="tel" id="campoFONE" class="form-control" name="conta['fone']" placeholder="(00)00000-0000" >
            </div>
            <div class="form-group col-md-2">
                <label for="name">CEP</label>
                <input type="text" id="campoCEP" class="form-control" name="conta['cep']" placeholder="00000-000">
            </div>
            <div class="form-group col-md-4">
                <label for="name">Endere&ccedil;o</label>
                <input type="text" class="form-control" name="conta['endereco']">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Complemento</label>
                <input type="text" class="form-control" name="conta['complemento']">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Bairro</label>
                <input type="text" class="form-control" name="conta['bairro']">
            </div>
        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                <a href="index.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </form>
    <script type="text/javascript">
			$('#exemplo').datepicker({	
				format: "dd/mm/yyyy",	
				language: "pt-BR",
				startDate: '+0d',
			});
			$('#exemplo2').datepicker({	
				format: "dd/mm/yyyy",	
				language: "pt-BR",
				startDate: '+0d',
			});
		</script>


<?php include(FOOTER_TEMPLATE); ?>