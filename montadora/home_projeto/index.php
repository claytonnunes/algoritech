<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/produtoController.php');
require_once('../controller/empresasController.php');
require_once('../controller/eventosController.php');
require_once('../controller/usuarioController.php');
require_once('../controller/atendimentosController.php');
require_once('../controller/briefingController.php');
pesquisaBriefingPendente();
?> 
	<header>
	<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
	<?php 
		if((time() - $_SESSION['time_message'])>1): unset($_SESSION['message']); endif; 
		if (!empty($_SESSION['message'])) : ?>
    	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
    		<?php echo $_SESSION['message']; ?>
		</div>
	<?php endif; ?>
	<hr>
	<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->
	<div id="divConteudo2">
		<div id="row">
			<div class="form-group col-md-12" align="left" >
				<h4>
				<div class="form-group col-md-4" align="left" >
					<i class="glyphicon glyphicon-edit  " aria-hidden="true"></i> BRIEFING
				</div>
				</h4>
			</div>
		</div>
	</div>
	<div id="divConteudo2">
		<h5>
		<div id="row">
			<div class="form-group col-md-1" align="left" >n.
			</div>
			<div class="form-group col-md-11" align="left" >
				<div class="form-group col-md-1" align="left" >
					cod
				</div>
				<div class="form-group col-md-2" align="left" >
					Vendedor
				</div>
				<div class="form-group col-md-2" align="left" >
					Cliente
				</div>
				<div class="form-group col-md-2" align="left" >
					Evento
				</div>	
				<div class="form-group col-md-3" align="left" >
					<div class="form-group col-md-6" align="left" >
						dias
					</div>
					<div class="form-group col-md-6" align="left" >
						inaugura&ccedil;&atilde;o
					</div>
				</div>
				<div class="form-group col-md-1" align="left" >
					nivel
				</div>
				<div class="form-group col-md-1" align="left" >
					altera&ccedil;&atilde;o
				</div>
			</div>
		</div>
		</h5>	
	</div>	
	<table id="tabela2" class="table table-hover">
	<?php
		if ($briefings) : 
			$i=1;
			foreach ($briefings as $briefing) :
	?>
		<tr>
			<td>	
				<div id="row">
					<div class="form-group col-md-1" align="left" ><h1><?php echo $i++; ?></h1>
					</div>
					<div class="form-group col-md-11" align="left" >
						<div class="form-group col-md-1" align="left" >
							<?php echo $briefing['id']; ?>
						</div>
						<div class="form-group col-md-2" align="left" >
							<?php
								pesquisaTresColunas('id_pai', $_SESSION['id_pai'], 'id', $briefing['id_usuario'], 'deleted','0');
								if ($usuarios) : 
									foreach ($usuarios as $usuario) :
									echo $usuario['nome_usuario'];
									endforeach;
								endif;
							?>
						</div>
						<div class="form-group col-md-2" align="left" >
							<?php
								pesquisaAtendimentoTres('id_pai', $_SESSION['id_pai'], 'id', $briefing['id_grupo_produto'], 'deleted','0');
								if ($atendimentos) : 
									foreach ($atendimentos as $atendimento) :
									$id_empresa = $atendimento['id_empresa'];
									$id_edicao = $atendimento['id_edicao'];
									endforeach;
								endif;
								pesquisaEmpresaId('id_pai', $_SESSION['id_pai'], 'id', $id_empresa, 'deleted','0');
								if ($empresas) :
									foreach ($empresas as $empresa) :
									echo $empresa['nome_fantasia'];
									endforeach;
								endif;
							?>
						</div>
						<div class="form-group col-md-2" align="left" >
							<?php pesquisaEdicaoId($id_edicao);
								if ($eventos) :
									foreach ($eventos as $evento) :
									
									$data1 = date("Y-m-d");
									$data2 = $evento["inicio_evento"];

									$diferenca = strtotime($data2) - strtotime($data1);

									$dias_inauguracao = floor($diferenca / (60 * 60 * 24));
									
									echo $evento['nome_edicao'];
									endforeach;
								endif; ?>
						</div>	
						<div class="form-group col-md-3" align="left" >
							<div class="form-group col-md-6" align="left" >
								<?php 
									$data_briefing = $briefing['created'];
									$date_arr= explode(" ", $data_briefing);
									$date= $date_arr[0];						
									$explode = explode('-' ,$date);
									$data_briefing = "".$explode[2]."/".$explode[1]."/".$explode[0];
									$time= $date_arr[1];
									
									$data1 = date("Y-m-d");
									$data2 = $briefing["created"];

									$diferenca = strtotime($data2) - strtotime($data1);

									$dias = floor($diferenca / (60 * 60 * 24));
									echo $dias;
								
								?>
							</div>
							<div class="form-group col-md-6" align="center" >
								<?php  echo $dias_inauguracao; ?>
							</div>
						</div>
						<div class="form-group col-md-1" align="left" >
							<?php 
							$nivel = $briefing['nivel'];
							if($nivel == 1):
								echo "<i class='glyphicon glyphicon-heart'></i>";
							elseif($nivel == 2):
								echo "<i class='fa fa-flash'></i>";
							elseif($nivel == 3):
								echo "<i class='glyphicon glyphicon-fire'></i>";
							else:
							endif;
							?>
						</div>
						<div class="form-group col-md-1" align="left" >
							<?php 
							$numero_desenho = $briefing['numero_desenho'];
							if($numero_desenho == 0):
								echo "<i class='glyphicon glyphicon-share-alt'></i>";
							else:
								echo "<i class='glyphicon glyphicon-retweet'></i>";
							endif;?>
						</div>
						<div class="form-group col-md-11" align="left" >
							<?php 
								echo "Briefing: ".substr($briefing['comentario'],0,500)."...<br>"; 
								echo "<a href=' ".BASEURL."briefing/view.php?id_briefing=".$briefing['id']."'>ler mais </a>"; 
							?>
						</div>
						<div class="form-group col-md-1" align="left" >
							<a href="<?php echo BASEURL; ?>home_projeto/view2.php?id_negocio=<?php echo $briefing['id_grupo_produto']; ?>&id_briefing=<?php echo $briefing['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Visualizar</a>
						</div>
					
					</div>
				</div>	
			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	</table>
<?php include(FOOTER_TEMPLATE); ?>