<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/eventosController.php');
findEvento(); 
?>

<?php
	if (isset($_REQUEST['acao'])){
		if ($_REQUEST['acesso'] == "semtipo") {
						echo "<script language='javascript' type='text/javascript'>
					alert('Selecione o tipo de Acesso!');
				  </script>";			
			echo "<script>location.href='../usuarios/add_novo_usuario.php';</script>";
			}
		
	  ////////////////*********INICIO**********///////////
	   //Tira os espaços em branco do começo e do fim
	   $novo_usuario = trim($_POST["novo_usuario"]);	
		if(empty($novo_usuario) || is_null($novo_usuario)) {			
			echo "<script language='javascript' type='text/javascript'>
					alert('Não pode conter espaço no campo Login de acesso!');
				  </script>";			
			echo "<script>location.href='../usuarios/add_novo_usuario.php';</script>";			   
		} else if (strrpos($novo_usuario, " ") !== false) { //Procura a última ocorrência de espaço
			echo "<script language='javascript' type='text/javascript'>
					alert('Não pode conter espaço no campo Login de acesso!!');
				  </script>";			
			echo "<script>location.href='../usuarios/add_novo_usuario.php';</script>";
		} 
		
		////////////////*********FIM**********///////////
		else {			
			require_once('../controller/usuarioController.php');
			pesquisaUsuario();			
			if ($usuarios) : 			
			foreach ($usuarios as $usuario) :
				$novo_usuario = $usuario['usuario'];
					echo "<script language='javascript' type='text/javascript'>
						alert('Usuário já existe! Digite um usuario diferente!');
					  </script>";			
				echo "<script>location.href='../usuarios/add_novo_usuario.php';</script>";
					   
				 endforeach;
			else : 
				salvarUsuarioFilho();
		   endif; 
		}
	}
?>

    <h2>Informa&ccedil;&otilde;es do Vendedor</h2>

    <form id="formEmpresa" name="formEmpresa" action="../usuarios/add_novo_usuario.php?acao=addvendedor" method="post">
        <!-- area de campos do form -->
        <hr />
        
        <div class="form-group col-md-3">
                <label id="nome" for="name">Nome Completo</label>
                <input type="text" class="form-control" name="usuario['nome_usuario']" placeholder="Nome Completo Ex: José Carlos" autofocus required >
            </div>
            <div class="form-group col-md-3">
                <label for="name" >Login de acesso</label>
                <input type="text" class="form-control" name="novo_usuario" autofocus  placeholder="Login (Nome de Usuário) Ex: josecarlos" required >
            </div>               
            <div class="form-group col-md-3">
                <label for="name">E-mail</label>
                <input type="text" class="form-control"  name="usuario['email']" placeholder="E-mail Ex: jose@cocacola.com" required>
            </div>
            <div class="form-group col-md-2">
                <label for="name">Senha</label>
                
                <input type="password" id="senha" class="form-control" name="usuario['senha']" placeholder="Criar Senha" required>
            </div>            
        </div>

        <div class="row">
            <div class="form-group col-md-2">
                <label for="name">Fun&ccedil;&atilde;o</label>
                <!--                <input type="text" class="form-control" name="empresa['estado']">-->
                <select class="form-control" name="modulo" required>
                <option value="" selected="selected" >Selecione a Fun&ccedil;&atilde;o</option>
                    <option value="1">Financeiro</option>
					<option value="2">Marketing</option>
					<option value="3">Operacional</option>
					<option value="4">Projetista</option>
					<option value="5">Vendas</option>    
                </select>
			</div>
			<div class="form-group col-md-2">
                <label for="name">Acesso</label>
                <!--                <input type="text" class="form-control" name="empresa['estado']">-->
                <select class="form-control" name="acesso" required>
                <option value="" selected="selected">Selecione</option>
                    <option value="1">Simples</option>
                    <option value="0">Administrador</option>                    
                </select>
            	<input type="hidden" name="usuario['tipo_conta']" value="1"  class="form-control" />
                <input type="hidden" name="usuario['status']" value="0"  class="form-control" />
			</div>
        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                <a href="index.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>