<?php
session_start();
?>


<?php

unset( $_SESSION['sess_fair'] );
unset( $_SESSION['sess_edition'] );
unset( $_SESSION['sess_name_fair'] );

unset( $_SESSION['usuario'] );
unset( $_SESSION['senha'] );
unset( $_SESSION['nome_usuario'] );
unset( $_SESSION['id_pai'] );
unset( $_SESSION['id_usuario'] );
unset( $_SESSION['tipo_acesso'] );
unset( $_SESSION['tipo_conta'] );

?>.
<style>
    .bkc_ground{
        background-color: #000000;
    }
</style>
<!---->
<!DOCTYPE html>
<html lang="pt-br" >
  <head>
    <?php ini_set('default_charset','utf-8')?>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
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
       <form class="form-signin" id="formCadastro" name="formCadastro" action="usuarios/add.php?acao=add_usuario" method="post">
                   
                   <h3 class="form-signin-heading text-center">
          <a href=""> <img  width="300" src="img/algoritech_logo_vendas.png"> </a>
        </h3>
        <br/>
                    <h2>Criar uma nova conta</h2>                  
                  
                  <input type="text" id="nome_usuario" name= "nome_usuario" class="form-control" placeholder="Nome Completo Ex: José Carlos" required style="margin-bottom: 10px;" />                  
                  
                  <input type="text" id="email" name= "email" class="form-control" placeholder="E-mail Ex: jose@cocacola.com" required style="margin-bottom: 10px;" />
                  
                  
                  <input type="text" id="login_usuario" name="login_usuario" class="form-control" placeholder="Login (Nome de Usuário) Ex: josecarlos" required style="margin-bottom: 10px;" />
                  <input type="password" id="senha" name="senha" minlength="8" class="form-control" placeholder="Criar Senha (Minimo de 8 digitos)" required style="margin-bottom: 10px;" />  
                  <input type="hidden" id="tipo_acesso" name="usuario['tipo_acesso']" value="0"  class="form-control" />
                  <input type="hidden" id="tipo_conta" name="usuario['tipo_conta']" value="0"  class="form-control" />
                  <input type="hidden" id="status" name="usuario['status']" value="0"  class="form-control" /> 
                      <br>
                    
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="checkTermos" id="checkTermos" name="check_termos" required/>
                            Sim, eu concordo com os <a href="#"><b>Termos de uso</b>.</a>
                        </label>
                    </div>
                     <button class="btn btn-lg btn-primary btn-block" type="submit"onclick="validarCheck();" style="width: 300px; height: 40px;">Cadastrar</button>
                     
                     
      </form>
	
    </div>
<!--Luan santana  
//verificar se clicou no botão
isset ($_POST['nome])
{

  $nome_usuario = addlashes($_POST['nome_usuario']);
  $email = addlashes($_POST['email']);
  $novo_usuario = addlashes($_POST['novo_usuario']);
  $senha = addlashes($_POST['senha']);
 //verificar se está preenchido
 if(!empty($nome_usuario) && !empty($email) && !empty($novo_usuario) && !empty($senhaCripto)) 
{
    
} else
{
echo "Preencha todos os campos!";
}

}
 
-->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
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

