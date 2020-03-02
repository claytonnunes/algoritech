<?php
$visitantes = null;
$visitante = null;
/**
 *  Listagem de Visitantes
 */
function index() {
    global $visitantes;
    $visitantes = find_all('empresas');
}

function salvarVisitante(){
    $result = false;
    if (!empty($_POST['visitante'])) {
        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $visitante = $_POST['visitante'];
        $visitante['created'] = $today->format("Y-m-d H:i:s");
        $visitante['modified'] = $visitante['created'];

        $result = save('visitantes', $visitante);
        echo "<script>alert(".json_encode($_SESSION['message']).")</script>";

    }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function editarVisitante() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['visitante'])) {
            $visitante = $_POST['visitante'];
            $visitante['modified'] = $now->format("Y-m-d H:i:s");
            update('visitantes', $id, $visitante);
            header('location: index.php');
        } else {
            global $visitante;
            $visitante = find('visitantes', $id);
        }
    } else {
        header('location: index.php');
    }
}

/**
 *  Visualização de um Visitante
 */
function visualizarVisitante($id = null) {
    global $visitante;
    $visitante = find('visitantes', $id);
}

/**
 *  Exclusão de um Visitante
 */
function excluirVisitante($id = null) {
    global $visitante;
    $visitante = remove('visitantes', $id);
    header('location: index.php');
}
