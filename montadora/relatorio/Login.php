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

    <title>MotoShow Credenciamento</title>

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

    <div class="container">

      <form class="form-signin" action="valida.php" method="POST">

        <h3 class="form-signin-heading text-center">
          <a href=""> <img src="imagem/login.jpg" width="302"/> </a>
        </h3>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Login" required autofocus >
          <br/>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required >
        <div class="checkbox">
          <label> <input type="checkbox" value="remember-me"> Lembrar Senha </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div>

    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
