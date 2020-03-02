<?php
$logs = null;
$log = null;

function pesquisaLogTres($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $logs;
    $logs = pesquisa_tres_colunas('log', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}
function salvarLog($valor=null){
	
	$result = false;	 
    if (isset($valor)) {
		
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$today =
            date_create('now', new DateTimeZone('America/Recife'));
        
		$log['created'] = $today->format("Y-m-d H:i:s");
        $log['modified'] = $log['created'];
		$log['id_pai'] = $id_pai;
		$log['id_created'] = $id_usuario;
		$log['acao'] = $valor;
		
		$result = save('log', $log);
	}
}
?>