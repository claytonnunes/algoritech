<?php
	include_once("conexao.php");
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$nome = mysqli_real_escape_string($conn, $_POST['nome']);
	$detalhes = mysqli_real_escape_string($conn, $_POST['detalhes']);
	echo "$id - $nome - $detalhes";
	$result_cursos = "UPDATE cursos SET nome='$nome', detalhes =  '$detalhes' WHERE id = '$id'";
	
	$resultado_cursos = mysqli_query($conn, $result_cursos);	
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="ISO-8859-1">
	</head>

	<body> <?php
		if(mysqli_affected_rows($conn) != 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http:index.php'>
				<script type=\"text/javascript\">
					alert(\"Curso alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http:index.php'>
				<script type=\"text/javascript\">
					alert(\"Curso n�o foi alterado com Sucesso.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>