<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Celke - Upload</title>
    </head>
    <body>
        <h1>Cadastrar Imagem</h1>
        <?php
        $numero_desenho = $_REQUEST['numero_desenho'];
        $id_briefing = $_REQUEST['id_briefing'];
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="proc_cad_img.php?id_vendedor=<?php echo $_REQUEST['id_vendedor']; ?>&id_negocio=<?php echo $_REQUEST['id_negocio']; ?>&id_briefing=<?php echo $_REQUEST['id_briefing']; ?>&numero_desenho=<?php echo $_REQUEST['numero_desenho']; ?>&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>" enctype="multipart/form-data">
            <label>Imagem</label>
            <input type="file" name="imagem"><br><br>
            
            <input name="SendCadImg" type="submit" value="Cadastrar">
        </form>
    </body>
</html>
