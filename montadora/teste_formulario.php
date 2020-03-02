<?php
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
?>
<?php
/*
            echo $_SESSION["myusername"];
            echo "-------";
			echo $_SESSION["mypassword"];
            echo "-------";
			echo $_SESSION["tipo_acesso"];
			 echo "-------";
			echo $_SESSION["id_conta"];
			 echo "-------";
			echo $_SESSION["subdominio"];
*/
?>
<style>

    .bkc_ground{
        background-color: #000000;

    }

</style>
<!---->

<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Organiza Eventos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class = "bkc_ground" >
  
  <form id="formExemplo" data-toggle="validator" role="form">
  <div class="form-group">
    <label for="textNome" class="control-label">Nome</label>
    <input id="textNome" class="form-control" placeholder="Digite seu Nome..." type="text" required>
  </div>
  
  <div class="form-group">
    <label for="inputEmail" class="control-label">Email</label>
    <input id="inputEmail" class="form-control" placeholder="Digite seu E-mail" type="email" 
      data-error="Por favor, informe um e-mail correto." required>
    <div class="help-block with-errors"></div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword" class="control-label">Senha</label>
    <input type="password" class="form-control" id="inputPassword" placeholder="Digite sua Senha..."  
      data-minlength="6" required>
    <span class="help-block">Mínimo de seis (6) digitos</span>
  </div>
  
  <div class="form-group">
    <label for="inputConfirm" class="control-label">Confirme a Senha</label>
    <input type="password" class="form-control" id="inputConfirm" placeholder="Confirme sua Senha..." 
      data-match="#inputPassword" data-match-error="Atenção! As senhas não estão iguais." required>
    <div class="help-block with-errors"></div>
  </div>
  
  <div class="form-group">
    <div class="checkbox">
      <label>
        <input type="checkbox" data-error="Você deve marcar este campo!" required> Marque este item.
      </label>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
</form>
  
  
    <div class="container">

      <form class="form-signin" id="formLogin" method="POST" action="valida.php">

        <h3 class="form-signin-heading text-center">
          <a href=""> <img  width="300" src="img/logo_algoritech300px.png"> </a>
        </h3>
        <br/>
        <label for="inputSubdominio" class="sr-only">Subdominio</label>
        <input type="text" id="subdominio" name="subdominio" class="form-control" placeholder="Subdominio" required autofocus >
          <br/>
          
          <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Nome de Usuário" required autofocus >
           <br/>
           
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required >
        <div class="checkbox">
        
          <label> <input type="checkbox" value="remember-me"> Lembrar Senha </label>
        
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
      </form>
      </div>
      </br>
       <div class="form-group">
       								<div class="col-md-5 control">
                                    </div>
                                    <div class="col-md-2 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                         </br>
                                            Não tem conta ainda! 
                                        <a href="../token.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Cadastre aqui
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 control">
                                    </div>
                                </div> 


<div class="row">
      
      
      
             






      

    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
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
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username != null && password!= null) {
            document.getElementById('formLogin').submit();
        }
    }
</script>
  </body>
</html>
