<?php
$arquivos = null;
$arquivo = null;

function pesquisaArquivoTres($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null) {
	global $arquivos;
    $arquivos = pesquisa_tres_colunas('arquivo', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3);
}
?>