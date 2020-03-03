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

//if (isset($_POST[ok])){

   // $email = $mysqli->escape_string($_POST['email']);

  //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  //      $erro[] = "E-mail inválido.";
  //  }

    //$sql = "SELECT id FROM usuarios WHERE usuario = '$usuario' and email = '$email' and status = '0'";
    //$usuario = mysqli_real_escape_string($db,$_POST['usuario']);
    //$email = mysqli_real_escape_string($db,$_POST['email']);
    

 //   if (count($erro) == 0){

  //      $novasenha = substr(md5(time()), 0, 6);
   //     $nscriptografada = md5(md5($novasenha));

  //  if (mail($email, "Sua Nova Senha", "Sua Nova senha: ".$novasenha)){


  //  $sql_code = "UPDATE usuario SET senha = '$nscriptografada' WHERE email = '$email'"
  //  $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
 //   }    
//}
    
//}

?>.
<style>

    div.a{
      text-align: center;
    } 
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

    <title>Esqueceu a Senha</title>

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
                    <div class="a">
                    <h2 text-align: center;>Esqueceu a senha!</h2> </div>                
                  
                  <input type="text" id="email" name="usuario['email']" class="form-control text-center"  placeholder="Seu Email!" required style="margin-bottom: 10px;" />
                                   
                  <input type="hidden" id="tipo_acesso" name="usuario['tipo_acesso']" value="0"  class="form-control" />
                  <input type="hidden" id="tipo_conta" name="usuario['tipo_conta']" value="0"  class="form-control" />
                  <input type="hidden" id="status" name="usuario['status']" value="0"  class="form-control" />
                    <br>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit"onclick="validarCheck();" style="width: 300px; height: 40px;">Enviar</button>
                     
                     
      </form>
	
    </div>

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
