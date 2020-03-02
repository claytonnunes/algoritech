<!-- MODAL NOVO NEGÓCIO -->
<div class="modal fade" id="modalNovaEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalNovaEmpresaLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalNovaEmpresaLabel">Curso</h4>
            </div>
            <div class="modal-body">
            <form method="POST" action="<?php echo BASEURL."empresas/index.php?acao=salvarEmpresa" ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Nome Fantasia (Obrigatório)</label>
                    <input name="nome_fantasia" type="text" class="form-control" value="" required>
                </div>
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Fone empresa (Obrigatório)</label>
                    <input name="fone" type="text" class="form-control" id="campoFONE2" value="" placeholder="(99) 9999-9999" required>
                </div>
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Nome contato (Obrigatório)</label>
                    <input name="contato['nome']" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Fone contato (Obrigatório)</label>
                    <input name="fone2" type="text" class="form-control" id="campoFONE3" value="" placeholder="(99) 9999-9999" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">E-mail contato</label>
                    <input name="contato['email']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Site</label>
                    <input name="empresa['website']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Celular contato</label>
                    <input name="celular" type="text" class="form-control" id="campoCEL" placeholder="(99)9 9999-9999">
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Instagram contato</label>
                    <input name="contato['instagram']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Função contato</label>
                    <input name="contato['funcao']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Razão social</label>
                    <input name="empresa['razao_social']" type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">CNPJ</label>
                    <input name="cnpj" type="text" class="form-control" id="campoCNPJ" placeholder="00.000.000/0000-00">
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Instagram empresa</label>
                    <input name="empresa['instagram']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-5">
                    <label for="recipient-name" class="control-label">Endereço</label>
                    <input name="empresa['endereco']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Complemento</label>
                    <input name="empresa['complemento']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-3">
                    <label for="recipient-name" class="control-label">Bairro</label>
                    <input name="empresa['bairro']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">Cidade</label>
                    <input name="empresa['cidade']" type="text" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                    <label>Estado</label>  
                    <select name="empresa['estado']" class="form-control"  value="" >  
					<option value="" selected>Selecione</option>
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
                <div class="form-group col-md-4">
                    <label for="recipient-name" class="control-label">CEP</label>
                    <input name="cep" type="text" class="form-control" id="campoCEP" placeholder="00000-000">
                </div>
				<input name="negocio['id_empresa']" type="hidden" class="form-control" id="get-id" value="">
                <!--Footer-->
                <div class="modal-footer"   >
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
            </form>
            </div>
            
        </div>
    </div>
</div>
                