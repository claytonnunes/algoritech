<?php
session_start();
?>
<?php
@ini_set('display_errors', 0);
header('Content-type: text/html; charset=utf-8'); 
date_default_timezone_set("Brazil/East");
		//Sql_visitantes
			$nome_usuario = $_SESSION["sess_name_user_vendas"];
			$id_conta = $_SESSION["id_conta_vendas"];
			$id_usuario = $_SESSION["id_usuario_vendas"] ;
			$nivel = $_SESSION["tipo_acesso_vendas"];	
			$tipo_conta = $_SESSION["tipo_conta_vendas"];
			$id_evento = $_SESSION["sess_fair_vendas"];
			
		//sql_contatos
		
		
		
				 
// Inclui a conexão
include ("../connection2.php");

// Nome do Arquivo do Excel que será gerado
$arquivo = 'banco_dados_algoritech.xls';

// Criamos uma tabela HTML com o formato da planilha para excel
$tabela = '<table border="1">';
$tabela .= '<tr><b> LISTA DB ALGORITECH 2017 </b></tr>';
//$tabela .= '<td colspan="2">'.$evento.' - '.$data_inicio.' a '.$data_final.'</tr>';
//$tabela .= '</tr>';
//$tabela .= '<tr></tr>'; 
$tabela .= '<tr>';
$tabela .= '<td><b>EMPRESA</b></td>';
$tabela .= '<td><b>CONTA</b></td>';
$tabela .= '<td><b>USUARIO</b></td>';
$tabela .= '<td><b>TIPO DE CONTA</b></td>';
$tabela .= '<td><b>FONE</b></td>';
$tabela .= '<td><b>CNPJ</b></td>';
$tabela .= '<td><b>EVENTO</b></td>';
$tabela .= '<td><b>NOME</b></td>';
$tabela .= '<td><b>EMAIL</b></td>';
$tabela .= '<td><b>ID USUARIO</b></td>';
$tabela .= '<td><b>ID CONTA</b></td>';
$tabela .= '<td><b>EMPRESA</b></td>';
$tabela .= '</tr>';

// Puxando dados do Banco de dados

$sql_visitantes=mysql_query("SELECT * FROM empresas WHERE id_conta = '$id_conta' AND id_evento = '$id_evento' ORDER BY 'empresas . nome_fantasia' ASC ;",$connection);

						
          	while ($loop_visitantes=mysql_fetch_array($sql_visitantes)) {
	$nome_usuario = ucfirst(strtoupper ($loop_visitantes ["nome_fantasia"]));	
	$id_conta = ucfirst(strtoupper ($loop_visitantes ["id_conta"]));	
	$id_usuario = ($loop_visitantes ["id_usuario"]);	
	$tipo_conta = ucfirst(strtoupper ($loop_visitantes ["tipo_conta"]));	
	$fone = ($loop_visitantes ["fone"]);	
	$cnpj = ($loop_visitantes ["cnpj"]);
	$id_evento = ($loop_visitantes["sess_fair_vendas"]); 
	
	
	$sql_contatos=mysql_query("SELECT * FROM contatos WHERE nome = '$nome' AND email = '$email' AND funcao = '$funcao' AND id_empresa = '$id_empresa';",$connection);
	

          	while ($loop_contatos=mysql_fetch_array($sql_contatos)) {
		$nome = ucfirst(strtoupper ($loop_contatos ["nome"]));
		$email = ucfirst(strtoupper ($loop_contatos ["email"]));
		$id_usuario_contato = ucfirst(strtoupper ($loop_contatos ["funcao"]));
		$id_conta_contato = ($loop_contatos ["fone2"]);
		$id_empresa_contato = ucfirst(strtoupper ($loop_contatos ["id_empresa"]));
				
				}
	
$tabela .= '<tr>';
$tabela .= '<td>'.$nome_usuario.'</td>';
$tabela .= '<td>'.$id_conta.'</td>';
$tabela .= '<td>'.$id_usuario.'</td>';
$tabela .= '<td>'.$tipo_conta.'</td>'; 
$tabela .= '<td>'.$fone.'</td>';
$tabela .= '<td>'.$cnpj.'</td>';
$tabela .= '<td>'.$id_evento.'</td>';
$tabela .= '<td>'.$nome.'</td>';
$tabela .= '<td>'.$email.'</td>'; 
$tabela .= '<td>'.$id_usuario_contato.'</td>';
$tabela .= '<td>'.$id_conta_contato.'</td>';
$tabela .= '<td>'.$id_empresa_contato.'</td>';
//$tabela .= '<td>'.$nome_evento.'</td>';
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