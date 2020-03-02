<?php

$dbname="gestor_evento"; // Indique o nome do banco de dados que será aberto
$userlogin="root"; // Indique o nome do usuário que tem acesso
$passwordagiz="Blaster631xd"; // Indique a senha do usuário

//1º passo - Conecta ao servidor MySQL
if(!($conexao = mysql_connect("localhost",$userlogin,$passwordagiz))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {
	


}
//2º passo - Seleciona o Banco de Dados
if(!($db=mysql_select_db($dbname,$conexao))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {

}
?>
