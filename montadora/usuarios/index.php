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
require_once('../controller/vendasController.php');
$id_pai = $_SESSION['id_pai'];
pesquisatresColunas('id_pai', $id_pai, 'status', '0', 'deleted', '0');

?>

    <header>
        <div class="row">
            <div class="col-sm-6">
                <h2>Usu&aacute;rios</h2>
            </div>
            <div class="col-sm-6 text-right h2">
            	<a class="btn btn-primary" href="<?php echo BASEURL; ?>empresas/add.php"><i class="fa fa-plus"></i> Nova Empresa</a>
                <a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php"><i class="fa fa-plus"></i> Novo Evento</a>      
            </div>
        </div>
    </header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
    </div>
<?php endif; ?>
	<hr>
    <div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
			  <tr>
            	<th width="5%"></th>                
                <th width="40%">Nome</th>
                <th width="15%">Acesso</th>                
              <th width="20%">Usu&aacute;rio</th>
              <th width="20%"></th>
              
            </tr>
            </thead>
            <tbody>
            <?php 
				if ($usuarios) : 
			 		foreach ($usuarios as $usuario) : 
						
				?>
                	
                    
                
              <tr>
                    	<td></td>
                        <td><?php echo $usuario['nome_usuario']; ?></td>
                        <td><?php 
						$acesso = $usuario['tipo_acesso'];
						if ($acesso==0){
							$acesso = "Administrador";
						}
						else if ($acesso==1){
							$acesso = "Simples";
						}
						else {							
							$acesso = "Indefinido";							
							}	
						echo $acesso; ?></td>                        
                      <td ><?php echo $usuario['usuario']; ?>
              		        
                </td>
                <td>
                  <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-empresa="<?php echo $usuario['id']; ?>">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                    
                    
                    
                    
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Nenhum usuario cadastrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include('../modal/modal-exclusao.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>