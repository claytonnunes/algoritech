<?php
function salvarCheckin() {
    $db = open_database();

    if (!empty($_POST['cpf'])) {
        $today = date_create('now', new DateTimeZone('America/Recife'));
        
        $checkin["cpf"] = $_POST['cpf'];
        $checkin['created'] = $today->format("Y-m-d H:i:s");
        $checkin['modified'] = $checkin['created'];
        
        $retorno = validarCadastroCpfEmpresa($checkin['cpf'], $db);
        
		if($retorno){
			save('checkins', $checkin);
            echo "<script>alert(".json_encode($_SESSION['message']).")</script>";
        } else{
        	$_SESSION['message'] = "Empresa não cadastrado! Favor realizar o cadastro!";
			echo "<script>alert(".json_encode($_SESSION['message']).")</script>";
            
		}

    } 
}

function validarCadastroCpfEmpresa($cpf, $db) {
    $existeEmpresa = false;

    $sql = "SELECT * FROM empresas WHERE cpf = '$cpf' ";

    $search = mysqli_query($db, $sql);
        //mysqli_result['num_rows']
        // var_dump($search);
    if (isset($search)) {
        $row = mysqli_fetch_array($search,MYSQLI_ASSOC);
    }

    if(isset($row) > 0){
        $existeEmpresa = true;
    }

    return $existeEmpresa;

}

?>