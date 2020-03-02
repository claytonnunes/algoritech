<?php

$dbname="gestor_evento"; // Indique o nome do banco de dados que será aberto
$userlogin="gestor_evento"; // Indique o nome do usuário que tem acesso
$passwordagiz="gara591xd"; // Indique a senha do usuário

//1º passo - Conecta ao servidor MySQL
if(!($conexao = mysql_connect("gestor_evento.mysql.dbaas.com.br",$userlogin,$passwordagiz))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {
 // echo "Conectado ao banco de dados";
}
//2º passo - Seleciona o Banco de Dados
if(!($db=mysql_select_db($dbname,$conexao))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {
// echo "Banco de dados selecionado";
}

?>
