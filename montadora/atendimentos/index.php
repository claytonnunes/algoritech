<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/equipeController.php');
pesquisaEquipe();
require_once('../controller/atendimentosController.php');
findAtendimento();
require_once('../controller/vendasController.php');
findVendedores();
?>              
<header>	
<?php 
	// VERIFICA SE PRECISA CADASTRAR O PRIMEIRO VENDEDOR
	if ($equipes == false) : 
	?>
	 <h4><i class="fa fa-th-large fa-2x"></i> Evento:  <?php echo " ".$_SESSION['nome_edicao'];	
				?></h4>
	<hr>
	<div class="col-sm-12 text-left h4">Adicione vendedor na equipe do evento para iniciar
        <a class="btn btn-primary" href="<?php echo BASEURL; ?>./equipe/index.php?acao=add_vendedor_evento"><i class="fa fa-plus"></i> Adicionar Vendedor</a>
		
	</div>
	<br><br><br><br><br><br><br><br><br>
             
<?php 
	else:
?>
		<?php 
		if(isset($_REQUEST['filter'])):
			if ($_REQUEST['filter']=='salesman'):
		?>
		<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<?php echo "VOCÊ ESTÁ VENDO O ATENDIMENTO DE ".$_REQUEST['name_salesman']; ?>
		</div>
		<hr>
		<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->
		<?php 

			endif;
			else:
		endif;	
		?>
        <div class="container">
	        <div class="col-sm-5 text-right">
				 <form class="form-inline" id="navbar-form" name="form1" method="post" action="index.php?filtro=nomeCliente">
					<label for="PesquisaCliente"></label>
					<input class="form-control form-control-sm mr-3 w-75" type="text" name="PesquisaCliente" id="PesquisaCliente" placeholder="Pesquisar" value="<?php 
					if(isset($_REQUEST['PesquisaCliente'])):
					echo $_REQUEST['PesquisaCliente']; endif;?>" aria-label="Pesquisar"/> 
					<i class="fa fa-search" aria-hidden="true"></i>
				 </form>
			</div>
            <div class="col-sm-7 text-right">
            <?php
			///////*****INICIO*****////////// 
			if ($_SESSION['tipo_acesso']==0):
            ?>	
        	<div class="btn-group">
	        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Vendedor <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <?php if ($vendedores) : ?>
            <?php foreach ($vendedores as $vendedor) : ?>
            <li><a href="<?php echo BASEURL; ?><?php echo
			"atendimentos/index.php?filter=salesman&name_salesman=".$vendedor['nome_usuario']."&id_salesman=". $vendedor['id']; ?>"><?php echo $vendedor['nome_usuario']; ?></a></li>
            <?php
			endforeach;
			endif;
			?>
            <li><a href="<?php echo BASEURL; ?>atendimentos/index.php">MINHA AGENDA</a></li>
			</ul>
			</div>
            
 			<?php 
			endif; 
			//////// *********** FIM **********////////
			
			?>	<a class="btn btn-info" href="../funil/index.php?pg=funil"><i class="fa fa-filter"></i> Funil de vendas</a>
				<a class="btn btn-success" href="<?php echo BASEURL; ?>empresas/index.php"><i class="fa fa-group"></i> Iniciar atendimento</a>
            	<a class="btn btn-success" href="<?php echo BASEURL; ?>empresas/add.php"><i class="fa fa-building-o"></i> Nova Empresa</a>
            </div>
        </div>
    </header>
<?php if(0==1):?>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $_SESSION['message']; ?></div>
    
<?php endif; ?>
<?php endif; ?>


    <hr>
     <?PHP
		  	if ($atendimentos) :
            $i = 0;
			$quantidade_expositores=0;
			$atendimento_ativo = 'negativo';
			foreach ($atendimentos as $atendimento):
				$i++;	
				if ($atendimento['posicao']!=""):
					$quantidade_expositores++;
					$atendimento_ativo = 'positivo';
				endif;
			endforeach;
			endif;	
        ?>
        <?php if($atendimento_ativo!='positivo') : ?>
				
   			 	<h4>ATIVOS </h4>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    <div id="divConteudo2">
    	<div id="row">
			<div class="form-group col-md-6" align="left" >
				<h4><i class="fa fa-calendar" aria-hidden="true"></i> AGENDA:  <?php echo $quantidade_expositores; 
				if($quantidade_expositores>1):
					echo " CLIENTES";
					else:
					echo " CLIENTE";
				endif;
				?></h4>
			</div>
			<div class="form-group col-md-6" align="left" >
				<h4><i class="fa fa-bookmark" aria-hidden="true"></i> EVENTO: <?php echo $_SESSION['nome_edicao'];
				?></h4>
			</div>
		</div>
	</div>
    <div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
				<tr>
					<td>
					<h4>
					<div id="row">
						<div class="form-group col-md-2" align="left">Proximo Contato</div>
						<div class="form-group col-md-3" align="left" >Cliente</div>
						<div class="form-group col-md-5" align="left" >Comentário</div>
						<div class="form-group col-md-1" align="left" >Status</div>
						<div class="form-group col-md-1" align="left" ></div>
					</div>
					</h4>
					</td>
				</tr>
            </thead>
            <tbody>
          <?PHP
		  	if ($atendimentos) :
            $i = 0;
			$quantidade_expositores=0;
			
			foreach ($atendimentos as $atendimento):
				$i++;	
				if ($atendimento['posicao']!=""):
					$quantidade_expositores++;
        ?>
        
                        <tr>
							
							
							
							<td>
					<div id="row">
						<div class="form-group col-md-2" align="left" >
							<?php 						
							$proximo_data = $atendimento['proxima_data'];
							$date_arr= explode(" ", $proximo_data);
							$date= $date_arr[0];

							$explode = explode('-' ,$date);
							$proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
							$time= $date_arr[1];
								$data_hoje = date('d-m-Y');
								if(strtotime($proximo_data) < strtotime($data_hoje)):
									$notificacao_agenda = "<i class='fa fa-warning'></i>";
									$cor_agenda = 'danger';
									
								elseif(strtotime($proximo_data) == strtotime($data_hoje)):
									$notificacao_agenda = "<i class='fa fa-warning'></i>";
									$cor_agenda = 'warning';
								else:
									$notificacao_agenda = "<i class='fa fa-clock'></i>";
									$cor_agenda = 'info';
								endif;
							echo $notificacao_agenda." ".$proximo_data; 
							
							?>
						</div>
						<div class="form-group col-md-3" align="left" >
							<?php echo $atendimento['nome_fantasia']; ?>
						</div>
						<div class="form-group col-md-4" align="left" >
							<?php  
							echo substr($atendimento['comentario'],0,50)."... <br>"; 
							echo "<a href=' ".BASEURL."empresas/view2.php?id_atendimento=".$atendimento['id_atendimento']."&id_empresa=".$atendimento['id']."'>ler mais </a>";
							?>
						</div>
						<div class="form-group col-md-1" align="left" >
							<?php 
							$situacao = $atendimento['posicao'];
							if($situacao==0){
									$situacao = "<i class='fa fa-lock'></i>";
								}
								else if ($situacao==1){ //Captação
									$situacao = "<i class='fa fa-phone'></i>";
								}
								else if ($situacao==2){ //Orçamento Enviado
									$situacao = "<i class='fa fa-file'></i>"; 
								}
								else if ($situacao==3){ //Alinhando Contrato
									$situacao = "<i class='fa fa-bell'></i>";
								}
								else if ($situacao==4){ //Contrato Assinado
									$situacao = "<i class='fa fa-trophy'></i>";
								}
								else if ($situacao==5){ //Negativado
									$situacao = "<i class='fa fa-thumbs-down'></i>";
								}
								else{
									$situacao = "<i class='fa fa-lock'></i>";
									}

							echo $situacao; ?>
						</div>
						<div class="form-group col-md-2" align="left" >
							<a href="<?php echo BASEURL; ?>negocio/index.php?id_edicao=<?php echo $atendimento['id_edicao']; ?>&id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-<?php echo $cor_agenda; ?>"><i class="fa fa-eye"></i></a>
							<a href="<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-<?php echo $cor_agenda; ?>"><i class="fa fa-eye"></i></a>
						</div>
					</div>
					</td>
				</tr>
                    	
                    <?php endif; ?>
                <?php endforeach; ?>  
                 <?php endif; ?>          
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
             $(document).ready(function(){
                $("#PesquisaCliente").autocomplete("buscaCliente.php", {
                    width:310,
                    selectFirst: false
                });
            });
			
         </script>

<?php 
	include('../modal/modal-exclusao.php'); 
	
	// FIM DA CONDIÇÃO QUE VERIFICA SE TEM VENDEDOR CADASTRADO NO EVENTO					
	endif; 
?>

<?php include(FOOTER_TEMPLATE); ?>