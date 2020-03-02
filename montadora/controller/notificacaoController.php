<?php
$notificacoes = null;
$notificacao = null;

function pesquisaNotificacao($coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null) {
	global $notificacoes;
    $notificacoes = pesquisa_tres_colunas('notificacao', $coluna1, $valor1, $coluna2, $valor2, $coluna3, $valor3, $condicao);
}
?>