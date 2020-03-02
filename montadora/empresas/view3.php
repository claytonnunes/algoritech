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
	require_once('../controller/atendimentosController.php');
	require_once('../controller/contatosController.php');
    require_once('../controller/eventosController.php');
    require_once('../controller/negocioController.php');
    require_once('../controller/produtoController.php');
    require_once('../controller/arquivoController.php');
    require_once('../controller/briefingController.php');
    findAtendimentoId();
    visualizarEmpresa($_GET['id_empresa']);
    
    if (isset($_REQUEST['acao'])) {
        if ($_REQUEST['acao']=='salvarContato') {
            salvarContatoTwo();
        }
        elseif ($_REQUEST['acao']=='ganharNegocio'){
            ganharNegocio();
        }
        elseif ($_REQUEST['acao']=='salvarNegocio'){
            salvarNegocioProduto();
        }
        elseif ($_REQUEST['acao']=='editarContato') {
            editarContato();
        }
    }

    /* CODIGO SUBSTITUIDO PELO DE BAIXO 27/3/2019
    echo "----->".$_SESSION['id_edicao'];
	if($_SESSION['id_edicao']==null):
			$id_edicao = $_REQUEST['id_edicao'];
			$_SESSION["id_edicao"] = $id_edicao;
		else:
			$id_edicao = $_SESSION['id_edicao'];
    endif;
    echo "<br>----->".$_SESSION['id_edicao'];
    */
    $id_edicao = $_REQUEST['id_edicao'];
    pesquisaEdicaoId($id_edicao);
	// Se não tiver evento cadastrado redireciona
	if ($eventos) :
		foreach ($eventos as $evento):
			$id_edicao = $evento['id'];
			$nome_edicao = $evento['nome_edicao'];
		endforeach;
	else:
		header('location: ../eventos/add.php?msg=semevento');
		$_SESSION['message'] = 'Banco de dados sem evento cadastrado!! Cadastre um evento.';
		$_SESSION['type'] = 'danger';
	endif;

	if(isset($_REQUEST['salvaratendimento'])):
		if($_REQUEST['comentario']==""){		
			$mensagem = "Escreva um comentário";		
		}
		else if($_REQUEST['proxima_data']==""){
			$mensagem = "Selecione a proxima data";
		}	

		else if($_REQUEST['id_edicao']==""){
			$mensagem = "Selecione o Evento";
		}
		else{
			$mensagem = "Comentário registrada com sucesso";
			salvarAtendimento();
		}
	endif;	
    
    pesquisaGrupoProduto($_REQUEST['id_atendimento']);
    if(isset($_REQUEST['acao'])):
        if ($_REQUEST['acao']=='salvarGrupo'):
            salvarGrupoProduto();
        endif;
    endif;
    if (!isset($_REQUEST['id_negocio'])) {
        $_SESSION['message'] = 'SELECIONE UM NEGOCIO PARA INICIAR.';
        $_SESSION['type'] = 'danger';
        $_SESSION['time_message'] = time();
    }
    unset($_SESSION['numero_cotacao']);
    unset($_SESSION['metro_quadrado']);
    ?>
	<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
	<?php 
		if((time() - $_SESSION['time_message'])>1): unset($_SESSION['message']); endif; 
		if (!empty($_SESSION['message'])) : ?>
    	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
    		<?php echo $_SESSION['message']; ?>
		</div>
	<?php endif; ?>
    <hr>

    <!-- TITULO -->
    <div class="col-md-12">
	    <div class="col-md-10">
            <h5><?php echo "NEGÓCIO SELECIONADO CODIGO: ".$_REQUEST['id_negocio']; ?></h5>
        </div>
        <div class="dropdown col-md-1">
        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="glyphicon glyphicon-thumbs-up"></i>
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Quente</a></li>
                <li><a href="#">Morno</a></li>
                <li><a href="#">Frio</a></li>
            </ul>
        </div>
        <div class="dropdown col-md-1">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ação
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="index.php?acao=ganharNegocio&id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_negocio=<?php echo $_REQUEST['id_negocio']; ?>">Ganhar</a></li>
                <li><a href="#">Perder</a></li>
                <hr>
                <li><a href="#">Excluir</a></li>
            </ul>
        </div>
    </div>

    <!-- PAINÉL NEGÓCIOS -->
    <div class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-phone fa-fw"></i> NEGÓCIO
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNegocio"><i class="fa fa-plus"></i></button>
            </div>
            <div class="panel-footer">
            <?php	
				if ($grupo_produtos) : 
                    foreach ($grupo_produtos as $grupo_produto):
                        $status = $grupo_produto['status'];
                        if ($status == '1') {
                            $iconeNegocio = "<i class='fa fa-trophy'></i>";
                        }
                        else {
                            $iconeNegocio = "";
                        }
				?>
                <a href="../negocio/index.php?id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_negocio=<?php echo $grupo_produto['id']; ?>" class="list-group-item <?php if ($_REQUEST['id_negocio']==$grupo_produto['id']) { echo "active"; }?>" >
                 <?php echo $iconeNegocio." ".$grupo_produto['nome'];?>
                </a>
                <?php
					endforeach; endif; 
					?>
            </div>
        </div>

        <!-- PAINÉL EVENTO -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-bookmark fa-fw"></i> EVENTO
            </div>
            <div class="panel-footer">
                <a href="#" class="list-group-item">
                <?php echo $nome_edicao; ?>
                </a>
            </div>
        </div>

        <!-- PAINÉL EMPRESA -->
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-building"></i> EMPRESA 
            </div>
            <div class="panel-footer">
                <a href="#" class="list-group-item"><i class="fa fa-building"></i>
                <?php echo $empresa['nome_fantasia']; ?>
                </a>
            </div>
        </div>

        <!-- PAINÉL CONTATO -->
        <div class="panel panel-warning">
            <div class="panel-heading">
            <i class="glyphicon glyphicon-user"></i> CONTATO
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCart"><i class="fa fa-plus"></i></button>
            </div>
            <div class="panel-footer">
                <?php  
                findContato(); 
                if ($contatos):  
                    foreach ($contatos as $contato): 
                    $fone = substr($contato['fone2'], 0, 2) . "-" . substr($contato['fone2'], 2, 4). "." . substr($contato['fone2'], -4);
                    $celular = substr($contato['celular'], 0, 2) . "-" . substr($contato['celular'], 2, 5). "." . substr($contato['celular'], -4);
                ?> 
                <a href="../contatos/edit.php?id=<?php echo $contato['id']; ?>&id_company=<?php echo $empresa['id']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>" class="list-group-item"><i class="glyphicon glyphicon-user"></i>
                <?php echo $contato['nome']; ?>
                <P><i class="fa fa-phone"></i> <?php echo $fone; ?></P>
                <P><i class="glyphicon glyphicon-phone"></i> <?php echo $celular; ?></P>
                <p><i class="fa fa-envelope"></i> <?php echo $contato['email']; ?></p>
                </a>
                <?php endforeach; endif; ?> 
            </div>
        </div>
    </div> 

    <!-- PAINÉL DADOS DA NEGOCIAÇÃO -->
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="col-lg-3">
                                <a href="#" class="list-group-item active">
                                <i class="fa fa-phone fa-fw"></i> Contato 
                                <p><i class="fa fa-calendar"></i> 0 dias </p>  
                                </a>
                                </div>
                            <div class=" col-lg-3">
                                <a href="#" class="list-group-item">
                                <i class="fa fa-file fa-fw"></i> Projeto 
                                <p><i class="fa fa-calendar"></i> 0 dias </p>  
                                </a>
                            </div>
                            <div class=" col-lg-3">
                                <a href="#" class="list-group-item">
                                <i class="fa fa-bell fa-fw"></i> Proposta 
                                <p><i class="fa fa-calendar"></i> 0 dias </p> 
                                </a>
                            </div>
                            <div class=" col-lg-3">
                                <a href="#" class="list-group-item">
                                <i class="fa fa-trophy fa-fw"></i> Negociação 
                                <p><i class="fa fa-calendar"></i> 0 dias </p> 
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <hr> 
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-3">
                                    Valor 
                                    <p><h4>R$ 0,00</h4></p>
                                </div>
                                <div class="col-md-2">
                                    Expectativa
                                    <p>00/00/0000</p>
                                </div>
                                <div class="col-md-2">
                                    Duração
                                    <p>0 dias</p>
                                </div>
                                <div class="col-md-2">
                                    Início
                                    <p>00/00/0000</p>
                                </div>
                                <div class="col-md-2">
                                    Atualização
                                    <p>00/00/0000</p>
                                </div>
                                <div class="col-md-1">
                                    Status
                                    <p>Aberto</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAINÉL CARACTERISTICAS DA NEGOCIAÇÃO -->
    
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-3">
                                    Projetista 
                                    <p><h4></h4></p>
                                </div>
                                <div class="col-md-3">
                                    Modelo
                                    <p></p>
                                </div>
                                <div class="col-md-3">
                                    Nivel do projeto
                                    <p></p>
                                </div>
                                <div class="col-md-3">
                                    Medida
                                    <p></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    Localização
                                    <p></p>
                                </div>
                                <div class="col-md-3">
                                    Posição
                                    <p><img src="../imagem/posicao01.png" alt="..." class="img-thumbnail"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAINÉL SUBMENU -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Agenda</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Briefing</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Cotação</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Contrato</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <p></p>
                            <div id="divConteudo2">
                            <div class="col-lg-12" align="right">
                            <a href="#agenda" class="btn btn-sm btn-success" data-toggle="tab"><i class="fa fa-plus fa-1x"></i> Tarefa</a>
                            </div>     
                            <div class="col-lg-12">
                                    <div class="col-lg-3">Data tarefa</div>
                                    <div class="col-lg-7">Anotação</div>
                                    <div class="col-lg-2">Status</div>
                                        <?php 
                                        if ($atendimentos) : 
                                            foreach ($atendimentos as $atendimento) :
                                            $data_comentario = $atendimento['created'];
                                            $date_arr= explode(" ", $data_comentario);
                                            $date= $date_arr[0];
                                            $explode = explode('-' ,$date);
                                            $data_comentario = "".$explode[2]."-".$explode[1]."-".$explode[0];
                                            $time= $date_arr[1];

                                            $situacao = $atendimento['posicao_agenda'];
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


                                                $proximo_data = $atendimento['proxima_data'];
                                                $date_arr= explode(" ", $proximo_data);
                                                $date= $date_arr[0];

                                                $explode = explode('-' ,$date);
                                                $proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
                                                $time= $date_arr[1];
                                        ?>                    
                                        <div class="row list-group-item col-lg-12">
                                            <div class="col-lg-3">
                                                <?php echo $proximo_data; ?>
                                            </div>
                                            <div class="col-lg-7">
                                                <?php echo $atendimento['comentario']; ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <?php  echo $situacao; ?>
                                            </div>
                                        </div>
                                        <?php endforeach;  else :  endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="agenda">
                            <form id="formEmpresa" name="formEmpresa" action="../empresas/view2.php?salvaratendimento=1&pagina=agenda&id_empresa=<?php echo $_REQUEST['id_empresa'];?>&id_atendimento=<?php echo $_REQUEST['id_atendimento'];?>&id_edicao=<?php echo $id_edicao;?>" method="post">
                                <div class="form-group col-md-6">
                                    <label for="exampleTextarea">Tarefa</label>
                                    <textarea class="form-control" id="exampleTextarea" rows="2" name="comentario" placeholder="Descreva o seu comentário..." required ></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label"></label>
                                    <div class="input-group date">
                                    <label for="name">Próxima tarefa</label>
                                    <input type="text" id="campoDATE1" class="form-control" name="proxima_data" placeholder="00/00/0000" required >
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" id="salvar">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>                                  


                        <div class="tab-pane fade" id="profile">
                            <?php include("../briefing/index3.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <?php include("../cotacao/index3.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <h4>Contrato</h4>
                            <p>Contrato</p>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>  



<!-- Modal: CADASTRO NOVO CONTATO -->
<form id="formContato" name="formContato" action="index.php?acao=salvarContato&id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_empresa=<?php  echo $_REQUEST['id_empresa']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>" method="post">
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Novo Contato
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </h4>
      </div>
      <!--Body-->
      <div class="modal-body">
        <!-- area de campos do form -->
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="contato['nome']">
            </div>
          <div class="form-group col-md-6">
                <label for="name">Fun&ccedil;&atilde;o</label>
                 <input type="text" class="form-control" name="contato['funcao']">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Email</label>
                 <input type="text" class="form-control" name="contato['email']">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Instagram</label>
                 <input type="text" class="form-control" name="contato['instagram']">
            </div>
              <div class="form-group col-md-6">
                <label for="name">Telefone 1</label>
                <input type="tel" id="campoFONE" class="form-control" name="telefone1" placeholder="(00)00000-0000">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Telefone 2</label>
                <input type="text" id="campoCEL" class="form-control" name="telefone2" placeholder="(00)00000-0000">
                
                <input type="hidden" id="id_empresa" name="contato['id_empresa']" value="<?php echo $_REQUEST['id_empresa']; ?>"  class="form-control" />
                <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id']; ?>"  class="form-control" />
                <input type="hidden" id="id_company" name="id_company" value="<?php echo $_REQUEST['id_company']; ?>"  class="form-control" />
                <input type="hidden" id="id_atendimento" name="id_atendimento" value="<?php echo $_REQUEST['id_atendimento']; ?>"  class="form-control" />
                
                
                  <input type="hidden" id="tipo_conta" name="usuario['tipo_conta']" value="0"  class="form-control" />
                  <input type="hidden" id="status" name="usuario['id_atendimento']" value="0"  class="form-control" />
                    <br>
            </div>
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
        <button class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- Modal: CADASTRO NOVO NEGÓCIO -->
<form id="formNegocio" name="formNegocio" action="index.php?acao=salvarNegocio&id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_empresa=<?php  echo $_REQUEST['id_empresa']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>" method="post">
<div class="modal fade" id="modalNegocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Novo negócio
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <!-- area de campos do form -->
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome do negócio</label>
                        <input type="text" class="form-control" name="negocio['nome']" placeholder="Ex: STAND, QUIOSQUE, CENOGRAFIA, PDV..." required >
                    </div>
                </div> 
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
        jQuery(function($){  
		    $("#campoFONE").mask("(99) 9999-9999");
			$("#campoFONE2").mask("(99) 9999-9999");
            $("#campoCEL").mask("(99) 9 9999-9999");
		    $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
            $("#campoDATE1").mask("99/99/9999");

        });
    </script>

	
	<script type="text/javascript">
		$('#exemplo').datepicker({	
			format: "dd/mm/yyyy",	
			language: "pt-BR",
			startDate: '+0d',
		});
	</script>
<?php include(FOOTER_TEMPLATE); ?>