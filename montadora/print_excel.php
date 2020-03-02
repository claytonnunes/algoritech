<?php
@ini_set('display_errors', 0);
header('Content-type: text/html; charset=utf-8'); 
date_default_timezone_set("Brazil/East");

// Inclui a conexão
include ("./connection.php");

// Nome do Arquivo do Excel que será gerado
$arquivo = 'visitantes_motorshow.xls';

// Criamos uma tabela HTML com o formato da planilha para excel
$tabela = '<table border="1">';
$tabela .= '<tr> LISTA DE VISITANTES MOTORSHOW 2016 </tr>';
//$tabela .= '<td colspan="2">'.$evento.' - '.$data_inicio.' a '.$data_final.'</tr>';
//$tabela .= '</tr>';
//$tabela .= '<tr></tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>NOME</b></td>';
$tabela .= '<td><b>SOBRENOME</b></td>';
$tabela .= '<td><b>CPF</b></td>';
$tabela .= '<td><b>E-MAIL</b></td>';
$tabela .= '<td><b>FONE</b></td>';
$tabela .= '<td><b>FAX</b></td>';
$tabela .= '<td><b>CELULAR</b></td>';
$tabela .= '</tr>';

// Puxando dados do Banco de dados

$sql_visitantes=mysql_query("SELECT * FROM visitantes 
			ORDER BY nome ASC;",$connection);
			
          	while ($loop_visitantes=mysql_fetch_array($sql_visitantes)) {
	$nome = ucfirst(strtoupper ($loop_visitantes ["nome"]));	
	$sobrenome = ucfirst(strtoupper ($loop_visitantes ["sobrenome"]));	
	$cpf = $loop_visitantes ["cpf"];	
	$website = ucfirst(strtoupper ($loop_visitantes ["website"]));	
	$fone = $loop_visitantes ["fone"];	
	$fax = $loop_visitantes ["fax"];	
	$celular = $loop_visitantes ["celular"];
		
	
$tabela .= '<tr>';
$tabela .= '<td>'.$nome.'</td>';
$tabela .= '<td>'.$sobrenome.'</td>';
$tabela .= '<td>'.$cpf.'</td>';
$tabela .= '<td>'.$website.'</td>';
$tabela .= '<td>'.$fone.'</td>';
$tabela .= '<td>'.$fax.'</td>';
$tabela .= '<td>'.$celular.'</td>';

$tabela .= '</tr>';
}

$tabela .= '</table>';

// Força o Download do Arquivo Gerado
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;
?>