<?php
/**
 * Created by Algoritech.
 * User: clayton.nunes
 * Date: 19/01/2017
 * Time: 23:59
 */

require_once('../controller/eventosController.php');

if (isset($_GET['id'])){

    excluirEvento($_GET['id']);

} else {
    die("ERRO: ID não definido.");
}
?>