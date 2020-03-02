<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/vendasController.php');
findVendedores();

require_once('../controller/equipeController.php');
pesquisaEquipe();

if($_REQUEST['acao']=='add_vendedor'):
	salvarVendedorEquipe();
endif;
?>
    <header>		
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
			<div class="col-sm-6 text-left h4">
           		<h4><i class="fa fa-user fa-2x"></i> Equipe de vendas <?php echo " ".$_SESSION['nome_edicao'];	?></h4>
			</div>	
            <div class="col-sm-6 text-right h4">
                <a class="btn btn-primary" href="<?php echo BASEURL; ?>usuarios/add_novo_usuario.php"><i class="fa fa-user"></i> Novo usuário</a>
            </div>
        </div>
    </header>
	<hr>

 	<!-- CONDIÇÃO PARA ABRIR TELA DE CADASTRO DA META -->
	<?php 	if ($_REQUEST['add']=='add_meta_edicao') : 	
				if(isset($_REQUEST['id_meta'])):
				$id_meta = $_REQUEST['id_meta'];
	?>
				<div class="col-sm-12 text-left h4">
					<h4><i class="fa fa-usd fa-2x"></i> Editar valor da meta </h4>
				</div>	

	<?php 	else: 
				$id_meta = '';
	?>
				<div class="col-sm-12 text-left h4">
					<h4><i class="fa fa-usd fa-2x"></i> Inserir valor da meta </h4>
				</div>
	<?php 	 endif; ?>
	<form id="formEquipe" name="formEquipe" action="../equipe/index.php?acao=add_vendedor&id_meta=<?php 	echo $id_meta;?>&id_usuario=<?php 	echo $_REQUEST['id_usuario'];?>&nome_usuario=<?php echo $_REQUEST['nome_usuario'];	?>" method="post">
		<h3>
				<div id="display-2">
					<div class="col-sm-1" align="left">
						<?php 	echo $_REQUEST['id_usuario'];	?>
				 	</div>
					<div class="col-sm-5" align="left">
						<?php 	echo $_REQUEST['nome_usuario'];	?>
				 	</div>
					<div class="col-sm-4" align="left">
						<input type="text" id="valor" class="form-control" name="valor_meta_edicao" placeholder="insira o valor da meta aqui!">
				 	</div>
					<div class="col-sm-2" align="left"> 
						<button type="submit" class="btn btn-success" id="salvar">Salvar</button>
					</div>
					
            	</div>
		</h3>
	</form>

	<!-- CONDIÇÃO PARA VISUALIZAR TELA COM METAS CADASTRADAS -->
	<?php 	else:	?>

		<?php  if ($vendedores) : 	?>
		
		<!-- CONDIÇÃO PARA SOMAR VALOR DA META -->
		<?php 
		if ($equipes) : 
			foreach ($equipes as $equipe) : 
				$meta = $equipe['meta'];
				$meta_total += $meta;
			endforeach;
			$meta_total = $meta_total;
			$meta_parcial = 0; 
			function porcentagem_nx ( $parcial, $total ) {
				return ( $parcial * 100 ) / $total;
			}
			$porcentagem_parcial = porcentagem_nx($meta_parcial, $meta_total);
			if($porcentagem_parcial<33):
				$cor_barra = 'danger';
			elseif(($porcentagem_parcial>=33)and($porcentagem_parcial<66)):
				$cor_barra = 'warning';
			else:
				$cor_barra = 'success';
			endif;
			$meta_total_real = number_format( $meta_total , 2, ',', '.');
			$meta_parcial_real = number_format( $meta_parcial , 2, ',', '.');

		?>
<div class="container">
  	<div class="row">
		<div class="col-sm-12" align="left">
			<p>
				<strong>Meta total da equipe '<?php echo "R$ ".$meta_total_real; ?>', cumprida '<?php echo "R$ ".$meta_parcial_real; ?>'</strong>
				<span class="pull-right text-muted"><?php echo $porcentagem_parcial; ?>%</span>
			</p>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-<?php echo $cor_barra; ?>" role="progressbar" aria-valuenow="<?php echo $porcentagem_parcial; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentagem_parcial; ?>%">
					<span class="sr-only"><?php echo $porcentagem_parcial; ?>%</span>
				</div>
			</div>			
		</div>	
	</div>
</div>
<?php 	endif;	?>


		<h3>
			<div class="container">
  				<div class="row">
					<div class="col-sm-2" align="left">
						Usuário
				 	</div>
					<div class="col-sm-2" align="left">
                        Nome
					</div>	
					<div class="col-sm-2" align="left">
						e-mail
					</div>                        
                    <div class="col-sm-2" align="left">  
						   Acesso 
                	</div>
					<div class="col-sm-2" align="left">  
						   Meta 
                	</div>
					<div class="col-sm-2" align="left">  
						    ...
                	</div>
            	</div>
			</div>
		</h3>
		    <tbody>

            <?php 
				
			 		foreach ($vendedores as $vendedor) : 
						
				?>
				<form id="formEquipe" name="formEquipe" action="../equipe/index.php?add=add_meta_edicao&id_usuario=<?php echo $vendedor['id']; ?>&nome_usuario=<?php echo $vendedor['nome_usuario']; ?>" method="post">
			<div class="example-container">
  				<div class="example-row">
					<?php if (0==1): ?>
	        		<div class="col-sm-1" align="left">
						<?php echo "<label> <input type='checkbox' name='equipe[]' value='".$vendedor['id']."'></label>"; ?>
					</div>
					<?php endif; ?>
					<div class="col-sm-2" align="left">
						<?php echo $vendedor['usuario']; ?>
				 	</div>
					<div class="col-sm-2" align="left">
                        <?php echo $vendedor['nome_usuario']; ?>
					</div>	
					<div class="col-sm-2" align="left">
						<?php echo $vendedor['email']; ?>
					</div>                        
                    <div class="col-sm-2" align="left">  
						<?php $acesso = $vendedor['tipo_acesso'];
						if ($acesso==0){
							$acesso = "Administrador";
						}
						else if ($acesso==1){
							$acesso = "Simples";
						}
						else {							
							$acesso = "Indefinido";							
							}	
						echo $acesso; ?>
              		        
                	</div>
					
					<?php 
					pesquisaMeta($vendedor['id']); 
					
					if($metas):
						foreach ($metas as $meta) : 

						
					
					?>
					<div class="col-sm-2" align="left"> 
						<button type="button" class="btn btn-warning btn-sm">
						<?php 
							$valor = number_format( $meta['meta'] , 2, ',', '.');
							echo "R$ ".$valor;  ?>
						</button>
					</div>
					
					<div class="col-sm-2" align="left"> 
						<button type="submit" class="btn btn-success" id="salvar">Editar meta</button>
						<input type="hidden" id="edicao" name="id_meta" value="<?php echo $meta['id']; ?>">
					</div>

					<?php endforeach; else: ?>
					<div class="col-sm-2" align="left"> 
						<button type="button" class="btn btn-danger btn-sm">
							R$ 0,00
						</button>
					</div>
					<div class="col-sm-2" align="left"> 
						<button type="submit" class="btn btn-primary" id="salvar">Inserir meta</button>
						<input type="hidden" id="edicao" name="id_meta" value="sem_id">
					</div>
					 <?php endif; ?>
            	</div>
			</div>
				</form>
                <?php  endforeach; ?>
					
							
            <?php else : ?>
				<h3>
				<div id="display-1">
					<div class="col-sm-12" align="left">
						Nenhum Vendedor cadastrado.
				 	</div>
            	</div>
				</h3>
				
                <tr>
                    <td colspan="6">Nenhuma meta cadastrada.</td>
                </tr>
            <?php endif; ?>
			</tbody>
<?php 	endif; 	?>
	  <script type="text/javascript">+$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>

<?php include('../modal/modal-exclusao.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>