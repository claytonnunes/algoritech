<?php
$contas = null;
$conta = null;

/**
 *  Listagem de contas
 */
function findConta() {
	$id_pai = $_SESSION["id_pai"];
    global $contas;
    $contas = find_columns('conta', 'id_pai', $id_pai);
}
function salvarConta(){
    $result = false;
    if (!empty($_POST['conta'])) {
		$id_pai = $_SESSION["id_pai"];
        $id_usuario = $_SESSION["id_usuario"];
        $today =
            date_create('now', new DateTimeZone('America/Recife'));
        $conta = $_POST['conta'];
        $conta['created'] = $today->format("Y-m-d H:i:s");
        $conta['modified'] = $conta['created'];
		$conta['id_pai'] = $id_pai;
		$conta['id_created'] = $id_usuario;		
		$result = save('conta', $conta);
		//header('location: ../eventos/eventos.php');
		echo "<script>location.href='../eventos/eventos.php';</script>";	
	}
}