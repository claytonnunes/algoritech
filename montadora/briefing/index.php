<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/briefingController.php');
pesquisaBriefings();
?>              
<header>
<h2>Briefings aguardando projeto</h2>
<table id="tabela2" class="table table-hover">
	
	<?php
	if ($briefings) : 
		foreach ($briefings as $briefing) :
	?>
	<tr>
		<td>
			<div id="row">
				<div class="form-group col-md-1" align="left"><i class="fa fa-comments fa-2x"></i></div>
				<div class="form-group col-md-2" align="left"><?php 
							$data_briefing = $briefing['created'];
							$date_arr= explode(" ", $data_briefing);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$data_briefing = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date_arr[1];
					
					
					echo $data_briefing." ".$time; ?></div>
				<div class="form-group col-md-2" align="left"><?php echo $briefing['nome_fantasia']; ?></div>
				<div class="form-group col-md-2" align="left"><?php echo $briefing['produto']; ?></div>
				<div class="form-group col-md-4" align="left"><?php echo substr($briefing['comentario'],0,50)."...<br>"; 
							echo "<a href=' ".BASEURL."briefing/view.php?id_briefing=".$briefing['id']."'>ler mais </a>"; ?></div>
				<div class="form-group col-md-1" align="right">
					<a href="<?php echo BASEURL; ?>briefing/view2.php?id_briefing=<?php echo $briefing['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
				</div>
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>

<?php include(FOOTER_TEMPLATE); ?>