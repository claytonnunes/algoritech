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
			$id_empresa = $_SESSION["sess_fair"];
			
			//sql_contatos
			
		
				 
// Inclui a conexão
include ("../connection2.php");

// Nome do Arquivo do Excel que será gerado
$arquivo = 'banco_dados_algoritech.xls';

// Criamos uma tabela HTML com o formato da planilha para excel
$tabela = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$tabela = '<table border="1">';
$tabela .= '<tr><b> LISTA DB ALGORITECH 2017 </b></tr>';
//$tabela .= '<td colspan="2">'.$evento.' - '.$data_inicio.' a '.$data_final.'</tr>';
//$tabela .= '</tr>';
//$tabela .= '<tr></tr>'; 
$tabela .= '<tr>';
$tabela .= '<td><b>NOME FANTASIA</b></td>';
$tabela .= '<td><b>CNPJ</b></td>';
$tabela .= '<td><b>CEP</b></td>';
$tabela .= '<td><b>FONE</b></td>';
$tabela .= '<td><b>ENDEREÇO</b></td>';
$tabela .= '<td><b>COMPLEMENTO</b></td>';
$tabela .= '<td><b>BAIRRO</b></td>';
$tabela .= '<td><b>CIDADE</b></td>';
$tabela .= '<td><b>ESTADO</b></td>';
$tabela .= '<td><b>WEBSITE</b></td>';
$tabela .= '<td><b>Nome</b></td>';
$tabela .= '<td><b>Função</b></td>';
$tabela .= '<td><b>Email</b></td>';
$tabela .= '<td><b>Fone</b></td>';
$tabela .= '<td><b>Celular</b></td>';
$tabela .= '</tr>';

// Puxando dados do Banco de dados

$sql_visitantes=mysql_query("SELECT * FROM empresas INNER JOIN contatos ON empresas.id_conta = contatos.id_conta WHERE empresas.id_conta = contatos.id_conta ORDER BY empresas.nome_fantasia ASC;");

/*$sql_visitantes=mysql_query("SELECT * FROM `empresas` WHERE id_evento = '$id_evento'  ORDER BY `empresas`.`nome_fantasia` ASC;");*/

						
          	while ($loop_visitantes=mysql_fetch_array($sql_visitantes)) {
	$nome_usuario = ucfirst(strtoupper ($loop_visitantes ["nome_fantasia"]));	
	$cnpj = ($loop_visitantes ["cnpj"]);
	$cep = ($loop_visitantes ["cep"]);
	$fone = ($loop_visitantes ["fone"]);
	$endereco = ($loop_visitantes ["endereco"]);
	$complemento = ($loop_visitantes ["complemento"]);
	$bairro = ($loop_visitantes ["bairro"]);
	$cidade = ($loop_visitantes ["cidade"]);
	$estado = ($loop_visitantes ["estado"]);
	$website = ($loop_visitantes ["website"]);
	$id_usuario = ($loop_visitantes ["id_usuario"]);	
	$tipo_conta = ucfirst(strtoupper ($loop_visitantes ["tipo_conta"]));	
	$id_evento = ($loop_visitantes["sess_fair_vendas"]);
		$nome = ucfirst(strtoupper ($loop_visitantes ["nome"]));
		$funcao = ucfirst(strtoupper ($loop_visitantes ["funcao"]));
		$email = ucfirst(strtoupper ($loop_visitantes ["email"]));
		$fone_contato = ucfirst(strtoupper ($loop_visitantes ["fone2"]));
		$celular = ($loop_visitantes ["celular"]);
	
/*$sql_contatos=mysql_query("SELECT * FROM `contatos` WHERE id_conta = '$id_conta' ORDER BY `contatos`.`nome` ASC;");
	
	 while($loop_contatos=mysql_fetch_array($sql_contatos)):
		$nome = ucfirst(strtoupper ($loop_contatos ["nome"]));
		$funcao = ucfirst(strtoupper ($loop_contatos ["funcao"]));
		$email = ucfirst(strtoupper ($loop_contatos ["email"]));
		$fone_contato = ucfirst(strtoupper ($loop_contatos ["fone2"]));
		$celular = ($loop_contatos ["celular"]);
	 endwhile;*/
		
$tabela .= '<tr>';
$tabela .= '<td>'.$nome_usuario.'</td>';
$tabela .= '<td>'.$cnpj.'</td>';
$tabela .= '<td>'.$cep.'</td>';
$tabela .= '<td>'.$fone.'</td>';
$tabela .= '<td>'.$endereco.'</td>';
$tabela .= '<td>'.$complemento.'</td>';
$tabela .= '<td>'.$bairro.'</td>';
$tabela .= '<td>'.$cidade.'</td>';
$tabela .= '<td>'.$estado.'</td>';
$tabela .= '<td>'.$website.'</td>';
$tabela .= '<td>'.$nome.'</td>';
$tabela .= '<td>'.$funcao.'</td>';
$tabela .= '<td>'.$email.'</td>'; 
$tabela .= '<td>'.$fone_contato.'</td>';
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