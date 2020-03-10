<div class="modal fade" id="modalEdita" tabindex="-1" role="dialog" aria-labelledby="modalEditaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="modalEditaLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <script>
        jQuery(function($){
			$("#campoFONE").mask("(99) 9999-9999");
            $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
        });
    </script>
      <div class="modal-body">
      <form method="POST" action="<?php echo "index.php?acao=editarContatoEmpresa&nome_fantasia=".$_REQUEST['nome_fantasia']."" ?>" enctype="multipart/form-data">
        <div class="row">
         <input name="id" type="hidden" class="form-control" id="get-id" value="">
        <div class="form-group col-md-6">
                <label for="name">Nome Fantasia</label>
                <input type="text" class="form-control" name="nome_fantasia"  id="nome_fantasia" value="<?php echo $empresa['nome_fantasia']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Razão Social</label>
                <input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo $empresa['razao_social']; ?>">
            </div>  
            <div class="form-group col-md-6">
                <label for="name">* Fone</label>
                <input type="tel" class="form-control" name="fone" id="campoFONE" value="<?php echo $empresa['fone']; ?>" required >
            </div>      
            <div class="form-group col-md-6">
                <label for="name">CNPJ</label>
                <input type="text"  class="form-control" name="cnpj" id="campoCNPJ" value="<?php echo $empresa['cnpj']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="name">CEP</label>
                <input type="text"  class="form-control" name="cep" id="campoCEP" value="<?php echo $empresa['cep']; ?>">
            </div>
        </div>
        <div class="row">
        <div class="form-group col-md-6">
                <label for="name">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo $empresa['endereco']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Complemento</label>
                <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $empresa['complemento']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Bairro</label>
                <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $empresa['bairro']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Cidade</label>
                <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo  $empresa['cidade']; ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Estado</label>
<!--                <input type="text" class="form-control" name="empresa['estado']" value="--><?php //echo $empresa['estado']; ?><!--">-->
                <select class="form-control" id="selected" name="empresa['estado']">
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
        	<div class="form-group col-md-6">
                <label for="name">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="<?php echo $empresa['website']; ?>">
            </div>
        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                
            
            </div>
        </div>
    
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary" name="editarContatoEmpresa" >Salvar</button>
        </div>
    </div>
    </form>
  </div>
</div>