<?php
$briefings = null;
$briefing = null;
$briefingAtivos = null;
$briefingAtivo = null;


function pesquisaBriefingTres($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $briefings;
    $briefings = pesquisa_tres_colunas('briefing', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

function pesquisaBriefingPendente() {
	$id_pai = $_SESSION['id_pai'];
	$id_usuario = $_SESSION['id_usuario'];
	$condicao = " ORDER BY created ASC";
    global $briefings;
    $briefings = pesquisa_tres_colunas('briefing', 'id_projetista', $id_usuario, 'id_pai', $id_pai, 'motivo', '0', $condicao);
}

function pesquisaBriefings() {
	$id_usuario = $_SESSION['id_usuario'];
	$id_pai = $_SESSION['id_pai'];
    global $briefings;
    $briefings = pesquisa_tres_tabelas($id_pai, $id_usuario);
}

function pesquisaBriefing() {
	$id_negocio = $_REQUEST['id_negocio'];
	$condicao = "ORDER BY id ASC";
    global $briefings;
    $briefings = find_columns('briefing', 'id_grupo_produto', $id_negocio, $condicao);
}

function pesquisaBriefingAtivo($id=null) {
	$id_pai = $_SESSION['id_pai'];
	$condicao = " ORDER BY id DESC LIMIT 1";
    global $briefingAtivos;
    $briefingAtivos = pesquisa_tres_colunas('briefing', 'id_grupo_produto', $id, 'id_pai', $id_pai, 'deleted', '0', $condicao);
}

function pesquisaBriefingId($id=null) {
	$id_usuario = $_SESSION['id_usuario'];
	$id_pai = $_SESSION['id_pai'];
	$condicao = "ORDER BY id ASC";
    global $briefings;
    $briefings = pesquisa_tres_colunas('briefing', 'id_grupo_produto', $id, 'id_pai', $id_pai, 'deleted', '0', $condicao);
}

function salvarBriefing(){
	
	$result = false;	 
    if ($_REQUEST['acao']=='salvarBriefing') {
		$numero_briefing = $_REQUEST['numero_briefing'];
		if ($numero_briefing !="") {
			$numero_briefing = $_REQUEST['numero_briefing'];
		}
		else {
			$numero_briefing = '0';
		}

		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$id_negocio = $_REQUEST['id_negocio'];
		$today =
            date_create('now', new DateTimeZone('America/Recife'));
        
		$briefing = $_REQUEST['briefing'];
		$briefing['created'] = $today->format("Y-m-d H:i:s");
        $briefing['modified'] = $briefing['created'];
		$briefing['id_pai'] = $id_pai;
		$briefing['id_usuario'] = $id_usuario;
		$briefing['id_created'] = $id_usuario;
		$briefing['id_grupo_produto'] = $id_negocio;
		$briefing['numero_briefing'] =  $numero_briefing;
		
		if ($_REQUEST['id_briefing']!=""):
		    $briefing_update['modified'] = $briefing['created'];
			$briefing_update['data_finalizado'] =  $briefing['created'];
			$briefing_update['status'] =  '1';
			$briefing_update['motivo'] =  '2';
			update('briefing', $_REQUEST['id_briefing'], $briefing_update);
		endif;
		$result = save('briefing', $briefing);
		echo "<script>location.href='../negocio/index.php?id_negocio=".$_REQUEST['id_negocio']."&id_edicao=".$_REQUEST['id_edicao']."&id_empresa=".$_REQUEST['id_empresa']."     ';</script>";
	}
}