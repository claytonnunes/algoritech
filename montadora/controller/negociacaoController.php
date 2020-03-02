<?php
$negociacoes = null;
$negociacao = null;

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