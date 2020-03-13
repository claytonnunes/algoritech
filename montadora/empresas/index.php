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
	require_once('../controller/vendasController.php');
	require_once('../controller/negocioController.php');
	require_once('../controller/eventosController.php');
	findVendedores();
	if (isset($_REQUEST['acao'])) {
		if ($_REQUEST['acao']=='salvarNegocio') {
			salvarNegocio();
		}
		else if ($_REQUEST['acao']=='salvarEmpresa') {
			salvarDadosEmpresa();
		}
		else {
			
		}
	}
	else{

	}

	if (isset($_REQUEST['PesquisaCliente'])):
				$nome_fantasia = $_REQUEST['PesquisaCliente'];			
				
				$string=$nome_fantasia;
				function tirarAcentos($string){
					return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
					}
				$string = tirarAcentos($string);
				findIdCompany($string);			
			else:
			pesquisaEmpresa();
			
				
	endif;

	if ($_REQUEST['acao']=='editarContatoEmpresa') {
		editarEmpresa();
	}

	if ($_REQUEST['acao']=='excluirContatoEmpresa') {
		excluirEmpresa();

	}

?>
<header>
	<div class="row">
		<div class="col-sm-4 h4">
			<i class="fa fa-th-large fa-2x"></i>  Contato:
		</div>     
		<div class="col-sm-5 h4">
			 <form class="form-inline" id="navbar-form" name="form1" method="post" action="index.php?filtro=nomeCliente&pg=cliente">
				<label for="PesquisaCliente"></label>
				<input class="form-control form-control-sm mr-3 w-75" type="text" name="PesquisaCliente" id="PesquisaCliente" placeholder="Pesquisar" value="<?php 
				if(isset($_REQUEST['PesquisaCliente'])):
				echo $_REQUEST['PesquisaCliente']; endif;?>" aria-label="Pesquisar"/> 
				<button class="fa fa-search" type="submit" aria-hidden="true" style="background: transparent; border: none"></button>
			 </form>
		</div>
		<div class="col-sm-3 text-right">
			<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalNovaEmpresa" 
							data-send-id="<?php echo $empresa['id']; ?>"> <i class="fa fa-plus"></i> Nova Empresa</button>
		</div>
	</div> 
</header>
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

	<!-- FINAL -->	
	
	<hr>
	<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->
	<form role="form">
    	<div id="divConteudo2">
        	<table id="tabela2" class="table table-hover">
            	<thead>
					<tr>
						<th width="5%">COD</th>                
						<th width="20%">Clientes</th>
						<th width="10%">Status</th>
						<th width="20%"></th>
					</tr>
            	</thead>
            	<tbody>
					<?php 
					
					if ($empresas) : 
						foreach ($empresas as $empresa) :	
							global $id_empresa;
							if(isset($id_empresa)):
								$id_empresa = $empresa['empresas.id'];	
							endif;
							findAtendimentoField($id_empresa);	
								if ($atendimentos) : 
									else:			
					?>
					
					<tr>
                    	<td><?php echo $empresa['id']; ?></td>
                        <td><?php echo $empresa['nome_fantasia']; ?></td>
                        <td> 
							<?php
							echo "<font color='#FF0004'>Aguardando Atendimento</font>";
								$atendimento['id_atendimento']='first';
							?>
            			</td>
                      	<td class="actions text-center" >
						
								<a href="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalNovoNegocio" data-send-id="<?php echo $empresa['id']; ?>"> 
								<i class="fa fa-plus"></i> Novo negócio</a>

								<a href="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalVisualizarEmpresa" data-visualiza="<?php echo $empresa['id']; ?>"
								data-visualizanomefantasia="<?php echo $empresa['nome_fantasia']; ?>" 
								data-visualizarazao="<?php echo $empresa['razao_social']; ?>"
								data-visualizacampofone="<?php echo $empresa['fone']; ?>"
								data-visualizaemail="<?php echo $empresa['email']; ?>"
								data-visualizacnpj="<?php echo $empresa['cnpj']; ?>"
								data-visualizacep="<?php echo $empresa['cep']; ?>"
								data-visualizaendereco="<?php echo $empresa['endereco']; ?>" 
								data-visualizacomplemento="<?php echo $empresa['complemento']; ?>"
								data-visualizabairro="<?php echo $empresa['bairro']; ?>"
								data-visualizacidade="<?php echo $empresa['cidade']; ?>"
								data-visualizaestado="<?php echo $empresa['estado']; ?>"
								data-visualizawebsite="<?php echo $empresa['website']; ?>" > 
								<i class="fa fa-eye"></i> Visualizar</a>
							 
								<?php if($_SESSION['tipo_acesso']==0): ?>
									  
								<a href="button" class="btn btn-sm btn-warning editbtn" data-toggle="modal" data-target="#modalEdita" data-whatever="<?php echo $empresa['id']; ?>" 
								data-whatevernomefantasia="<?php echo $empresa['nome_fantasia']; ?>" 
								data-whateverrazao="<?php echo $empresa['razao_social']; ?>"
								data-whatevercampofone="<?php echo $empresa['fone']; ?>"
								data-whateveremail="<?php echo $empresa['email']; ?>"
								data-whatevercnpj="<?php echo $empresa['cnpj']; ?>"
								data-whatevercep="<?php echo $empresa['cep']; ?>"
								data-whateverendereco="<?php echo $empresa['endereco']; ?>" 
								data-whatevercomplemento="<?php echo $empresa['complemento']; ?>"
								data-whateverbairro="<?php echo $empresa['bairro']; ?>"
								data-whatevercidade="<?php echo $empresa['cidade']; ?>"
								data-whateverestado="<?php echo $empresa['estado']; ?>"
								data-whateverwebsite="<?php echo $empresa['website']; ?>"  >
								<i class="fa fa-pencil"></i> Editar</a>
							
								<a href="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalExcluir" data-excluirempr="<?php echo $empresa['id']; ?>">
                                <i class="fa fa-trash"></i> Excluir</a>
                      	</td>
					</tr>
							
					<?php 
						endif;
						endif;
						//endforeach;
						//	endif;
						endforeach; ?>
					<?php else : ?>
					<tr>
                    	<td colspan="6">Nenhuma empresa cadastrada.</td>
                	</tr>
            		<?php endif; ?>
            	</tbody>
        	</table>
    	</div>
    </form>
	<?php // include('../modal/modalVisualizar.php'); ?>
	
	<?php include('../modal/modalVisualizarEmpresa.php'); ?>
	<?php include('../modal/modal-exclusao.php'); ?>
	<?php include('../modal/modalNovoNegocio.php'); ?>
	<?php include('../modal/modalNovaEmpresa.php'); ?>
	<?php include('../modal/modalEditaEmpresa.php'); ?>


<!-- LUAN SANTANA -->


						
		<!-- SCRIPT PARA MODAL VISUALIZAR EMPRESA -->
		<script type="text/javascript">
			$('#modalVisualizarEmpresa').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) 
				var id = button.data('visualiza')
				var idvisualizanomefantasia = button.data('visualizanomefantasia')
				var idvisualizarazao = button.data('visualizarazao')
				var idvisualizacampofone = button.data('visualizacampofone')
				var idvisualizaemail = button.data('visualizaemail')
				var idvisualizacnpj = button.data('visualizacnpj') 
				var idvisualizacep = button.data('visualizacep') 
				var idvisualizaendereco = button.data('visualizaendereco') 
				var idvisualizacomplemento = button.data('visualizacomplemento') 
				var idvisualizabairro = button.data('visualizabairro') 
				var idvisualizacidade = button.data('visualizacidade') 
				var idvisualizaestado = button.data('visualizaestado')
				var idvisualizawebsite = button.data('visualizawebsite')	 
				var modal = $(this)
									
				modal.find('.modal-title').text('Codigo do cliente: ' + id)
				modal.find('.modal-body input').val(id)
				modal.find('#nome_fantasia').val(idvisualizanomefantasia)
				modal.find('#razao_social').val(idvisualizarazao)
				modal.find('#fone').val(idvisualizacampofone)
				modal.find('#email').val(idvisualizaemail)
				modal.find('#cnpj').val(idvisualizacnpj)
				modal.find('#cep').val(idvisualizacep)
				modal.find('#endereco').val(idvisualizaendereco)
				modal.find('#complemento').val(idvisualizacomplemento)
				modal.find('#bairro').val(idvisualizabairro)
				modal.find('#cidade').val(idvisualizacidade)
				modal.find('#selected').val(idvisualizaestado)
				modal.find('#website').val(idvisualizawebsite)
			})
		</script> 

	<!-- SCRIPT PARA MODAL EXCLUIR EMPRESA -->
	<script type="text/javascript">

			$('#modalExcluir').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Botão que acionou o modal
			var excluir = button.data('excluirempr')
			var modal = $(this)
			
			modal.find('.modal-title').text('Excluir Empresa: ' + excluir)
			modal.find('#get-id').val(excluir)
		
			})
	</script>

	<!-- SCRIPT PARA MODAL EDITAR EMPRESA -->
	<script type="text/javascript">

			$('#modalEdita').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Botão que acionou o modal
			var recipient = button.data('whatever')
			var recipientnomefantasia = button.data('whatevernomefantasia')
			var recipientrazao = button.data('whateverrazao')
			var recipientcampofone = button.data('whatevercampofone')
			var recipientemail = button.data('whateveremail')
			var recipientcnpj = button.data('whatevercnpj') 
			var recipientcep = button.data('whatevercep') 
			var recipientendereco = button.data('whateverendereco') 
			var recipientcomplemento = button.data('whatevercomplemento') 
			var recipientbairro = button.data('whateverbairro') 
			var recipientcidade = button.data('whatevercidade') 
			var recipientestado = button.data('whateverestado')
			var recipientwebsite = button.data('whateverwebsite')	

			var modal = $(this)
			modal.find('.modal-title').text('Codigo do Cliente: ' + recipient)
			modal.find('#get-id').val(recipient)
			modal.find('#nome_fantasia').val(recipientnomefantasia)
			modal.find('#razao_social').val(recipientrazao)
			modal.find('#email').val(recipientemail)
			modal.find('#fone').val(recipientcampofone)
			modal.find('#cnpj').val(recipientcnpj)
			modal.find('#cep').val(recipientcep)
			modal.find('#endereco').val(recipientendereco)
			modal.find('#complemento').val(recipientcomplemento)
			modal.find('#bairro').val(recipientbairro)
			modal.find('#cidade').val(recipientcidade)
			modal.find('#selected').val(recipientestado)
			modal.find('#website').val(recipientwebsite)
			})
	</script>



<!-- CLAYTON RASTA PRA BAIXO -->
	
	
	<!-- SCRIPT PARA MODAL NOVO NEGÓCIO -->
	<script type="text/javascript">
		$('#modalNovoNegocio').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var id = button.data('send-id') 
			var modal = $(this)
			modal.find('.modal-title').text('Codigo do cliente: ' + id)
			modal.find('#get-id').val(id)
		})
	</script>

	<!-- SCRIPT PARA MODAL NOVA EMPRESA -->
	<script type="text/javascript">
		$('#modalNovaEmpresa').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var id = button.data('send-id') 
			var modal = $(this)
			modal.find('.modal-title').text('Dados cliente:')
			modal.find('#get-id').val(id)
		})
	</script>

	<script type="text/javascript">+$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
    <script type="text/javascript">
		$(document).ready(function(){
		$("#PesquisaCliente").autocomplete("buscaCliente.php", {
			width:310,
			selectFirst: false
		});
	});

	</script>

<?php include(FOOTER_TEMPLATE); ?>