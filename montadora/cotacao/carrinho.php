<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/cotacaoController.php');
require_once('../controller/produtoController.php');

if ($_REQUEST['id_grupo_produto']=="") {
	$_SESSION['message'] = 'SELECIONE UMA NEGOCIAÇÃO PARA INICIAR A COTAÇÃO.';
	$_SESSION['type'] = 'danger';
	$_SESSION['time_message'] = time();
	echo "<script>location.href='../negocio/index.php?mensagem=semIdNegocio&id_atendimento=".$_REQUEST['id_atendimento']."&id_empresa=".$_REQUEST['id_empresa']."&id_negocio=".$_REQUEST['id_grupo_produto']."';</script>";
}

if (!isset($_SESSION['numero_cotacao']) OR ($_SESSION['numero_cotacao']=='0') ):
	$condicao = 'ORDER BY numero_cotacao DESC LIMIT 1';
	pesquisaCotacao('id_pai', $_SESSION['id_pai'],'deleted', '0','id_grupo_produto', $_REQUEST['id_grupo_produto'], $condicao);
	if($cotacoes):
		foreach($cotacoes as $cotacao):
			$numeroCotacao = $cotacao['numero_cotacao'];
			$cotacaoFinalizada = $cotacao['cotacao_finalizada'];
		endforeach;
		if($cotacaoFinalizada == '1'):
			$_SESSION['numero_cotacao'] = $cotacao['numero_cotacao']+1;	
		else:
			$_SESSION['numero_cotacao'] = $cotacao['numero_cotacao'];
		endif;
	else:
		$_SESSION['numero_cotacao'] = '1';
	endif;
endif;

if (isset($_REQUEST['acao'])) :
	if ($_REQUEST['acao']=='salvar_produto_carrinho'):
		$idGrupoProduto = $_REQUEST['id_grupo_produto'];
		$condicao = 'ORDER BY id_cotacao ASC';
		pesquisaCotacao('id_produto', $_REQUEST['id_produto'],'cotacao_finalizada', '0','id_grupo_produto', $idGrupoProduto, $condicao);
		if ($cotacoes) : 
			$_SESSION['message'] = 'O produto selecionado já está no carrinho!';
			$_SESSION['type'] = 'danger';
			$_SESSION['time_message'] = time();
		else:
			salvarProdutoCarrinho();
		endif;
		
	endif;
	if ($_REQUEST['acao']=='atualizarCarrinho') :
		$_SESSION['metro_quadrado'] = $_REQUEST['metro_quadrado'];
		atualizarCarrinho();
	endif;
	if ($_REQUEST['acao']=='deletarCotacao') :
		deletaCotacao();
	endif;
endif;
pesquisaCotacao('id_pai', $_SESSION['id_pai'],'cotacao_finalizada', '0','id_grupo_produto', $_REQUEST['id_grupo_produto'], 'ORDER BY id_cotacao DESC');
		
?>              
<header>
<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
<?php 
	if((time() - $_SESSION['time_message'])>1): unset($_SESSION['message']); endif; 
	if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
<?php endif; ?>
<hr>
<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->

<form id="formCarrinho" name="formCarrinho" action="<?php echo "../cotacao/carrinho.php?acao=atualizarCarrinho&id_cotacao=".$cotacao["id_cotacao"]."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto'].""; ?>" method="post">
<div class="container">
	<div class="col-xs-3">
		<h4>CARRINHO</h4>
	</div>
	<div class="col-xs-9 float" align="right">
			<a class="btn btn-warning" href="<?php echo "../cotacao/index.php?acao=pesquisaProduto&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto']."" ?>" class="card-link"><i class="fa fa-shopping-cart"></i> Continuar comprando</a>
			<button type="submit" class="btn btn-primary" id="salvar"><i class="fa fa-refresh"></i> Atualizar carrinho</button>
			<button type="submit" class="btn btn-success" name="finalizar_compra" value="1" id="salvar"><i class="fa fa-check"></i> Finalizar locação</button>
			<a href="<?php echo BASEURL; ?>negocio/index.php?id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_negocio=<?php echo $_REQUEST['id_grupo_produto']; ?>" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Voltar</a>
			
	</div>
</div>
<hr>
	<div class="container">
		<h5>
			<div id="row">
				<div class="form-group col-md-2" align="left">Produto</div>
				<div class="form-group col-md-1" align="left">Quant.</div>
				<div class="form-group col-md-1" align="left"></div>
				<div class="form-group col-md-1" align="left" >Valor unid.</div>
				<div class="form-group col-md-2" align="left" >Subtotal</div>
				<div class="form-group col-md-2" align="left" >Desconto unid.</div>
				<div class="form-group col-md-2" align="left" >Total</div>
				<div class="form-group col-md-1" align="left" >Ação</div>
			</div>
		</h5>
	</div>	
	<div class="container">
		<table id="tabela2" class="table table-hover">
			<tbody>
				<?php	
				if ($cotacoes) : 
					
					foreach ($cotacoes as $cotacao) :
						$quantidade = $cotacao['quantidade'];
						$valorUnidade = $cotacao['valor_unidade'];
						$descontoUnidade = $cotacao['valor_desconto'];
						$somaDescontoQuantidade = $descontoUnidade * $quantidade;
						
						$somaDescontoTotal += $somaDescontoQuantidade;

						$subTotal = $valorUnidade * $quantidade;
						
						$valorUnidadeTotal = $subTotal - $somaDescontoQuantidade;

						$somaTotal += $subTotal;
						$somaTotalCobrado  = $somaTotal - $somaDescontoTotal;

						if(isset($_SESSION['metro_quadrado'])):
							$metroQuadrado = $_SESSION['metro_quadrado'];
						else:
							$metroQuadrado = '0';
						endif;
						$valorMetroQuadrado = $somaTotalCobrado / $metroQuadrado;
						
						$unidadeMedida = $cotacao['unidade_medida']; 
						if ($unidadeMedida == 1):
							$unidadeMedida = 'unid.';
						elseif ($unidadeMedida == 2):
							$unidadeMedida = 'm2';
						elseif ($unidadeMedida == 3):
							$unidadeMedida = 'mL';
						else:
							$unidadeMedida = 'indefinido'; 
						endif;
				?>
					<tr>
						<div class="container">
							<div id="row col-md-12">
							<input type="hidden" class="form-control" name="id_cotacao[]" value="<?php echo $cotacao['id_cotacao']; ?>">
								<div class="form-group col-md-2" align="left"><?php echo $cotacao['nome_produto']; ?></div>
								<div class="form-group col-md-1" align="right"><input type="text" class="form-control" id="quantidade" name="quantidade[<?php echo $cotacao['id_cotacao']; ?>]" value="<?php echo $cotacao['quantidade']; ?>"></div>
								<div class="form-group col-md-1" align="left"><?php echo $unidadeMedida; ?></div>
								<div class="form-group col-md-1" align="left" ><?php echo number_format($valorUnidade, 2, ',', '.'); ?></div>
								<div class="form-group col-md-2" align="left" ><?php echo number_format($subTotal, 2, ',', '.'); ?></div>
								<div class="form-group col-md-2" align="left" ><input type="text" class="form-control" id="desconto" name="desconto[<?php echo $cotacao['id_cotacao']; ?>]" value="<?php echo $descontoUnidade; ?>"></div>
								<div class="form-group col-md-2" align="left" ><?php echo number_format($valorUnidadeTotal, 2, ',', '.'); ?></div>
								<div class="form-group col-md-1" align="left" >
								<a class="btn btn-danger" href="
								<?php echo "../cotacao/carrinho.php?acao=deletarCotacao&id_cotacao=".$cotacao["id_cotacao"]."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto'].""; ?>" class="card-link"><i class="fa fa-trash"></i> Remover</a>
								</div>
							</div>
						</div>
					</tr>
				<?php
					endforeach; 
				endif; 
				?>
			</tbody>
		</table>
	</div>
	<hr>
	<div id="row">
		<div class="form-group col-md-5" align="left">
			<div class="form-group col-md-5" align="left">Valor total: </div>
			<div class="form-group col-md-7" align="left">R$ <?php echo number_format($somaTotal, 2, ',', '.'); ?></div>
			<div class="form-group col-md-5" align="left">Valor desconto: </div>
			<div class="form-group col-md-7" align="left">R$ <?php echo number_format($somaDescontoTotal, 2, ',', '.'); ?></div>
			<div class="form-group col-md-12" align="left"><hr></div>
			<div class="form-group col-md-5" align="left"><i class="fa fa-usd"></i> Valor cobrado: </div>
			<div class="form-group col-md-7" align="left">R$ <?php echo number_format($somaTotalCobrado, 2, ',', '.'); ?></div>
			<div class="form-group col-md-5" align="left"><i class="fa fa-exclamation"></i> valor m2: </div>
			<div class="form-group col-md-7" align="left">R$ <?php echo number_format($valorMetroQuadrado, 2, ',', '.'); ?></div>
			<div class="form-group col-md-5" align="left"> insira o m2: </div>
			<div class="form-group col-md-7" align="left">
			<input type="text" class="form-control" id="metro_quadrado" name="metro_quadrado" value="<?php echo $metroQuadrado; ?>">
			</div>
			
						
		</div>
		<div class="form-group col-md-2" align="left">
		</div>
		<div class="form-group col-md-5" align="left">
			<div class="form-group col-md-5" align="left">Sub produto: </div>
			<div class="form-group col-md-7" align="left"><?php echo $_REQUEST['id_grupo_produto']; ?></div>
			<div class="form-group col-md-5" align="left">Cliente: </div>
			<div class="form-group col-md-7" align="left"><?php echo $_REQUEST['id_empresa']; ?></div>
			<div class="form-group col-md-5" align="left">Evento: </div>
			<div class="form-group col-md-7" align="left"><?php echo $_SESSION['nome_edicao']; ?></div>
		</div>
	</div>	
</form>
<?php include(FOOTER_TEMPLATE); ?>