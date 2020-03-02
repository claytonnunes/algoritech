<?php
$empresas = null;
$empresa = null;
/**
 *  Listagem de empresas
 */
function index() {
    global $empresas;
    $empresas = find_all('empresas');
}

function salvarCadastro(){
    $result = false;
    if (!empty($_POST['usuario'])) {
        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $usuario = $_POST['usuario'];
        $usuario['created'] = $today->format("Y-m-d H:i:s");
        $usuario['modified'] = $empresa['created'];

        $result = save('usuarios', $empresa);
        echo "<script>alert(".json_encode($_SESSION['message']).")</script>";

    }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function editarEmpresa() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['empresa'])) {
            $empresa = $_POST['empresa'];
            $empresa['modified'] = $now->format("Y-m-d H:i:s");
            update('empresas', $id, $empresa);
           // header('location: index.php');
			echo "<script>location.href='index.php';</script>";	
        } else {
            global $empresa;
            $empresa = find('empresas', $id);
        }
    } else {
        //header('location: index.php');
		echo "<script>location.href='index.php';</script>";	
    }
}

/**
 *  Visualização de uma empresa
 */
function visualizarEmpresa($id = null) {
    global $empresa;
    $empresa = find('empresas', $id);
}

/**
 *  Exclusão de uma empresa
 */
function excluirEmpresa($id = null) {
    global $empresa;
    $empresa = remove('empresas', $id);
   // header('location: index.php');
	echo "<script>location.href='index.php';</script>";	
}
