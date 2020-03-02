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
pesquisaBriefingId();
?> 
<header>
<h2><i class="fa fa-comments fa-2x"></i> Briefings aguardando projeto</h2>
<table id="tabela2" class="table table-hover">
	
	<?php
	if ($briefings) : 
		foreach ($briefings as $briefing) :
	?>
	<tr>
		<td>
			<div id="row">
				<div class="form-group col-md-12" align="left"><?php 
							$data_briefing = $briefing['created'];
							$date_arr= explode(" ", $data_briefing);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$data_briefing = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date_arr[1];
							
							$inicio_evento = $briefing['inicio_evento'];
							$date_arr= explode(" ", $inicio_evento);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$inicio_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date_arr[1];
							
							$fim_evento = $briefing['fim_evento'];
							$date_arr= explode(" ", $fim_evento);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$fim_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date[1];						
							
							$metro_quadrado = $briefing['largura'] * $briefing['profundidade'];
						
						
					echo "data do Briefing: ".$data_briefing." ".$time."<br>"; 
					echo "Evento: ".$briefing['nome_edicao']."<br>";
					echo "Local: ".$briefing['local']."<br>";
					echo "Período: ".$inicio_evento." à ".$fim_evento."<br>";
					echo "Vendedor: ".$_SESSION['nome_usuario']."<br>";
					echo "Empresa: ".$briefing['nome_fantasia']."<br>";
					echo "Produto: ".$briefing['produto']."<br>";
					echo "Revisão: <br>";
					echo "Posição: ".$briefing['posicao']."<br>";
					echo "Medida: ".$briefing['largura']."x".$briefing['profundidade']." = ".$metro_quadrado."m2<br>";
					echo "Modelo: ".$briefing['modelo']."<br>";
					echo "Nivél: ".$briefing['nivel']."<br><br>";
					
					echo "Comentário: ".$briefing['comentario']."<br>";
					
					
					?>
				
				
				</div>
				
				
					<div class="custom-file">
					  <input type="file" class="custom-file-input" id="customFileLang" lang="es">
					  <label class="custom-file-label" for="customFileLang">Selecione o arquivo</label>
					</div>
				
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>

<?php include(FOOTER_TEMPLATE); ?>