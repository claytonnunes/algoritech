<?php

$dbname="gestor_evento"; // Indique o nome do banco de dados que ser� aberto
$userlogin="root"; // Indique o nome do usu�rio que tem acesso
$passwordagiz="Blaster631xd"; // Indique a senha do usu�rio

//1� passo - Conecta ao servidor MySQL
if(!($conexao = mysql_connect("localhost",$userlogin,$passwordagiz))) {
   echo "N�o foi poss�vel estabelecer uma conex�o com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {
	


}
//2� passo - Seleciona o Banco de Dados
if(!($db=mysql_select_db($dbname,$conexao))) {
   echo "N�o foi poss�vel estabelecer uma conex�o com o gerenciador MySQL. Favor Contactar o Administrador.";
   exit;
} else {

}
?>
