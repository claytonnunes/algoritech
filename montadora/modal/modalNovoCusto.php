<!-- MODAL NOVO NEGÓCIO -->
<div class="modal fade" id="modalNovoCusto" tabindex="-1" role="dialog" aria-labelledby="modalNovoCustoLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalNovoCustoLabel">Curso</h4>
            </div>
            <div class="modal-body">
            <form method="POST" action="<?php echo BASEURL."empresas/index.php?acao=salvarNegocio" ?>" enctype="multipart/form-data">
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">descrição:</label>
                    <input name="negocio['nome']" type="text" class="form-control" value="" required>
                </div>
				<div class="form-group col-md-6">
                    <label>Fornecedor: </label>  
                    <select name="negocio['id_edicao']" class="form-control" value="" required>  
					<option value="" selected>Selecione</option>
                    <?php 
					pesquisaEdicaoCadastrado();
					if ($eventos):
						foreach($eventos as $evento):
					?>
                    <option value="<?php echo $evento['id_edicao'];?>"><?php echo $evento['nome_edicao'];?></option>
					<?php 
						endforeach;
					endif;
					?>
                    </select>  
                </div> 
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Valor estimado:</label>
                    <input name="valor_estimado" type="text" class="form-control" id="valor" value="" placeholder="R$ 0,00" required>
                </div>
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Expectativa de conclusão:</label>
                    <input name="expectativa_conclusao" type="text" class="form-control" id="campoDATE1" value="" placeholder="00/00/0000" required>
                </div>
				<div class="form-group col-md-6">
                    <label>Canal captação:</label>  
                    <select name="negocio['canal_captacao']" class="form-control"  value="" required>  
					<option value="" selected>Selecione</option>
                    <option value="1">Cliente ativo</option>
                    <option value="2">Lista expositor</option>
                    <option value="3">Indicação promotora</option>
					<option value="4">Outras indicações</option>
					<option value="4">Instagram</option>
					<option value="4">Site</option>	
					</select>  
                </div>
				<div class="form-group col-md-6">
                    <label>Potencial:</label>  
                    <select name="negocio['potencial_vendas']" class="form-control"  value="" required>  
					<option value="" selected>Selecione</option>
                    <option value="1">Baixo</option>
                    <option value="2">Médio</option>
                    <option value="3">Alto</option>
					</select>  
                </div>
				<div class="form-group col-md-6">
                    <label>Estágio:</label>  
                    <select name="negocio['estagio']" class="form-control"  value="" required>  
					<option value="" selected>Selecione</option>
                    <option value="1">Captação</option>
                    <option value="2">Proposta enviada</option>
                    <option value="3">Negociando contrato</option>
					</select>  
                </div>
				<input name="negocio['id_empresa']" type="hidden" class="form-control" id="get-id" value="">
                <!--Footer-->
                <div class="modal-footer"   >
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </form>
            </div>
            
        </div>
    </div>
</div>
                