<?php
session_start();
include('../inc/conexao.php');

$numero_desenho = $_REQUEST['numero_desenho'];
$id_atendimento = $_REQUEST['id_atendimento'];
$id_briefing = $_REQUEST['id_briefing'];
$id_usuario = $_SESSION['id_usuario'];
$id_pai = $_SESSION['id_pai'];
$today = date_create('now', new DateTimeZone('America/Recife'));
$created = $today->format("Y-m-d H:i:s");
$modified = $created;

//Receber os dados do formulário
$tmp_name = $_FILES['arquivo']['tmp_name'];
$name = $_FILES['arquivo']['name'];

$explode = explode('.' ,$name);
$nome = $explode[0];
$tipo_arquivo = $explode[1];		
$name = "layout".$id_briefing."-".$numero_desenho.".".$tipo_arquivo;

//Fazer o Upload
move_uploaded_file($tmp_name, 'upload/'. $name);

mysql_query("INSERT INTO arquivo 
						(id_briefing, id_created, created, modified, id_pai, nome_arquivo			
						) ". 
						"VALUES ('$id_briefing', '$id_usuario', '$created', '$modified', '$id_pai', '$name');",$conexao);

$db_sucess = '1';

mysql_query("UPDATE briefing SET 
	data_finalizado = NOW(), 
	motivo = 1, 
	status = 1, 
	numero_desenho = ".$numero_desenho."
							WHERE id = '".$id_briefing."'" ,$conexao);

if($db_sucess!=''){
	$_SESSION['msg'] = "<div class='alert alert-success'>Imagem cadastrada com sucesso!</div> <br> <a href='../home_projeto/index.php'><font size=5px>!! CLIQUE AQUI PARA CONCLUIR!!</font></a><br><br><br>";
		$_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
		$_SESSION['time_message'] = time();
		echo "<script>location.href='../home_projeto/index.php';</script>";	
	
	
}else{
	$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrada a imagem!</div>";
}
?>