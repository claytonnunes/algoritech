<?php
session_start();
include_once './conexao.php';

//variaveis para DB
$numero_desenho = $_REQUEST['numero_desenho'];
$id_briefing = $_REQUEST['id_briefing'];
$id_usuario = $_SESSION['id_usuario'];
$id_pai = $_SESSION['id_pai'];
$today = date_create('now', new DateTimeZone('America/Recife'));
$created = $today->format("Y-m-d H:i:s");
$modified = $created;


//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nome_imagem = $_FILES['imagem']['name'];
    
    $tmp_name = $_FILES['imagem']['tmp_name'];
    //$nomeOriginal = $nome_imagem;


    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO arquivo (nome_arquivo, nome_original) VALUES ('$tmp_name', '$nome_imagem')";
    $insert_msg = $conn->prepare($result_img);


    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = 'upload/';

        //Criar a pasta de foto 
       // mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nome_imagem)){
            $_SESSION['msg'] = "<p style='color:green;'>Dados salvo com sucesso e upload da imagem realizado com sucesso</p>";
            header("Location: index.php");
        }else{
            $_SESSION['msg'] = "<p><span style='color:green;'>Dados salvo com sucesso. </span><span style='color:red;'>Erro ao realizar o upload da imagem</span></p>";
            header("Location: index.php");
        }        
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
        header("Location: index.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
    header("Location: index.php");
}