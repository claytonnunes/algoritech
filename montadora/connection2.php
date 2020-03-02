<?php

$dbname="gestor_evento"; // Indique o nome do banco de dados que será aberto
$userlogin="gestor_evento"; // Indique o nome do usuário que tem acesso
$passwordagiz="gara591xd"; // Indique a senha do usuário

//1º passo - Conecta ao servidor MySQL
if(!($connection = mysql_connect("gestor_evento.mysql.dbaas.com.br",$userlogin,$passwordagiz))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {
 // echo "Conectado ao banco de dados";
}
//2º passo - Seleciona o Banco de Dados
if(!($db=mysql_select_db($dbname,$connection))) {
   echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {
// echo "Banco de dados selecionado";
}


/*


$connection = mysql_connect('localhost','agiz',')0VGF%7L')
   or die ("erro mysql-3");

$db = mysql_select_db("agiz_dbwebagiz")
   or die ("erro no bd");

*/
?>