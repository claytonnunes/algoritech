<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/arquivoController.php');
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
				<h5>
				<i class="fa fa-tags fa-1x"></i> <?php echo "PRODUTO: ". $grupo_produto['nome']; ?></h5>
			</div>
		</div>
	</div>
	<div id="divConteudo2">
		<h5>
		<div id="row">
			<div class="form-group col-md-1" align="left" >
				cod
			</div>
			<div class="form-group col-md-5" align="left" >
				briefing
			</div>
			<div class="form-group col-md-2" align="left" >
				<div class="form-group col-md-8" align="left" >
					projetista
				</div>
				<div class="form-group col-md-4" align="left" >
				</div>
			</div>
			<div class="form-group col-md-3" align="left" >
				<div class="form-group col-md-6" align="left" >
					soliciata&ccedil;&atilde;o
				</div>
				<div class="form-group col-md-6" align="left" >
					finalizado
				</div>
			</div>
			<div class="form-group col-md-1" align="left" >
				visualizar
			</div>
		</div>
		</h5>	
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
							echo "<a href=' ".BASEURL."briefing/view2.php?id_negocio=".$briefing['id_grupo_produto']."&id_briefing=".$briefing['id']."'>ler mais </a>"; 
						?>
					</div>
					
					<div class="form-group col-md-2" align="left" >
						<div class="form-group col-md-8" align="left" >
							projetista
						</div>
						<div class="form-group col-md-4" align="left" >
							
							<?php 
							pesquisaArquivoTres('id_briefing', $briefing['id'], 'id_pai', $_SESSION['id_pai'], 'deleted', '0');
								if ($arquivos) : 
								foreach ($arquivos as $arquivo) : 
							?> 
								<a href="<?php echo BASEURL; ?>projeto/upload/<?php echo $arquivo['nome_arquivo']; ?>" target="_blank" title="<?php echo  $arquivo['nome_arquivo']; ?>"><i class="fa fa-download fa-2x"></i></a>

							<?php 
								endforeach;
								endif;
							?>
						</div>
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
								echo $data_briefing."<br>".$time; 
							?>
						</div>
						<div class="form-group col-md-6" align="center" >
							<?php 
								$data_finalizado = $briefing['data_finalizado'];
								$date_arr= explode(" ", $data_finalizado);
								$date= $date_arr[0];						
								$explode = explode('-' ,$date);
								$data_finalizado = "".$explode[2]."/".$explode[1]."/".$explode[0];
								$time= $date_arr[1];
								if($data_finalizado == '00/00/0000'):
									echo "<i class='fa fa-warning fa-2x' title='Briefing pendente'></i> ";
								else:
									echo $data_finalizado."<br>".$time;
								endif;
							?>
						</div>
					</div>
					<div class="form-group col-md-1" align="left" >
						<a href="<?php echo BASEURL; ?>briefing/view2.php?id_negocio=<?php echo $briefing['id_grupo_produto']; ?>&id_briefing=<?php echo $briefing['id']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Visualizar</a>
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
					<a href="<?php echo BASEURL; ?>briefing/add.php?acao=novoBriefing&numero_briefing=<?php echo $i++; ?>&id_grupo_produto=<?php echo $grupo_produto['id']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>" >
					<div class="col-md-1 text-right">
						<i class="fa fa-plus fa-1x"></i> 
					</div>
					<div class="col-md-11 text-left">
						NOVO BRIEFING 	<?php $i=1; ?>
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
		echo "<script>location.href='../produto/add.php?acao=cadastrarGrupoProduto&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."';</script>";
		endif; ?>
<?php include(FOOTER_TEMPLATE); ?>