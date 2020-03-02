<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
unset( $_SESSION['id_edicao'] );
unset( $_SESSION['id_evento'] );
unset( $_SESSION['nome_edicao'] );

require_once('../controller/tarefaController.php');
require_once('../controller/agendaController.php');
require_once('../controller/vendasController.php');

if(isset($_REQUEST['pesquisa'])){
	if ($_REQUEST['pesquisa']=='vendedor'){
		$idVendedor = $_REQUEST['id_vendedor'];
	}
	else{
		$idVendedor = $_SESSION;	
	}
}

pesquisaTarefa('id_usuario',  $idVendedor, 'id_pai', $_SESSION['id_pai'], 'status', '0', 'ORDER BY proxima_data ASC');

findVendedores();
?>              
<header>	
        <div class="container">
	        <div class="col-sm-4" align="left">
               <h4><i class="fa fa-th-large fa-2x"></i> Agenda</h4>
    			<?php 
				if(isset($_REQUEST['pesquisa'])):
					if ($_REQUEST['pesquisa']=='vendedor'):
					echo "<br><font color='red'> Você está vendo o atendimento de ".$_REQUEST['nome_vendedor']."</font>";
					endif;
					else:
				endif;	
				?>
                
            </div>
            <div class="col-sm-8 text-right">
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
            <li><a href="#<?php echo BASEURL; ?><?php echo
			"agenda/index.php?pesquisa=vendedor&nome_vendedor=".$vendedor['usuario']."&id_vendedor=". $vendedor['id']; ?>"><?php echo $vendedor['usuario']; ?></a></li>
            <?php
			endforeach;
			endif;
			?>
            <li><a href="#<?php echo BASEURL; ?>agenda/index.php">MEU ATENDIMENTO</a></li>
			</ul>
			</div>
            
 			<?php 
			endif; 
			//////// *********** FIM **********////////
			
			?>	           
            <?php if($_SESSION['tipo_acesso']==0): ?>
                
                <a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php?acao=novo_cadastro"><i class="fa fa-plus"></i> Novo Evento</a>
                <?php endif; ?>
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
				if ($atendimento['posicao']<=3):
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
    
    <h4>AGENDA - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	?></h4>
    
    
                
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
                <th width="30%">Coment&aacute;rio</th>
                <th width="10%">Situa&ccedil;&atilde;o</th>
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
				if ($atendimento['posicao']<=3):
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

                    	<td><?php echo $atendimento['nome_fantasia']; ?></td>
                        <td><?php  
							echo substr($atendimento['comentario'],0,50)."... <br>"; 
							echo "<a href='#".BASEURL."empresas/view2.php?id_atendimento=".$atendimento['id_atendimento']."&id_empresa=".$atendimento['id']."&id_edicao=".$atendimento['id_edicao']."'>ler mais </a>";
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
						echo $proximo_data; 
							$data_hoje = date('d-m-Y');
							if(strtotime($proximo_data) < strtotime($data_hoje)):
								$cor_agenda = 'danger';
							elseif(strtotime($proximo_data) == strtotime($data_hoje)):
								$cor_agenda = 'warning';
							else:
								$cor_agenda = 'success';
							endif;
							
							?></td>
                      <td class="actions text-right">
                            <a href="#<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>&id_edicao=<?php echo $atendimento['id_edicao']; ?>" class="btn btn-sm btn-<?php echo $cor_agenda; ?>"><i class="fa fa-eye"></i> Visualizar</a>
                            
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
				if ($atendimento['posicao']==4):
					$quantidade_expositores++;
					$atendimento_ativo = 'positivo';					
				endif;
			endforeach;
			endif;	
        ?>
        <?php if($atendimento_ativo!='positivo') : ?>
                 <h4><font color="#3D7E52">APROVADOS</font></h4>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    
    <h4><font color="#3D7E52">EXPOSITORES - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	?></font></h4>
    
    
                
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
                <th width="30%">Coment&aacute;rio</th>
                <th width="10%">Situa&ccedil;&atilde;o</th>
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

                    	<td><?php echo $atendimento['nome_fantasia']; ?></td>
                        <td><?php  
							echo substr($atendimento['comentario'],0,50)."... <br>"; 
							echo "<a href='#".BASEURL."empresas/view2.php?id_atendimento=".$atendimento['id_atendimento']."&id_empresa=".$atendimento['id']."&id_edicao=".$atendimento['id_edicao']."'>ler mais </a>";
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
						echo $proximo_data; 
							$data_hoje = date('d-m-Y');
							if(strtotime($proximo_data) < strtotime($data_hoje)):
								$cor_agenda = 'danger';
							elseif(strtotime($proximo_data) == strtotime($data_hoje)):
								$cor_agenda = 'warning';
							else:
								$cor_agenda = 'success';
							endif;
							
							?></td>
                      <td class="actions text-right">
                            <a href="#<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>&id_edicao=<?php echo $atendimento['id_edicao']; ?>" class="btn btn-sm btn-<?php echo $cor_agenda; ?>"><i class="fa fa-eye"></i> Visualizar</a>
                            
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
                 <h4><font color="#FF0004">CANCELADOS</font></h4>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    
    <h4><font color="#FF0004">NEGATIVADOS - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	?></font></h4>
    
    
                
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
                <th width="30%">Coment&aacute;rio</th>
                <th width="10%">Situa&ccedil;&atilde;o</th>
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

                    	<td><?php echo $atendimento['nome_fantasia']; ?></td>
                        <td><?php  
							echo substr($atendimento['comentario'],0,50)."... <br>"; 
							echo "<a href='#".BASEURL."empresas/view2.php?id_atendimento=".$atendimento['id_atendimento']."&id_empresa=".$atendimento['id']."&id_edicao=".$atendimento['id_edicao']."'>ler mais </a>";
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
						echo $proximo_data; 
							$data_hoje = date('d-m-Y');
							if(strtotime($proximo_data) < strtotime($data_hoje)):
								$cor_agenda = 'danger';
							elseif(strtotime($proximo_data) == strtotime($data_hoje)):
								$cor_agenda = 'warning';
							else:
								$cor_agenda = 'success';
							endif;
							
							?></td>
                      <td class="actions text-right">
                            <a href="#<?php echo BASEURL; ?>empresas/view2.php?id_atendimento=<?php echo $atendimento['id_atendimento']; ?>&id_empresa=<?php echo $atendimento['id']; ?>&id_edicao=<?php echo $atendimento['id_edicao']; ?>" class="btn btn-sm btn-<?php echo $cor_agenda; ?>"><i class="fa fa-eye"></i> Visualizar</a>
                            
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
?>

<?php include(FOOTER_TEMPLATE); ?>