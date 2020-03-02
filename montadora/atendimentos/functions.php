<?php
/**
 * Created by PhpStorm.
 * User: andre.luis.a.costa
 * Date: 30/11/2016
 * Time: 15:24
 */

require_once('../config.php');
require_once(DBAPI);
$visitantes = null;
$visitante = null;
/**
 *  Listagem de Visitantes
 */
function index() {
    global $visitantes;
    $visitantes = find_all('visitantes');
}

/**
 *  Cadastro de Clientes
 */
function add() {
    if (!empty($_POST['visitante'])) {

        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $visitante = $_POST['visitante'];
        $visitante['modified'] = $visitante['created'] = $today->format("Y-m-d H:i:s");

        save('visitantes', $visitante);
        header('location: index.php');
    }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {
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
function view($id = null) {
    global $visitante;
    $visitante = find('visitantes', $id);
}

/**
 *  Exclusão de um Visitante
 */
function delete($id = null) {
    global $visitante;
    $visitante = remove('visitantes', $id);
    header('location: index.php');
}
