<?php
$agendas = null;
$agenda = null;
$atendimentos = null;
$atendimento = null;

// Listagem de Agenda 
function pesquisaAgendaUsuario($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null)  {	
	global $agendas;
	$agendas = pesquisa_tres_colunas('agenda', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

// Listagem de Agenda 
function pesquisaAgenda() {	
	
	$id_pai = $_SESSION["id_pai"];
	if (isset($_REQUEST['filter'])):
		if($_REQUEST['filter']=='salesman'):
		$id_usuario = $_REQUEST['id_salesman'];
		endif;
	else:
		$id_usuario = $_SESSION["id_usuario"];
	endif;	
	global $atendimentos;
    $atendimentos = pesquisa_relacional_tres('grupo_produto', 'id_empresa', 'empresas', 'id', $id_pai, $id_usuario);
}

function pesquisaAgendaTemporaria() {	
	
	$id_pai = $_SESSION["id_pai"];
	if (isset($_REQUEST['filter'])):
		if($_REQUEST['filter']=='salesman'):
		$id_usuario = $_REQUEST['id_salesman'];
		endif;
	else:
		$id_usuario = $_SESSION["id_usuario"];
	endif;	
	global $atendimentos;
    $atendimentos = pesquisa_temporaria('grupo_produto', 'id_empresa', 'empresas', 'id', $id_pai, $id_usuario);
}