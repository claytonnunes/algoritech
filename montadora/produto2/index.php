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
		if ($_REQUEST['pesquisaProduto']!="") {
			pesquisaProduto();
		}
		else {
			pesquisaProdutoNome('nome_produto', $_REQUEST['nome_produto'], 'id_pai', $_SESSION['id_pai']);
		}
		
	}
}
?>              
<header>
<div class="container">
	<div class="col-xs-1">
		<h4>PRODUTO</h4>
	</div>
	<div class="col-xs-11 text-right">
		<div class="container col-sm-12">
			<div class="col-sm-6 text-right">
				<form class="form-inline" id="navbar-form" name="form1" method="post" action="
				<?php echo "index.php?acao=pesquisaProdutoNome"; ?>">
				<label for="PesquisaProduto"></label>
				<input class="form-control form-control-sm mr-3 w-75" type="text" name="nome_produto" id="nome_produto" size="40" placeholder="Pesquisar" value="<?php 
				if(isset($_REQUEST['acao'])):
					if ($_REQUEST['acao']=='pesquisaProduto'):
					echo $_REQUEST['nome_produto']; endif; endif;?>" aria-label="Pesquisar"/> 
				<i class="fa fa-search" aria-hidden="true"></i>
				</form>
			</div>
			<div class="col-sm-6 text-right">
				<div class="btn-group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Categoria <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
					<?php if ($vendedores) : ?>
					<?php foreach ($vendedores as $vendedor) : ?>
					<li><a href="<?php echo BASEURL; ?><?php echo
					"index.php?pesquisar=categoria&id_categoria=". $vendedor['id']; ?>"><?php echo $vendedor['nome_usuario']; ?></a></li>
					<?php
					endforeach;
					endif;
					?>
					</ul>
				</div>
				<a class="btn btn-primary" href="<?php echo BASEURL; ?>produto2/add.php"><i class="fa fa-plus"></i> Novo produto</a>
			</div>
		</div>
	</div>
</div>
<div id="divConteudo2">
	<table id="tabela2" class="table table-hover">
		<thead>
			<tr>
				<td>
				<h4>
					<div id="row">
						<div class="form-group col-md-1" align="left">Cod.</div>
						<div class="form-group col-md-2" align="left">Produto</div>
						<div class="form-group col-md-4" align="left" >Descrição</div>
						<div class="form-group col-md-3" align="left" >Categoria</div>
						<div class="form-group col-md-1" align="left" ></div>
					</div>
				</h4>
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
							<div class="form-group col-md-1" align="left"><?php echo $produto['id']; ?></div>
							<div class="form-group col-md-3" align="left"><?php echo $produto['nome_produto']; ?></div>
							<div class="form-group col-md-4" align="left" ><?php echo $produto['descricao']; ?></div>
							<div class="form-group col-md-1" align="left" ><?php echo $produto['id_categoria']; ?></div>
							<div class="form-group col-md-3" align="left" >
							<a href="#" class="btn btn-sm btn-danger">
							<i class="fa fa-trash"></i> Excluir</a>
							<a href="../produto2/edit.php?id_produto=<?php echo $produto['id']; ?>" class="btn btn-sm btn-warning">
							<i class="fa fa-pencil"></i> Editar</a>
							<a href="<?php echo BASEURL; ?>produto2/view.php?id_produto=<?php echo $produto['id']; ?>" class="btn btn-sm btn-success">
							<i class="fa fa-eye"></i> Visualizar</a>
							</div>
						</div>
					</td>         
				</tr>
			<?php
				endforeach; 
			endif; 
			?>
		</tbody>
	</table>
<?php include(FOOTER_TEMPLATE); ?>