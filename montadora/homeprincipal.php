<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>

<?php
require_once('../controller/eventosController.php');
findEvento();
?>

    <header>
        <div class="row">
            <div class="col-sm-6">
                <h2>Eventos</h2>
            </div>
           <div class="col-sm-6 text-right h2">
                <a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php?acao=novo_cadastro"><i class="fa fa-plus"></i> Novo Evento</a>
                <a class="btn btn-default" href="<?php echo BASEURL; ?>eventos/index.php"><i class="fa fa-refresh"></i> Atualizar</a>
            </div>
        </div>

    </header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; 
			unset( $_SESSION['message'] );
		?>
		
    </div>
<?php endif; ?>

    <hr>
    <div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
            <tr>
            	<th width="5%"></th>                
                <th width="20%">Evento</th>
                <th width="10%">Inicio do evento</th>
              <th width="10%">Fim do evento</th>
              <th width="20%"></th>
              
            </tr>
            </thead>
            <tbody>
            <?php if ($eventos) : ?>
                <?php foreach ($eventos as $evento) : ?>
                    <tr>
                    	<td><?php echo "<label> <input type='checkbox' value='".$evento['id']."'></label>"; ?></td>
                        <td><?php echo $evento['nome_evento']; ?></td>
                        <td><?php 
						$inicio_evento = $evento['inicio_evento'];
						$date_arr= explode(" ", $inicio_evento);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$inicio_evento = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
						
						$time= $date_arr[1];
						
						echo $inicio_evento; ?></td>
                        <td><?php 
						$fim_evento = $evento['fim_evento'];
						$date_arr= explode(" ", $fim_evento);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$fim_evento = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
						
						$time= $date[1];
						
						echo $fim_evento; ?></td>
                      <td class="actions text-right">
                            <a href="view.php?id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                            <a href="edit.php?id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Nenhum evento cadastrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php //include('../modal/modal-exclusao.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>