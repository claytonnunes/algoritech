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

?>
<header>
	<div class="row">
		<div class="col-sm-4 h4">
			<i class="fa fa-th-large fa-2x"></i>  Contato:  <?php echo $_SESSION['nome_edicao'];?>
		</div>     
		<div class="col-sm-5 h4">
			 <form class="form-inline" id="navbar-form" name="form1" method="post" action="index.php?filtro=nomeCliente&pg=cliente">
				<label for="PesquisaCliente"></label>
				<input class="form-control form-control-sm mr-3 w-75" type="text" name="PesquisaCliente" id="PesquisaCliente" placeholder="Pesquisar" value="<?php 
				if(isset($_REQUEST['PesquisaCliente'])):
				echo $_REQUEST['PesquisaCliente']; endif;?>" aria-label="Pesquisar"/> 
				<i class="fa fa-search" aria-hidden="true"></i>
			 </form>
		</div>
		<div class="col-sm-3 text-right">
			<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalNovaEmpresa" 
							data-send-id="<?php echo $empresa['id']; ?>"> <i class="fa fa-plus"></i> Nova Empresa</button>
		</div>
	</div> 
</header>
   	<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span></button> SELECIONE UM CLIENTE ABAIXO PARA INICIAR ATENDIMENTO
	</div>
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
                      	<td class="actions text-right">
						  <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalNovoNegocio" 
							data-send-id="<?php echo $empresa['id']; ?>"> <i class="fa fa-plus"></i> Novo negócio</button>
					  		<a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Visualizar</a>
                             <?php if($_SESSION['tipo_acesso']==0): ?>
                            <a href="edit.php?id=<?php echo $empresa['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
							<a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-empresa="<?php echo $empresa['id']; ?>">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
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
	<?php include('../modal/modal-exclusao.php'); ?>
	<?php include('../modal/modalNovoNegocio.php'); ?>
	<?php include('../modal/modalNovaEmpresa.php'); ?>
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


	<script>
        jQuery(function($){  
		    $("#campoDATE1").mask("99/99/9999");
			$("#campoDATE2").mask("99/99/9999");
			$("#campoDATE3").mask("99/99/9999");
			$("#campoDATE4").mask("99/99/9999");
			$("#campoDATE5").mask("99/99/9999");
			$("#campoDATE6").mask("99/99/9999");
			$("#campoFONE").mask("(99) 9999-9999");
			$("#campoFONE2").mask("(99) 9999-9999");
			$("#campoFONE3").mask("(99) 9999-9999");
            $("#campoCEL").mask("(99) 9 9999-9999");
		    $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");

        });
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