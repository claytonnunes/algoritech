<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
?>
<?php
require_once('../controller/cotacaoController.php');
require_once('../controller/produtoController.php');
require_once('../controller/usuarioController.php');
require_once('../controller/empresasController.php');
require_once('../controller/eventosController.php');

if (isset($_REQUEST['acao'])) {
	if ($_REQUEST['acao']=='gerarPdf'){
		pesquisaUsuarioTres('id', $_SESSION['id_usuario'], 'id_pai', $_SESSION['id_pai'], 'status', '0');
		if ($usuarios) {
			foreach ($usuarios as $usuario) {
				$nomeUsuario = $usuario['nome_usuario'];
				$cargo = $usuario['cargo'];

				$fone = substr($usuario['fone'], 0, 2) . "-" . substr($usuario['fone'], 2, 4). "." . substr($usuario['fone'], -4);
				$celular = substr($usuario['celular'], 0, 2) . "-" . substr($usuario['celular'], 2, 5). "." . substr($usuario['celular'], -4);
					
				$email = $usuario['email'];
				$siteEmpresa = $usuario['site_empresa'];
				$instagramEmpresa = $usuario['instagram_empresa'];
			}
		}
		pesquisaProdutoTres('id', $_REQUEST['id_negocio'], 'id_pai', $_SESSION['id_pai'], 'deleted', '0');
		if ($grupo_produtos) {
			foreach ($grupo_produtos as $grupo_produto) {
				$nomeNegociacao = $grupo_produto['nome'];
				$idEdicao = $grupo_produto['id_edicao'];
				$idEmpresa = $grupo_produto['id_empresa'];
			}
		}
		pesquisaEmpresaId('id', $idEmpresa, 'id_pai', $_SESSION['id_pai'], 'deleted', '0');
		if ($empresas) {
			foreach ($empresas as $empresa) {
				$nomeEmpresa = $empresa['nome_fantasia'];
			}
		}
		pesquisaEdicaoId($idEdicao);
		if ($eventos) {
			foreach ($eventos as $evento) {
				$nomeEdicao = $evento['nome_edicao'];
				$inicio_evento = $evento['inicio_evento'];
				$date_arr= explode(" ", $inicio_evento);
				$date= $date_arr[0];						
				$explode = explode('-' ,$date);
				$inicio_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
				$time= $date_arr[1];
				
				$fim_evento = $evento['fim_evento'];
				$date_arr= explode(" ", $fim_evento);
				$date= $date_arr[0];						
				$explode = explode('-' ,$date);
				$fim_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
				$time= $date[1];						
				$periodoEvento = $inicio_evento." à ".$fim_evento; 
			}
		}
		pesquisaCotacao('numero_cotacao', $_REQUEST['numero_cotacao'],'deleted', '0','id_grupo_produto', $_REQUEST['id_negocio'], 'ORDER BY id_cotacao DESC');
	
	}
}
?>  
<?php
	$dia = date("d");
	$mes = date("m");
	$ano = date("Y");
	switch ($mes){
	case 1: $mes = "JANEIRO"; break;
	case 2: $mes = "FEVEREIRO"; break;
	case 3: $mes = "MARÇO"; break;
	case 4: $mes = "ABRIL"; break;
	case 5: $mes = "MAIO"; break;
	case 6: $mes = "JUNHO"; break;
	case 7: $mes = "JULHO"; break;
	case 8: $mes = "AGOSTO"; break;
	case 9: $mes = "SETEMBRO"; break;
	case 10: $mes = "OUTUBRO"; break;
	case 11: $mes = "NOVEMBRO"; break;
	case 12: $mes = "DEZEMBRO"; break;
	}

	function extenso($valor = 10, $maiusculas = false) { 

		$singular = array("CENTAVOS", "REAL", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO", "QUATRILHÃO"); 
		$plural = array("CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", 
		"QUATRILHÕES");
		
		$c = array("", "CEM", "DUZENTOS", "TREZENTOS", "QUATROCENTOS", 
		"QUINHENTOS", "SEISCENTOS", "SETECENTOS", "OITOCENTOS", "NOVECENTOS"); 
		$d = array("", "DEZ", "VINTE", "TRINTA", "QUARENTA", "CINQUENTA", 
		"SESSENTA", "SETENTA", "OITENTA", "NOVENTA"); 
		$d10 = array("DEZ", "ONZE", "DOZE", "TREZE", "QUATORZE", "QUINZE", 
		"DEZESSEIS", "DEZESETE", "DEZOITO", "DEZENOVE"); 
		$u = array("", "UM", "DOIS", "TRÊS", "QUATRO", "CINCO", "SEIS", 
		"SETE", "OITO", "NOVE"); 
		
		$z = 0; 
		$rt = "";
		
		$valor = number_format($valor, 2, ".", "."); 
		$inteiro = explode(".", $valor); 
		for($i=0;$i<count($inteiro);$i++) 
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++) 
		$inteiro[$i] = "0".$inteiro[$i]; 
		
		$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2); 
		for ($i=0;$i<count($inteiro);$i++) { 
			$valor = $inteiro[$i]; 
			$rc = (($valor > 100) && ($valor < 200)) ? "CENTO" : $c[$valor[0]]; 
			$rd = ($valor[1] < 2) ? "" : $d[$valor[1]]; 
			$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : ""; 
			
			$r = $rc.(($rc && ($rd || $ru)) ? " E " : "").$rd.(($rd && 
			$ru) ? " E " : "").$ru; 
			$t = count($inteiro)-1-$i; 
			$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : ""; 
			if ($valor == "000")$z++; elseif ($z > 0) $z--; 
			if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " DE " : "").$plural[$t]; 
			if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && 
			($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " E ") : " ") . $r; 
		} 
		
		if(!$maiusculas){ 
			return($rt ? $rt : "ZERO"); 
		} 
		else { 
			if ($rt) $rt=ereg_replace(" E "," E ",ucwords($rt));
			return (($rt) ? ($rt) : "ZERO"); 
		} 
		
	} 
		
	$valor = $valor_total;
	$dim = extenso($valor);
	$dim = ereg_replace(" E "," E ",ucwords($dim));
	$valor = number_format($valor, 2, ",", ".");
	
	$nome_arquivo = "cotacao".$_REQUEST['id_negocio']."-".$_REQUEST['numero_cotacao'].".pdf"; 			
	
	$textoData= "$dia - $mes - $ano\n\n";	
	$textoCodigo= "CODIGO DA COTAÇÃO: ".$_REQUEST['id_negocio']."-".$_REQUEST['numero_cotacao']."\nNOME DO NEGÓCIO: ".$nomeNegociacao." \n";	

	$dadosCotacao= "EMPRESA: ".$nomeEmpresa." \nEVENTO: ".$nomeEdicao." \nPERÍODO: ".$periodoEvento." \n\n";
	
	$formaDePagamento= "\nFORMA DE PAGAMENTO: \nA COMBINAR ";
	
	$assinatura= "\n\nATENCIOSAMENTE, \n\n".$nomeUsuario." \n".$cargo." \n".$fone." / ".$celular." \n".$email." \n".$siteEmpresa." \n".$instagramEmpresa."";
	
	$validadeCotacao = "\nVALIDADE DA PROPOSTA: 5 DIAS";

	$titulo = "Sistema Algoritech";  //TÃÿTULO DO RELATÃÿRIO
	$tipo_pdf = "F";

	define("FPDF_FONTPATH", "../biblioteca/font/");
	require_once("../biblioteca/fpdf.php");
	$pdf= new FPDF("P","mm","A4");
 			
	class PDF extends FPDF { //Page header 
	function header () { 
	$this->Image('../img/upload/logo_pontual.jpg' ,85 ,5 ,40 ,24 );	
	$this->Image('../img/upload/rodape_pontual.jpg' ,0 ,271 ,210 ,26 );	
	$this-> SetFont ( 'Arial' , '' , 6 ); //Move to the right 
	$this->SetTextColor(55);	
	$this-> Ln ( 20 ); } 
	function footer () { 
	
	//Position at 1.5 cm from bottom 
	$this-> SetY (- 15 ); //Arial italic 8 
	$this-> SetFont ( 'Arial' , 'I' , 8 ); //Page number 
	
	} } //Instanciation of inherited class 

	$pdf =new PDF ("P","mm","A4"); 
	$pdf -> AliasNbPages (); 
	$pdf -> AddPage (); 

	$pdf->SetFont('arial','',12);
	$pdf->SetTextColor(55);

	$pdf->SetTextColor(55);
	$pdf->SetFont ( 'Arial' , '' , 10 );  

	$xt = $xt + 15;
	$pdf->SetXY(15,$xt);
	$pdf->MultiCell(180,5,$textoData,0,'J', 0);	

	$pdf->SetFont ( 'Arial' , 'B' , 8 ); 
	
	$pdf->SetX(15);
	$pdf->MultiCell(180,5,$textoCodigo,0,'J', 0);

	$pdf->SetFont('arial','',8);
	$pdf->SetX(15);
	$pdf->MultiCell(180,5,$dadosCotacao,0,'J', 0);

	$pdf->SetX(15);
	$pdf->MultiCell(180,5, '',0,'J', 0);
	
	$pdf->SetFont('arial','B',8);
	$pdf->SetX(15);
	$pdf->MultiCell(180,0, 'PRODUTO',0,'J', 0);

	$pdf->SetX(115);
	$pdf->MultiCell(20, 0, 'QTDA.',0,'J', 0);

	$pdf->SetX(130);
	$pdf->MultiCell(50, 0, 'SUBTOTAL',0,'J', 0);

	$pdf->SetX(155);
	$pdf->MultiCell(50, 0, 'DESCONTO',0,'J', 0);

	$pdf->SetX(180);
	$pdf->MultiCell(50, 0, 'TOTAL',0,'J', 0);

	$pdf->SetFont('arial','',8);
	$pdf->SetX(15);
	$pdf->MultiCell(200,10,"-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,'J', 0);

	if ($cotacoes) { 
				
		foreach ($cotacoes as $cotacao) {
			$quantidade = $cotacao['quantidade'];
			$valorUnidade = $cotacao['valor_unidade'];
			$descontoUnidade = $cotacao['valor_desconto'];
			$somaDescontoQuantidade = $descontoUnidade * $quantidade;
			
			$somaDescontoTotal += $somaDescontoQuantidade;

			$subTotal = $valorUnidade * $quantidade;
			
			$valorUnidadeTotal = $subTotal - $somaDescontoQuantidade;

			$somaTotal += $subTotal;
			$somaTotalCobrado  = $somaTotal - $somaDescontoTotal;

			$dim = extenso($somaTotalCobrado);
			$dim = ereg_replace(" E "," E ",ucwords($dim));
			$valor = number_format($valor, 2, ",", ".");

			if(isset($_SESSION['metro_quadrado'])):
				$metroQuadrado = $_SESSION['metro_quadrado'];
			else:
				$metroQuadrado = '0';
			endif;
			$valorMetroQuadrado = $somaTotalCobrado / $metroQuadrado;
			
			$unidadeMedida = $cotacao['unidade_medida']; 
			if ($unidadeMedida == 1):
				$unidadeMedida = $cotacao['quantidade'].' unid.';
			elseif ($unidadeMedida == 2):
				$unidadeMedida = $cotacao['quantidade'].' m2';
			elseif ($unidadeMedida == 3):
				$unidadeMedida = $cotacao['quantidade'].' mL';
			else:
				$unidadeMedida = $cotacao['quantidade']; 
			endif;

			$pdf->SetX(15);
			$pdf->MultiCell(180,0, $cotacao['nome_produto'],0,'J', 0);

			$pdf->SetX(115);
			$pdf->MultiCell(20,0, $unidadeMedida,0,'J', 0);

			$pdf->SetX(130);
			$pdf->MultiCell(50,0, number_format($subTotal, 2, ',', '.'),0,'J', 0);

			$pdf->SetX(155);
			$pdf->MultiCell(50,0, number_format("-".$somaDescontoQuantidade, 2, ',', '.'),0,'J', 0);

			$pdf->SetX(180);
			$pdf->MultiCell(50,0, number_format($valorUnidadeTotal, 2, ',', '.'),0,'J', 0);

			$pdf->SetX(15);
			$pdf->MultiCell(90,7, $cotacao['descricao'],0,'J', 0);
			

			$pdf->SetX(15);
			$pdf->MultiCell(200,5,"-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,'J', 0);
		}
	}

	$pdf->SetX(15);
	$pdf->MultiCell(180,5,"SUBTOTAL: R$ ".number_format($somaTotal, 2, ',', '.'),0,'J', 0);

	$pdf->SetX(15);
	$pdf->MultiCell(180,5,"DESCONTO: R$ - ".number_format($somaDescontoTotal, 2, ',', '.'),0,'J', 0);

	$pdf->SetFont ( 'Arial' , 'B' , 8 );  

	$pdf->SetX(15);
	$pdf->MultiCell(180,5,"VALOR TOTAL: R$ ".number_format($somaTotalCobrado, 2, ',', '.')." (".$dim." )",0,'J', 0);

	$pdf->SetFont ( 'Arial' , '' , 8 );  

	$pdf->SetX(15);
	$pdf->MultiCell(180,5,$formaDePagamento,0,'J', 0);

	$pdf->SetX(15);
	$pdf->MultiCell(180,5, $validadeCotacao,0,'J', 0);

	$pdf->SetX(15);
	$pdf->MultiCell(180,5,$assinatura,0,'J', 0);

$pdf->Output("upload/".$nome_arquivo."", "$tipo_pdf");
header("Location: upload/".$nome_arquivo."");
?>
