<?php
/**
 * Created by PhpStorm.
 * User: andre.luis.a.costa
 * Date: 30/11/2016
 * Time: 15:09
 */
require_once('controller/eventosController.php');
findEvento();
// require_once ('config.php');
require_once ("inc/visibilidade-header.php");
?>

<?php $db = open_database(); ?>

    <h1>Selecione um Evento</h1>
    <hr />

    <div class="row">
    
    <?php if ($eventos) : ?>
                <?php foreach ($eventos as $evento) : ?>
                    
        
        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="visitantes" class="btn btn-default">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p><?php echo $evento['nome_evento']; ?></p>
                    </div>
                </div>
            </a>
        </div>
        
         <?php endforeach; ?>
       <?php else : ?>
                <tr>
                    <td colspan="6">Nenhum evento cadastrado.</td>
                </tr>
      <?php endif; ?>
        
    </div>

<?php include(FOOTER_TEMPLATE); ?>