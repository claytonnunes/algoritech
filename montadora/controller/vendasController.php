<?php
$usuarios = null;
$usuario = null;
$vendedores = null;
$vendedor_atend = null;
$metas = null;
$meta = null;

function pesquisaMetaVendas($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $metas;
    $metas = pesquisa_tres_colunas('equipe', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}

function pesquisaMeta($id_usuario=null) {
	$id_pai = $_SESSION['id_pai'];
	$id_edicao = $_SESSION['id_edicao'];
	global $metas;
    $metas = pesquisa_tres_colunas('equipe', 'id_usuario', $id_usuario, 'id_pai', $id_pai, 'id_edicao', $id_edicao );
}

function pesquisaVendedor() {
	$id_pai = $_SESSION['id_pai'];
	global $vendedores;
    $vendedores = pesquisa_duas_tabelas($id_pai);
}

function salvarVendedor(){
    $result = false;
    if (!empty($_POST['usuario'])) {
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$today =
            date_create('now', new DateTimeZone('America/Recife'));
        $usuario = $_POST['usuario'];	
		$usuario['tipo_acesso'] = $_REQUEST['acesso'];
		$usuario['usuario'] = $_REQUEST['newusername'];
		$usuario['id_pai'] = $id_pai;       
	    $usuario['created'] = $today->format("Y-m-d H:i:s");
        $usuario['modified'] = $usuario['created'];
		
		$pagina['id_evento'] = $_REQUEST["id_evento"];
		$pagina['created'] = $today->format("Y-m-d H:i:s");
        $pagina['modified'] = $usuario['created'];
		$pagina['id_pai'] = $id_pai;  
		 
    $result = save_two('usuarios', $usuario, 'controle_pagina', $pagina, 'id_usuario');
	
		//header('location: ../equipe/index.php?acao=add_vendedor_evento');
		echo "<script>location.href='../equipe/index.php?acao=add_vendedor_evento';</script>";
    }
}

/**
 *  Visualiza��o de uma empresa
 */
function findVendedor() {
	$username = $_REQUEST['newusername'];
    global $usuarios;
    $usuarios = find_columns('usuarios', 'usuario', $username);
}

function findVendedores() {
	$id_pai = $_SESSION['id_pai'];
	global $vendedores;
    $vendedores = find_two_columns('usuarios', 'id_pai', $id_pai, 'modulo', '5');
}

function findVendedorAtend($id_atendimento = null) {
	global $vendedor_atend;
    $vendedor_atend = find_columns('usuarios', 'id', $id_atendimento);
}


function salvarVendedorEquipe(){
    $result = false;
	
	if (!empty($_REQUEST['id_usuario'])):
		
		$valor_meta_edicao = $_REQUEST['valor_meta_edicao'];	
		$valor_meta =  str_replace(',','.', str_replace('.','', $valor_meta_edicao));
		//$saida = number_format( $valor , 2, ',', '.');		
		
		$soma_string = strlen($valor_meta); 	
		if ($soma_string < 12):
				$id_vendedor = $_REQUEST['id_usuario'];
				$id_pai = $_SESSION["id_pai"];
				$id_usuario = $_SESSION["id_usuario"];
				$id_edicao = $_SESSION["id_edicao"];
				$id_evento = $_SESSION["id_evento"];
				$today = date_create('now', new DateTimeZone('America/Recife'));

				$equipe['created'] = $today->format("Y-m-d H:i:s");
				$equipe['modified'] = $equipe['created'];
				$equipe['id_usuario'] = $id_vendedor;
				$equipe['meta'] = $valor_meta;
				$equipe['id_evento'] = $id_evento;
				$equipe['id_edicao'] = $id_edicao;
				$equipe['id_pai'] = $id_pai;
				$equipe['id_created'] = $id_usuario;
	
				$meta['modified'] = $today->format("Y-m-d H:i:s");
				$meta['meta'] = $valor_meta;
				$meta['id_created'] = $id_usuario;	
				
				if($_REQUEST['id_meta'] == 'sem_id'):
					$result = save('equipe', $equipe);
				
				elseif($_REQUEST['id_meta'] != 'sem_id'):
					$id_meta = $_REQUEST['id_meta'];
					$result = update('equipe', $id_meta, $meta);
				
				endif;	

				echo "<script>location.href='../equipe/index.php';</script>";	
	
				else:
				 	$_SESSION['message'] = 'o valor não pode ser maior que R$ 99.999.999,99!';
					$_SESSION['type'] = 'danger';
					$_SESSION['time_message'] = time();
			
				echo "<script>location.href='../equipe/index.php?add=add_meta_edicao&id_usuario=".$_REQUEST['id_usuario']."&nome_usuario=".$_REQUEST['nome_usuario']."';</script>";	
			
			endif;
	endif;
}


/**
 *  Exclus�o de uma empresa (sem eliminar o registro)
 */
function excluirUsuario($id = null) {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
            $usuario['modified'] = $now->format("Y-m-d H:i:s");
			$usuario['deleted'] = '1';
			update('usuarios', $id, $usuario);
            //header('location: ../vendas/index.php');
		echo "<script>location.href='../vendas/index.php';</script>";
    } else {
        //header('location: ../vendas/index.php');
		echo "<script>location.href='../vendas/index.php';</script>";
    }
}
/* FUN��o salvando formulario recebido por RADIO
function salvarVendedorEquipe(){
    $result = false;
	
	if (!empty($_REQUEST['id_vendedor'])) {
		$equipe_array = $_REQUEST['equipe'];
		foreach ($equipe_array as $id_vendedor => $equipe_array2):
			$equipe_array2 = $equipe_array2;
		
			$id_pai = $_SESSION["id_pai"];
			$id_usuario = $_SESSION["id_usuario"];
			$id_edicao = $_SESSION["id_edicao"];
			$id_evento = $_SESSION["id_evento"];
			$today =
				date_create('now', new DateTimeZone('America/Recife'));
			
			$equipe['created'] = $today->format("Y-m-d H:i:s");
			$equipe['modified'] = $equipe['created'];
			$equipe['id_usuario'] = $equipe_array2;
			$equipe['id_evento'] = $id_evento;
			$equipe['id_edicao'] = $id_edicao;
			$equipe['id_pai'] = $id_pai;
			$equipe['id_created'] = $id_usuario;
		
			$result = save('equipe', $equipe);
			
	endforeach;
		echo "<script language='javascript' type='text/javascript'>
					alert('Equipe cadastrada com Sucesso!');
				  </script>";			
			echo "<script>location.href='../atendimentos/index.php';</script>";	
	}
}
*/
?>