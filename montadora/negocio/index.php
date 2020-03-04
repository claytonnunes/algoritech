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
	require_once('../controller/contatosController.php');
    require_once('../controller/eventosController.php');
    require_once('../controller/negocioController.php');
    require_once('../controller/produtoController.php');
    require_once('../controller/arquivoController.php');
    require_once('../controller/briefingController.php');
    require_once('../controller/agendaController.php');
    require_once('../controller/tarefaController.php');
    require_once('../controller/anotacaoController.php');

    if (!isset($_REQUEST['id_negocio']) OR ($_REQUEST['id_negocio']=="")) {
        $_SESSION['message'] = 'SELECIONE UM NEGOCIO PARA INICIAR.';
        $_SESSION['type'] = 'danger';
        $_SESSION['time_message'] = time();
        echo "<script>location.href=".BASEURL."'empresas/index.php?';</script>";
    }

    // SE O LOGIN FOR ADMIN 
    if ($_SESSION['tipo_acesso']==0) {
        if ($_REQUEST['id_negocio']=="indefinido") {
            pesquisaNegocio('id_usuario',  $_SESSION['id_usuario'], 'id_pai', $_SESSION['id_pai'], 'deleted', '0', 'ORDER BY id DESC LIMIT 1');
        }
        else {
             pesquisaNegocio('id',  $_REQUEST['id_negocio'], 'id_pai', $_SESSION['id_pai'], 'deleted', '0', 'ORDER BY id DESC');
        }
    }
    // SE O LOGIN N�O FOR ADMIN
    else {
        if ($_REQUEST['id_negocio']=="indefinido") {
            pesquisaNegocio('id_usuario',  $_SESSION['id_usuario'], 'id_pai', $_SESSION['id_pai'], 'deleted', '0', 'ORDER BY id DESC LIMIT 1');
        }
        else {
             pesquisaNegocio('id',  $_REQUEST['id_negocio'], 'id_usuario', $_SESSION['id_usuario'], 'deleted', '0', 'ORDER BY id DESC');
        }
    }

    if (!isset($negociacoes)) {
        echo "<script>location.href=".BASEURL."'empresas/index.php?';</script>";
    }
    else {
        if ($negociacoes) {
            foreach ($negociacoes as $negocio){
                $idNegocio = $negocio['id'];
                $nomeNegocio = $negocio['nome'];
                $idEmpresa = $negocio['id_empresa'];
                $idEdicao = $negocio['id_edicao'];
                $idUsuario = $negocio['id_usuario'];
                $idNegociador = $negocio['id_negociador'];
                
                $canalCaptacao = $negocio['canal_captacao'];
                
                $valorEstimado = $negocio['valor_estimado'];
                $valorEstimado = "R$ ".number_format($valorEstimado, 2, ',', '.');
                $potencialVendas = $negocio['potencial_vendas'];

                $estagio = $negocio['estagio'];
                        if ($estagio==1){
                            $textoCaptacao = "active";
                        }
                        else if ($estagio==2){
                            $textoOrcamento = "active";
                        }
                        else if ($estagio==3){
                            $textoContrato = "active";
                            
                        }
                        else{
                            $textoCaptacao = "";
                            $textoOrcamento = "";
                            $textoContrato = "";
                            $textoBriefing = "";
                        }

                $expectativaConclusao = $negocio['expectativa_conclusao'];
                $date_arr= explode(" ", $expectativaConclusao);
                $date= $date_arr[0];
                $explode = explode('-' ,$date);
                $expectativaConclusao = "".$explode[2]."-".$explode[1]."-".$explode[0];
                $time= $date_arr[1];

                $dataModificado = $negocio['modified'];
                $date_arr= explode(" ", $dataModificado);
                $date= $date_arr[0];
                $explode = explode('-' ,$date);
                $dataAtualizacaoNegocio = "".$explode[2]."-".$explode[1]."-".$explode[0];
                $time= $date_arr[1];
               
                $dataCriado = $negocio['created'];
                $date_arr= explode(" ", $dataCriado);
                $date= $date_arr[0];
                $explode = explode('-' ,$date);
                $dataInicioNegocio = "".$explode[2]."-".$explode[1]."-".$explode[0];
                $time= $date_arr[1];

                $dataAtual = date("Y-m-d");

                $diferenca = strtotime($dataAtual) - strtotime($dataCriado);
                $dias = floor($diferenca / (60 * 60 * 24));
                $duracao = $dias;

                $status = $negocio['status'];
                if ($status=='0') {
                    $statusTexto = 'andamento';
                }
                else if ($status=='1') {
                    $statusTexto = 'ganhou';
                }
                else if ($status=='2') {
                    $statusTexto = 'perdeu';
                }
                else{
                    $statusTexto = 'ERRO';
                }


                if ($potencialVendas=='1') {
                    $iconePotencialVendas = 'fa fa-thumbs-down';
                    $corPotencialVendas = 'danger';
                }
                else if ($potencialVendas=='2') {
                    $iconePotencialVendas = 'fa fa-hand-o-right';
                    $corPotencialVendas = 'warning';
                }
                else if ($potencialVendas=='3') {
                    $iconePotencialVendas = 'fa fa-thumbs-up';
                    $corPotencialVendas = 'success';
                }
                else {
                    $iconePotencialVendas = 'fa fa-meh-o';
                    $corPotencialVendas = 'primary';
                }
                
            }
        }
    }
    pesquisaNegocio('id_empresa',  $idEmpresa, 'id_edicao', $idEdicao, 'deleted', '0', 'ORDER BY id DESC');

    pesquisaAgendaUsuario('id_pai', $_SESSION['id_pai'], 'id_negocio', $idNegocio, 'deleted', '0', 'ORDER BY id_agenda DESC');
    
    visualizarEmpresa($idEmpresa);
    
    if (isset($_REQUEST['acao'])) {
        if ($_REQUEST['acao']=='salvarContato') {
            salvarContatoTwo();
        }
        elseif ($_REQUEST['acao']=='ganharNegocio'){
            ganharNegocio();
        }
        elseif ($_REQUEST['acao']=='perderNegocio'){
            perderNegocio();
        }
        elseif ($_REQUEST['acao']=='salvarNegocio'){
            salvarNegocioProduto();
        }
        elseif ($_REQUEST['acao']=='salvarTarefa'){
            salvarTarefa();
        }
        elseif ($_REQUEST['acao']=='salvarAnotacao'){
            salvarAnotacao();
        }
        elseif ($_REQUEST['acao']=='editarContato') {
            editarContato();
        }
    }

    if(isset($_REQUEST['salvaratendimento'])):
		if($_REQUEST['comentario']==""){		
			$mensagem = "Escreva um comentário";		
		}
		else if($_REQUEST['proxima_data']==""){
			$mensagem = "Selecione a proxima data";
		}	

		else if($idEdicao==""){
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
    
    pesquisaEdicaoId($idEdicao);
	if ($eventos) :
		foreach ($eventos as $evento):
			$nome_edicao = $evento['nome_edicao'];
		endforeach;
	else:
        echo "<script>location.href=".BASEURL."'empresas/index.php?';</script>";
		$_SESSION['message'] = 'Banco de dados sem evento cadastrado!! Cadastre um evento.';
		$_SESSION['type'] = 'danger';
	endif;
    
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
	    <div class="col-md-9">
            <h5><?php echo "NEGÓCIO SELECIONADO: ".$nomeNegocio; ?></h5>
        </div>
        <div class="dropdown col-md-2">
        <button class="btn btn-<?php echo $corPotencialVendas; ?> dropdown-toggle" type="button" data-toggle="dropdown"><i class="<?php echo $iconePotencialVendas; ?>"></i> Potencial vendas
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">baixo</a></li>
                <li><a href="#">médio</a></li>
                <li><a href="#">alto</a></li>
            </ul>
        </div>
        <div class="dropdown col-md-1">
            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Ação
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="index.php?acao=ganharNegocio&id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_negocio=<?php echo $_REQUEST['id_negocio']; ?>">Ganhar</a></li>
                <li><a href="index.php?acao=perderNegocio&id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_negocio=<?php echo $_REQUEST['id_negocio']; ?>">Perder</a></li>
                <hr>
                <li><a href="#">Excluir</a></li>
            </ul>
        </div>
    </div>

    <!-- PAIN�L NEG�CIOS -->
    <div class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-phone fa-fw"></i> NEGÓCIO
                <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalNovoNegocio" 
							data-send-id="<?php echo $idEmpresa; ?>"> <i class="fa fa-plus"></i> Novo negócio</button>
            </div>
            <div class="panel-footer">
            <?php	
				if ($negociacoes) : 
                    foreach ($negociacoes as $negocio):
                        $status = $negocio['status'];
                        if ($status == '1') {
                            $iconeNegocio = "<i class='fa fa-trophy'></i>";
                        }
                        else if ($status == '2') {
                            $iconeNegocio = "<i class='glyphicon glyphicon-thumbs-down'></i>";
                        }
                        else {
                            $iconeNegocio = "";
                        }
				?>
                <a href="../negocio/index.php?id_edicao=<?php  echo $_REQUEST['id_edicao']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_negocio=<?php echo $negocio['id']; ?>" class="list-group-item <?php if ($idNegocio==$negocio['id']) { echo "active"; }?>" >
                 <?php echo $iconeNegocio." ".$negocio['nome'];?>
                </a>
                <?php
					endforeach; endif; 
					?>
            </div>
        </div>

        <!-- PAIN�L EVENTO -->
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

        <!-- PAIN�L EMPRESA -->
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

        <!-- PAIN�L CONTATO -->
        <div class="panel panel-warning">
            <div class="panel-heading">
            <i class="glyphicon glyphicon-user"></i> CONTATO
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCart"><i class="fa fa-plus"></i></button>
            </div>
            <div class="panel-footer">
                <?php  
                pesquisaContato($idEmpresa); 
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

    <!-- PAIN�L DADOS DA NEGOCIA��O -->
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="col-lg-3">
                                <a href="#" class="list-group-item <?php echo $textoCaptacao; ?>">
                                <i class="fa fa-phone fa-fw"></i> Contato 
                                <p><i class="fa fa-calendar"></i> 0 dias </p>  
                                </a>
                                </div>
                            <div class=" col-lg-3">
                                <a href="#" class="list-group-item <?php echo $textoBriefing; ?>">
                                <i class="fa fa-file fa-fw"></i> Projeto 
                                <p><i class="fa fa-calendar"></i> 0 dias </p>  
                                </a>
                            </div>
                            <div class=" col-lg-3">
                                <a href="#" class="list-group-item <?php echo $textoOrcamento; ?>">
                                <i class="fa fa-bell fa-fw"></i> Proposta 
                                <p><i class="fa fa-calendar"></i> 0 dias </p> 
                                </a>
                            </div>
                            <div class=" col-lg-3">
                                <a href="#" class="list-group-item <?php echo $textoContrato; ?>">
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
                                <div class="col-md-2">
                                    Valor 
                                    <p><h5><?php echo $valorEstimado; ?> </h5></p>
                                </div>
                                <div class="col-md-2">
                                    Expectativa
                                    <p><?php echo $expectativaConclusao; ?></p>
                                </div>
                                <div class="col-md-2">
                                    Duração
                                    <p><?php echo $duracao." dias"; ?></p>
                                </div>
                                <div class="col-md-2">
                                    Início
                                    <p><?php echo $dataInicioNegocio; ?></p>
                                </div>
                                <div class="col-md-2">
                                    Atualização
                                    <p><?php echo $dataAtualizacaoNegocio; ?></p>
                                </div>
                                <div class="col-md-2">
                                    Status
                                    <p><?php echo $statusTexto; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAIN�L CARACTERISTICAS DA NEGOCIA��O -->
    
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

        <!-- PAIN�L SUBMENU -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Histórico</a>
                        </li>
                        <li><a href="#briefing" data-toggle="tab">Briefing</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Cotação</a>
                        </li>
                        <li><a href="#contrato" data-toggle="tab">Contrato</a>
                        </li>
                        <?php  if ($_SESSION['tipo_acesso']==0) { ?>  
                        <li><a href="#budjet" data-toggle="tab">Budjet</a>
                        </li>
                        <?php  } ?>  
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <p></p>
                            <div id="divConteudo2">
                            <div class="col-lg-12" align="right">
                            <a href="#agenda" class="btn btn-sm btn-success" data-toggle="tab"><i class="fa fa-plus fa-1x"></i> Tarefa</a>
                            <a href="#anotacao" class="btn btn-sm btn-info" data-toggle="tab"><i class="fa fa-plus fa-1x"></i> Anotação</a>
                            </div>     
                            <div class="col-lg-12">
                                    <div class="col-lg-3">Data tarefa</div>
                                    <div class="col-lg-7">Anotação</div>
                                    <div class="col-lg-2">Status</div>
                                        <?php 
                                        if ($agendas) : 
                                            foreach ($agendas as $agenda) :
                                            $data_comentario = $agenda['created'];
                                            $date_arr= explode(" ", $data_comentario);
                                            $date= $date_arr[0];
                                            $explode = explode('-' ,$date);
                                            $data_comentario = "".$explode[2]."-".$explode[1]."-".$explode[0];
                                            $time= $date_arr[1];

                                            $situacao = $agenda['tarefa'];
                                               if ($situacao==1){
                                                    $situacao = "<i class='fa fa-phone fa-fw'></i>"; //fone
                                                }
                                                else if ($situacao==2){
                                                    $situacao = "<i class='fa fa-envelope fa-fw'></i>"; // email
                                                }
                                                else if ($situacao==3){
                                                    $situacao = "<i class='fa fa-beer fa-fw'></i>"; // reuni�o
                                                }
                                                else if ($situacao==9){
                                                    $situacao = "<i class='fa fa-edit fa-fw'></i>"; // anota��o
                                                }
                                                else{
                                                    $situacao = "Indefinido"; 
                                                }


                                                $proximo_data = $agenda['proxima_data'];
                                                $date_arr= explode(" ", $proximo_data);
                                                $date= $date_arr[0];

                                                $explode = explode('-' ,$date);
                                                $proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
                                                $time= $date_arr[1];

                                                if ($proximo_data=='00-00-0000') {
                                                    $proximo_data = "";
                                                }
                                                else {
                                                    $proximo_data = $proximo_data;
                                                
                                                }
                                        ?>                    
                                        <div class="row list-group-item col-lg-12">
                                            <div class="col-lg-3">
                                                <?php echo $proximo_data; ?>
                                            </div>
                                            <div class="col-lg-7">
                                                <?php echo $agenda['comentario']; ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <?php  echo $situacao; ?>
                                            </div>
                                        </div>
                                        <?php endforeach;  else :  endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- MENU AGENDA -->
                        <div class="tab-pane fade" id="agenda">
                            <form id="formEmpresa" name="formEmpresa" action="index.php?acao=salvarTarefa&id_empresa=<?php echo $_REQUEST['id_empresa'];?>&id_negocio=<?php echo $_REQUEST['id_negocio'];?>&id_edicao=<?php echo $_REQUEST['id_edicao'];?>" method="post">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" id="exampleTextarea" name="tarefa['comentario']" placeholder="Descreva o seu coment�rio..." required ></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group date">
                                        <input type="text" id="campoDATE1" class="form-control" name="data_tarefa" placeholder="00/00/0000" required >
                                    </div>
                                </div> 
                                <div class="form-group col-md-6">
                                    <select name="tarefa['tarefa']" class="form-control"  value="" required>  
                                    <option value="" selected>Selecione a tarefa</option>
                                    <option value="1">Ligar</option>
                                    <option value="2">Enviar e-mail</option>
                                    <option value="3">Reunião</option>
                                    </select>  
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" id="salvar">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>  
                        
                        <!-- MENU ANOTA��O -->
                        <div class="tab-pane fade" id="anotacao">
                            <form id="formEmpresa" name="formEmpresa" action="index.php?acao=salvarAnotacao&id_empresa=<?php echo $_REQUEST['id_empresa'];?>&id_negocio=<?php echo $_REQUEST['id_negocio'];?>&id_edicao=<?php echo $_REQUEST['id_edicao'];?>" method="post">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" id="exampleTextarea" name="tarefa['comentario']" placeholder="Descreva o seu coment�rio..." required ></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" id="salvar">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>                                  


                        <div class="tab-pane fade" id="briefing">
                            <?php include("../briefing/index3.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <?php include("../cotacao/index3.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="contrato">
                            <a class="btn btn-primary" href="<?php echo BASEURL; ?>contrato/index.php?acao=novoContrato&filtro=nomeCliente&pg=cliente&id_edicao=<?php  echo $idEdicao; ?>&id_empresa=<?php  echo $idEmpresa; ?>&id_negocio=<?php echo $idNegocio; ?>&PesquisaCliente=<?php echo $empresa['nome_fantasia']; ?>"><i class="fa fa-plus"></i> Novo Contrato</a>
                        </div>
                        <div class="tab-pane fade" id="budjet">
                            <?php include("../budjet/index.php"); ?>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>  



<!-- Modal: CADASTRO NOVO CONTATO -->
<form id="formContato" name="formContato" action="index.php?acao=salvarContato&id_edicao=<?php  echo $idEdicao; ?>&id_empresa=<?php  echo $idEmpresa; ?>&id_negocio=<?php echo $idNegocio; ?>" method="post">
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Novo Contato
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">À</span>
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
                <input type="hidden" id="id_company" name="id_company" value="<?php echo $idEmpresa; ?>"  class="form-control" />
                <input type="hidden" id="id_negocio" name="id_negocio" value="<?php echo $idNegocio; ?>"  class="form-control" />
                
                
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

<!-- SCRIPT PARA MODAL NOVO NEG�CIO -->
<?php include('../modal/modalNovoNegocio.php'); ?>
<script type="text/javascript">
		$('#modalNovoNegocio').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var id = button.data('send-id') 
			var modal = $(this)
			modal.find('.modal-title').text('Codigo do cliente: ' + id)
			modal.find('#get-id').val(id)
		})
</script>

<!-- SCRIPT PARA MODAL NOVO NEG�CIO -->
<?php include('../modal/modalNovoCusto.php'); ?>
<script type="text/javascript">
		$('#modalNovoCusto').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var id = button.data('send-id') 
			var modal = $(this)
			modal.find('.modal-title').text('Codigo do negócio: ' + id)
			modal.find('#get-id').val(id)
		})
</script>

<!-- SCRIPT PARA MODAL NOVO CONTRATO -->
<?php include('../modal/modalNovoContrato.php'); ?>
<script type="text/javascript">
		$('#modalNovoContrato').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var id = button.data('send-id') 
			var modal = $(this)
			modal.find('.modal-title').text('Contrato: ' + id)
			modal.find('#get-id').val(id)
		})
</script>

<script>
        jQuery(function($){  
		    $("#campoDATE1").mask("99/99/9999");
			$("#campoDATE2").mask("99/99/9999");
			$("#campoDATE3").mask("99/99/9999");
			$("#campoDATE4").mask("99/99/9999");
			$("#campoDATE5").mask("99/99/9999");
			$("#campoDATE6").mask("99/99/9999");
			$("#campoFONE").mask("(99) 9999-9999");
			$("#campoFONE2").mask("(99) 9999-9999");
			$("#campoFONE3").mask("(99) 9999-9999");
            $("#campoCEL").mask("(99) 9 9999-9999");
		    $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");

        });
    </script>
	<script type="text/javascript">+$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
    
	<script type="text/javascript">
		$('#exemplo').datepicker({	
			format: "dd/mm/yyyy",	
			language: "pt-BR",
			startDate: '+0d',
		});
	</script>
<?php include(FOOTER_TEMPLATE); ?>