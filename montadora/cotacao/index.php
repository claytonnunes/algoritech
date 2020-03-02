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
if (isset($_REQUEST['acao'])) {
	if ($_REQUEST['acao']=='pesquisaProduto') {
		pesquisaProduto();
	}
	elseif ($_REQUEST['acao']=='pesquisaProdutoNome') {
		pesquisaProdutoNome('nome_produto', $_REQUEST['nome_produto'], 'id_pai', $_SESSION['id_pai']);
	}

}
if ($_REQUEST['acao']=='editarProduto') {
	editarProduto();
}
?>
<header>
<div class="container">
	<div class="col-sm-6 text-right">
		<form class="form-inline" id="navbar-form" name="form1" method="post" action="
		<?php echo "../cotacao/index.php?acao=pesquisaProdutoNome&id=".$product['id']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto'].""; ?>">
		<label for="PesquisaProduto"></label>
		<input class="form-control form-control-sm mr-3 w-75" type="text" name="nome_produto" id="nome_produto" size="40" placeholder="Pesquisar" value="<?php 
		if(isset($_REQUEST['acao'])):
			if ($_REQUEST['acao']=='pesquisaProduto'):
			echo $_REQUEST['nome_produto']; endif; endif;?>" aria-label="Pesquisar"/> 
		<i class="fa fa-search" aria-hidden="true"></i>
		</form>
	</div>
	<div class="col-sm-6 text-right">
	</div>
</div>
<div class="container">
	<div class="col-xs-3">
		<h4>PRODUTO</h4>
	</div>
	<div class="col-xs-9 floa" align="right">
		<a class="btn btn-primary" href="<?php echo BASEURL; ?>produto2/add.php"><i class="fa fa-plus"></i> Novo produto</a>
	</div>
</div>
<div class="container">
	<table id="tabela2" class="table table-hover">
		<thead>
			<tr>
				<td>
				<h5>
					<div id="row">
						<div class="form-group col-md-4" align="left">Produto</div>
						<div class="form-group col-md-2" align="left">Medida</div>
						<div class="form-group col-md-1" align="left" >Estoque</div>
						<div class="form-group col-md-2" align="left" >Preço</div>
						<div class="form-group col-md-3" align="left" >Ação</div>
					</div>
				</h5>
				</td>
			</tr>
		</thead>
		<tbody>
			<?php	
			if ($produtos) : 
				foreach ($produtos as $produto) : 
			?>
				<tr>
					<td>
						<div id="row">
							<div class="form-group col-md-4" align="left"><?php echo $produto['nome_produto']; ?></div>
							<div class="form-group col-md-2" align="left"><?php echo $produto['medida']; ?></div>
							<div class="form-group col-md-1" align="left" ><?php echo $produto['estoque']; ?></div>
							<div class="form-group col-md-2" align="left" ><?php echo number_format($produto['valor_locacao'], 2, ',', '.'); ?></div>
							<div class="form-group col-md-3" align="left" >
							<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal<?php echo $produto['id']; ?>">Visualizar</button>
							<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" 
							data-send-id="<?php echo $produto['id']; ?>" 
							data-send-nome="<?php echo $produto['nome_produto']; ?>"
							data-send-estoque="<?php echo $produto['estoque']; ?>"
							data-send-descricao="<?php echo $produto['descricao']; ?>"
							data-send-unidademedida="<?php echo $produto['unidade_medida']; ?>"
							data-send-valorcompra="<?php echo  number_format( $produto['valor_compra'], 2, ',', '.');?>"
							data-send-valorlocacao="<?php echo  number_format( $produto['valor_locacao'], 2, ',', '.');?>"
							data-send-idcategoria="<?php echo $produto['id_categoria']; ?>"
							data-send-medida="<?php echo $produto['medida']; ?>">Editar</button>
							<a class="btn btn-xs btn-success" href="
							<?php echo "../cotacao/carrinho.php?acao=salvar_produto_carrinho&id_produto=".$produto['id']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto'].""; ?>" class="card-link"><i class="fa fa-shopping-cart"></i> Alugar</a>
							</div>
						</div>
					</td>         
				</tr>
				<!-- MODAL DE VISUALIZAÇÃO -->
				<?php include('modalView.php');?>
			<?php
				endforeach; 
			endif; 
			?>
		</tbody>
	</table>
	<!-- MODAL DE EDIÇÃO -->
	<?php include('modalEdit.php');?>
	
    <script type="text/javascript">
		$('#exampleModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			
			var id = button.data('send-id') 
			var nomeproduto = button.data('send-nome')
			var medida = button.data('send-medida')
			var estoque = button.data('send-estoque')
			var descricao = button.data('send-descricao')
			var unidademedida = button.data('send-unidademedida')
			var valorcompra = button.data('send-valorcompra')
			var valorlocacao = button.data('send-valorlocacao')
			var idcategoria = button.data('send-idcategoria')

			var modal = $(this)
			modal.find('.modal-title').text('Codigo do produto: ' + id)
			modal.find('#get-nome').val(nomeproduto)
			modal.find('#get-id').val(id)
			modal.find('#get-medida').val(medida)
			modal.find('#get-estoque').val(estoque)
			modal.find('#get-descricao').val(descricao)
			modal.find('#get-unidademedida').val(unidademedida)
			modal.find('#get-valorcompra').val(valorcompra)
			modal.find('#get-valorlocacao').val(valorlocacao)
			modal.find('#get-idcategoria').val(idcategoria)
		})
	</script>
	 <script type="text/javascript">+$("#get-valorlocacao").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
	 <script type="text/javascript">+$("#get-valorcompra").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>



<?php include(FOOTER_TEMPLATE); ?>