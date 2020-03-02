<?php
/**
 * Created by Algoritech.
 * User: clayton.nunes
 * Date: 19/01/2017
 * Time: 23:59
 */

require_once('../controller/empresasController.php');

if (isset($_GET['id'])){

    excluirEmpresa($_GET['id']);

} else {
    die("ERRO: ID não definido.");
}
?>