<?php
session_start();
?>
<?php
    require_once ('../config.php');
    require_once(DBAPI);
    require_once ("../inc/visibilidade-header.php");
    require_once ("../modal/modalEdita.php");
    require_once('../controller/empresasController.php');
    include_once("")
     
?>

<?php 
    if(isset($_POST['editaempresa']))
    {
        
        $id = $_POST['id'];
        $nome = $_POST['nome_fantasia'];
        $razao_social = $_POST['razao_social'];
        $fone = $_POST['fone'];
        $cnpj = $_POST['cnpj'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $website = $_POST['website'];


            echo "$id - $nome - $razao_social";
            $query = "UPDATE empresas SET nome_fantasia = '$nome', razao_social = '$razao_social', fone = '$fone', cnpj = '$cnpj', cep = '$cep', endereco = '$endereco', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = $estado, website = '$website', instagram = '$instagram' WHERE id = 'id' ";
            $pdo = new PDO("mysql:host=localhost;dbname=gestor_evento", "root", "Blaster631xd", "$query");
       
            if($pdo)
    {

        echo '<script> alert("Editado Com Sucess"); </script>';
        header("location: processa.php");
    }  
        else{

            echo '<script> alert("Não Foi Possivel Editar a Empresa");</script>';
        }
}
    /*
   function editarEmpresa() {
    $now = date_create('now', new DateTimeZone('America/Recife'));
    if (isset($_POST['editaempresa'])) {
        $id = $_POST['id'];
        
            $empresa = $_POST['empresa'];
            $empresa['modified'] = $now->format("Y-m-d H:i:s");
			
			$empresa['nome_fantasia'] = $_REQUEST['nome_fantasia'];
			$empresa['razao_social'] = $_REQUEST['razao_social'];
			$empresa['endereco'] = $_REQUEST['endereco'];
			$empresa['complemento'] = $_REQUEST['complemento'];
			$empresa['bairro'] = $_REQUEST['bairro'];
			$empresa['cidade'] = $_REQUEST['cidade'];
			$empresa['website'] = $_REQUEST['website'];
			update('empresas', $id, $empresa);
            
            
            $query = "UPDATE empresas SET nome_fantasia = '$nome' WHERE id = '$id' ";
            $query_run = mysql_query($connection, $query);
            }
        
    } else {
        //header('location: index.php');
		echo "<script>location.href='index.php';</script>";	
    }
}
*/

?>