<?php 
// ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start(); ?>
 <?php
 $texto = $_SESSION["texto"];
 if($texto) {
 echo "A sess&atilde;o guardou: [ $texto ]";
 } else { echo "Houve um erro na sess&atilde;o";  }
 ?>