<?php
$contatos = null;
$contato = null;
/**
 *  Listagem de contatos
 */
function pesquisaContato($valor = null) {
	$id_pai = $_SESSION["id_pai"];
    global $contatos;
    $contatos = find_two_columns('contatos', 'id_pai', $id_pai, 'id_empresa', $valor);
}


function findContato() {
	$id_pai = $_SESSION["id_pai"];
    global $contatos;
    $contatos = find_two_columns('contatos', 'id_pai', $id_pai, 'id_empresa', $_REQUEST['id_empresa']);
}

function findContato2() {
	$id_pai = $_SESSION["id_pai"];
	global $empresa;
    global $contatos;
    $contatos = procurar_contato($_SESSION["sess_fair_vendas"],$_REQUEST['id_salesman']);
	
}

function salvarContato(){
    $result = false;
    if (!empty($_POST['contato'])) {
		$id_pai = $_SESSION["id_pai"];
        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $contato = $_POST['contato'];
        $contato['created'] = $today->format("Y-m-d H:i:s");
        $contato['modified'] = $contato['created'];
		$contato['id_pai'] = $id_pai;
		
		
		$result = save('contatos', $contato);
        echo "<script>alert(".json_encode($_SESSION['message']).")</script>";

    }
}


function salvarContatoTwo(){
    $result = false;
    if (!empty($_POST['contato'])) {
        function soNumero($str) {
            return preg_replace("/[^0-9]/", "", $str);
        }
		$id_pai = $_SESSION["id_pai"];
		$id_created = $_SESSION["id_usuario"];
        $today = date_create('now', new DateTimeZone('America/Recife'));
        $telefoneUm = soNumero($_REQUEST['telefone1']);
        $telefoneDois = soNumero($_REQUEST['telefone2']);
        
        $contato = $_POST['contato'];
        $contato['created'] = $today->format("Y-m-d H:i:s");
        $contato['modified'] = $contato['created'];
        $contato['id_pai'] = $id_pai;
        $contato['fone2'] = $telefoneUm;
        $contato['celular'] = $telefoneDois;
		$contato['id_created'] = $id_created;
		
        $result = save('contatos', $contato);
         //header('location: ../empresas/view2.php?id_empresa='.$_REQUEST['id_company'].'&id_atendimento='.$_REQUEST['id_atendimento'].'');
		echo "<script>location.href='../negocio/index.php?id_empresa=".$_REQUEST['id_empresa']."&id_negocio=".$_REQUEST['id_negocio']."';</script>";	
    
	}
}


/**
 *	Atualizacao/Edicao de Cliente
 */
function editarContato() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['contato'])) {
            
            function soNumero($str) {
                return preg_replace("/[^0-9]/", "", $str);
            }
                            
            $fone = soNumero($_REQUEST['fone2']);
            $celular = soNumero($_REQUEST['celular']);
           
            $contato = $_POST['contato'];
            $contato['modified'] = $now->format("Y-m-d H:i:s");
            $contato['fone2'] = $fone;
            $contato['celular'] = $celular;
			$contato['email'] = $_REQUEST['email'];
			
            update('contatos', $id, $contato);
            echo "<script>location.href='../empresas/view2.php?id_empresa=".$_REQUEST['id_company']."&id_atendimento=".$_REQUEST['id_atendimento']."';</script>";
           // header('location: ../empresas/view.php?id_empresa='.$_REQUEST['id_company'].'&id_atendimento='.$_REQUEST['id_atendimento'].'');
        } else {
            global $contato;
            $contato = find('contatos', $id);
        }
    } else {
       // header('location: ../empresas/view.php?id_empresa='.$_REQUEST['id_company'].'&id_atendimento='.$_REQUEST['id_atendimento'].'');
		echo "<script>location.href='../empresas/view2.php?id_empresa=".$_REQUEST['id_company']."&id_atendimento=".$_REQUEST['id_atendimento']."';</script>";
    }
}

/**
 *  Visualização de uma contato
 */
function visualizarContato($id = null) {
    global $contato;
    $contato = find('contatos', $id);
}

/**
 *  Exclusão de um contato
 */
function excluirContato($id = null) {
    global $contato;
    $contato = remove('contatos', $id);
    //header('location: index.php');
	echo "<script>location.href='index.php';</script>";	
}
