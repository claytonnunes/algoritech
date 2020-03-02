<?php 	
	require_once "functions/product.php";
	$pdoConnection = require_once "connection.php";

	if(isset($_REQUEST['acao'])):
		if ($_REQUEST['acao']=='pesquisaProduto'):
			$products = getProductsSearch($pdoConnection);
		endif; 
	else:
		$products = getProducts($pdoConnection);
	endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="ISO 8859-1">
	<title>Carrinho de Compras</title>
	<link rel="stylesheet" href="../css/manuntencao.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- MetisMenu CSS -->l
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!--css -->
	<link rel="stylesheet" type="text/css" href="jquery-autocomplete/jquery.autocomplete.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<div class="container">
	<div class="col-xs-12">
		<h4><a class="btn btn-warning" href="../eventos/eventos.php"><i class="fa fa-home fa-2x"></i> HOME</a></h4>
	</div>
	<div class="col-xs-3">
		<h4>PRODUTO</h4>
	</div>
	<div class="col-xs-9 floa" align="right">
		<a class="btn btn-primary" href="../produto2/add.php"><i class="fa fa-plus"></i> Cadastrar produto</a>
	</div>
</div>
<body>
	<div class="container">
	<table id="tabela2" class="table table-hover">
		<thead>
			<tr>
				<td>
				<h5>
					<div id="row">
						<div class="form-group col-md-4" align="left">Produto</div>
						<div class="form-group col-md-3" align="left">Medida</div>
						<div class="form-group col-md-2" align="left" >Estoque</div>
						<div class="form-group col-md-2" align="left" >Preço</div>
						<div class="form-group col-md-1" align="left" >Ação</div>
					</div>
				</h5>
				</td>
			</tr>
		</thead>
		<tbody>
			<div class="row">
				<?php foreach($products as $product) : ?>
					<tr>
					<td>
						<div class="col-sm-4 text-left">
							<?php echo $product['nome_produto'];?>
						</div>
						<div class="col-sm-3 text-left">
							<?php echo $product['medida'];?>
						</div>
						<div class="col-sm-2 text-left">
							<?php echo $product['estoque'];?>
						</div>
						<div class="col-sm-2 text-left">
							R$<?php echo number_format($product['valor_locacao'], 2, ',', '.')?>
						</div>
						<div class="col-sm-1 text-left">
							<a class="btn btn-success" href="
							<?php echo "../cotacao/carrinho.php?acao=add&id=".$product['id']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto'].""; ?>" class="card-link"><i class="fa fa-shopping-cart"></i> Alugar</a>
						</div>
					</td>
					</tr>
				<?php endforeach;?>
			</div>
		</tbody>
	</table>

	</div>
	
</body>
</html>


<header>
<div class="container">
	<div class="col-sm-6 text-right">
		<form class="form-inline" id="navbar-form" name="form1" method="post" action="
		
		
		
		<?php echo "../cotacao/index2.php?acao=pesquisaProduto&id=".$product['id']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto'].""; ?>">
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
<hr>
