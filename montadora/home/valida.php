<?php
session_start();
?>
<?php 
	if (isset ($_REQUEST['acao'])):
		if ($_REQUEST['acao']=="select_conta"):
			$_SESSION["sess_edition_vendas"] = $_REQUEST['id_edicao'];
			$_SESSION["sess_fair_vendas"] = $_REQUEST['id_evento'];
			$_SESSION["sess_name_fair_vendas"] = $_REQUEST['nome_evento'];		  	
        echo "<script>location.href='../atendimentos/index.php';</script>";
		endif;
		else:
		echo "<script>location.href='../eventos/eventos.php';</script>";
	endif;
	echo "<script>location.href='../eventos/eventos.php';</script>";
	?>