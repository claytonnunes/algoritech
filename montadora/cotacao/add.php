<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/cotacaoController.php');
salvarCotacao();

?>
<?php //var_dump($_SESSION['carrinho'])."<-----<br><br><br>"; ?>
<?php include(FOOTER_TEMPLATE); ?>