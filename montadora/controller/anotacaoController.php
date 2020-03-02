<?php
$anotacoes = null;
$anotacao = null;


function salvarAnotacao(){
	
	$result = false;	 
    if (!empty($_POST['tarefa'])) {
		
		$idPai = $_SESSION["id_pai"];
		$idUsuario = $_SESSION["id_usuario"];
        
        $idNegocio = $_REQUEST['id_negocio'];
		$idEmpresa = $_REQUEST['id_empresa'];
		$idEdicao = $_REQUEST['id_edicao'];
        
		$today = date_create('now', new DateTimeZone('America/Recife'));
		
		$agenda = $_POST['tarefa'];
        
        $agenda['created'] = $today->format("Y-m-d H:i:s");
        $agenda['modified'] = $agenda['created'];
        
        $agenda['id_pai'] = $idPai;
		$agenda['id_usuario'] = $idUsuario;
        
        $agenda['id_empresa'] = $idEmpresa;
        $agenda['id_edicao'] = $idEdicao;
        $agenda['id_negocio'] = $idNegocio;
		
        $agenda['status'] = 0;
        $agenda['tarefa'] = 9;
		$result = save('agenda', $agenda);
        
        echo "<script>location.href='../negocio/index.php?id_negocio=".$_REQUEST['id_negocio']."&id_edicao=".$_REQUEST['id_edicao']."&id_empresa=".$_REQUEST['id_empresa']."';</script>";
		
	}
}