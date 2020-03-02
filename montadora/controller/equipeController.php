<?php
$equipes = null;
$equipe = null;

/**
 *  Listagem de equipes
 */
function pesquisaEquipe() {
	$id_edicao = $_SESSION["id_edicao"];
    global $equipes;
	$equipes = find_columns('equipe', 'id_pai', $_SESSION['id_pai']);
	//$equipes = find_columns('equipe', 'id_edicao', $id_edicao);
}


// Listagem de atendimentos 
function pesquisaEquipeBackup() {	
	
	$id_pai = $_SESSION["id_pai"];
	if (isset($_REQUEST['filter'])):
		if($_REQUEST['filter']=='salesman'):
		$id_usuario = $_REQUEST['id_salesman'];
		endif;
	else:
		$id_usuario = $_SESSION["id_usuario"];
	endif;	
	
	
	$id_edicao = $_SESSION["id_edicao"];  
	global $atendimentos;
    $atendimentos = pesquisa_equipe_usuario('atendimentos', 'id_empresa', 'empresas', 'id', $id_pai, $id_usuario, $id_edicao);
}
?>