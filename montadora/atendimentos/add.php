<?php
/**
 * Created by Algoritech.
 * User: clayton.nunes
 * Date: 19/01/2017
 * Time: 23:59
 */
?>

<?php
//var_dump($_REQUEST ['atendimento']);
require_once('../controller/atendimentosController.php');
require_once('../controller/eventosController.php');
findAtendimento();
findEvento();

// Se não tiver evento cadastrado redireciona
if ($eventos == 0 ) :
 header('location: ../eventos/add.php?msg=semevento');
  $_SESSION['message'] = 'Banco de dados sem evento cadastrado!! Cadastre um evento.';
        $_SESSION['type'] = 'danger';
endif;

if($_REQUEST['salvaratendimento']):
salvarAtendimento();
endif;	

?>
<?php
require_once ('../config.php');
require_once ("../inc/visibilidade-header.php");
?>
    
    <h2>Atendimento</h2>

    <form id="formEmpresa" name="formEmpresa" action="../atendimentos/add.php?salvaratendimento=1" method="post">
        <!-- area de campos do form -->
        <hr />
         
    <div class="row">
            <div class="form-group col-md-4">
                <label for="exampleTextarea"></label>
    			<textarea class="form-control" id="exampleTextarea" rows="4" name="atendimento['comentario']" placeholder="Descreva o seu comentário..."></textarea>
            </div>
            
            <div class="form-group col-md-3">
                	<label class="control-label"> 
</label>
							<div class="input-group date">
							<input type="text" class="form-control" id="exemplo" name="proxima_data" placeholder="Proxima data...">

							<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
			</div>
            
            <input type="hidden" id="tipo_acesso" name="atendimento['id_empresa']" value="<?php echo $_REQUEST['id_empresa'];?>"  class="form-control" />
            
			<div class="form-group col-md-3">                
            	<select class="form-control" name="atendimento['id_evento']">
                <option value="" selected="selected">Selecione um Evento</option>
					<?php if ($eventos) : ?>
                    <?php foreach ($eventos as $evento) : ?>
                           
                     <option value="<?php echo $evento['id']; ?>"><?php echo $evento['nome_evento']; ?></option>
                    
                     <?php endforeach; ?>
                    <?php else : ?>
                    
                   <option value="">Nenhum Evento Cadastrado</option>
                    
                    <?php endif; ?>
                    
                   
                </select>
            </div>
    </div>
    <div class="row">
          	<div class="form-group col-md-4">
            	
                <fieldset class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="atendimento['posicao']" id="optionsRadios1" value="1" checked>
                        Em negociação
                      </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="atendimento['posicao']" id="optionsRadios2" value="2">
                        Expositor
                      </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="atendimento['posicao']" id="optionsRadios3" value="3">
                        Negativo
                      </label>
                    </div>

                  </fieldset>                
            </div>
    </div>
            <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                <a href="index.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
        
        </br>
        <h2>Histórico </h2>
        <hr />
        <div class="row">
            <dl class="dt-horizontal">                
                    <div class="form-group col-md-2">
                        <dt> vendedor </dt>                
                    </div>
                    <div class="form-group col-md-2">
                        <dt> Data </dt>              
                    </div>
                    <div class="form-group col-md-4">
                        <dt> Comentário  </dt>              
                    </div>                                
            </dl>    
        </div>
        
       
        <div class="row">
                <div class="form-group col-md-2">
                    Usuário 1                
                </div>
                <div class="form-group col-md-2">
                     Data  1              
                </div>
                <div class="form-group col-md-4">
                    Comentário  1               
                </div>                
        </div>
        
            </form>
            <script type="text/javascript">
			$('#exemplo').datepicker({	
				format: "dd/mm/yyyy",	
				language: "pt-BR",
				startDate: '+0d',
			});
		</script>

<?php include(FOOTER_TEMPLATE); ?>