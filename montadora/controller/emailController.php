<?php
$atendimentos = null;
$atendimento = null;
/**
 *  Listagem de atendimentos
 */
 
 /*
function index() {
    global $atendimentos;
    $atendimentos = find_all('atendimentos');
}
*/

function findAgenda() {
	$id_conta = $_SESSION["id_conta_vendas"];
	if (isset($_REQUEST['filter'])):
		if($_REQUEST['filter']=='salesman'):
		$id_usuario = $_REQUEST['id_salesman'];
		endif;
	else:
		$id_usuario = $_SESSION["id_usuario_vendas"];
	endif;	
	
	
	$id_edicao = $_SESSION["sess_edition_vendas"];  
	global $atendimentos;
    $atendimentos = find_all('atendimentos');
	// $atendimentos = find_atendimento('atendimentos', 'id_empresa', 'empresas', 'id', $id_conta, $id_usuario, $id_edicao);
}

function findAtendimentoId() {
	$id_conta = $_SESSION["id_conta_vendas"];
	$id_usuario = $_SESSION["id_usuario_vendas"];
    $id_empresa = $_REQUEST['id_empresa'];
	$id_edicao = $_SESSION["sess_edition_vendas"];	
	$id_atendimento = $_REQUEST['id_atendimento'];
	
	global $atendimentos;
    $atendimentos = find_atendimento_id('atendimentos', 'id_empresa', 'empresas', 'id', $id_conta, $id_usuario, $id_edicao, $id_atendimento);
}

function salvarAtendimento(){
	
	$result = false;	 
    if (!empty($_POST['comentario'])) {
		
		$id_conta = $_SESSION["id_conta_vendas"];
		$id_usuario = $_SESSION["id_usuario_vendas"];
		$id_atendimento = $_REQUEST['id_atendimento'];
					
		$id_empresa = $_REQUEST['id_empresa'];
		$id_evento = $_SESSION['sess_fair_vendas'];
		$id_edicao = $_SESSION['sess_edition_vendas'];
		$comentario = $_REQUEST['comentario'];
		$posicao = $_REQUEST['posicao'];
		
		$proxima_data = $_REQUEST['proxima_data'];
		$explode = explode('/' ,$proxima_data);
		$proxima_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
		$today =
            date_create('now', new DateTimeZone('America/Recife'));
        
		$atendimento = $_POST['atendimento'];
		$atendimento['created'] = $today->format("Y-m-d H:i:s");
        $atendimento['modified'] = $atendimento['created'];
		$atendimento['id_conta'] = $id_conta;
		$atendimento['id_usuario'] = $id_usuario;
		$atendimento['id_empresa'] = $id_empresa;
		$atendimento['id_evento'] = $id_evento;
		$atendimento['id_edicao'] = $id_edicao;
		$atendimento['posicao'] = $posicao;
		$atendimento['proxima_data'] = $proxima_data;
		
		$agenda = $_POST['atendimento'];
		$agenda['created'] = $today->format("Y-m-d H:i:s");
        $agenda['modified'] = $agenda['created'];
		$agenda['id_conta'] = $id_conta;
		$agenda['id_usuario'] = $id_usuario;
		$agenda['id_empresa'] = $id_empresa;
		$agenda['id_evento'] = $id_evento;
		$agenda['id_edicao'] = $id_edicao;
		$agenda['comentario'] = $comentario;
		$agenda['posicao_agenda'] = $posicao;
		$agenda['proxima_data'] = $proxima_data;
		
		


		if($id_atendimento == 'first'):
		$result = save_two('atendimentos', $atendimento, 'agenda', $agenda, 'id_atendimento');
		
		else:
		$agenda['id_atendimento'] = $id_atendimento;
		$update_agenda['status'] = 1;
		$update_atendimento['posicao'] = $posicao;
		update_columns('agenda', $id_atendimento, $update_agenda);
		update_columns('atendimentos', $id_atendimento, $update_atendimento);
		$result = save('agenda', $agenda);
		
		endif;
		header("location: ../atendimentos/index.php");
	}
}