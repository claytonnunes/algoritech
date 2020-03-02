<?php
ini_set( 'display_errors', true );error_reporting( E_ALL );
?>
<?php
session_start();
?>
<?php
require_once('./config.php');
require_once(DBAPI);

require_once('./controller/logController.php');
$db = open_database();

// CODIGO PARA CRIAR SESSÃO DO USUARIO E INICIAR O SISTEMA	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// username and password sent from form
    $usuario = mysqli_real_escape_string($db,$_POST['usuario']);
	$senha = md5($_POST['senha']);
	//$senha = mysqli_real_escape_string($db,$_POST['senha']);
    $sql = "SELECT id FROM usuarios WHERE usuario = '$usuario' and senha = '$senha' and status = '0'";
	
    $result = mysqli_query($db,$sql);
	
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
    if ($row == 0) {
		
        echo "<script language='javascript' type='text/javascript'>
                    alert('Usuário / Senha incorreta!');
                 </script>";
        echo "<script>location.href='login.php';</script>";


    } 
	
	
	else if ($row > 0){
		
        $query = mysqli_query($db,"SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'");

        while ($l = mysqli_fetch_array($query)) //percorre registros da tabela
        {
			$id_usuario = $l["id"];
            $nivel = $l["tipo_acesso"];			
			$tipo_conta = $l["tipo_conta"];
			$nome_usuario = $l["nome_usuario"];
			$modulo = $l["modulo"];
			$id_pai = $l["id_pai"];
			if ($id_pai==0){
				$id_pai = $id_usuario;
				}
				else{
					$id_pai = $id_pai;
				}
			 //armazena o valor do campo nome que satisfaça as condições da query
           	$_SESSION["usuario"] = $usuario;
            $_SESSION["senha"] = $senha;
			$_SESSION["nome_usuario"] = $nome_usuario;
			$_SESSION["id_pai"] = $id_pai;
			$_SESSION["id_usuario"] = $id_usuario;
			$_SESSION["tipo_acesso"] = $nivel;	
			$_SESSION["tipo_conta"] = $tipo_conta;
			$_SESSION["modulo"] = $modulo;
			
			salvarLog('1');
			
			if ($modulo == '1'):
				header ("location: home_financeiro/index.php");
			elseif ($modulo == '2' ):
				header ("location: home_marketing/index.php");
			elseif ($modulo == '3' ):
				header ("location: home_operacional/index.php");
			elseif ($modulo == '4' ):
				header ("location: home_projeto/index.php");
			elseif ($modulo == '5' ):
				header ("location: eventos/eventos.php");
			else: 
				header ("location: eventos/eventos.php");
			endif;
        }
    }
}

// CODIGO PARA CRIAR SESSÃO DO EVENTO E INICIAR A GESTÃO DOS ATENDIMENTOS
if (isset ($_REQUEST['acao'])):

	if ($_REQUEST['acao']=="seleciona_evento"):
		$_SESSION["id_edicao"] = $_REQUEST['id_edicao'];
		$_SESSION["id_evento"] = $_REQUEST['id_evento'];
		$_SESSION["nome_edicao"] = $_REQUEST['nome_edicao'];		  	
        echo "<script>location.href='./atendimentos/index.php';</script>";
	endif;
	else:
	echo "<script>location.href='./eventos/eventos.php';</script>";
endif;
?>