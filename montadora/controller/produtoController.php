<?php
$grupo_produtos = null;
$grupo_produto = null;
$produtos = null;
$produto = null;
$categorias = null;
$categoria = null;
$produtos_nome = null;
$produto_nome = null;

function pesquisaProdutoNome($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null) {
	global $produtos;
	$produtos = pesquisa_like('produto', $coluna1, $valor1, $coluna2, $valor2);
}

function pesquisaProduto() {
	global $produtos;
	$valor1 = $_SESSION['id_pai'];
	$produtos = pesquisa_tres_colunas('produto', 'id_pai', $valor1, 'deleted', '0', 'status', '0');
}

function pesquisaProdutoTres($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $grupo_produtos;
    $grupo_produtos = pesquisa_tres_colunas('grupo_produto', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3);
}

function pesquisaGrupoProduto($id=null) {
	$id_usuario = $_SESSION['id_usuario'];
	$id_pai = $_SESSION['id_pai'];
    global $grupo_produtos;
	$grupo_produtos = pesquisa_tres_colunas('grupo_produto', 'id_atendimento', $id, 'id_pai', $id_pai, 'deleted', '0');
	//$grupo_produtos = pesquisa_tres_colunas('grupo_produto', 'id_atendimento', $id, 'id_pai', $id_pai, 'id_usuario', $id_usuario);
}

function salvarNegocioProduto(){
	$result = false;	 
    if ($_REQUEST['acao']=='salvarNegocio') {
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$id_atendimento = $_REQUEST['id_atendimento'];
		$today = date_create('now', new DateTimeZone('America/Recife'));
        
		$grupo_produto = $_REQUEST['negocio'];
		$grupo_produto['created'] = $today->format("Y-m-d H:i:s");
        $grupo_produto['modified'] = $grupo_produto['created'];
		$grupo_produto['id_pai'] = $id_pai;
		$grupo_produto['id_usuario'] = $id_usuario;
		$grupo_produto['id_created'] = $id_usuario;
		$grupo_produto['id_atendimento'] = $id_atendimento;
		
		$result = save('grupo_produto', $grupo_produto);
		echo "<script>location.href='../negocio/index.php?id_atendimento=".$_REQUEST['id_atendimento']."&id_empresa=".$_REQUEST['id_empresa']."';</script>";
	}
}

function salvarGrupoProduto(){
	$result = false;	 
    if ($_REQUEST['acao']=='salvarGrupo') {
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$id_atendimento = $_REQUEST['id_atendimento'];
		$today =
            date_create('now', new DateTimeZone('America/Recife'));
        
		$grupo_produto = $_REQUEST['grupo_produto'];
		$grupo_produto['created'] = $today->format("Y-m-d H:i:s");
        $grupo_produto['modified'] = $grupo_produto['created'];
		$grupo_produto['id_pai'] = $id_pai;
		$grupo_produto['id_usuario'] = $id_usuario;
		$grupo_produto['id_created'] = $id_usuario;
		$grupo_produto['id_atendimento'] = $id_atendimento;
		
		$result = save('grupo_produto', $grupo_produto);
		echo "<script>location.href='../briefing/view.php?acao=verGrupo&id_atendimento=".$_REQUEST['id_atendimento']."&id_empresa=".$_REQUEST['id_empresa']."';</script>";
	}
}
function salvarProduto(){
	$result = false;	 
	if (isset($_REQUEST['acao'])) :
		if($_REQUEST['acao']=='salvarProduto'):
			$valor_locacao = $_REQUEST['valor_locacao'];	
			$valor_locacao =  str_replace(',','.', str_replace('.','', $valor_locacao));
			$valor_compra = $_REQUEST['valor_compra'];	
			$valor_compra =  str_replace(',','.', str_replace('.','', $valor_compra));
			$id_pai = $_SESSION["id_pai"];
			$id_usuario = $_SESSION["id_usuario"];
			$today =
				date_create('now', new DateTimeZone('America/Recife'));
			
			$produto = $_REQUEST['produto'];
			$produto['created'] = $today->format("Y-m-d H:i:s");
			$produto['modified'] = $produto['created'];
			$produto['id_pai'] = $id_pai;
			$produto['id_created'] = $id_usuario;
			$produto['valor_compra'] = $valor_compra;
			$produto['valor_locacao'] = $valor_locacao;
			
			$result = save('produto', $produto);
			header('location: ../produto2/index.php');
		endif;
	endif;
}

function pesquisaCategoria($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $categorias;
	$condicao = 'ORDER BY nome_categoria ASC';
    $categorias = pesquisa_tres_colunas('categoria_produto', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

function salvarCategoria(){
	$result = false;	 
	global $categoria;
	if (isset($_REQUEST['acao'])) :
		if($_REQUEST['acao']=='salvarCategoria'):
			$id_pai = $_SESSION["id_pai"];
			$id_usuario = $_SESSION["id_usuario"];
			$today =
				date_create('now', new DateTimeZone('America/Recife'));
			
			$categoria['nome_categoria'] = $_REQUEST['nome_categoria'];
			$categoria['created'] = $today->format("Y-m-d H:i:s");
			$categoria['modified'] = $categoria['created'];
			$categoria['id_pai'] = $id_pai;
			$categoria['id_created'] = $id_usuario;
			
			$result = save('categoria_produto', $categoria);
			header('location: ../produto2/add.php');
		endif;
	endif;
}

function editarProduto() {
	$now = date_create('now', new DateTimeZone('America/Recife'));
	$valorCompra =  str_replace(',','.', str_replace('.','', $_REQUEST['valor_compra']));
	$valorLocacao =  str_replace(',','.', str_replace('.','', $_REQUEST['valor_locacao']));
    if ($_REQUEST['idProduto']!="") {
	    $id = $_REQUEST['idProduto'];
        if (isset($_POST['produto'])) {
	        $produto = $_POST['produto'];
            $produto['modified'] = $now->format("Y-m-d H:i:s");
			$produto['valor_compra'] = $valorCompra;
			$produto['valor_locacao'] = $valorLocacao;

			update('produto', $id, $produto);
			echo "<script>location.href='index.php?acao=pesquisaProduto&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$_REQUEST['id_grupo_produto']."';</script>";	
	   
		} else {
		    global $produto;
            $produto = find('produto', $id);
        }
    } else {
		echo "<script>location.href='index.php?acao=pesquisaProduto&id_empresa=8361&id_atendimento=1588&id_grupo_produto=2';</script>";	
    }
}
?>