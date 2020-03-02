<?php
$negociacoes = null;
$negociacao = null;

function searchNegocio() {
	$idPai = $_SESSION['id_pai'];
	$pesquisa = $_REQUEST['pesquisa_tudo'];
	global $negociacoes;
	$negociacoes = pesquisaJoinLike($idPai, $pesquisa);
}

function pesquisaNegocio($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $negociacoes;
	$negociacoes = pesquisa_tres_colunas('grupo_produto', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

function salvarNegocio(){

$result = false;	 
	if ($_REQUEST['acao']=='salvarNegocio') {
	$expectativaConclusao = $_REQUEST['expectativa_conclusao'];
	$explode = explode('/' ,$expectativaConclusao);
	$expectativaConclusao = "".$explode[2]."-".$explode[1]."-".$explode[0];

	$valorEstimado = $_REQUEST['valor_estimado'];	
	$valorEstimado =  str_replace(',','.', str_replace('.','', $valorEstimado));
	
	$soma_string = strlen($valorEstimado); 	
			if ($soma_string < 12){

			$id_pai = $_SESSION["id_pai"];
			$id_usuario = $_SESSION["id_usuario"];
			$today = date_create('now', new DateTimeZone('America/Recife'));
							
			$negocio = $_REQUEST['negocio'];
			$negocio['created'] = $today->format("Y-m-d H:i:s");
			$negocio['modified'] = $negocio['created'];
			$negocio['valor_estimado'] = $valorEstimado;
			$negocio['expectativa_conclusao'] = $expectativaConclusao;
			$negocio['id_pai'] = $id_pai;
			$negocio['id_created'] = $id_usuario;
			$negocio['id_usuario'] = $id_usuario;
			$negocio['id_negociador'] = $id_usuario;
			$negocio['status'] = "0";
			$negocio['deleted'] = "0";
			
			$result = save('grupo_produto', $negocio);

			echo "<script>location.href='../negocio/index.php?id_negocio=indefinido';</script>";
		}
		else{
		$_SESSION['message'] = 'o valor não pode ser maior que R$ 99.999.999,99!';
		$_SESSION['type'] = 'danger';
		$_SESSION['time_message'] = time();

		echo "<script>location.href='../empresas/index.php?';</script>";	
		}
	}
}

function ganharNegocio() {
	if (isset($_REQUEST['acao'])) {
		if ($_REQUEST['acao']=='ganharNegocio') {
			$now = date_create('now', new DateTimeZone('America/Recife'));
			$idNegociacao = $_REQUEST['id_negocio'];
			$negociacao['status'] = '1';
			$negociacao['modified'] = $now->format("Y-m-d H:i:s");
			update('grupo_produto', $idNegociacao, $negociacao);
		echo "<script>location.href='index.php?id_negocio={$_REQUEST['id_negocio']}&id_edicao={$_REQUEST['id_edicao']}&id_empresa={$_REQUEST['id_empresa']}&id_atendimento={$_REQUEST['id_atendimento']}';</script>";
	}
 	} else {
  	echo "<script>location.href='index.php';</script>";
    }
}

function perderNegocio() {
	if (isset($_REQUEST['acao'])) {
		if ($_REQUEST['acao']=='perderNegocio') {
			$now = date_create('now', new DateTimeZone('America/Recife'));
			$idNegociacao = $_REQUEST['id_negocio'];
			$negociacao['status'] = '2';
			$negociacao['modified'] = $now->format("Y-m-d H:i:s");
			update('grupo_produto', $idNegociacao, $negociacao);
		echo "<script>location.href='index.php?id_negocio={$_REQUEST['id_negocio']}&id_edicao={$_REQUEST['id_edicao']}&id_empresa={$_REQUEST['id_empresa']}&id_atendimento={$_REQUEST['id_atendimento']}';</script>";
	}
 	} else {
  	echo "<script>location.href='index.php';</script>";
    }
}

function editarNegociacao() {
	if (isset($_REQUEST['acao'])) {
		if ($_REQUEST['acao']=='editar_negociacao') {
			$idEmpresa = $_REQUEST['id_empresa'];
			$idAtendimento = $_REQUEST['id_atendimento'];
			$now = date_create('now', new DateTimeZone('America/Recife'));
			$idNegociacao = $_REQUEST['id_negociacao'];
			$negociacao['nome'] = $_REQUEST['nome_negociacao'];
			$negociacao['modified'] = $now->format("Y-m-d H:i:s");
			update('grupo_produto', $idNegociacao, $negociacao);
		echo "<script>location.href='./add.php?acao=editar&id_empresa=$idEmpresa&id_atendimento=$idAtendimento';</script>";
	}
	//header('location: ./add.php?acao=editar&id_empresa='.$_REQUEST['id_empresa'].'&id_atendimento='.$_REQUEST['id_atendimento'].'');
    } else {
       // header('location: ./index.php');
		echo "<script>location.href='./index.php';</script>";
    }
}

?>