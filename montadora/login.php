<?php 
if (isset($_SESSION['usuario'])):
	unset( $_SESSION['usuario'] );
	unset( $_SESSION['senha'] );
	unset( $_SESSION['nome_usuario'] );
	unset( $_SESSION['id_pai'] );
	unset( $_SESSION['id_usuario'] );
	unset( $_SESSION['tipo_acesso'] );
	unset( $_SESSION['tipo_conta'] );
else:
endif;
?><style>
    .bkc_ground{
        background-color: #000000;
    }
</style>
<!---->
<!DOCTYPE html>
<html lang="pt-br" >
  <head>
    <?php ini_set('default_charset','utf-8')?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="algoritech">
    <meta name="author" content="algoritech">
    <link rel="icon" href="favicon.ico">

    <title>Sistema de Vendas</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class = "bkc_ground" >
    <div class="container">

      <form class="form-signin" id="formLogin" method="POST" action="valida.php">

        <h3 class="form-signin-heading text-center">
          <a href=""> <img  width="300" src="img/algoritech_logo_vendas.png"> </a>
        </h3>
        <br/>
         
          <label for="inputEmail" class="sr-only">Usuário</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Nome de Usuário" required autofocus >
           <br/>
           
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required >
        <div class="checkbox">
        
          <label> <input type="checkbox" value="remember-me"> Lembrar Senha &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="esqueceusenha.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Esqueceu sua senha!
                                        </a></label>
          <!-- <a href="esqueceusenha.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Esqueceu a Senha!
                                       </a>-->
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
      </form>
      </div>
      </br>
       <div class="form-group">
       								<div class="col-md-5 control">
                                    </div>
                                    <div class="col-md-2 control">
                                        <div style="border-top: 1px solid#888; padding-top:10px; font-size:99%" align="center">
                                         </br>
                                            Não tem conta ainda? 
                                        <a href="cadastro.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Cadastre aqui!
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 control">
                                    </div>
                                </div> 
<div class="row">

    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script>
    function validarCheck() {
        var marcouTermo = document.getElementById("checkTermos").checked;
        var login = document.getElementById("email").value;
        var email_confirma = document.getElementById("email_confirma").value;
        var senha = document.getElementById("senha").value;
        var senha_confirma = document.getElementById("senha_confirma").value;

        if (marcouTermo && login!=null && senha!=null) {
            document.getElementById('formCadastro').submit();        }
    }

    function validarCampos() {
        var usuario = document.getElementById("usuario").value;
        var senha = document.getElementById("senha").value;

        if (usuario != null && senha!= null) {
            document.getElementById('formLogin').submit();
        }
    }
</script>
  </body>
</html>
