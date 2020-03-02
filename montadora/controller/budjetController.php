<?php
$budjets = null;
$budjet = null;

function pesquisaBudjet($valor1 = null) {
    global $negociacoes;
    $condicao = 'ORDER BY id ASC';
	$negociacoes = pesquisa_tres_colunas('budjet', 'id_pai', $_SESSION['id_pai'], 'id_negocio', $valor1, 'deleted', '0', $condicao);
}