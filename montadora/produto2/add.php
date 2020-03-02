<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/produtoController.php');
if (isset($_REQUEST['acao'])) :
	if($_REQUEST['acao']=='salvarProduto'):
		salvarProduto();
	elseif($_REQUEST['acao']=='salvarCategoria'):
		salvarCategoria();
	endif;
endif;
?>
<header>
	<div class="container">
		<div class="col-xs-3">
			<h4>PRODUTO</h4>
		</div>
		<form id="formCategoria" name="formCategoria" action="add.php?acao=salvarCategoria" method="post">
		<div class="col-xs-5 floa" align="right">
			<input type="text" class="form-control" name="nome_categoria" placeholder="Ex: MÓVEIS, VITRINE, BALCÃO..." required >
		</div>
		<div class="col-xs-2 floa" align="left">
			<button type="submit" class="btn btn-success" id="salvar">
			<i class="fa fa-plus" aria-hidden="true"></i> salvar categoria</button>
		</div>
		<div class="col-xs-2 floa" align="right">
			<a class="btn btn-primary" href="<?php echo BASEURL; ?>produto2/index.php"><i class="fa fa-eye"></i> Visualisar produto</a>
		</div>
		</form>
	</div>
	<hr>
	<form id="formProduto" name="formProduto" action="add.php?acao=salvarProduto" method="post">
		<div class="row">
			<div class="form-group col-md-5">
                <label for="name">Produto</label>
                <input type="text" class="form-control" name="produto['nome_produto']" placeholder="Ex: MESA, CADEIRA, BALCÃO VITRINE..." required >
            </div>
			<div class="form-group col-md-5">
                <label for="name">Descrição</label>
                <input type="text" class="form-control" name="produto['descricao']" placeholder="Ex: MESA REDONDA COM TAMPO DE VIDRO" required >
            </div>
			<div class="form-group col-md-2">
                <label for="name">Estoque</label>
                <input type="text" class="form-control" name="produto['estoque']" placeholder="Ex: 12" required >
            </div>
			<div class="form-group col-md-4">
                <label for="name">Medida</label>
                <input type="text" class="form-control" name="produto['medida']" placeholder="Ex: 1m x 0,50m x 1m LxPxA" required >
            </div>
			<div class="form-group col-md-2">
                <label for="name">Categoria</label>
                <select class="form-control" name="produto['id_categoria']">
                    <option value="" selected="selected">Selecione</option>
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
			<div class="form-group col-md-2">
                <label for="name">Unidade de cobrança</label>
                <select class="form-control" name="produto['unidade_medida']">
                    <option value="" selected="selected">Selecione</option>
                    <option value="1">unidade</option>
					<option value="2">metro quadrado</option>
                    <option value="3">metro linear</option>
                </select>
            </div>
			<div class="form-group col-md-2">
				<label for="name">Valor compra</label>
				<input type="text" class="form-control" id="valor1" name="valor_compra" required >
			</div> 
			<div class="form-group col-md-2">
				<label for="name">Valor locação</label>
				<input type="text" class="form-control" id="valor2" name="valor_locacao"  required >
			</div> 
		</div>
		<div class="row">
			<div class="form-group col-md-12" align="left" >
				<h4>
				<div class="form-group col-md-12" align="left" >
					<i class="fa fa-upload" aria-hidden="true"></i> Inserir foto
				</div>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<button type="submit" class="btn btn-success" id="salvar">Salvar</button>
				<a href="javascript:history.back()" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Voltar</a>
			</div>
		</div>
	</form>
	<script type="text/javascript">+$("#valor1").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
	<script type="text/javascript">+$("#valor2").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
<?php include(FOOTER_TEMPLATE); ?>