<?php
$usuarios = null;
$usuario = null;


//teste aqui novo28022020

function salvarUsuarioCripto(){
    $result = false;
    if (isset($_REQUEST['acao'])) {
		if ($_REQUEST['acao']=='add_usuario') {
			$today =
				date_create('now', new DateTimeZone('America/Recife'));
            $senha_usuario = md5($_REQUEST['senha']);
            $usuario = $_REQUEST['usuario'];
            $usuario['usuario'] = $usuario;
                                    
            $usuario['nome_usuario'] = $_REQUEST['nome_usuario'];
            $usuario['email'] = $_REQUEST['email'];
            $usuario['usuario'] = $_REQUEST['login_usuario'];
            $usuario['senha'] = $senha_usuario;
            $usuario['modulo'] = '5';
			$usuario['created'] = $today->format("Y-m-d H:i:s");
			$usuario['modified'] = $usuario['created'];
            
            
			$result = save('usuarios', $usuario);
			echo "<script language='javascript' type='text/javascript'>
					alert('Usuário Cadastrado com Sucesso! Bem Vindo. ;)');
				  </script>";			
			echo "<script>location.href='../login.php';</script>";	
		}
    }
}



// PESQUISA USUÁRIO POR MODULO
function pesquisaModuloUsuario($modulo = null) {
	$id_pai = $_SESSION['id_pai'];
	global $usuarios;
    $usuarios = find_two_columns('usuarios', 'id_pai', $id_pai, 'modulo', $modulo);
}


function pesquisaUsuarioTres($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $usuarios;
    $usuarios = pesquisa_tres_colunas('usuarios', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3);
}


function pesquisaTresColunas($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $usuarios;
    $usuarios = pesquisa_tres_colunas('usuarios', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3);
}


//PESQUISA USUÁRIO PELO NOME
function pesquisaUsuario() {
	$novo_usuario = $_REQUEST['novo_usuario'];
    global $usuarios;
    $usuarios = find_columns('usuarios', 'usuario', $novo_usuario);
}


function index() {
    global $usuarios;
    $usuarios = find_all('usuarios');
}

function salvarUsuario(){
    $result = false;
    if (isset($_REQUEST['acao'])) {
		if ($_REQUEST['acao']=='add_usuario') {
			$today =
				date_create('now', new DateTimeZone('America/Recife'));
			$usuario = $_REQUEST['usuario'];		
            $usuario['usuario'] = $_REQUEST['novo_usuario'];
            $usuario['modulo'] = '5';
			$usuario['created'] = $today->format("Y-m-d H:i:s");
			$usuario['modified'] = $usuario['created'];
			
			$result = save('usuarios', $usuario);
			echo "<script language='javascript' type='text/javascript'>
					alert('Usuário Cadastrado com Sucesso! Bem Vindo. ;)');
				  </script>";			
			echo "<script>location.href='../login.php';</script>";	
		}
    }
}

function salvarUsuarioFilho(){
    $result = false;
    if (!empty($_POST['usuario'])) {
		$id_pai = $_SESSION["id_pai"];
		$id_usuario = $_SESSION["id_usuario"];
		$today =
            date_create('now', new DateTimeZone('America/Recife'));
        $usuario = $_POST['usuario'];	
		$usuario['tipo_acesso'] = $_REQUEST['acesso'];
        $usuario['usuario'] = $_REQUEST['novo_usuario'];
        $usuario['senha'] = $_REQUEST['senha'];
		$usuario['modulo'] = $_REQUEST['modulo'];
		$usuario['id_pai'] = $id_pai; 
		$usuario['id_created'] = $id_usuario; 
	    $usuario['created'] = $today->format("Y-m-d H:i:s");
        $usuario['modified'] = $usuario['created'];
		
		$pagina['id_pai'] = $id_pai;
		$pagina['id_created'] = $id_usuario;
		$pagina['modulo'] = $_REQUEST['modulo'];
		$pagina['created'] = $today->format("Y-m-d H:i:s");
        $pagina['modified'] = $usuario['created'];  
		 
    $result = save_two('usuarios', $usuario, 'controle_pagina', $pagina, 'id_usuario');
	
		//header('location: ../equipe/index.php?acao=add_vendedor_evento');
		echo "<script>location.href='../equipe/index.php?acao=add_vendedor_evento';</script>";
    }
}

// EDIÇÃO DO ID_PAI NO DB DO USUARIO
function editarIdPaiUsuario() {
	$now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
            $usuario['id_pai']= $_SESSION['id_pai'];
			$usuario['id_created']= $id_usuario;
            $usuario['modified'] = $now->format("Y-m-d H:i:s");
            update('usuarios', $id_usuario, $usuario);
            //header('location: ./index.php');
    } else {
       // header('location: ./index.php');
		echo "<script>location.href='./index.php';</script>";
    }
}


/**
 *	Atualizacao/Edicao de Cliente
 */
function editarUsuario() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['usuario'])) {
            function soNumero($str) {
                return preg_replace("/[^0-9]/", "", $str);
            }               
            $fone = soNumero($_REQUEST['fone']);
            $celular = soNumero($_REQUEST['celular']);

            $usuario = $_POST['usuario'];
            $usuario['celular'] = $celular;
            $usuario['fone'] = $fone;
            $usuario['modified'] = $now->format("Y-m-d H:i:s");
            update('usuarios', $id, $usuario);
           // header('location: ../atendimentos/index.php');
            // echo "<script>location.href='../atendimentos/index.php';</script>";
            $modulo = $_SESSION['modulo'];
            if ($modulo == 1) {
                echo "<script>location.href='../home_financeiro/index.php';</script>";
            } 
            elseif ($modulo == 2) {
                echo "<script>location.href='../home_marketing/index.php';</script>";
            } 
            elseif ($modulo == 3) {
                echo "<script>location.href='../home_operacional/index.php';</script>";
            } 
            elseif ($modulo == 4) {
                echo "<script>location.href='../home_projeto/index.php';</script>";
            } 
            elseif ($modulo == 5) {
                echo "<script>location.href='../eventos/eventos.php';</script>";
            } 
            else {
                echo "<script>location.href='../login.php';</script>";
            }
        } else {
            global $usuario;
            $usuario = find('usuarios', $id);
        }
    } else {
        //header('location: ../atendimentos/index.php');
        //echo "<script>location.href='../atendimentos/index.php';</script>";
        $modulo = $_SESSION['modulo'];
        if ($modulo == 1) {
            echo "<script>location.href='../home_financeiro/index.php';</script>";
        } 
        elseif ($modulo == 2) {
            echo "<script>location.href='../home_marketing/index.php';</script>";
        } 
        elseif ($modulo == 3) {
            echo "<script>location.href='../home_operacional/index.php';</script>";
        } 
        elseif ($modulo == 4) {
            echo "<script>location.href='../home_projeto/index.php';</script>";
        } 
        elseif ($modulo == 5) {
            echo "<script>location.href='../eventos/eventos.php';</script>";
        } 
        else {
            echo "<script>location.href='../login.php';</script>";
        }
    }
}

function editarCampoUsuario() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_REQUEST['id_usuario'])) {
        $id = $_REQUEST['id_usuario'];
        if (isset($_POST['usuario'])) {
            $usuario = $_POST['usuario'];
            $usuario['modified'] = $now->format("Y-m-d H:i:s");
            update('usuarios', $id, $usuario);
            //header('location: ../atendimentos/index.php');
			echo "<script>location.href='../atendimentos/index.php';</script>";
        } else {
            global $usuario;
            $usuario = find('usuarios', $id);
        }
    } else {
        //header('location: ../atendimentos/index.php');
		echo "<script>location.href='../atendimentos/index.php';</script>";
    }
}

//PESQUISA USUÁRIO PELO ID
function findUsuario() {
	$id_usuario = $_SESSION['id_usuario'];
    global $usuarios;
    $usuarios = find_columns('usuarios', 'id', $id_usuario);
}

//-----Luan Santana------

