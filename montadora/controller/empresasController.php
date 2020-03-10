<?php

$empresas = null;
$empresa = null;
$contatos = null;
$contato = null;
$atendimentos = null;
$atendimento = null;
$agendas = null;
$agenda = null;
/**
 *  Listagem de empresas
 */
function index_empresa() {
    global $empresas;
    $empresas = 	('empresas');
}

// PESQUISA USUÁRIO POR MODULO
function pesquisaEmpresaId($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $empresas;
    $empresas = pesquisa_tres_colunas('empresas', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3);
}

function find_company() {
	$id_pai = $_SESSION["id_pai"];
	$id_usuario = $_SESSION["id_usuario"];
	$id_evento = $_SESSION["id_evento"];
	$order = "nome_fantasia";
    global $empresas;
    $empresas = find_account('empresas', $id_pai, $id_evento, $order, $id_usuario);
}

function findCompanyField() {
	$id_pai = $_SESSION["id_pai"];
	$id_usuario = $_SESSION["id_usuario"];
	$id_evento = $_SESSION["id_evento"];
	$order = "nome_fantasia";
    global $empresas;
    $empresas = find_account_field('empresas', 'id', 'nome_fantasia', $id_pai, $id_evento, $order, $id_usuario);
}

// Listagem de atendimentos 
function pesquisaEmpresa() {	
	
	$id_pai = $_SESSION["id_pai"];
	$id_usuario = $_SESSION["id_usuario"];
	$id_edicao = $_SESSION["id_edicao"];  
	
	global $empresas;
	$empresas = pesquisa_empresa($id_pai, $id_usuario, $id_edicao);
	}


function findFilterCompany($nome_fantasia = null) {
	$id_pai = $_SESSION["id_pai"];
	$id_evento = $_SESSION["id_evento"];
	$condicao = "and id_pai = ".$id_pai." and id_evento = ".$id_evento."";
    global $empresas;
   $empresas = find_columns_like('empresas', 'nome_fantasia', $nome_fantasia, $condicao);
	
}

function findIdCompany($nome_fantasia = null) {
	$id_pai = $_SESSION["id_pai"];
	//$id_edicao = $_SESSION["id_edicao"];
	$condicao = "and id_pai = ".$id_pai." ORDER BY id DESC";
	//$condicao = "and id_pai = ".$id_pai." and id_edicao = ".$id_edicao."";
    global $empresas;
	
   $empresas = find_columns_like('empresas', 'nome_fantasia', $nome_fantasia, $condicao);
   $_SESSION['msgpesquisa'] = '<div class="alert alert-danger" role="alert" class="close">SELECIONE UM CLIENTE ABAIXO PARA INICIAR ATENDIMENTO<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>';
	
	
}


function findIdAtendimento( $id_empresa=null ) {

		global $atendimentos;
		$condicao = " LIMIT 1 ";
		$atendimentos = find_columns('atendimentos', 'id_empresa', $id_empresa, $condicao);
}

function findAtendimentoField( $id_empresa=null ) {

		global $atendimentos;
		$condicao = " LIMIT 1 ";
		$atendimentos = find_columns_field('atendimentos', 'id_empresa' , 'id_empresa', $id_empresa, $condicao);
}
	
function findTemp() {
	$id_pai = $_SESSION["id_pai"];
	$id_usuario = $_SESSION["id_usuario"];
    global $empresas;
    $empresas = findTemp($id_pai, $id_usuario);
}

function findClienteEvento() {
	$id_pai = $_SESSION["id_pai"];
    global $empresas;
    $empresas = findLeftEvento('eventos', 'id', 'empresas', 'id_evento', $id_pai);
}

function findFiltroCliente() {
	
	$id_pai = $_SESSION["id_pai"];
	$id_usuario = $_SESSION["id_usuario"];
	
	  global $eventos;
    $eventos = find_columns('controle_pagina', 'id_usuario', $id_usuario);
	
	if ($eventos) : 
	foreach ($eventos as $evento) : 
		$id_evento = $evento['id_evento'];		
	endforeach;
	endif;
	
	global $empresas;
    $empresas = find_columns('empresas', 'id_evento', $id_evento);
	
	global $evento_nome;
    $evento_nome = find_columns('eventos', 'id', $id_evento);
	
}

function salvarDadosEmpresa(){

	$result = false;
    if (!empty($_POST['empresa'])) {
		 	
		$id_pai = $_SESSION["id_pai"];
        $id_usuario = $_SESSION["id_usuario"];
        
		function soNumero($str) {
    		return preg_replace("/[^0-9]/", "", $str);
		}
						
		$fone = soNumero($_REQUEST['fone']);
		$fone2 = soNumero($_REQUEST['fone2']);
		$celular = soNumero($_REQUEST['celular']);
		$cnpj = soNumero($_REQUEST['cnpj']);
		$cep = soNumero($_REQUEST['cep']);
			
		$today = date_create('now', new DateTimeZone('America/Recife'));
				
		
		$empresa = $_POST['empresa'];
		$empresa['nome_fantasia'] = $_REQUEST['nome_fantasia'];
        $empresa['created'] = $today->format("Y-m-d H:i:s");
        $empresa['modified'] = $empresa['created'];
		$empresa['id_pai'] = $id_pai;
		$empresa['id_created'] = $id_usuario;		
		$empresa['fone'] = $fone;
		$empresa['cnpj'] = $cnpj;
		$empresa['cep'] = $cep;
		

		$contato = $_POST['contato'];
        $contato['created'] = $today->format("Y-m-d H:i:s");
        $contato['modified'] = $contato['created'];
		$contato['id_pai'] = $id_pai;
		$contato['id_created'] = $id_usuario;
		$contato['fone2'] = $fone2;
		$contato['celular'] = $celular;
			

		$result = save_two('empresas', $empresa, 'contatos', $contato, 'id_empresa');
		echo "<script>location.href='../empresas/index.php?filtro=nomeCliente&pg=cliente&PesquisaCliente=".$_REQUEST['nome_fantasia']."';</script>";		
		
		//header('location: ../empresas/index.php');
    }
}


function salvarEmpresa(){
	$result = false;
    if (!empty($_POST['empresa'])) {
		 $id_edicao = $_SESSION['id_edicao'];
		if ($id_edicao==""){
			echo "<script language='javascript' type='text/javascript'>
              	alert('Selecione um evento!');
              </script>";	
			  	
        echo "<script>location.href='../eventos/eventos.php?acao=selecioneevento';</script>";
					}
			else{
			
		$id_pai = $_SESSION["id_pai"];
        $id_usuario = $_SESSION["id_usuario"];
        
		function soNumero($str) {
    		return preg_replace("/[^0-9]/", "", $str);
		}
						
		$fone = soNumero($_REQUEST['fone']);
		$fone2 = soNumero($_REQUEST['fone2']);
		$celular = soNumero($_REQUEST['celular']);
		$cnpj = soNumero($_REQUEST['cnpj']);
		$cep = soNumero($_REQUEST['cep']);
			
		$today = date_create('now', new DateTimeZone('America/Recife'));
				
		
        $empresa = $_POST['empresa'];
        $empresa['created'] = $today->format("Y-m-d H:i:s");
        $empresa['modified'] = $empresa['created'];
		$empresa['id_pai'] = $id_pai;
		$empresa['id_created'] = $id_usuario;		
		$empresa['nome_fantasia'] = $_REQUEST['nome_fantasia'];
		$empresa['fone'] = $fone;
		$empresa['cnpj'] = $cnpj;
		$empresa['cep'] = $cep;
		
		$empresa['razao_social'] = $_REQUEST['razao_social'];
		$empresa['endereco'] = $_REQUEST['endereco'];
		$empresa['complemento'] = $_REQUEST['complemento'];
		$empresa['bairro'] = $_REQUEST['bairro'];
		$empresa['cidade'] = $_REQUEST['cidade'];
		$empresa['website'] = $_REQUEST['website'];
		
		
		$contato = $_POST['contato'];
        $contato['created'] = $today->format("Y-m-d H:i:s");
        $contato['modified'] = $contato['created'];
		$contato['id_pai'] = $id_pai;
		$contato['id_created'] = $id_usuario;
		$contato['nome'] = $_REQUEST['nome'];
		$contato['funcao'] = $_REQUEST['funcao'];
		$contato['email'] = $_REQUEST['email'];
		$contato['fone2'] = $fone2;
		$contato['celular'] = $celular;
				
		$atendimento['created'] = $today->format("Y-m-d H:i:s");
        $atendimento['modified'] = $atendimento['created'];
		$atendimento['id_pai'] = $id_pai;
		$atendimento['id_edicao'] = $id_edicao;		
		$atendimento['id_usuario'] = $id_usuario;
		$atendimento['id_created'] = $id_usuario;
		$atendimento['posicao'] = "0";
				
		$agenda['created'] = $today->format("Y-m-d H:i:s");
        $agenda['modified'] = $agenda['created'];
		$agenda['id_pai'] = $id_pai;
		$agenda['id_edicao'] = $id_edicao;		
		$agenda['id_usuario'] = $id_usuario;
		$agenda['id_created'] = $id_usuario;
		$agenda['posicao_agenda'] = "0";
				
        $result = save_four('empresas', $empresa, 'contatos', $contato, 'id_empresa', 'atendimentos', $atendimento, 'agenda', $agenda, 'id_atendimento');
		echo "<script>location.href='../empresas/index.php';</script>";		
		//header('location: ../empresas/index.php');
      	}
    }
   
}


/**
 *	Atualizacao/Edicao de Cliente
 */
function editarEmpresa() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
				
        if (isset($_POST['empresa'])) {
            $empresa = $_POST['empresa'];
            $empresa['modified'] = $now->format("Y-m-d H:i:s");
			
			$empresa['nome_fantasia'] = $_REQUEST['nome_fantasia'];
			$empresa['razao_social'] = $_REQUEST['razao_social'];
			$empresa['endereco'] = $_REQUEST['endereco'];
			$empresa['complemento'] = $_REQUEST['complemento'];
			$empresa['bairro'] = $_REQUEST['bairro'];
			$empresa['cidade'] = $_REQUEST['cidade'];
			$empresa['website'] = $_REQUEST['website'];
			update('empresas', $id, $empresa);
			$_SESSION['msgeditada'] = '<div class="alert alert-warning" role="alert">Empresa Editada com Sucesso<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>';
            //header('location: index.php');
			echo "<script>location.href='../empresas/index.php?filtro=nomeCliente&pg=cliente&PesquisaCliente=".$_REQUEST['nome_fantasia']."';</script>" ;	
        } else {
            global $empresa;
            $empresa = find('empresas', $id);
		}
		
    } else {
        //header('location: index.php');
		echo "<script>location.href='index.php?acao=id';</script>";	
    }
}

/**
 *  Visualização de uma empresa
 */
function visualizarEmpresa($id = null) {
    
	global $empresa;
	global $contato;
    $empresa = find('empresas', $id);
	
	$contato = find_contato('contatos', $id);

	
    	
}


/**
 *  Exclusão de uma empresa
 */
function excluirEmpresa_backup($id = null) {
    global $empresa;
    $empresa = remove('empresas', $id);
    //header('location: index.php');
	echo "<script>location.href='index.php';</script>";	
}

/**
 *  Exclusão de uma empresa (sem eliminar o registro)
 */
function excluirEmpresa() {
    if (isset($_REQUEST['id'])) {
		$now = date_create('now', new DateTimeZone('America/Recife'));
		    $id = $_REQUEST['id'];
            $empresa['modified'] = $now->format("Y-m-d H:i:s");
			$empresa['deleted'] = '1';
			update('empresas', $id, $empresa);
			$_SESSION['msgapagar'] = '<div class="alert alert-danger" role="alert" class="close">Empresa Excluida com Sucesso<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>';
            //header('location: ../empresas/index.php');
			echo "<script>location.href='../empresas/index.php';</script>";
			
    } else {
       // header('location: ../empresas/index.php');
		echo "<script>location.href='../empresas/index.php';</script>";	
		
   	 }
}
?>