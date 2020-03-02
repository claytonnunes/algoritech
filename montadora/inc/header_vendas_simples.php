<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sistema Comercial</title>
    <meta name="description" content="">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo RAIZURL; ?>css/manuntencao.css">
    <link rel="stylesheet" href="<?php echo RAIZURL; ?>css/bootstrap.min.css">

    <script type="text/javascript" src="<?php echo RAIZURL; ?>js/filtro.js"></script>
    <script type="text/javascript" src="<?php echo RAIZURL; ?>js/jquery-3.1.1.min.js"></script>
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
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo BASEURL; ?>eventos/eventos.php" class="navbar-brand">Home</a>   
        </div>
         
        <div id="navbar" class="navbar-collapse collapse">
        <?php 
		  
		  	if ( isset( $_SESSION['id_edicao'] ) ) :
		   	$page_home = 0;
		  ?>
          <ul class="nav navbar-nav">
            <li class="dropdown">
                <a id="a-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Visualizar <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>atendimentos/index.php">Agenda</a></li>
                    <li><a href="<?php echo BASEURL; ?>empresas/index.php">Contatos</a></li>
                    </ul>
            </li>
            <li class="dropdown">
                <a id="a-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Cadastrar <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>empresas/add.php">+ Novo Cliente</a></li>
                    </ul>                
            </li>
            <li class="dropdown">
                  <a id="a-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      Perfil 
 <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="#<?php echo BASEURL; ?>usuarios/edit.php?id=<?php echo $_SESSION['id_usuario']; ?>">Alterar dados</a></li>
                       <?php if (0==1): ?>
                      <li><a href="#">Visualizar Configura&ccedil;&otilde;es</a></li>
                       <?php endif; ?>
                  </ul>
              </li>
                <a id="links" href="<?php echo BASEURL; ?>logout.php" class="navbar-brand" style="background-color: red">
                   <div class="col-xs-12 text-center">
                       <i class="fa fa-sign-out" aria-hidden="true"></i>
                   </div>
               </a>
          </ul>
        </div><!--/.navbar-collapse -->
        
		<?php else:
			$page_home = 1;
		endif;
		
	
	?>
    <?php if ($page_home == 1): ?>
    
     <a id="links" href="<?php echo BASEURL; ?>logout.php" class="navbar-brand" style="background-color: red">
                   <div class="col-xs-12 text-center">
                       <i class="fa fa-sign-out" aria-hidden="true"></i>
                   </div>
               </a>
     <?php endif; ?>
          </ul>
      </div>
    </nav>

    <main class="container">    
    <?php
	$hr = date(" H ");
	if($hr >= 12 && $hr<18) {
	$resp = "Boa tarde ";}
	else if ($hr >= 0 && $hr <12 ){
	$resp = "Bom dia ";}
	else {
	$resp = "Boa noite ";}
	?>
    <?php echo "<br> Olá  ".$_SESSION['nome_usuario'].""; 
	?> 
				<i class="fa fa-star"></i>
			  	<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>