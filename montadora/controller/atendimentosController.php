<?php
$atendimentos = null;
$atendimento = null;


function pesquisaAtendimentoTres($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $atendimentos;
    $atendimentos = pesquisa_tres_colunas('grupo_produto', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3);
}


// Listagem de atendimentos 
function findAtendimento() {	
	
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
    $atendimentos = find_atendimento('grupo_produto', 'id_empresa', 'empresas', 'id', $id_pai, $id_usuario, $id_edicao);
}

function ProcuraAtendimento() {	
	
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
    $atendimentos = find_atendimento2('grupo_produto', 'id_empresa', 'empresas', 'id','contatos', $id_pai, $id_usuario, $id_edicao);
}




function findAtendimentoId() {
	$id_pai = $_SESSION["id_pai"];
	$id_usuario = $_SESSION["id_usuario"];
    $id_empresa = $_REQUEST['id_empresa'];
	$id_edicao = $_SESSION["id_edicao"];	
	$id_atendimento = $_REQUEST['id_atendimento'];
	
	global $atendimentos;
    $atendimentos = find_atendimento_id('grupo_produto', 'id_empresa', 'empresas', 'id', $id_pai, $id_usuario, $id_edicao, $id_atendimento);
}

function salvarAtendimento(){
	
	$result = false;	 
    if (!empty($_POST['comentario'])) {
		
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$id_atendimento = $_REQUEST['id_atendimento'];
					
		$id_empresa = $_REQUEST['id_empresa'];
		$id_edicao = $_SESSION['id_edicao'];
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
		$atendimento['id_pai'] = $id_pai;
		$atendimento['id_usuario'] = $id_usuario;
		$atendimento['id_empresa'] = $id_empresa;
		$atendimento['id_edicao'] = $id_edicao;
		$atendimento['posicao'] = $posicao;
		$atendimento['proxima_data'] = $proxima_data;
		
		$agenda = $_POST['atendimento'];
		$agenda['created'] = $today->format("Y-m-d H:i:s");
        $agenda['modified'] = $agenda['created'];
		$agenda['id_pai'] = $id_pai;
		$agenda['id_usuario'] = $id_usuario;
		$agenda['id_empresa'] = $id_empresa;
		$agenda['id_edicao'] = $id_edicao;
		$agenda['comentario'] = $comentario;
		$agenda['posicao_agenda'] = $posicao;
		$agenda['proxima_data'] = $proxima_data;
			
		if($id_atendimento == 'first'):
		
		$result = save_two('grupo_produto', $atendimento, 'agenda', $agenda, 'id_atendimento');
		
		else:
		$agenda['id_atendimento'] = $id_atendimento;
		$update_agenda['status'] = 1;
		$update_atendimento['posicao'] = $posicao;
		update_columns('agenda', $id_atendimento, $update_agenda);
		update_columns('grupo_produto', $id_atendimento, $update_atendimento);
		$result = save('agenda', $agenda);
		
		endif;
		if($_REQUEST['pagina']=='atendimento'):
			echo "<script>location.href='../atendimentos/index.php';</script>";
		else:
			echo "<script>location.href='../agenda/index.php';</script>";
		endif;
	}
}