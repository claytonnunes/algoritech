<?php
if ( ! isset( $_SESSION['usuario'] ) && ! isset( $_SESSION['senha'] ) ) {
    // Ação a ser executada: mata o script e manda uma mensagem
	echo "<script language='javascript' type='text/javascript'>
              	alert('Sessão não inicializada!');
              </script>";			
        echo "<script>location.href='../login.php';</script>";
    exit('Usuário não está logado');
} 
else {	
    $modulo = $_SESSION['modulo'];
    if ($modulo == 1) {
        include (MODULO_FINANCEIRO);
    } 
    elseif ($modulo == 2) {
        include (MODULO_MARKETING);
    } 
    elseif ($modulo == 3) {
        include (MODULO_OPERACIONAL);
    } 
    elseif ($modulo == 4) {
        include (MODULO_PROJETO);
    } 
    elseif ($modulo == 5) {
        include (MODULO_VENDAS);
    } 
    else {
        include (ERROR);
    }
}
?>