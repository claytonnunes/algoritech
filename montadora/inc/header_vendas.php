<?php
//ini_set( 'display_errors', true );error_reporting( E_ALL );
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sistema Comercial</title>
    <meta name="description" content="">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo RAIZURL; ?>css/manuntencao.css">
    <link rel="stylesheet" href="<?php echo RAIZURL; ?>css/bootstrap.min.css">
    <!-- MetisMenu CSS -->l
    <link href="<?php echo RAIZURL; ?>css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo RAIZURL; ?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo RAIZURL; ?>css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo RAIZURL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- SCRIPT PARA MASCARA DE MOEDA R$ -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo RAIZURL; ?>js/jquery.maskMoney.js" type="text/javascript"></script>
	
	<!-- FIM DO SCRIPT PARA MASCARA DE MOEDA R$ -->
	
    <script type="text/javascript" src="<?php echo RAIZURL; ?>js/filtro.js"></script>
	
	<!-- desativado dia 27/01/2019
    	<script type="text/javascript" src="<?php //echo RAIZURL; ?>js/jquery-3.1.1.min.js"></script>
     -->
	
	<script type="text/javascript" src="<?php echo RAIZURL; ?>js/validacoes.js"></script>
    <script type="text/javascript" src="<?php echo RAIZURL; ?>js/mascaras.js" ></script>
	<script src="<?php echo RAIZURL; ?>js/bootstrap-datepicker.min.js"></script> 
	<script src="<?php echo RAIZURL; ?>js/bootstrap-datepicker.pt-BR.min.js"></script>
    
    		<script type="text/javascript" src="jquery-autocomplete/lib/jquery.bgiframe.min.js"></script>
        <script type="text/javascript" src="jquery-autocomplete/lib/jquery.ajaxQueue.js"></script>
        <script type="text/javascript" src="jquery-autocomplete/lib/thickbox-compressed.js"></script>
        <script type="text/javascript" src="jquery-autocomplete/jquery.autocomplete.js"></script>
        
        <!--css -->
     	<link rel="stylesheet" type="text/css" href="jquery-autocomplete/jquery.autocomplete.css"/>
     
    <style>
        body {
            padding-top: 50px;
                    padding-bottom: 20px;
                }
    </style>
    <link rel="stylesheet" href="<?php echo RAIZURL; ?>css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
          </button>    
          <a href="<?php echo BASEURL; ?>eventos/eventos.php" class="navbar-brand">Home</a> 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
         <?php 
		  	if (isset( $_SESSION['id_edicao'] ) or (isset( $_REQUEST['pg'] ) ) ) :
		   $page_home = 0;
		  ?>
          <ul class="nav navbar-nav">
             <?php if (0==1): ?>
              <li class="dropdown">
                  <a id="a-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      Relat&oacute;rios <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="<?php echo BASEURL; ?>relatorio/index.php">Visualizar no Monitor</a></li>
                      <li><a href="#">Gerar Relat&oacute;rio - Atendimento</a></li>                  </ul>
              </li>
              <?php endif; ?>
            </ul>
            <!-- CAMPO DE PESQUISA -->
            <?php 
            
            if (isset($_REQUEST['pg'])) {
                if ($_REQUEST['pg']=='funil') {
                    $campoPesquisa = "index.php?pg=funil&pesquisa=pesquisaNegocio";
                    $campoPlaceHolder = "pesquisar empresa";
                }
            }
            else {
                $campoPesquisa = "#../eventos/eventos.php?acao=pesquisaEvento";
                $campoPlaceHolder = "evento ou edi??o";
            }
            ?>
            <ul class="nav navbar-nav">
                <form class="form-inline" id="navbar-form" name="form1" method="post" action="<?php echo $campoPesquisa; ?>">
                    <label for="PesquisaNegocio"></label>
                    <input class="form-control form-control-sm mr-3 w-75" type="text" name="pesquisa_tudo" id="pesquisa_tudo" size="100" placeholder="<?php echo $campoPlaceHolder; ?>" value="<?php 
                    if(isset($_REQUEST['pesquisa'])):
                        if ($_REQUEST['pesquisa']=='pesquisaNegocio'):
                        echo $_REQUEST['pesquisa_tudo']; endif; endif;?>" aria-label="Pesquisar"/> 
                    <i class="fa fa-search" aria-hidden="true"></i>
                </form>
            </ul>

			   <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Capta??o</strong>
                                        <span class="pull-right text-muted">40%</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Negocia??o</strong>
                                        <span class="pull-right text-muted">20%</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Aprovado</strong>
                                        <span class="pull-right text-muted">60%</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Cancelado</strong>
                                        <span class="pull-right text-muted">80%</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo BASEURL; ?>usuarios/edit.php?id=<?php echo $_SESSION['id_usuario']; ?>"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li><a href="<?php echo BASEURL; ?>usuarios/index.php"><i class="fa fa-user fa-fw"></i> Usu?rios</a>
                        </li>
                        <li><a href="<?php echo BASEURL; ?>home/add.php"><i class="fa fa-user fa-fw"></i> Contas</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configura??o</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASEURL; ?>logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
          </ul>
        </div><!--/.navbar-collapse -->
        <?php else:
			$page_home = 1;
		endif;
	
	?>
    <?php if ($page_home == 1): ?>
     <div id="navbar" class="navbar-collapse collapse">
   			<ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo BASEURL; ?>usuarios/edit.php?id=<?php echo $_SESSION['id_usuario']; ?>"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configura??o</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASEURL; ?>logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
    </div>
    <?php endif; ?>
    </div>
    <!-- MENU -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>agenda/index.php?pg=agendas"><i class="fa fa-calendar"></i> Agendas</a>                
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>funil/index.php?pg=funil" ><i class="fa fa-filter"></i> Negócios</a> 
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>ganhos/index.php?pg=ganhos"><i class="fa fa-trophy"></i> Ganhos</a> 
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>eventos/index.php?pg=eventos"><i class="fa fa-bookmark"></i> Eventos</a> 
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>empresas/index.php?pg=contatos"><i class="fa fa-group"></i> Contatos</a> 
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>produto2/index.php?pg=produtos&acao=pesquisaProduto"><i class="fa fa-shopping-cart"></i> Produtos</a> 
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="<?php echo BASEURL; ?>log/index.php?pg=relatorios"><i class="fa fa-bar-chart-o"></i> relatórios</a> 
                </button>
                <button type="button" class="btn btn-link"> 
                    <a href="#<?php echo BASEURL; ?>funil/index.php?pg=funil"><i class="fa fa-gear"></i> Configurações</a> 
                </button>
            </div>
        </div>
    </div>
    </nav>
    <br />
    <br />
    <br />
    <main class="container">
    <?php  if (0==1) { ?> 
    <?php 
    echo $_SESSION['nome_usuario'];?> 
				<i class="fa fa-star"></i>
			  	<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>
    <?php   }?> 