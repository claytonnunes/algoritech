<?php
session_start();
?>
<?php

//@ini_set('display_errors', 0);
header('Content-type: text/html; charset=ISO-8859-1'); 
//date_default_timezone_set("Brazil/East");

require_once ('../config.php');
require_once(DBAPI);
//require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/negocioController.php');
//require_once('../controller/atendimentosController.php');
require_once('../controller/vendasController.php');
require_once('../controller/eventosController.php');
require_once('../controller/briefingController.php');
require_once('../controller/empresasController.php');
require_once('../controller/usuarioController.php');
require_once('../controller/cotacaoController.php');
require_once('../controller/contatosController.php');
require_once('../controller/equipeController.php');
findVendedores();
	
pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'deleted', '0', '0', '0', 'ORDER BY status ASC');
		
if ($negociacoes) {
	foreach ($negociacoes as $negociacao) {
		$idEdicao = $negociacao['id_edicao'];
		$estagio = $negociacao['estagio'];
		$idEmpresa = $negociacao['id_empresa'];
        $nomeNegocio = $negociacao["nome"];
        $statusNegocio = $negociacao["status"];
        if ($statusNegocio == 0) {
            $statusNegocio = 'prospect';
        }
        elseif ($statusNegocio == 1) {
            $statusNegocio = 'ganhou';
        }
        elseif ($statusNegocio == 2) {
            $statusNegocio = 'perdeu';
        }
        else{
            $statusNegocio = 'indefinido';
        }
		$somaEstagioTotal++;
		pesquisaUsuarioTres('id', $negociacao['id_usuario'], 'id_pai', $_SESSION['id_pai'], 'deleted', '0');
		if ($usuarios) {
			foreach ($usuarios as $usuario) {
				$idVendedor = $usuario['id'];
				$nomeVendedor = $usuario['nome_usuario'];
			}
		}
		pesquisaBriefingTres('id_grupo_produto', $negociacao['id'], 'id_pai', $_SESSION['id_pai'], 'status', '0');
		if ($briefings) {
			foreach ($briefings as $briefing) {
				$idBriefing = $briefing['id'];
				$idNegocioBriefing = $briefing['id_grupo_produto'];
				$somaEstagioUm++;
				$estimativaEstagioUm += $negociacao['valor_estimado'];
			}
		}
		if (($negociacao['estagio']=="1")and($negociacao['id']!=$idNegocioBriefing)) {
			$somaEstagioZero++;
			$estimativaEstagioZero += $negociacao['valor_estimado'];
		}
		else if (($negociacao['estagio']=="2") and($negociacao['id']!=$idNegocioBriefing)) {
			$somaEstagioDois++;
			$estimativaEstagioDois += $negociacao['valor_estimado'];
		}
		else if (($negociacao['estagio']=="3") and($negociacao['id']!=$idNegocioBriefing)) {
			$somaEstagioTres++;
			$estimativaEstagioTres += $negociacao['valor_estimado'];
		}
		else{

		}
		pesquisaEdicaoId($idEdicao);	
		if ($eventos) {
			foreach ($eventos as $evento) {
                $nomeEdicao = $evento['nome_edicao'];
                $inicioEvento = $evento['inicio_evento'];
				pesquisaEmpresaId('id', $idEmpresa, 'id_pai', $_SESSION['id_pai'], 'deleted', '0');
				if ($empresas) {
					foreach ($empresas as $empresa) {
                        $nomeEmpresa = $empresa['nome_fantasia'];
                        $idEmpresa = $empresa['id'];
                        pesquisaContato($idEmpresa); 
                        if ($contatos) {
                            foreach ($contatos as $contato) {
                                $nomeContato = $contato['nome'];
                                $idContato = $contato['id'];
                                $emailContato = $contato['email'];
                                $celularContato = $contato['celular'];
                                $instagramContato = $contato['instagram'];
                           
                                $estimativaEstagioTotal += $negociacao['valor_estimado'];
                                $quantidadeNegocios++;
                                $arrayNegocios[] = array(	
                                    'idContato' => $idContato,
                                    'nomeEmpresa' => $nomeEmpresa,
                                    'nomeNegocio' => $nomeNegocio,
                                    'nomeContato' => $nomeContato,	
                                    'emailContato' => $emailContato,
                                    'celularContato' => $celularContato,
                                    'instagramContato' => $instagramContato,	
                                    'status' => $statusNegocio,
                                    'estagio' => $negociacao['estagio'],
                                    'nomeEdicao' => $nomeEdicao,
                                    'inicioEvento' => $inicioEvento,
                                    'nomeVendedor' => $nomeVendedor,
                                    'canalCaptacao' => $negociacao['canal_captacao'],
                                    'potencialVenda' => $negociacao['potencial_venda'],
                                    'tempoAtendimento' => '0'
                                    );		
                                    sort($row['id']);
                                }
                            }
                           
					}
				}
			}
		}
		
	}
}	
?>  





<?php
//@ini_set('display_errors', 0);
//header('Content-type: text/html; charset=utf-8'); 
//date_default_timezone_set("Brazil/East");

	
// Nome do Arquivo do Excel que serÃ¡ gerado
$arquivo = 'dados_marketing.xls';

// Criamos uma tabela HTML com o formato da planilha para excel
$tabela = '<table border="1">';
$tabela .= '<tr> DADOS MARKETING 2019 </tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>COD CONTATO</b></td>';
$tabela .= '<td><b>EMPRESA</b></td>';
$tabela .= '<td><b>NEGÓCIO</b></td>';
$tabela .= '<td><b>CONTATO</b></td>';
$tabela .= '<td><b>E-MAIL</b></td>';
$tabela .= '<td><b>WHATSAPP</b></td>';
$tabela .= '<td><b>INSTAGRAM</b></td>';
$tabela .= '<td><b>STATUS</b></td>';
$tabela .= '<td><b>ESTÁGIO</b></td>';
$tabela .= '<td><b>EVENTO</b></td>';
$tabela .= '<td><b>INAUGURAÇÃO</b></td>';
$tabela .= '<td><b>VENDEDOR</b></td>';
$tabela .= '<td><b>CANAL CAPTAÇÃO</b></td>';
$tabela .= '<td><b>POTENCIAL</b></td>';
$tabela .= '<td><b>TEMPO DE ATENDIMENTO</b></td>';


$tabela .= '</tr>';

// Puxando dados do Banco de dados
if ($arrayNegocios) {
    foreach ($arrayNegocios as $arrayNegocio) {
        $tabela .= '<tr>';
        $tabela .= '<td>'.$arrayNegocio['idContato'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['nomeEmpresa'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['nomeNegocio'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['nomeContato'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['emailContato'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['celularContato'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['instagramContato'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['status'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['estagio'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['nomeEdicao'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['inicioEvento'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['nomeVendedor'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['canalCaptacao'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['potencialVenda'].'</td>';
        $tabela .= '<td>'.$arrayNegocio['tempoAtendimento'].'</td>';
        $tabela .= '</tr>';
    }
}

$tabela .= '</table>';

// ForÃ§a o Download do Arquivo Gerado
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;
?>