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
findVendedores();
if ($_REQUEST['PesquisaCliente']!=""):
			$PesquisaCliente = $_REQUEST['PesquisaCliente'];
			findIdCompany($PesquisaCliente);
			
		else:
		find_company();
		
endif;
		//findIdAtendimento();
// require_once('../controller/atendimentosController.php');
	// 	findAtendimento();			
?>
    <header>      
      <div class="row">
            <div class="col-sm-6">
                <h2> <i class="fa fa-th-large fa-2x"></i>  Clientes:  <?php echo "<br>".$_SESSION['sess_name_fair_vendas'];?></h2>
            </div>
            <?php if (0==1): ?>
             <div class="col-sm-2 ">
                  <input type="hidden" name="usuario['tipo_conta']" value="1"  class="form-control" />
                  <input type="hidden" name="usuario['status']" value="0"  class="form-control" />
            </div> 
            <?php endif; ?>           
          <div class="col-sm-6 text-right h2">
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
   <?php if(0==1): ?>
   
      <div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="<?php echo BASEURL; ?>empresas/index.php?filter=1">Ativo</a></li>
    <li><a href="<?php echo BASEURL; ?>empresas/index.php?filter=2">Inativo</a></li>
     </ul>
     
     <?php endif; ?>
</div>

        </div>
        
    </header>
<?php if(0==1):?>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php  //clear_messages(); ?>
<?php endif; ?>
<?php endif; ?>
	<?php 
	// CODIGO DE SEARCH
    /*
        <div class="row">
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Pesquisar</button>
              </span>
              <input type="text" class="form-control" placeholder="Pesquisar Cliente...">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
    */
    ?>
    
    
    
    
     <?php 
	 		
			 if ($empresas) : 
				$i = 0;
				$quantidade_expositores=0;

				foreach ($empresas as $empresa) :	
					global $id_empresa;
					$id_empresa = $empresa['id'];	
					findIdAtendimento($id_empresa);	
					 
						if ($atendimentos) : 
						 $atendimento_ativo = 'negativo';

							foreach ($atendimentos as $atendimento) : 
							$i++;
							$id_atendimento = $atendimento['id_atendimento'];
								if($id_atendimento>=1):
									$quantidade_expositores++;
									$atendimento_ativo = 'positivo';
								endif;
							endforeach;
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
            	<th width="13%">cod</th>                
                <th width="26%">Clientes</th>
                <th width="22%">
                <?php if(0==1):?>
                <div class="row">
                    <a href="../empresas/index.php?acao=order_situation" class="btn btn-default">
                        <i class="fa fa-chevron-down fa-9x"></i>Situação
                    </a>                
                </div>
                <?php  
                endif;
                ?>
                Situação</th>
              <th width="14%">Atend.</th>
              <th width="25%"></th>
              
            </tr>
            </thead>
            <tbody>
            
    
            <?php 
			 if ($empresas) : 
				foreach ($empresas as $empresa) :	
					global $id_empresa;
					$id_empresa = $empresa['id'];	
					findIdAtendimento($id_empresa);	
					 
						if ($atendimentos) : 
							foreach ($atendimentos as $atendimento) : 
							$id_atendimento = $atendimento['id_atendimento'];
							if($id_atendimento>=1):
									    	
			?>
           
                	<tr>
                    	<td><?php echo $atendimento['id_atendimento'];?></td>
                        <td><?php echo utf8_encode($empresa['nome_fantasia']); ?></td>
                        						

                        <td> 
                       <?php
					  	echo "ativo";
					   ?>
            </td>
                      <td class="actions text-left"><?php
					  	findVendedorAtend($id_atendimento = $atendimento['id_usuario']);
					   if ($vendedor_atend) : ?>
            			<?php foreach ($vendedor_atend as $vendedor_a) : 
						
						?><?php echo $vendedor_a['nome']; ?>
 			<?php
			endforeach;
			endif;
			?></td>
                      <td class="actions text-right"><a href="<?php echo BASEURL; ?>empresas/view2.php?id_empresa=<?php echo $empresa['id']; ?>&id_atendimento=<?php echo $atendimento['id_atendimento']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                        <?php if($_SESSION['tipo_acesso_vendas']==0): ?>
                      <a href="edit.php?id=<?php echo $empresa['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a> <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-empresa="<?php echo $empresa['id']; ?>"> <i class="fa fa-trash"></i> Excluir </a></td>
                    </tr>
                    
                <?php 
				endif;
					endif;
					endforeach;
					endif;
				endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Nenhuma empresa cadastrada.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    
    
    
        <hr>
        
        
        
        
        
          <?php 
			 if ($empresas) : 
				$i = 0;
				$quantidade_expositores=0;

				foreach ($empresas as $empresa) :	
					global $id_empresa;
					$id_empresa = $empresa['id'];	
					findIdAtendimento($id_empresa);	
					 
						if ($atendimentos) : 
						else:
						 $atendimento_ativo = 'negativo';

							$i++;
							
								if($id_empresa>=1):
									$quantidade_expositores++;
									$atendimento_ativo = 'positivo';
								endif;
						endif;	
				endforeach;
			endif;	
			
									    	
			?>
    
    
   
        <?php if($atendimento_ativo!='positivo') : ?>
                 <h3><font color="#FF0004">INATIVOS</font></h3>
                 <div id="divConteudo2">
        			<table id="tabela2" class="table table-hover">
            		<thead>
                	<tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                	</tr>
                <?php else: ?>
    
    <h3><font color="#FF0004">INATIVOS - <?php echo $quantidade_expositores; 
	if($quantidade_expositores>1):
		echo " Clientes";
		else:
		echo " Cliente";
	endif;
	endif;
	?></font></h3>
        
        
        
        
        
        
        
        
        
        
        
        
        
      <form role="form">
         
         <?php if (0==1): ?>
      <div class="row">
      	<div class="col-sm-4">
        	<div class="btn-group">
	        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <?php if ($vendedores) : ?>
            <?php foreach ($vendedores as $vendedor) : 
			$nome_vendedor = $vendedor['nome'];
			?>
            
            <li><a href="<?php echo BASEURL; ?>empresas/index.php?filter=1"><?php echo $vendedor['username']; ?></a></li>
 			<?php
			endforeach;
			endif;
			?>
			</ul>
			</div>
		</div>
        <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" id="salvar">Enviar</button>
               
        </div>
        
   	</div>
        <?php endif; ?>

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
            	<th width="12%">&nbsp;</th>                
                <th width="26%">Clientes</th>
                <th width="22%">
                <?php if(0==1):?>
                <div class="row">
                    <a href="../empresas/index.php?acao=order_situation" class="btn btn-default">
                        <i class="fa fa-chevron-down fa-9x"></i>Situação
                    </a>                
                </div>
                <?php  
                endif;
                ?>
                Situação</th>
              <th width="15%">Atend.</th>
              <th width="25%"></th>
              
            </tr>
            </thead>
            <tbody>
            
    
            <?php 
			 if ($empresas) : 
				foreach ($empresas as $empresa) :	
					global $id_empresa;
					$id_empresa = $empresa['id'];	
					findIdAtendimento($id_empresa);	
					 
						if ($atendimentos) : 
							
							else:									    	
											
			?>
           
                	<tr>
                    	<td>&nbsp;</td>
                          
                        <td><?php echo utf8_encode($empresa['nome_fantasia']); ?></td>
                        						

                        <td> 
                       <?php
					  echo "<font color='#FF0004'>inativo</font>";
							$atendimento['id_atendimento']='first';
						?>
            </td>
                      <td class="actions text-left">
                      
					  <?php
					  	findVendedorAtend($id_atendimento = $atendimento['id_usuario']);
					   if ($vendedor_atend) : ?>
            			<?php foreach ($vendedor_atend as $vendedor_a) : 
						
						?><?php echo $vendedor_a['nome']; ?>
 			<?php
			endforeach;
			endif;
			?></td>
                      <td class="actions text-right"><a href="<?php echo BASEURL; ?>empresas/view2.php?id_empresa=<?php echo $empresa['id']; ?>&id_atendimento=<?php echo $atendimento['id_atendimento']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                        <?php if($_SESSION['tipo_acesso_vendas']==0): ?>
                      <a href="edit.php?id=<?php echo $empresa['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a> <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-empresa="<?php echo $empresa['id']; ?>"> <i class="fa fa-trash"></i> Excluir </a></td>
                    </tr>
                    
                <?php 
				endif;
					endif;
					//endforeach;
				//	endif;
				endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Nenhuma empresa cadastrada.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    </form>
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