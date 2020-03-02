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
pesquisaEmpresaId('id',$_REQUEST['id_empresa'],'id_pai',$_SESSION['id_pai'],'deleted','0');
if($empresas):
	foreach($empresas as $empresa):
	
	$nome_empresa = $empresa['nome_fantasia'];
	endforeach;
endif;
//require_once('../controller/usuarioController.php');

if(isset($_REQUEST['id_atendimento'])):
	$id_atendimento = $_REQUEST['id_atendimento'];
endif;
pesquisaGrupoProduto($id_atendimento);

require_once('../controller/briefingController.php');
?> 
	<header>
	<div id="divConteudo2">
		<div id="row">
			<div class="form-group col-md-12" align="left" >
				<h4>
				<div class="form-group col-md-4" align="left" >
					<i class="glyphicon glyphicon-equalizer  " aria-hidden="true"></i> EMPRESA: <?php echo $nome_empresa;
					?>
				</div>
				<div class="form-group col-md-4" align="left" >
					<i class="fa fa-bookmark" aria-hidden="true"></i> EVENTO: <?php echo $_SESSION['nome_edicao'];
					?>
				</div>
				</h4>
				<div class="form-group col-md-4" align="right" >
					<a href="javascript:history.back()" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Voltar</a>
					<a href="<?php echo BASEURL; ?>produto/add.php?acao=cadastrarGrupoProduto&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>"" class="btn btn-sm btn-success"><i class="fa fa-tags"></i> Novo produto</a>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ($grupo_produtos) : 
		foreach ($grupo_produtos as $grupo_produto) :
	?>
	<div id="divConteudo2">
		<div id="row">
			<div class="form-group col-md-12" align="left" >
				<h4>
				<i class="fa fa-tags fa-1x"></i> <?php echo "PRODUTO: ". $grupo_produto['nome']; ?></h4>
			</div>
		</div>
	</div>
	<div id="divConteudo2">
		<h4>
		<div id="row">
			<div class="form-group col-md-1" align="left" >
				cod
			</div>
			<div class="form-group col-md-5" align="left" >
				briefing
			</div>
			<div class="form-group col-md-2" align="left" >
				projetista
			</div>
			<div class="form-group col-md-3" align="left" >
				<div class="form-group col-md-6" align="left" >
					soliciatação
				</div>
				<div class="form-group col-md-6" align="left" >
					entrega
				</div>
			</div>
			<div class="form-group col-md-1" align="left" >
				visualizar
			</div>
		</div>
		</h4>	
	</div>	
	<table id="tabela2" class="table table-hover">
		<?php
		pesquisaBriefingId($grupo_produto['id']);
		if ($briefings) : 
			$i=1;
			foreach ($briefings as $briefing) :
	?>
		<tr>
			<td>
				<div id="row">
					<div class="form-group col-md-1" align="left" >
						<?php echo "n: ".$i++; ?>
					</div>
					<div class="form-group col-md-5" align="left" >
						<?php 
							echo substr($briefing['comentario'],0,90)."...<br>"; 
							echo "<a href=' ".BASEURL."briefing/view.php?id_briefing=".$briefing['id']."'>ler mais </a>"; 
						?>
					</div>
					<div class="form-group col-md-2" align="left" >
						projetista
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
								echo $data_briefing; 
							?>
						</div>
						<div class="form-group col-md-6" align="left" >
							entrega
						</div>
					</div>
					<div class="form-group col-md-1" align="left" >
						<a href="<?php echo BASEURL; ?>briefing/view.php?id_briefing=<?php echo $briefing['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Visualizar</a>
					</div>
				</div>	
			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
		<tr>
			<td>
			<h5>
			<div class="row">
				<div class="col-md-12">
					<a href="<?php echo BASEURL; ?>briefing/add.php?acao=novoBriefing&id_grupo_produto=<?php echo $grupo_produto['id']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>" >
					<div class="col-md-1 text-right">
						<i class="fa fa-plus fa-1x"></i> 
					</div>
					<div class="col-md-11 text-left">
						NOVO BRIEFING
					</div>
					</a>
				</div>
			</div>
			</h5>
			</td>
		</tr>
	</table>
<?php endforeach; else:
		// SE NÃO TIVER GRUPO CADASTRADO INICIA ESTE CÓDIGO 
		echo "<script>location.href='../produto/add.php?acao=cadastrarGrupoProduto&id_atendimento=".$_REQUEST['id_atendimento']."';</script>";
		endif; ?>
<?php include(FOOTER_TEMPLATE); ?>