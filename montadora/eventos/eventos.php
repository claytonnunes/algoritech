<?php
session_start();
?>
<?php
unset( $_SESSION['id_edicao'] );
unset( $_SESSION['id_evento'] );
unset( $_SESSION['nome_edicao'] );

require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
// PESQUISA SE TEM CONTA CcADASTRADA 
require_once('../controller/contasController.php');
require_once('../controller/notificacaoController.php');
pesquisaNotificacao('id_pai', $_SESSION['id_pai'], 'usuario_notificado', $_SESSION['id_usuario'], 'status', '1');
findConta();

// SE N�O RETORNAR CONTA, DIRECIONA PARA PAGINA DE CADASTRO DE CONTA
if ($contas == false) :
		header("location: ../home/index.php");

// SE TIVER CONTA CADASTRADA SEGUE O CODIGO	
else : 

require_once('../controller/eventosController.php');

// SE USUARIO FOR ADMINISTRADOR FAZ A PESQUISA ABAIXO
if($_SESSION['tipo_acesso']==0):
	pesquisaEdicao();
	$tipo_usuario = 'administrador'; 
// SE USUARIO FOR SIMPLES FAZ A PESQUISA ABAIXO
else:
	pesquisaEdicaoCadastrado();
	$tipo_usuario = 'simples'; 
endif;

// SE USUARIO FOR SIMPLES E TIVER EVENTO AUTORIZADO PRA ELE IMPRIME NA TELA

		// SE TIVER EVENTO CADASTRADO, IMPRIME NA TELA
	if ($eventos) : 
	 ?>
   <!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->		
	<?php 
		if ($notificacoes) :
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
    		<?php echo "TEM PROJETO NOVO NO SISTEMA "; ?><a href="../notificacao/index.php">acessar
		</div>
	<?php endif; ?>
	<hr>
	<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->
    <div class="row">
    
                <?php 
		
			foreach ($eventos as $evento) :
		if($tipo_usuario=='administrador'):
			$id_edicao = $evento["id"];
		elseif($tipo_usuario=='simples'):
			$id_edicao = $evento["id_edicao"];
		endif;
		?>
                    
        
        <div class="col-xs-6 col-sm-3 col-md-3">
            <a href="#../valida.php?acao=seleciona_evento&id_edicao=<?php echo $id_edicao; ?>&id_evento=<?php echo $evento["id_evento"]; ?>&nome_edicao=<?php echo $evento["nome_edicao"]; ?>" class="btn btn-default">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p><?php 
							echo $evento['nome_edicao']."<br>";
							echo $evento['local']."<br>";
							
							$inicio_evento = $evento['inicio_evento'];
							$date_arr= explode(" ", $inicio_evento);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$inicio_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date_arr[1];
							
							$fim_evento = $evento['fim_evento'];
							$date_arr= explode(" ", $fim_evento);
							$date= $date_arr[0];						
							$explode = explode('-' ,$date);
							$fim_evento = "".$explode[2]."/".$explode[1]."/".$explode[0];
							$time= $date[1];						
							echo $inicio_evento." À ".$fim_evento; 
						
							$data1 = date("Y-m-d");
							$data2 = $evento["inicio_evento"];
							
							$diferenca = strtotime($data2) - strtotime($data1);
							
							$dias = floor($diferenca / (60 * 60 * 24));
							
							if ($dias>0):
								echo "<br> <font color='red'> FALTAM: ".$dias." DIAS </font>";
							else:
								echo "<br> <font color='red'> INAUGUROU À ".$dias." DIAS </font>";
							endif;
							
							
						?></p>
                    </div>
                </div>
            </a>
        </div>
        
         <?php endforeach;
		
	// SE N�O TIVER EVENTO CADASTRADO, MOSTRA LINK DE CADASTRO
		else : ?>
       <hr />

             <h2>Cadastre o primeiro evento para iniciar</h2>
             <div class="col-sm-6 text-right h2">
            	<a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php?acao=novo_evento"><i class="fa fa-plus"></i> Novo Evento</a>
                </div>
        </div>
                </tr>
      <?php endif; 

?>
        
    </div>
<?php 
endif; 
?>
<?php include(FOOTER_TEMPLATE); ?>