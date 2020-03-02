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
salvarBriefing();
pesquisaBriefing();
pesquisaModuloUsuario('4');
?>
    
    <h2>Informações do projeto</h2>
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

    <form id="formEmpresa" name="formEmpresa" action="add.php?acao=novoBriefing&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>" method="post">
        <!-- area de campos do form -->
        <hr />
        <div class="row">
			<div class="form-group col-md-3">   
				<label for="name">Projetista</label>
            	<select class="form-control" name="briefing['id_projetista']" required >
                <option value="" selected="selected" >Selecione um projetista</option>
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
					<option value="" selected="selected">Selecione</option>
                 	<option value="1">Stand simples</option>
				 	<option value="2">Stand especial</option>
				  	<option value="3">Stand misto</option>
				  	<option value="4">Stand construído</option>
                </select>
            </div>
			<div class="form-group col-md-2">
                <label for="name">Nível do projeto</label>
              <select class="form-control" name="briefing['nivel']" required >
					<option value="" selected="selected">Selecione</option>
                 	<option value="1">Simples</option>
				 	<option value="2">Intermediario</option>
				  	<option value="3">Complexo</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="name" >Produto</label>
                <input type="text" class="form-control" name="briefing['produto']" placeholder="Ex: Stand, Quiosque, Elemento extra..." autofocus required >
            </div> 
			<div class="form-group col-md-2">
                <label for="name">Profundidade</label>
                <input type="text" class="form-control" name="briefing['profundidade']" autofocus required >
            </div> 
            <div class="form-group col-md-2">
                <label for="name">Largura</label>
                <input type="text" class="form-control" name="briefing['largura']" required>
            </div>
			 <div class="form-group col-md-2">
                <label for="name">Numero Stand</label>
                <input type="text" class="form-control" name="briefing['numero_stand']">
            </div>
			<div class="form-group col-md-4">
                    <label for="exampleTextarea"></label>
                    <textarea class="form-control" id="exampleTextarea" rows="4" name="briefing['comentario']" placeholder="Descreva o briefing do projeto..." required ></textarea>
            </div>
			
			<div class="form-group col-md-12">
				<div class="form-check col-md-2">
					<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios1" value="1">
          			<label class="form-check-label" for="gridRadios1">
          			</label>
            		<img src="../imagem/posicao01.png" alt="..." class="img-thumbnail">
				</div>
				<div class="form-check col-md-2">
					<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios2" value="2">
          			<label class="form-check-label" for="gridRadios1">
          			</label>
            		<img src="../imagem/posicao02.png" alt="..." class="img-thumbnail">
				</div>
				<div class="form-check col-md-2">
					<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios3" value="3">
          			<label class="form-check-label" for="gridRadios1">
          			</label>
            		<img src="../imagem/posicao03.png" alt="..." class="img-thumbnail">
				</div>
				<div class="form-check col-md-2">
					<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios4" value="4">
          			<label class="form-check-label" for="gridRadios1">
          			</label>
            		<img src="../imagem/posicao04.png" alt="..." class="img-thumbnail">
				</div>
				<div class="form-check col-md-2">
					<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios5" value="5">
          			<label class="form-check-label" for="gridRadios1">
          			</label>
            		<img src="../imagem/posicao05.png" alt="..." class="img-thumbnail">
				</div>
				<div class="form-check col-md-2">
					<input class="form-check-input" type="radio" name="briefing['posicao']" id="gridRadios6" value="6">
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

<?php include(FOOTER_TEMPLATE); ?>