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
editarEmpresa();
?>
    <script>
        jQuery(function($){
			$("#campoFONE").mask("(99) 9999-9999");
            $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
        });
    </script>

    <h2>Atualizar Empresa</h2>

    <form action="edit.php?id=<?php echo $empresa['id']; ?>" method="post">
        <hr />
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome Fantasia</label>
                <input type="text" class="form-control" name="nome_fantasia" value="<?php echo $empresa['nome_fantasia']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Razão Social</label>
                <input type="text" class="form-control" name="razao_social" value="<?php echo $empresa['razao_social']; ?>">
            </div>  
            <div class="form-group col-md-2">
                <label for="name">* Fone</label>
                <input type="tel" id="campoFONE" class="form-control" name="empresa['fone']" value="<?php echo $empresa['fone']; ?>" required >
            </div>      
            <div class="form-group col-md-2">
                <label for="name">CNPJ</label>
                <input type="text" id="campoCNPJ" class="form-control" name="empresa['cnpj']" value="<?php echo $empresa['cnpj']; ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">CEP</label>
                <input type="text" id="campoCEP" class="form-control" name="empresa['cep']" value="<?php echo $empresa['cep']; ?>">
            </div>
        </div>
        <div class="row">
        	<div class="form-group col-md-4">
                <label for="name">Endereço</label>
                <input type="text" class="form-control" name="endereco" value="<?php echo $empresa['endereco']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="name">Complemento</label>
                <input type="text" class="form-control" name="complemento" value="<?php echo $empresa['complemento']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="name">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="<?php echo $empresa['bairro']; ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Cidade</label>
                <input type="text" class="form-control" name="cidade" value="<?php echo  $empresa['cidade']; ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Estado</label>
<!--                <input type="text" class="form-control" name="empresa['estado']" value="--><?php //echo $empresa['estado']; ?><!--">-->
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
                    <option value="PE">PE</option>
                    <option value="<?php echo $empresa['estado']; ?>" selected="selected"><?php echo $empresa['estado']; ?></option>
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
        	<div class="form-group col-md-4">
                <label for="name">Website</label>
                <input type="text" class="form-control" name="website" value="<?php echo $empresa['website']; ?>">
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