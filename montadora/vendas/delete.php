<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/vendasController.php');

if (isset($_GET['id'])){

    excluirUsuario($_GET['id']);

} else {
    die("ERRO: ID não definido.");
}
?>