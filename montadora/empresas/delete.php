<?php
/**
 * Created by Algoritech.
 * User: clayton.nunes
 * Date: 19/01/2017
 * Time: 23:59
 */

require_once('../controller/empresasController.php');

if (isset($_REQUEST['id'])){

    excluirEmpresa($_REQUEST['id']);

} else {
    die("ERRO: ID não definido.");
}
?>