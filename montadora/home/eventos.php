<?php
session_start();
?>
<?php
unset( $_SESSION['sess_fair_vendas'] );
unset( $_SESSION['sess_edition_vendas'] );
unset( $_SESSION['sess_name_fair_vendas'] );

require_once('../controller/eventosController.php');
findEvento();
//require_once ('../config.php');
require_once ("../inc/visibilidade-header.php");
?>

<?php $db = open_database(); ?>
    <?php if ($eventos) : ?>

    <h1>Selecione um Evento</h1>
    <hr />

    <div class="row">
    
                <?php foreach ($eventos as $evento) :?>
                    
        
        <div class="col-xs-6 col-sm-3 col-md-3">
            <a href="../eventos/valida.php?acao=select_fair&id_edicao=<?php echo $evento["id_edicao"]; ?>&id_evento=<?php echo $evento["id"]; ?>&nome_evento=<?php echo utf8_encode($evento["nome_evento"]); ?>" class="btn btn-default">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p><?php 
							echo utf8_encode($evento['nome_evento'])."<br>";
							
							$inauguracao = $evento['inauguracao'];
							$date_arr= explode(" ", $inauguracao);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$inauguracao = "".$explode[2]."-".$explode[1]."-".$explode[0];
							$time= $date_arr[1];
							echo "inauguração: ".$inauguracao."<br>";
							
							$encerramento = $evento['encerramento'];
							$date_arr= explode(" ", $encerramento);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$encerramento = "".$explode[2]."-".$explode[1]."-".$explode[0];
							$time= $date[1];						
							echo "encerramento: ".$encerramento; 
							
						
						
						?></p>
                    </div>
                </div>
            </a>
        </div>
        
         <?php endforeach; ?>
       <?php else : ?>
       <hr />

             <h2>Cadastre o primeiro evento para iniciar</h2>
             <div class="col-sm-6 text-right h2">
            	<a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php?acao=first_event"><i class="fa fa-plus"></i> Novo Evento</a>
                </div>
        </div>
                </tr>
      <?php endif; ?>
        
    </div>
<?php include(FOOTER_TEMPLATE); ?>