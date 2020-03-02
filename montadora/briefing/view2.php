<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/atendimentosController.php');
require_once('../controller/produtoController.php');
require_once('../controller/empresasController.php');
require_once('../controller/eventosController.php');
require_once('../controller/usuarioController.php');
require_once('../controller/briefingController.php');
pesquisaBriefingTres('id_pai', $_SESSION['id_pai'], 'id_grupo_produto', $_REQUEST['id_negocio'], 'deleted', '0', 'ORDER BY numero_desenho DESC LIMIT 1');
if ($briefings) : 
	foreach ($briefings as $briefingx) :
		$numeroDesenho = $briefingx['numero_desenho']+1;
	endforeach;
endif;



pesquisaBriefingTres('id_pai', $_SESSION['id_pai'], 'id', $_REQUEST['id_briefing'], 'deleted', '0');
?> 
<header>
<h2><i class="fa fa-comments fa-2x"></i> Briefings aguardando projeto</h2>
<table id="tabela2" class="table table-hover">
	
	<?php
	if ($briefings) : 
		foreach ($briefings as $briefing) :
			$id_atendimento = $briefing['id_atendimento'];
			$idVendedor = $briefing['id_usuario'];
			
			//PESQUISA BANCO USUARIO
			pesquisaTresColunas('id_pai', $_SESSION['id_pai'], 'id', $briefing['id_usuario'], 'deleted','0');
			if ($usuarios) : 
				foreach ($usuarios as $usuario) :
				$vendedor = $usuario['nome_usuario'];
				endforeach;
			endif;

			//PESQUISA BANCO USUARIO
			pesquisaTresColunas('id_pai', $_SESSION['id_pai'], 'id', $briefing['id_projetista'], 'deleted','0');
			if ($usuarios) : 
				foreach ($usuarios as $usuario) :
				$projetista = $usuario['nome_usuario'];
				endforeach;
			endif;
	
			//PESQUISA BANCO ATENDIMENTO
			pesquisaAtendimentoTres('id_pai', $_SESSION['id_pai'], 'id', $briefing['id_grupo_produto'], 'deleted','0');
			if ($atendimentos) : 
				foreach ($atendimentos as $atendimento) :
				$id_empresa = $atendimento['id_empresa'];
				$id_edicao = $atendimento['id_edicao'];
				endforeach;
			endif;
	
			//PESQUISA BANCO GRUPO PRODUTO
			pesquisaProdutoTres('id_pai', $_SESSION['id_pai'], 'id', $briefing['id_grupo_produto'], 'deleted','0');
			if ($grupo_produtos) : 
				foreach ($grupo_produtos as $grupo_produto) :
				$nome_grupo_produto = $grupo_produto['nome'];
				endforeach;
			endif;
	
			//PESQUISA BANCO EMPRESA
			pesquisaEmpresaId('id_pai', $_SESSION['id_pai'], 'id', $id_empresa, 'deleted','0');
			if ($empresas) :
				foreach ($empresas as $empresa) :
				$nome_empresa = $empresa['nome_fantasia'];
				endforeach;
			endif;
			
			//PESQUISA BANCO EDICÃO DO EVENTO
			pesquisaEdicaoId($id_edicao);
			if ($eventos) :
				foreach ($eventos as $evento) :
				$inicio_evento = $evento['inicio_evento'];
				$date_arr= explode(" ", $inicio_evento);
				$date= $date_arr[0];						
				$explode = explode('-' ,$date);
				$inicio_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
				$time_inicio= $date_arr[1];

				$fim_evento = $evento['fim_evento'];
				$date_arr= explode(" ", $fim_evento);
				$date= $date_arr[0];						
				$explode = explode('-' ,$date);
				$fim_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
				$time_fim= $date[1];
				
				$nome_edicao = $evento['nome_edicao'];
				$local = $evento['local'];
				
				endforeach;
			endif; 
	?>
	<tr>
		<td>
			<div id="row">
				<div class="form-group col-md-6" align="left">
					<?php 
						$data_briefing = $briefing['created'];
						$date_arr= explode(" ", $data_briefing);
						$date= $date_arr[0];						
						$explode = explode('-' ,$date);
						$data_briefing = "".$explode[2]."/".$explode[1]."/".$explode[0];
						$time_briefing= $date_arr[1];
						$numero_desenho = $briefing['numero_desenho']+1;
						$metro_quadrado = $briefing['largura'] * $briefing['profundidade'];
						if($briefing['posicao']==1):
							$posicao = "<img src='../imagem/posicao01.png' alt='...' class='img-thumbnail'>";
						elseif($briefing['posicao']==2):
							$posicao = "<img src='../imagem/posicao02.png' alt='...' class='img-thumbnail'>";
						elseif($briefing['posicao']==3):
							$posicao = "<img src='../imagem/posicao03.png' alt='...' class='img-thumbnail'>";
						elseif($briefing['posicao']==4):
							$posicao = "<img src='../imagem/posicao04.png' alt='...' class='img-thumbnail'>";
						elseif($briefing['posicao']==5):
							$posicao = "<img src='../imagem/posicao05.png' alt='...' class='img-thumbnail'>";
						elseif($briefing['posicao']==6):
							$posicao = "<img src='../imagem/posicao06.png' alt='...' class='img-thumbnail'>";
						else:
						endif;
					
						echo "<strong>Data do briefing: </strong>".$data_briefing." ".$time_briefing."<br>"; 
						echo "<strong>Evento: </strong>".$nome_edicao."<br>";
						echo "<strong>Local: </strong>".$local."<br>";
						echo "<strong>Período: </strong>".$inicio_evento." à ".$fim_evento."<br>";
						echo "<strong>Projetista: </strong>".$projetista."<br>"; 
						echo "<strong>Vendedor: </strong>".$vendedor."<br>"; 
						echo "<strong>Empresa: </strong>".$nome_empresa."<br>";
						echo "<strong>Negócio: </strong>".$nome_grupo_produto."<br>";
						echo "<strong>Briefing n.: </strong>".$briefing['numero_briefing']."<br>";
						echo "<strong>Desenho n.: </strong>".$numeroDesenho."<br>";
						echo "<strong>Numero área: </strong>".$briefing['numero_stand']."<br>";
						echo "<strong>Medida: </strong>".$briefing['largura']."x".$briefing['profundidade']." = ".$metro_quadrado."m2<br>";
						
						if ($briefing['modelo']==1):
							$modelo = "Stand simples"; 
						elseif ($briefing['modelo']==2):
							$modelo = "Stand especial";
						elseif ($briefing['modelo']==3):
							$modelo = "Stand misto";
						elseif ($briefing['modelo']==4):
							$modelo = "Stand construído";
						else:
						endif;
						echo "<strong>Modelo: </strong>".$modelo."<br>";
					
						$nivel = $briefing['nivel'];
						if($nivel == 1):
							$nivel =  "<i class='glyphicon glyphicon-heart'></i> SIMPLES";
						elseif($nivel == 2):
							$nivel =  "<i class='fa fa-flash'></i> INTERMEDIÁRIO";
						elseif($nivel == 3):
							$nivel = "<i class='glyphicon glyphicon-fire'></i> COMPLEXO";
						else:
						endif;
						echo "<strong>Nivél: </strong>".$nivel."<br><br>";
						
					?>
				
				
				</div>
				<div class="form-group col-md-6" align="left">
					<?php echo "<strong>Posição: </strong>".$posicao."<br><br>"; ?>
				</div>
				<div class="form-group col-md-12" align="left">
					<?php
						echo "<strong>Briefing: </strong>".$briefing['comentario']."<br>";
					?>
				</div>
				
				 <div class="col-sm-12 text-left h4">
					<a class="btn btn-primary" href="<?php echo BASEURL; ?>projeto/upload_arquivo.php?id_vendedor=<?php echo $idVendedor; ?>&id_negocio=<?php echo $_REQUEST['id_negocio']; ?>&id_briefing=<?php echo $_REQUEST['id_briefing']; ?>&numero_desenho=<?php echo $numeroDesenho; ?>&id_atendimento=<?php echo $id_atendimento; ?>"><i class="glyphicon glyphicon-cloud-upload"></i> Enviar projeto</a>
				</div>
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>

<?php include(FOOTER_TEMPLATE); ?>