<?php
$tarefas = null;
$tarefa = null;

// Listagem de Agenda 
function pesquisaTarefa($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null)  {	
	global $agendas;
	$agendas = pesquisa_tres_colunas('agenda', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}


function salvarTarefa(){
	
	$result = false;	 
    if (!empty($_POST['tarefa'])) {
		
		$idPai = $_SESSION["id_pai"];
		$idUsuario = $_SESSION["id_usuario"];
        
        $idNegocio = $_REQUEST['id_negocio'];
		$idEmpresa = $_REQUEST['id_empresa'];
		$idEdicao = $_REQUEST['id_edicao'];
        
		$dataTarefa = $_REQUEST['data_tarefa'];
		$explode = explode('/' ,$dataTarefa);
		$dataTarefa = "".$explode[2]."-".$explode[1]."-".$explode[0];
		$today = date_create('now', new DateTimeZone('America/Recife'));
		
		$agenda = $_POST['tarefa'];
        
        $agenda['created'] = $today->format("Y-m-d H:i:s");
        $agenda['modified'] = $agenda['created'];
        
        $agenda['id_pai'] = $idPai;
		$agenda['id_usuario'] = $idUsuario;
        
        $agenda['id_empresa'] = $idEmpresa;
        $agenda['id_edicao'] = $idEdicao;
        $agenda['id_negocio'] = $idNegocio;
		
		$agenda['proxima_data'] = $dataTarefa;
		$agenda['status'] = 0;
		$result = save('agenda', $agenda);
        
        echo "<script>location.href='../negocio/index.php?id_negocio=".$_REQUEST['id_negocio']."&id_edicao=".$_REQUEST['id_edicao']."&id_empresa=".$_REQUEST['id_empresa']."';</script>";
		
	}
}