<?php
include_once('../phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
include_once("../phpjasperxml_0.9d/class/PHPJasperXML.inc.php");
include_once ('../phpjasperxml_0.9d/setting.php');

$xml = simplexml_load_file("./relatorioExpositores.jrxml"); //informe onde está seu arquivo jrxml

$PHPJasperXML = new PHPJasperXML();

$PHPJasperXML->debugsql=false;

$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->connect($server,$user,$pass,$db);


$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);


$PHPJasperXML->outpage("FI");

?>


