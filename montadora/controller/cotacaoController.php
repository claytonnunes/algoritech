<?php
$cotacoes = null;
$cotacao = null;

function pesquisaNumeroCotacao($coluna = null, $coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $cotacoes;
    $cotacoes = pesquisa_distinta('cotacao', $coluna, $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

function pesquisaCotacao($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $cotacoes;
    $cotacoes = pesquisa_tres_colunas('cotacao', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

function pesquisaCarrinho() {
	$id_pai = $_SESSION['id_pai'];
	$idGrupoProduto = $_REQUEST['id_grupo_produto'];
	global $cotacoes;
    $cotacoes = pesquisa_cotacao_produto($id_pai, $idGrupoProduto);
}

function salvarProdutoCarrinho() {
	$result = false;	 
	global $cotacoes;
	if (isset($_REQUEST['acao'])) :
		if($_REQUEST['acao']=='salvar_produto_carrinho'):
			$id_grupo_produto = $_REQUEST["id_grupo_produto"];

			$produtos = pesquisa_tres_colunas('produto', 'id', $_REQUEST["id_produto"], 'id_pai', $_SESSION['id_pai'],'deleted', '0');
			if ($produtos) {
				foreach ($produtos as $produto) {
					$nomeProduto = $produto['nome_produto'];
					$descricao = $produto['descricao'];
					$unidadeMedida = $produto['unidade_medida'];
					$medida = $produto['medida'];
					$valorUnidade = $produto['valor_locacao'];
					$idCategoria = $produto['id_categoria'];
				}
			}
			
			$id_pai = $_SESSION["id_pai"];
			$numeroCotacao = $_SESSION["numero_cotacao"];
			$id_usuario = $_SESSION["id_usuario"];
			$today =
				date_create('now', new DateTimeZone('America/Recife'));
            $cotacao['created'] = $today->format("Y-m-d H:i:s");
			$cotacao['modified'] = $cotacao['created'];
			$cotacao['id_pai'] = $id_pai;
			$cotacao['numero_cotacao'] = $numeroCotacao;
			$cotacao['id_created'] = $id_usuario;
			$cotacao['id_grupo_produto'] = $id_grupo_produto;
			$cotacao['id_produto'] = $_REQUEST['id_produto'];
			$cotacao['quantidade'] = '1';

			$cotacao['descricao'] = $descricao;
			$cotacao['valor_unidade'] = $valorUnidade;

			$cotacao['nome_produto'] = $nomeProduto;
			$cotacao['unidade_medida'] = $unidadeMedida;
			$cotacao['medida'] = $medida;
			$cotacao['id_categoria'] = $idCategoria;
			
			$result = save('cotacao', $cotacao);
			header('location: ../cotacao/carrinho.php?acao=verCarrinho&id_empresa='.$_REQUEST['id_empresa'].'&id_atendimento='.$_REQUEST['id_atendimento'].'&id_grupo_produto='.$_REQUEST['id_grupo_produto'].'');
		endif;
	endif;
}

function atualizarCarrinho() {
    if (isset($_REQUEST['acao'])) :
		if ($_REQUEST['acao']=='atualizarCarrinho') :
			$_conexao = mysqli_connect( 'localhost', 'root', 'Blaster631xd', 'gestor_evento' );
			
			$idEmpresa = $_REQUEST['id_empresa'];
			$idAtendimento = $_REQUEST['id_atendimento'];
			$idGrupoProduto = $_REQUEST['id_grupo_produto'];
			$idCotacao = $_REQUEST['id_cotacao']; 
			$quantidade = $_REQUEST['quantidade'];
			$desconto = $_REQUEST['desconto'];
			$finalizarCompra = 0;
			if($_REQUEST['finalizar_compra']):
				$finalizarCompra = $_REQUEST['finalizar_compra'];
			endif;

			foreach ($quantidade as $key => $value) {
				$items .= trim($key, "'") . " <<<---key    value--->'$value',";
		
			}
			//print_r($items);
				//$products =  implode(',', array_keys($quantidade));
				$products = rtrim($quantidade, ',');
			
			
			foreach ($_POST['quantidade'] as $id_cotacao => $key) :
				if (is_numeric($id_cotacao) && is_numeric($key)):
					$query = "UPDATE cotacao SET quantidade = '$key' 
					, cotacao_finalizada = '$finalizarCompra' 
					WHERE id_cotacao = '$id_cotacao'";
					$sql = mysqli_query($_conexao, $query);
				endif;
			endforeach;

			foreach ($_POST['desconto'] as $idCotacao => $key) :
				if (is_numeric($idCotacao) && is_numeric($key)):

					$query = "UPDATE cotacao SET valor_desconto = '$key'
					WHERE id_cotacao = '$idCotacao'";
					$sql = mysqli_query($_conexao, $query);
				endif;
			endforeach;
			if($_REQUEST['finalizar_compra']>0):
				echo "<script>location.href='../negocio/index.php?id_atendimento=".$_REQUEST['id_atendimento']."&id_empresa=".$_REQUEST['id_empresa']."&id_negocio=".$_REQUEST['id_grupo_produto']."';</script>";
			endif;
			//echo "<script>location.href='../cotacao/carrinho.php?acao=verCarrinho&id_empresa=$idEmpresa&id_atendimento=$idAtendimento&id_grupo_produto=$idGrupoProduto';</script>";
			// header('location: ../cotacao/carrinho.php?acao=verCarrinho&id_empresa='.$_REQUEST['id_empresa'].'&id_atendimento='.$_REQUEST['id_atendimento'].'&id_grupo_produto='.$_REQUEST['id_grupo_produto'].'');
		endif;
    endif;
}

function deletaCotacao() {
    if (isset($_REQUEST['acao'])) :
		if ($_REQUEST['acao']=='deletarCotacao') :
			$now = date_create('now', new DateTimeZone('America/Recife'));
			$idEmpresa = $_REQUEST['id_empresa'];
			$idAtendimento = $_REQUEST['id_atendimento'];
			$idGrupoProduto = $_REQUEST['id_grupo_produto'];


			$id = $_REQUEST['id_cotacao'];
			$cotacao['modified'] = $now->format("Y-m-d H:i:s");
			$cotacao['cotacao_finalizada'] = '1';
			$cotacao['deleted'] = '1';
			$cotacao['status'] = '1';
			
			update_variaveis('cotacao', 'id_cotacao', $id, $cotacao);

			echo "<script>location.href='../cotacao/carrinho.php?acao=verCarrinho&id_empresa=$idEmpresa&id_atendimento=$idAtendimento&id_grupo_produto=$idGrupoProduto';</script>";
			
			// header('location: ../cotacao/carrinho.php?acao=verCarrinho&id_empresa='.$_REQUEST['id_empresa'].'&id_atendimento='.$_REQUEST['id_atendimento'].'&id_grupo_produto='.$_REQUEST['id_grupo_produto'].'');
		endif;
    endif;
}