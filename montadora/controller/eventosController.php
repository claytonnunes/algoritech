<?php
$eventos = null;
$evento = null;
$equipes = null;
$equipe = null;

function pesquisaEdicaoId($valor = null) {
	$id_pai = $_SESSION["id_pai"];
		global $eventos;
	$eventos = pesquisa_tres_colunas('evento_edicao', 'id', $valor, 'id_pai', $id_pai, 'deleted', '0' );
}

function findEventoId() {
	$id_pai = $_SESSION["id_pai"];	
    global $eventos;
    $eventos = find_eventos('evento_edicao', 'id_evento', 'eventos', 'id', $id_pai);
}

function findEvento() {
	$id_pai = $_SESSION["id_pai"];
    global $eventos;
    $eventos = find_eventos('evento_edicao', 'id_evento', 'eventos', 'id', $id_pai);
}
function pesquisaEvento() {
	$id_pai = $_SESSION["id_pai"];
    global $eventos;
    $eventos = find_columns('eventos', 'id_pai', $id_pai);
}
function pesquisaEdicao() {
	$id_pai = $_SESSION["id_pai"];
	$data_hoje = date ("Y-m-d H:i:s"); 
	$condicao = "AND fim_evento >= '".$data_hoje."' ORDER BY inicio_evento ASC";
	//$condicao = "ORDER BY inicio_evento ASC";
    global $eventos;
    $eventos = find_columns('evento_edicao', 'id_pai', $id_pai, $condicao);
}

function pesquisaEquipeIdEdicao() {
	$id_usuario = $_SESSION["id_usuario"];
	global $equipes;
    $equipes = find_columns('equipe', 'id_usuario', $id_usuario);
	
}

function pesquisaEdicaoCadastrado() {
		$id_usuario = $_SESSION['id_usuario'];
		$id_pai = $_SESSION['id_pai'];
		global $eventos;
		$eventos = pesquisa_relacional($id_pai, $id_usuario);	
}


function pesquisaEdicaoSimples() {
	$id_usuario = $_SESSION["id_usuario"];

	global $equipes;
    $equipes = find_columns('equipe', 'id_usuario', $id_usuario);
	if ($equipes):
	
		foreach ($equipes as $equipe) :
			$id_edicao= $equipe['id_edicao'];
				endforeach;
		global $eventos;
		
		$eventos = find_columns('evento_edicao', 'id', $id_edicao);	
		
	else:
		$eventos = false;
		$pagina = true;
	endif;				
}

function salvarEvento(){
	$result = false;
    if (!empty($_POST['evento'])) {
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$id_conta = $_REQUEST['id_conta'];

        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $evento = $_POST['evento'];
		$edicao = $_POST['edicao'];
        //$edicao = $_POST['edicao'];
		$inicio_evento = $_REQUEST['inicio_evento'];
		$explode = explode('/' ,$inicio_evento);
		$inicio_evento = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$fim_evento = $_REQUEST['fim_evento'];
		$explode = explode('/' ,$fim_evento);
		$fim_evento = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$inicio_montagem = $_REQUEST['inicio_montagem'];
		$explode = explode('/' ,$inicio_montagem);
		$inicio_montagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$fim_montagem = $_REQUEST['fim_montagem'];
		$explode = explode('/' ,$fim_montagem);
		$fim_montagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$inicio_desmontagem = $_REQUEST['inicio_desmontagem'];
		$explode = explode('/' ,$inicio_desmontagem);
		$inicio_desmontagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$fim_desmontagem = $_REQUEST['fim_desmontagem'];
		$explode = explode('/' ,$fim_desmontagem);
		$fim_desmontagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		
        $evento['created'] = $today->format("Y-m-d H:i:s");
        $evento['modified'] = $evento['created'];
		$evento['id_pai'] = $id_pai;
		$evento['id_created'] = $id_usuario;
		$evento['id_conta'] = $id_conta;
		
		
		$edicao['created'] = $today->format("Y-m-d H:i:s");
        $edicao['modified'] = $edicao['created'];
		$edicao['id_pai'] = $id_pai;
		$edicao['id_conta'] = $id_conta;
		
		$edicao['id_created'] = $id_usuario;
		
		$edicao['inicio_evento'] = $inicio_evento;
		$edicao['fim_evento'] = $fim_evento;
		//$edicao['inicio_montagem'] = $inicio_montagem;
		//$edicao['fim_montagem'] = $fim_montagem;
		//$edicao['inicio_desmontagem'] = $inicio_desmontagem;
		//$edicao['fim_desmontagem'] = $fim_desmontagem;
		
		
    	$result = save_two('eventos', $evento, 'evento_edicao', $edicao, 'id_evento');
		//header('location: ../eventos/eventos.php');
		echo "<script>location.href='../eventos/eventos.php';</script>";	
  
    }
}
function salvarEdicao(){
    $result = false;
	if (!empty($_POST['id_evento'])) {
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$id_conta = $_REQUEST['id_conta'];
		$id_evento = $_REQUEST['id_evento'];
		$nome_edicao = $_REQUEST['nome_edicao'];

        $today =
            date_create('now', new DateTimeZone('America/Recife'));
		$edicao = $_POST['edicao'];
		$inicio_evento = $_REQUEST['inicio_evento'];
		$explode = explode('/' ,$inicio_evento);
		$inicio_evento = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$fim_evento = $_REQUEST['fim_evento'];
		$explode = explode('/' ,$fim_evento);
		$fim_evento = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$inicio_montagem = $_REQUEST['inicio_montagem'];
		$explode = explode('/' ,$inicio_montagem);
		$inicio_montagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$fim_montagem = $_REQUEST['fim_montagem'];
		$explode = explode('/' ,$fim_montagem);
		$fim_montagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$inicio_desmontagem = $_REQUEST['inicio_desmontagem'];
		$explode = explode('/' ,$inicio_desmontagem);
		$inicio_desmontagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$fim_desmontagem = $_REQUEST['fim_desmontagem'];
		$explode = explode('/' ,$fim_desmontagem);
		$fim_desmontagem = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
		$edicao['created'] = $today->format("Y-m-d H:i:s");
        $edicao['modified'] = $edicao['created'];
		$edicao['id_pai'] = $id_pai;
		$edicao['id_conta'] = $id_conta;
		$edicao['id_evento'] = $id_evento;
		$edicao['id_created'] = $id_usuario;
		
		$edicao['inicio_evento'] = $inicio_evento;
		$edicao['fim_evento'] = $fim_evento;
		//$edicao['inicio_montagem'] = $inicio_montagem;
		//$edicao['fim_montagem'] = $fim_montagem;
		//$edicao['inicio_desmontagem'] = $inicio_desmontagem;
		//$edicao['fim_desmontagem'] = $fim_desmontagem;
		
		$result = save('evento_edicao', $edicao);
		//header('location: ../eventos/eventos.php'); 
		echo "<script>location.href='../eventos/eventos.php';</script>";
    }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function editarEvento() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['evento'])) {
            $evento = $_POST['evento'];
            $evento['modified'] = $now->format("Y-m-d H:i:s");
            update('eventos', $id, $evento);
           // header('location: index.php');
			echo "<script>location.href='index.php';</script>";
        } else {
            global $evento;
            $evento = find('eventos', $id);
        }
    } else {
        //header('location: index.php');
		echo "<script>location.href='index.php';</script>";
    }
}

/**
 *  Visualização de uma evento
 */
function visualizarEvento($id = null) {
    global $evento;
    $evento = find('eventos', $id);
}
/**
 *  Exclusão de uma evento
 */
function excluirEvento($id = null) {
    global $evento;
    $evento = remove('eventos', $id);
    //header('location: index.php');
	echo "<script>location.href='index.php';</script>";
}
