<?php
session_start();
//session_unset ($_SESSION['cart']);
?>
<form action="teste.php" method="post">
   <label for="">Name</label>
   <input type="text" name="name">
   <br> <br>

   <label for="">Money</label>
   <input type="text" name="money">
   <br> <br>

   <input type="submit" value="Submit">
</form>

<?php
   if (empty($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
   }

   array_push($_SESSION['cart'], $_POST);

?>

<p>
   O Lançamento foi feito com sucesso.
   <a href="teste.php?acao=ver">Clique aqui</a>
</p>

<?php
if($_REQUEST['acao']=='ver'):
    var_dump($_SESSION['cart']);
    

    foreach ($_SESSION['cart'] as $key => $value) :
     //   echo "INSERT INTO teste (nome, dinheiro) VALUES ('" . $value["name"] . "'," . $value["money"] . ")";
     
     endforeach;
endif;
?>