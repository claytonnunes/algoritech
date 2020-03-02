<?php
session_start();
?>
<?php
require_once('../controller/atendimentosController.php');
findAtendimento();
require_once('../controller/vendasController.php');
findVendedores();
require_once('../controller/contatosController.php');
findContato2();

require_once ("../inc/visibilidade-header.php");
	$nome_usuario = $_SESSION["sess_name_user_vendas"];
			$id_conta = $_SESSION["id_conta_vendas"];
			$id_usuario = $_SESSION["id_usuario_vendas"] ;
			$nivel = $_SESSION["tipo_acesso_vendas"];	
			$tipo_conta = $_SESSION["tipo_conta_vendas"];
			$id_evento = $_SESSION["sess_fair_vendas"];
			$id_empresa = $_SESSION["sess_fair"];

?>
               
    <header>
     
        <div class="row">
            <div class="col-sm-6">
                <h2><i class="fa fa-th-large fa-2x"></i> Atendimento:  <?php echo "<br> ".$_SESSION['sess_name_fair_vendas'];	
				?></h2>
    			<?php 
				if(isset($_REQUEST['filter'])):
					if ($_REQUEST['filter']=='salesman'):
					echo "<br><font color='red'> Você está vendo o atendimento de ".$_REQUEST['name_salesman']."</font>";
					endif;
					else:
				endif;	
				?>
                
            </div>
            <div class="col-sm-6 text-right h2">
            <?php
			///////*****INICIO*****////////// 
			if ($_SESSION['tipo_acesso_vendas']==0):
            ?>
            
        	<div class="btn-group">
	        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Vendedor <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <?php if ($vendedores) : ?>
            <?php foreach ($vendedores as $vendedor) : ?>
            <li><a href="<?php echo BASEURL; ?><?php echo
			"atendimentos/index.php?filter=salesman&name_salesman=".$vendedor['username']."&id_salesman=". $vendedor['id']; ?>"><?php echo $vendedor['username']; ?></a></li>
            <?php
			endforeach;
			endif;
			?>
            <li><a href="<?php echo BASEURL; ?>atendimentos/index.php">MEU ATENDIMENTO</a></li>
			</ul>
			</div>
            
 			<?php 
			endif; 
			//////// *********** FIM **********////////
			
			?>	           
            
            
            
            
            
            
            
            	<a class="btn btn-primary" href="<?php echo BASEURL; ?>empresas/add.php"><i class="fa fa-plus"></i> Nova Empresa</a>
                <?php if($_SESSION['tipo_acesso_vendas']==0): ?>
                
                <a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php"><i class="fa fa-plus"></i> Novo Evento</a>
                <?php endif; ?>
            </div>
            
            
            <form id="navbar-form navbar-left" name="form1" method="post" action="pesquisa.php?filtro=nomeCliente<?php echo "$pesquisa_tudo&pg=cliente";?>"><div class="form-group">
           <label for="PesquisaCliente"></label>
           Empresa:
           <input type="text" name="PesquisaCliente" id="PesquisaCliente" value="<?php echo $_REQUEST['PesquisaCliente'];?>" size="15"/>
           <input type="submit" name="submit" id="submit" value="pesquisar" />
         </form>
        </div>
    </header>
<?php if(0==1):?>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $_SESSION['message']; ?></div>
    <?php  //clear_messages(); ?>
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
				if ($atendimento['posicao']<=3):
					$quantidade_expositores++;
					$atendimento_ativo = 'positivo';
				endif;
			endforeach;
			endif;	
        ?>
        <?php if($atendimento_ativo!='positivo') : ?>
                 <h3>ATIVOS</h3>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    
    <h3>ATIVOS - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	?></h3>
    
    
                
    <div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
<!--            <tr>-->
<!--                <th>Filtro por Empresa:</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th><input type="text" class="form-control" id="txtColuna2"/></th>-->
<!--            </tr>-->
             
            <tr>   
            	<th width="25%">Cliente</th>
                <th width="20%">Telefone</th>
               <th width="20%">Contato</th>
               <th width="25%">Email</th>
                <th width="25%">Fone</th>
                 <th width="25%">Celular</th>
                 <th width="10%"></th>
              
            </tr>
            </thead>
            <tbody>
          <?PHP
		 	foreach ($contatos as $contato):
				$i++;	
		   ?>
                         <tr>
                     
                       	<td><?php echo utf8_encode($contato['nome_fantasia']); ?></td>
                        <td><?php  
							echo utf8_encode(substr($contato['fone'],0,50))."... <br>"; 
							?></td>
                            <td><?php  
							echo utf8_encode($contato['nome']); 
							?></td>
                             <td><?php  
							echo utf8_encode($contato['email']); 
							?></td>
                             <td><?php  
							echo utf8_encode($contato['fone2']); 
							?></td>
                                  <td><?php  
							echo utf8_encode($contato['celular']); 
							?></td>
                            
                            
                           
<?php /*?>                        <td><?php 						
						$proximo_data = $atendimento['proxima_data'];
						$date_arr= explode(" ", $proximo_data);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
						$time= $date_arr[1];
						echo $proximo_data; ?></td><?php */?>
                      <td class="actions text-right">
                            <a href="<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                            
                        </td>
                    </tr>
              <?php endforeach; ?>  
                 <?php endif; ?>          
          </tbody>
        </table>
    </div>
    
    
   <hr>
     <?PHP
		  	if ($atendimentos) :
            $i = 0;
			$quantidade_expositores=0;
			$atendimento_ativo = 'negativo';
			foreach ($atendimentos as $atendimento):
				$i++;	
				if ($atendimento['posicao']==4):
					$quantidade_expositores++;
					$atendimento_ativo = 'positivo';					
				endif;
			endforeach;
			endif;	
        ?>
        <?php if($atendimento_ativo!='positivo') : ?>
                 <h3><font color="#3D7E52">EXPOSITORES</font></h3>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    
    <h3><font color="#3D7E52">EXPOSITORES - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	?></font></h3>
    
    
                
<div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
<!--            <tr>-->
<!--                <th>Filtro por Empresa:</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th><input type="text" class="form-control" id="txtColuna2"/></th>-->
<!--            </tr>-->
             
            <tr>   
            	<th width="10%"><div class="hidden-xs">Data</div></th>  
                <th width="30%">Cliente</th>
                <th width="30%">Comentário</th>
                <th width="10%">Situação</th>
              <th width="10%">Proximo Contato</th>
              <th width="10%"></th>
              
            </tr>

            </thead>
            <tbody>
          <?PHP
		  	if ($atendimentos) :
            $i = 0;
			$quantidade_expositores=0;
			
			foreach ($atendimentos as $atendimento):
				$i++;	
				if ($atendimento['posicao']==4):
					$quantidade_expositores++;
        ?>
                                                <tr>
                          <td>
                        <div class="hidden-xs">
                              				<?php 						
						$data_criado = $atendimento['created'];
						$date_arr= explode(" ", $data_criado);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$data_criado = "".$explode[2]."-".$explode[1]."-".$explode[0];
						$time= $date_arr[1];
						echo $data_criado; ?></div></td>

                    	<td><?php echo utf8_encode($atendimento['nome_fantasia']); ?></td>
                        <td><?php  
							echo utf8_encode(substr($atendimento['comentario'],0,50))."... <br>"; 
							echo "<a href=' ".BASEURL."atendimentos/view.php?id_atendimento=".$atendimento['id_atendimento']."&id_empresa=".$atendimento['id']."'>ler mais </a>";
							?></td>
                        <td><?php 
						$situacao = $atendimento['posicao'];
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
						
						echo $situacao; ?></td>
                        <td><?php 						
						$proximo_data = $atendimento['proxima_data'];
						$date_arr= explode(" ", $proximo_data);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
						$time= $date_arr[1];
						echo $proximo_data; ?></td>
                      <td class="actions text-right">
                            <a href="<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                            
                        </td>
                    </tr>
                    	
                    <?php endif; ?>
                <?php endforeach; ?>  
                 <?php endif; ?>          
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    
    
    
     <hr>
     <?PHP
		  	if ($atendimentos) :
            $i = 0;
			$quantidade_expositores=0;
			$atendimento_ativo = 'negativo';
			foreach ($atendimentos as $atendimento):
				$i++;	
				if ($atendimento['posicao']==5):
					$quantidade_expositores++;
					$atendimento_ativo = 'positivo';
				endif;
			endforeach;
			endif;	
        ?>
        <?php if($atendimento_ativo!='positivo') : ?>
                 <h3><font color="#FF0004">NEGATIVADOS</font></h3>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    
    <h3><font color="#FF0004">NEGATIVADOS - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	?></font></h3>
    
    
                
    <div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
<!--            <tr>-->
<!--                <th>Filtro por Empresa:</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th><input type="text" class="form-control" id="txtColuna2"/></th>-->
<!--            </tr>-->
             
 <tr>   
            	<th width="10%"><div class="hidden-xs">Data</div></th>  
                <th width="30%">Cliente</th>
                <th width="30%">Comentário</th>
                <th width="10%">Situação</th>
              <th width="10%">Proximo Contato</th>
              <th width="10%"></th>
              
            </tr>            </thead>
            <tbody>
          <?PHP
		  	if ($atendimentos) :
            $i = 0;
			$quantidade_expositores=0;
			
			foreach ($atendimentos as $atendimento):
				$i++;	
				if ($atendimento['posicao']==5):
					$quantidade_expositores++;
        ?>
                                               <tr>
                          <td>
                        <div class="hidden-xs">
                              				<?php 						
						$data_criado = $atendimento['created'];
						$date_arr= explode(" ", $data_criado);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$data_criado = "".$explode[2]."-".$explode[1]."-".$explode[0];
						$time= $date_arr[1];
						echo $data_criado; ?></div></td>

                    	<td><?php echo utf8_encode($atendimento['nome_fantasia']); ?></td>
                        <td><?php  
							echo utf8_encode(substr($atendimento['comentario'],0,50))."... <br>"; 
							echo "<a href=' ".BASEURL."atendimentos/view.php?id_atendimento=".$atendimento['id_atendimento']."&id_empresa=".$atendimento['id']."'>ler mais </a>";
							?></td>
                        <td><?php 
						$situacao = $atendimento['posicao'];
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
						
						echo $situacao; ?></td>
                        <td><?php 						
						$proximo_data = $atendimento['proxima_data'];
						$date_arr= explode(" ", $proximo_data);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
						$time= $date_arr[1];
						echo $proximo_data; ?></td>
                      <td class="actions text-right">
                            <a href="<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                            
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

<?php include('../modal/modal-exclusao.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>