<!-- MODAL NOVO NEGÓCIO -->
<div class="modal fade" id="modalVisualizarEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarEmpresaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="modalVisualizarEmpresaLabel"><?php echo $empresa['id']; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row align-items-start">
                <div class="form-group col-md-6">
                        <label for="nome_fantasia">Nome da Empresa</label><br>
                        <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo $empresa['nome_fantasia']; ?>" disabled>
                </div>
				    <div class="form-group col-md-6">
                        <label for="fone-empresa" class="control-label">Fone empresa (Obrigatório)</label><br>
                        <input type="tel" id="campoFONE" class="form-control" name="empresa['fone']" value="<?php echo $empresa['fone']; ?>" disabled >
                    </div>
			    </div>
            <div class="row align-items-start">
                <div class="form-group col-md-6">
                    <label for="email" class="control-label">E-mail contato</label><br>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $empresa['email']; ?>" disabled>
                </div>
                    <div class="form-group col-md-6">
                        <label for="website" class="control-label">Site</label><br>
                        <input type="text" class="form-control" name="website" id="website" value="<?php echo $empresa['website']; ?>" disabled>
                    </div>
                     <div class="form-group col-md-4">
                        <label for="razao_social" class="control-label">Razão social</label><br>
                        <input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo $empresa['razao_social']; ?>" disabled>
                </div>
                <div class="form-group col-md-4">
                        <label for="cnpj" class="control-label">CNPJ</label><br>
                        <input type="text" class="form-control" name="empresa['cnpj']" id="campoCNPJ" data-mask="000.000.000/00000" value="<?php echo $empresa['cnpj']; ?>" disabled>
                </div>
                <div class="form-group col-md-4">
                        <label for="endereco" class="control-label">Endereço</label><br>
                        <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo $empresa['endereco']; ?>" disabled>
                </div>
                <div class="form-group col-md-4">
                        <label for="complemento" class="control-label">Complemento</label><br>
                        <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $empresa['complemento']; ?>" disabled>
                </div>
                <div class="form-group col-md-3">
                        <label for="bairro" class="control-label">Bairro</label><br>
                        <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $empresa['bairro']; ?>" disabled>
                </div>
                <div class="form-group col-md-4">
                        <label for="cidade" class="control-label">Cidade</label><br>
                        <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $empresa['cidade']; ?>" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label> Estado </label><br>
                    <input type="text" class="form-control" name="selected" id="selected" value="<?php echo $empresa['selected']; ?>" disabled>
                </div>
                <div class="form-group col-md-3">
                        <label for="cep" class="control-label">CEP</label><br>
                        <input type="text" class="form-control" name="empresa['cep']" id="campoCEP" value="<?php echo $empresa['cep']; ?>" disabled>
                </div>
				<input name="negocio['id_empresa']" type="hidden" class="form-control" id="visualiza" value="">
                <!--Footer-->
                <div class="modal-footer"   >
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            </form>
            </div>
            
        </div>
    </div>
</div>                