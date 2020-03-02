<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/usuarioController.php');
require_once('../controller/produtoController.php');
require_once('../controller/briefingController.php');

pesquisaBriefingAtivo($_REQUEST['id_negocio']);
pesquisaBriefing();


	if(isset($_REQUEST['acao'])):
		if($_REQUEST['acao']=='salvarBriefing'):
			salvarBriefing();
		endif;
	endif;

	if ($briefingAtivos) : 
		foreach ($briefingAtivos as $briefingAtivo) :
		$id_briefing = $briefingAtivo['id'];
		$id_projetista = $briefingAtivo['id_projetista'];
		$posicao = $briefingAtivo['posicao'];
		$modelo = $briefingAtivo['modelo'];
		$nivel = $briefingAtivo['nivel'];
		$numero_desenho = $briefingAtivo['numero_desenho'];
		$profundidade = $briefingAtivo['profundidade'];
		$largura = $briefingAtivo['largura'];
		$numero_stand = $briefingAtivo['numero_stand'];
		$status = $briefingAtivo['status'];
		endforeach;
		
	else:
		$numero_desenho = '0';
	endif;
	pesquisaUsuarioTres('id_pai', $_SESSION['id_pai'], 'deleted', '0', 'id', $id_projetista);
		if ($usuarios) {
			foreach ($usuarios as $usuario) {
				$nome_projetista = $usuario['nome_usuario'];
			}
		}
	pesquisaModuloUsuario('4');
	?>
	<?php 	if ($status =='0') : ?>
		<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
		<div class="alert alert-danger alert-dismissible" role="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button><i class='fa fa-asterisk' aria-hidden='true'></i> O BRIEFING COD: <?php echo $id_briefing; ?> ESTÁ AGUARDANDO DESENHO, SE VOCÊ INSERIR UM NOVO BRIEFING, SERÁ CANCELADO O ANTERIOR!!!
		</div>
		<hr>
		<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->
	<?php 	endif; ?>
    <form id="formEmpresa" name="formEmpresa" action="add.php?acao=salvarBriefing&numero_briefing=<?php echo $_REQUEST['numero_briefing']; ?>&id_negocio=<?php echo $_REQUEST['id_negocio']; ?>&numero_desenho=<?php echo $numero_desenho; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_briefing=<?php echo $id_briefing; ?>" method="post">
	<!-- area de campos do form -->
	<hr />
	<div class="row">
		<div class="form-group col-md-3">   
			<label for="name">Projetista</label>
			<select class="form-control" name="briefing['id_projetista']" required >
			<?php 
				if ($nome_projetista!="") : 
			?>
			<option value="<?php echo $id_projetista; ?>" selected="selected" ><?php echo $nome_projetista; ?></option>
			<?php 
				else: 
			?>
			<option value="" selected="selected" >Selecione o projetista</option>
			<?php endif; ?>
				<?php 
				if ($usuarios) : 
					foreach ($usuarios as $usuario) :
				?>
				 <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
				 <?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="name">Modelo</label>
			<!--                <input type="text" class="form-control" name="empresa['estado']">-->
		  <select class="form-control" name="briefing['modelo']" required >
				<?php 	if ($id_briefing != "") : ?>
				<option value="<?php echo $modelo; ?>" selected="selected">
				<?php 
					if ($modelo==1):
						echo "Stand simples"; 
					elseif ($modelo==2):
						echo "Stand especial";
					elseif ($modelo==3):
						echo "Stand misto";
					elseif ($modelo==4):
						echo "Stand construído";
					else:
						echo "Selecione";
					endif;
					?>
				</option>
				<?php 	else : ?>
				<option value="" selected="selected">Selecione</option>
				<?php 	endif; ?>
				<option value="1">Stand simples</option>
				<option value="2">Stand especial</option>
				<option value="3">Stand misto</option>
				<option value="4">Stand constru&iacute;do</option>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="name">N&iacute;vel do projeto</label>
		  <select class="form-control" name="briefing['nivel']" required >
				<?php 	if ($id_briefing != "") : ?>
				<option value="<?php echo $nivel; ?>" selected="selected">
				<?php 
					if ($nivel==1):
						echo "Simples"; 
					elseif ($nivel==2):
						echo "Intermediario";
					elseif ($nivel==3):
						echo "Complexo";
					else:
						echo "Selecione";
					endif;
					?>
				</option>
				<?php 	else : ?>
				<option value="" selected="selected">Selecione</option>
			  	<?php 	endif; ?>
				<option value="1">Simples</option>
				<option value="2">Intermediario</option>
				<option value="3">Complexo</option>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="name">Largura</label>
			<input type="text" class="form-control" value="<?php echo $largura; ?>" name="briefing['largura']" required>
		</div>
		<div class="form-group col-md-2">
			<label for="name">Profundidade</label>
			<input type="text" class="form-control" value="<?php echo $profundidade; ?>" name="briefing['profundidade']" autofocus required >
		</div> 
		<div class="form-group col-md-2">
			<label for="name">Numero Stand</label>
			<input type="text" class="form-control" value="<?php echo $numero_stand; ?>" name="briefing['numero_stand']">
		</div>
		<div class="form-group col-md-4">
				<label for="exampleTextarea"></label>
				<textarea class="form-control" id="exampleTextarea" rows="4" name="briefing['comentario']" placeholder="Descreva o briefing do projeto..." required ></textarea>
		</div>

		<div class="form-group col-md-12">
			<div class="form-check col-md-2">
				<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios1" value="1" <?php if ($posicao == 1): echo 'checked'; endif; ?>>
				<label class="form-check-label" for="gridRadios1">
				</label>
				<img src="../imagem/posicao01.png" alt="..." class="img-thumbnail">
			</div>
			<div class="form-check col-md-2">
				<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios2" value="2" <?php if ($posicao == 2): echo 'checked'; endif; ?>>
				<label class="form-check-label" for="gridRadios1">
				</label>
				<img src="../imagem/posicao02.png" alt="..." class="img-thumbnail">
			</div>
			<div class="form-check col-md-2">
				<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios3" value="3" <?php if ($posicao == 3): echo 'checked'; endif; ?>>
				<label class="form-check-label" for="gridRadios1">
				</label>
				<img src="../imagem/posicao03.png" alt="..." class="img-thumbnail">
			</div>
			<div class="form-check col-md-2">
				<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios4" value="4" <?php if ($posicao == 4): echo 'checked'; endif; ?>>
				<label class="form-check-label" for="gridRadios1">
				</label>
				<img src="../imagem/posicao04.png" alt="..." class="img-thumbnail">
			</div>
			<div class="form-check col-md-2">
				<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios5" value="5" <?php if ($posicao == 5): echo 'checked'; endif; ?>>
				<label class="form-check-label" for="gridRadios1">
				</label>
				<img src="../imagem/posicao05.png" alt="..." class="img-thumbnail">
			</div>
			<div class="form-check col-md-2">
				<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios6" value="6" <?php if ($posicao == 6): echo 'checked'; endif; ?>>
				<label class="form-check-label" for="gridRadios1">
				</label>
				<img src="../imagem/posicao06.png" alt="..." class="img-thumbnail">
			</div>

		</div>

	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
			<a href="index.php" class="btn btn-default">Voltar</a>
		</div>
	</div>
</form>

<div class="row">
	<hr>
	</br></br>
<h5>Hist&oacute;rico de briefing deste atendimento</h5>	
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
				<div class="form-group col-md-9" align="left"><?php echo $briefing['comentario']; ?></div>
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>
</div>

<?php include(FOOTER_TEMPLATE); ?>