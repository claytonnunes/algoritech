<?php
session_start();
?>
	<?php
	require_once ('../config.php');
	require_once(DBAPI);
	require_once ("../inc/visibilidade-header.php");
	?>
	<?php
	require_once('../controller/empresasController.php');
	require_once('../controller/atendimentosController.php');
	require_once('../controller/contatosController.php');
	require_once('../controller/eventosController.php');
	findAtendimentoId();
	visualizarEmpresa($_GET['id_empresa']);

	if($_SESSION['id_edicao']==null):
			$id_edicao = $_REQUEST['id_edicao'];
			$_SESSION["id_edicao"] = $id_edicao;
		else:
			$id_edicao = $_SESSION['id_edicao'];
	endif;
	pesquisaEdicaoId($id_edicao);
	// Se não tiver evento cadastrado redireciona
	if ($eventos) :
		foreach ($eventos as $evento):
			$id_edicao = $evento['id'];
			$nome_edicao = $evento['nome_edicao'];
		endforeach;
	else:
		header('location: ../eventos/add.php?msg=semevento');
		$_SESSION['message'] = 'Banco de dados sem evento cadastrado!! Cadastre um evento.';
		$_SESSION['type'] = 'danger';
	endif;

	if(isset($_REQUEST['salvaratendimento'])):
		if($_REQUEST['comentario']==""){		
			$mensagem = "Escreva um comentário";		
		}
		else if($_REQUEST['proxima_data']==""){
			$mensagem = "Selecione a proxima data";
		}	

		else if($_REQUEST['id_edicao']==""){
			$mensagem = "Selecione o Evento";
		}
		else{
			$mensagem = "Comentário registrada com sucesso";
			salvarAtendimento();
		}
	endif;	
	?>
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
	<div class="row">
		<div class="form-group col-md-9" align="right">
			<a href="<?php echo BASEURL."briefing/view.php?acao=verGrupo&id_atendimento=".$_REQUEST['id_atendimento']."&id_empresa=".$_REQUEST['id_empresa']; ?>" class="btn btn-lg btn-link"><i class="fa fa-comment"></i> briefing</a>
			<a href="<?php echo BASEURL; ?>produto/add.php?acao=cadastrarGrupoProduto&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>" class="btn btn-lg btn-link"><i class="fa fa-shopping-cart"></i> cotação</a>
			<a href="#" class="btn btn-lg btn-link"><i class="fa fa-file"></i> contrato</a>
			<a href="#" class="btn btn-lg btn-link"><i class="fa fa-usd"></i> cobrança</a>
			<a href="#" class="btn btn-lg btn-link"><i class="fa fa-wrench"></i> OS</a>
			<a href="#" class="btn btn-lg btn-link"><i class="fa fa-paperclip"></i> anexar arquivo</a>
		</div>
		<div class="form-group col-md-3" align="right">
			<a href="../empresas/edit.php?id=<?php echo $empresa['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar empresa</a>
			<a class="btn btn-sm btn-success" href="#<?php echo BASEURL; ?>contatos/add2.php?id_empresa=<?php  echo urlencode( $empresa['id']); ?>&id=<?php echo $contato['id']; ?>&id_company=<?php echo $empresa['id']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>"><i class="fa fa-plus"></i> Novo Contato</a>
			</a>
		</div>
	</div>	
	<div class="row">
		<div id="divConteudo2">
			<div id="row">
				<h4>
				<div class="form-group col-md-6" align="left" >
					<i class="glyphicon glyphicon-equalizer  " aria-hidden="true"></i> EMPRESA: <?php echo $empresa['nome_fantasia']; ?>
				</div>
				<div class="form-group col-md-6" align="left" >
					<i class="fa fa-bookmark" aria-hidden="true"></i> EVENTO: <?php echo $_SESSION['nome_edicao'];
					?>
				</div>
				</h4>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="form-group col-md-12">
				<table id="tabela2" class="table table-hover">
				<?php  findContato(); if ($contatos):  foreach ($contatos as $contato): 
					$fone = substr($contato['fone2'], 0, 2) . "-" . substr($contato['fone2'], 2, 4). "." . substr($contato['fone2'], -4);
					
					
					?> 
				<tr>
					<td>
						<div id="row">
							<div class="form-group col-md-1" align="left"><i class="fa fa-user fa-2x"></i></div>
							<div class="form-group col-md-4" align="left"><?php echo $contato['nome']."<br>".$contato['funcao']; ?></div>

							<div class="form-group col-md-4" align="left"><?php echo $contato['email']; ?></div>
							<div class="form-group col-md-2" align="left"><?php echo $fone."<br>".$contato['celular']; ?></div>
							<div class="form-group col-md-1" align="right">
								<a href="../contatos/edit.php?id=<?php echo $contato['id']; ?>&id_company=<?php echo $empresa['id']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>" class="btn btn-sm btn-warning">
								<i class="fa fa-pencil"></i> Editar</a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; endif; ?> 
				</table>
			</div>
		</div>
	</div>
	<h4>
	<div class="form-group col-md-12" align="left">
		<i class="fa fa-calendar" aria-hidden="true"></i> AGENDA
	</div>
	</h4>
    <form id="formEmpresa" name="formEmpresa" action="../empresas/view2.php?salvaratendimento=1&pagina=agenda&id_empresa=<?php echo $_REQUEST['id_empresa'];?>&id_atendimento=<?php echo $_REQUEST['id_atendimento'];?>&id_edicao=<?php echo $id_edicao;?>" method="post">
	<div class="row">
		<div class="form-group col-md-5">
			<label for="exampleTextarea"></label>
			<textarea class="form-control" id="exampleTextarea" rows="2" name="comentario" placeholder="Descreva o seu comentário..." required ></textarea>
		</div>
		<div class="form-group col-md-3">
			<label class="control-label"></label>
			<div class="input-group date">
				<input type="text" class="form-control" id="exemplo" name="proxima_data" placeholder="Proxima data..." required >
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-th"></span>
				</div>
			</div>
		</div>  
		<div class="btn-group col-md-4">
			<label for="name"></label>
			<select name="posicao" class="form-control" id="posicao" required >
			<option value="" selected="selected">Selecione a Posi&ccedil;&atilde;o</option>
			<option value="1">Capta&ccedil;&atilde;o</option>
			<option value="2">Or&ccedil;amento Enviado</option>
			<option value="3">Alinhando Contrato</option>
			<option value="4">Contrato Assinado</option>
			<option value="5">Negativado</option>
		</select>         
		</div>
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-success" id="salvar">Salvar</button>
		</div>
	</div>
	</br>
	<hr />
	<h4>Hist&oacute;rico </h4>
	<div id="divConteudo2">
	<table id="tabela2" class="table table-hover">
		<thead>
			<tr>
				<th width="10%">Data:</th>            
				<th width="30%">Coment&aacute;rio:</th>
				<th width="10%">Status</th>
				<th width="10%">Proximo Contato</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($atendimentos) : ?>
			<?php foreach ($atendimentos as $atendimento) : ?>                    
			<tr>
				<td>
					<?php 
					$data_comentario = $atendimento['created'];
					$date_arr= explode(" ", $data_comentario);
					$date= $date_arr[0];

					$explode = explode('-' ,$date);
					$data_comentario = "".$explode[2]."-".$explode[1]."-".$explode[0];


					$time= $date_arr[1];


					echo "$data_comentario $time"; ?>
				</td>
				<td><?php echo $atendimento['comentario']; ?></td>
				<td><?php 
					$situacao = $atendimento['posicao_agenda'];
					if($situacao==0){
							$situacao = "indefinido";
						}
						else if ($situacao==1){
							$situacao = "Captação";
						}
						else if ($situacao==2){
							$situacao = "Orçamento Enviado";
						}
						else if ($situacao==3){
							$situacao = "Alinhando Contrato";
						}
						else if ($situacao==4){
							$situacao = "Contrato Assinado";
						}
						else if ($situacao==5){
							$situacao = "Negativado";
						}
						else{
							$situacao = "Indefinido";
							}

					echo $situacao; ?>
				</td>
				<td>
					<?php 						
					$proximo_data = $atendimento['proxima_data'];
					$date_arr= explode(" ", $proximo_data);
					$date= $date_arr[0];

					$explode = explode('-' ,$date);
					$proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
					$time= $date_arr[1];
					echo $proximo_data; ?>
				</td>                    
			</tr>
			<?php endforeach; ?>
			<?php else : ?>
			<tr>
				<td colspan="6">Nenhum atendimento cadastrado.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	</form>
	<script type="text/javascript">
		$('#exemplo').datepicker({	
			format: "dd/mm/yyyy",	
			language: "pt-BR",
			startDate: '+0d',
		});
	</script>
<?php include(FOOTER_TEMPLATE); ?>