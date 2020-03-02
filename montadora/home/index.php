<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php	
unset( $_SESSION['sess_nome_conta'] );
require_once('../controller/contasController.php');
require_once('../controller/usuarioController.php');
findConta();
?>

<?php $db = open_database(); ?>
    <?php if ($contas) : ?>

    <h1>Selecione uma conta</h1>
    <hr />

    <div class="row">
    
                <?php foreach ($contas as $conta) :?>
                    
        
        <div class="col-xs-6 col-sm-3 col-md-3">
            <a href="../home/valida.php?acao=select_conta&id_conta=<?php echo $conta["id_conta"]; ?>&id_conta_empresa=<?php  echo $conta["id"]; ?>" class="btn btn-default">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p><?php 
							echo utf8_encode($conta['nome_conta'])."<br>";
						?></p>
                    </div>
                </div>
            </a>
        </div>
        
         <?php endforeach; 
		
		?>
       <?php else :
		editarIdPaiUsuario();
		?>
       <hr />
			
             <h2>Cadastre a primeira conta para iniciar</h2>
             <div class="col-sm-6 text-right h2">
            	<a class="btn btn-primary" href="<?php echo BASEURL; ?>home/add.php?acao=first_conta"><i class="fa fa-plus"></i> Nova conta</a>
                </div>
        </div>
                </tr>
      <?php endif; ?>
        
    </div>
<?php include(FOOTER_TEMPLATE); ?>