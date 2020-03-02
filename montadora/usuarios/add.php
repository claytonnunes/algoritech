<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
?>
<?php

   //Tira os espaços em branco do começo e do fim
   $novo_usuario = trim($_POST['login_usuario']);
    		if(empty($novo_usuario) || is_null($novo_usuario)) {
			echo "<script language='javascript' type='text/javascript'>
					alert('O campo de usuário não pode estar vazio!');
				</script>";			
			echo "<script>location.href='../cadastro.php';</script>";	
			
		
		} else if (strrpos($novo_usuario, " ") !== false) { //Procura a última ocorrência de espaço
			echo "<script language='javascript' type='text/javascript'>
					alert('Não pode conter espaço no campo usuário!');
				</script>";			
			echo "<script>location.href='../cadastro.php';</script>";
		} else {
			
			require_once('../controller/usuarioController.php');
			pesquisaUsuario();
			
			if ($usuarios) : 
			foreach ($usuarios as $usuario) :
					echo "<script language='javascript' type='text/javascript'>
						alert('Usuário já existe! Digite um usuario diferente!');
					</script>";			
				echo "<script>location.href='../cadastro.php';</script>";
					
				endforeach;
			else : 
				salvarUsuarioCripto();
				//salvarUsuario();				
		endif; 
		}
	
	
?>


