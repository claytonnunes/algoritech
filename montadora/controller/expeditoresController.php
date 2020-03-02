<?php
/**
 * Created by Algoritech.
 * User: clayton.nunes
 * Date: 19/01/2017
 * Time: 23:59
 */
?>
<?php
require_once('../config.php');
require_once(DBAPI);

$expositores = "";
$expositor = null;
/**
 *  Listagem de Expositores
 */
function index() {
    global $expositores;
    $expositores = find_all('expositores');
}

/**
 *  Cadastro de Expositores
 */
function salvarExpeditor() {
    if (!empty($_POST['expositor'])) {

        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $expositor = $_POST['expositor'];
        $expositor['modified'] = $expositor['created'] = $today->format("Y-m-d H:i:s");

        save('expositores', $expositor);
        echo "<script>alert(".json_encode($_SESSION['message']).")</script>";

    }
}

/**
 *	Atualizacao/Edicao de Expositores
 */
function editarExpeditor() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['expositor'])) {
            $expositor = $_POST['expositor'];
            $expositor['modified'] = $now->format("Y-m-d H:i:s");
            update('expositores', $id, $expositor);
            header('location: index.php');
        } else {
            global $expositor;
            $expositor = find('expositores', $id);
        }
    } else {
        header('location: index.php');
    }
}

/**
 *  Visualização de um Expositores
 */
function view($id = null) {
    global $expositor;
    $expositor = find('expositores', $id);
}

/**
 *  Exclusão de um Expositores
 */
function excluirExpositor($id = null) {
    global $expositor;
    $expositor = remove('expositores', $id);
    header('location: index.php');
}
