<?php
session_start();
?>
<?
//require "../include/valida_cookies.php";
require ("conexao.php");

$q=strtolower ($_GET["q"]);

$string=$nome_fantasia;
			function tirarAcentos($string){
				return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
			}
			$q = tirarAcentos($string);

$id_conta = $_SESSION["id_conta_vendas"];
	
	

$sql = "SELECT * FROM empresas WHERE id_conta = ".$id_conta." AND nome_fantasia like '%" . $q . "%'";

$query = mysql_query($sql);// or die ("Erro". mysql_query());

while($reg=mysql_fetch_array($query)){

	//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
		$busca_empresa_cliente = utf8_encode($reg["nome_fantasia"]);
		echo $busca_empresa_cliente."\n";
		
//	}
}
?>