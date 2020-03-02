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
if(isset($_REQUEST['id_atendimento'])):
	$id_atendimento = $_REQUEST['id_atendimento'];
endif;
pesquisaGrupoProduto($id_atendimento);

require_once('../controller/briefingController.php');


if(isset($_REQUEST['acao'])):
	if($_REQUEST['acao']=='salvarGrupo'):
	salvarGrupoProduto();
	endif;
endif;
?> 

<?php
	if ($grupo_produtos) : 
		
		foreach ($grupo_produtos as $grupo_produto) :
?>
<header>
<h4><i class="fa fa-tags fa-2x"></i> <?php echo "PRODUTO: ". $grupo_produto['nome']; ?></h4>
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
				<div class="form-group col-md-1" align="left"><i class="fa fa-comments fa-2x"></i></div>
			<div class="form-group col-md-1" align="left"><?php echo "n: ".$i++; ?></div>
				<div class="form-group col-md-2" align="left"><?php 
							$data_briefing = $briefing['created'];
							$date_arr= explode(" ", $data_briefing);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$data_briefing = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date_arr[1];
					echo $data_briefing." ".$time; ?></div>
				<div class="form-group col-md-7" align="left"><?php echo substr($briefing['comentario'],0,90)."...<br>"; 
							echo "<a href=' ".BASEURL."briefing/view.php?id_briefing=".$briefing['id']."'>ler mais </a>"; ?></div>
				<div class="form-group col-md-1" align="right">
					<a href="<?php echo BASEURL; ?>briefing/view.php?id_briefing=<?php echo $briefing['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
				</div>
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>
<?php endforeach; else:?>
	
<!--   SE NÃO TIVER GRUPO CADASTRADO INICIA ESTE CÓDIGO  -->
<form id="formBriefing" name="formBriefing" action="view.php?acao=salvarGrupo&id_atendimento=<?php echo $_REQUEST['id_atendimento'];?>" method="post">
	<div class="row">
		<div class="form-group col-md-12" align="left">DESCREVA NO CAMPO ABAIXO UM NOME DE REFERENCIA DO PRODUTO.  
		</div>
		<div class="form-group col-md-6">
			<input type="text" class="form-control" name="grupo_produto['nome']" placeholder="Ex: STAND, QUIOSQUE, CENOGRAFIA, PDV..." required >
        </div> 
		<div class="form-group col-md-6">
			<button type="submit" class="btn btn-success" id="salvar">Salvar</button>
		</div>
	</div> 
</form>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>