<html>
<head>
<title>PHPMailer - SMTP advanced test with authentication</title>
</head>
<body>

<?php

if($_GET['acao'] == 'add'){
	
		include "conexao.php";
	
	$codigo = $_REQUEST['id'];
	$sqlrelacional = mysql_query("SELECT * FROM clienterelacional WHERE iD = '$codigo'", $conexao);
	$rowrelacional = mysql_num_rows($sqlrelacional);
	while ($loopsql=mysql_fetch_array($sqlrelacional)) {
				$vendedor = $loopsql ['vendedoR'];
				$resgatado_cliente = $loopsql ['idcarrinhO'];
				$resgatado_evento = $loopsql ['id_eventO'];
	}
	
	 $cod_funcionario = $vendedor;
			 $select_funcionario2 = mysql_query("SELECT * FROM dbfuncionario WHERE id_funcionario = '$cod_funcionario'" ,$conexao);
						 while ($fila_funcionario2=mysql_fetch_array($select_funcionario2)) {
			 $nome_vendedor = $fila_funcionario2["nomE"];
			 $sobrenome = $fila_funcionario2["sobrenomE"];
						 }
 




	/*
	$sqllayout = mysql_query("SELECT * FROM dblayout WHERE id_layout_relacionaL = '$codigo'", $conexao);
	$rowsqllayout = mysql_num_rows($sqllayout);
	while ($loopsqllayout=mysql_fetch_array($sqllayout)) {
				$arqlayout = $loopsqllayout ['layout_imageM'];
	}
	*/
	$codigocliente = $resgatado_cliente;
	$sqlcliente = mysql_query("SELECT * FROM dbcliente WHERE id_cliente = '$codigocliente'", $conexao);
	$rowrelacional = mysql_num_rows($sqlcliente);
	while ($loopsqlcliente=mysql_fetch_array($sqlcliente)) {
				
				$contato = utf8_encode($loopsqlcliente['contato_cliente']);
				$empresa = utf8_encode($loopsqlcliente['empresa_cliente']);
				}
	$codigoevento = $resgatado_evento;
	$sqlevento = mysql_query("SELECT * FROM dbcatcliente WHERE id_cat = '$codigoevento'", $conexao);
	$rowevento = mysql_num_rows($sqlevento);
	while ($loopevento=mysql_fetch_array($sqlevento)) {
				$evento = utf8_encode($loopevento['evento_cadastrO']);
	}

	$texto = "APROVADO!!! -- $empresa P/ ".$evento."";
	$corpo_mensagem = "O projeto da $empresa para o Evento $evento foi APROVADO!!<br><br>Att,<br><br>$nome_vendedor $sobrenome";

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "localhost"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Host       = "localhost"; // sets the SMTP server
  $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "suporte@agiz.com.br"; // SMTP account username
  $mail->Password   = "burubstr2";        // SMTP account password
  $mail->AddReplyTo('claytonnovo2010@gmail.com', 'clayton gmail');
  $mail->AddAddress('claytonn@hotmail.com', 'Clayton Hotmail');
  $mail->SetFrom('aprovados@agiz.com.br', 'Aprovados Sistema Agiz');
  $mail->AddReplyTo('clayton@pontualeventos.com.br', 'Clayton Pontual');
  $mail->Subject = $texto;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($corpo_mensagem);
  //$mail->MsgHTML(file_get_contents('contents.html')); 
  $mail->AddAttachment('images/mdias.pdf');      // attachment
  $mail->AddAttachment('images/ccaa.pdf'); // attachment
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
}
?>

</body>
</html>
