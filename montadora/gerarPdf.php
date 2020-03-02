<?php
require_once('./config.php');
include ('./pdf/mpdf.php');
include ('./inc/database.php');
$db = open_database();


$result = "Select * from visitantes";
$result = mysqli_query($db,$result);
$row = mysqli_fetch_assoc($result);


$pagina =
    "<html>
			<body>
				<h1>Relatório Lista de Usuário</h1>
				Nome :".$row['nome']."<br>
                Senha :".$row['nome']."<br>
				
			</body>
		</html>
		";


$arquivo = "RelatorioAlgoriTech.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');
exit();
// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
?>
