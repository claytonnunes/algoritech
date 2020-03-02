<?php 
session_start();

function getProducts($pdo){
	$sql = "SELECT *  FROM produto WHERE id_pai = ".$_SESSION['id_pai']."";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsSearch($pdo){
	$sql = "SELECT *  FROM produto WHERE nome_produto like '%".$_REQUEST['nome_produto']."%' AND id_pai = ".$_SESSION['id_pai']."";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByIds($pdo, $ids) {
	$sql = "SELECT * FROM produto WHERE id_pai = ".$_SESSION['id_pai']." and id IN (".$ids.")";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}