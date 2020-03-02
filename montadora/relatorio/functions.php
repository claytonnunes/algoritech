<?php
/**
 * Created by PhpStorm.
 * User: andre.luis.a.costa
 * Date: 30/11/2016
 * Time: 15:24
 */

require_once('../config.php');
require_once(DBAPI);
$expositores = null;
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
function add() {
    if (!empty($_POST['expositor'])) {

        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $expositor = $_POST['expositor'];
        $expositor['modified'] = $expositor['created'] = $today->format("d-m-Y H:i:s");

        save('expositores', $expositor);
        header('location: index.php');
    }
}

/**
 *	Atualizacao/Edicao de Expositores
 */
function edit() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['expositor'])) {
            $expositor = $_POST['expositor'];
            $expositor['modified'] = $now->format("Y- H:i:s");
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
function delete($id = null) {
    global $expositor;
    $expositor = remove('expositores', $id);
    header('location: index.php');
}
