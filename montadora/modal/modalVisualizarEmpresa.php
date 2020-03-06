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
                 <div class="row">
                <div class="form-group col-md-6">
                    <label for="nome_fantasia">Nome da Empresa</label><br>
                    <label for="nome_fantasia" id="nome_fantasia"><?php echo $empresa['nome_fantasia']; ?></label>
                </div>
				<div class="form-group col-md-6">
                    <label for="fone-empresa" class="control-label">Fone empresa (Obrigatório)</label><br>
                    <label for="fone-empresa" id="campoFONE" class="control-label"><?php echo $empresa['fone']; ?></label>
                </div>
				<div class="form-group col-md-6">
                    <label for="contato" class="control-label">Nome contato (Obrigatório)</label><br>
                    <label for="contato" id="contato" class="control-label"><?php echo $empresa['contato']; ?></label>
                </div>
                <div class="form-group col-md-6">
                    <label for="fone" class="control-label">Fone contato (Obrigatório)</label><br>
                    <label for="fone" class="control-label"><?php echo $empresa['fone']; ?></label>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label for="email" class="control-label">E-mail contato</label><br>
                    <label for="email" class="control-label"><?php echo $empresa['email']; ?></label>
                </div>
                <div class="form-group col-md-6">
                    <label for="website" class="control-label">Site</label><br>
                    <label for="website" class="control-label"><?php echo $empresa['website']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="celular" class="control-label">Celular contato</label><br>
                    <label for="celular" class="control-label"><?php echo $empresa['celular']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="instagram" class="control-label">Instagram contato</label><br>
                    <label for="instagram" class="control-label"><?php echo $empresa['instagram']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="Função contato" class="control-label">Função contato</label><br>
                    <label for="Função contato" class="control-label">Função contato</label>
                </div>
                <div class="form-group col-md-4">
                    <label for="razao_social" class="control-label">Razão social</label><br>
                    <label for="razao_social" class="control-label"><?php echo $empresa['razao_social']; ?></label>
                    
                </div>
                <div class="form-group col-md-4">
                    <label for="cnpj" class="control-label">CNPJ</label><br>
                    <label for="cnpj" class="control-label"><?php echo $empresa['cnpj']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="Instagram_empresa" class="control-label">Instagram empresa</label><br>
                    <label for="Instagram_empresa" class="control-label">Instagram empresa</label>
                </div>
                <div class="form-group col-md-5">
                    <label for="endereco" class="control-label">Endereço</label><br>
                    <label for="endereco" class="control-label"><?php echo $empresa['endereco']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="complemento" class="control-label">Complemento</label><br>
                    <label for="complemento" class="control-label"><?php echo $empresa['complemento']; ?></label>
                </div>
                <div class="form-group col-md-3">
                    <label for="bairro" class="control-label">Bairro</label><br>
                    <label for="bairro" class="control-label"><?php echo $empresa['bairro']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="cidade" class="control-label">Cidade</label><br>
                    <label for="cidade" class="control-label"><?php echo  $empresa['cidade']; ?></label>
                </div>
                <div class="form-group col-md-4">
                    <label> Estado </label><br>
                    <label><?php echo $empresa['estado']; ?></label>
                                     
                </div>
                <div class="form-group col-md-4">
                    <label for="cep" class="control-label">CEP</label><br>
                    <label for="cep" class="control-label"><?php echo $empresa['cep']; ?></label>
                </div>
				<input name="negocio['id_empresa']" type="hidden" class="form-control" id="get-id" value="">
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