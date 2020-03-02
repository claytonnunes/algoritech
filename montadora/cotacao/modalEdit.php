<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Curso</h4>
            </div>
            <div class="modal-body">
            <form method="POST" action="<?php echo "index.php?acao=editarProduto&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto']."" ?>" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Nome:</label>
                    <input name="produto['nome_produto']" type="text" class="form-control" id="get-nome">
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Medida:</label>
                    <input name="produto['medida']" type="text" class="form-control" id="get-medida">
                </div>
                <div class="form-group col-md-12">
                    <label for="recipient-name" class="control-label">descrição:</label>
                    <textarea name="produto['descricao']" class="form-control" id="get-descricao"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Estoque minimo:</label>
                    <input name="produto['estoque']" type="text" class="form-control" id="get-estoque">
                </div>
                <div class="form-group col-md-6">
                    <label>Unid. de medida:</label>  
                    <select name="produto['unidade_medida']" class="form-control" id="get-unidademedida" required>  
                    <option value="1">Unidade</option>
                    <option value="2">Metro quadrado</option>
                    <option value="3">Metro linear</option>
					</select>  
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Valor compra:</label>
                    <input name="valor_compra" type="text" class="form-control" id="get-valorcompra">
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Valor locação:</label>
                    <input name="valor_locacao" type="text" class="form-control" id="get-valorlocacao">
                </div>
                <div class="form-group col-md-12">
                    <label>Categoria</label>  
                    <select name="produto['id_categoria']" class="form-control" id="get-idcategoria" required>  
                    <?php 
					pesquisaCategoria('id_pai', $_SESSION['id_pai'],'deleted', '0','status', '0');
					if ($categorias):
						foreach($categorias as $categoria):
					?>
                    <option value="<?php echo $categoria['id'];?>"><?php echo $categoria['nome_categoria'];?></option>
					<?php 
						endforeach;
					endif;
					?>
                    </select>  
                </div>  

                <input name="idProduto" type="hidden" class="form-control" id="get-id" value="">
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
                