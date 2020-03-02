<?php
require_once('../controller/usuarioController.php');
editarUsuario();
findUsuario();
?>

<?php
require_once ('../config.php');
require_once ("../inc/visibilidade-header.php");
?>

    <script>
        jQuery(function($){
            $("#campoCEP").mask("99999-999");
            $("#campoCNPJ").mask("99.999.999/9999-99");
        });
    </script>
     <?php if ($usuarios) : ?>
                <?php foreach ($usuarios as $usuario) : ?>

    <form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post">
        <hr />
        <h2>Dados do Usuário: <?php echo $usuario['username']; ?></h2>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome Completo:</label>
                <input type="text" class="form-control" name="usuario['nome']" value="<?php echo $usuario['nome']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="name">E-mail: </label>
                <input type="text" class="form-control" name="usuario['email']" value="<?php echo $usuario['email']; ?>">
            </div>
            <div class="form-group col-md-2">Senha: 
                  <input type="password" class="form-control" name="usuario['senha']" value="<?php echo $usuario['senha']; ?>">
             </div> 
        </div>     
        <?php if (0==1): ?>  
        
        
        <div class="row">
        	<div class="form-group col-md-4">Conta Criada: <?php echo $usuario['created']; ?></div>
            <div class="form-group col-md-4">Conta Modificada: <?php echo $usuario['modified']; ?></div>
            </div>   
        </div>
        <?php endif; ?>
        
        <h2>Dados da Empresa</h2>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Nome Fantasia</label>
                <input type="text" class="form-control" name="usuario['nome_fantasia']" value="<?php echo $usuario['nome_fantasia']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Razão Social</label>
                <input type="text" class="form-control" name="usuario['razao_social']" value="<?php echo $usuario['razao_social']; ?>">
            </div>        
            <div class="form-group col-md-2">
                <label for="name">CNPJ</label>
                <input type="text" id="campoCNPJ" class="form-control" name="usuario['cnpj']" value="<?php echo $usuario['cnpj']; ?>">
            </div>
        </div>    
        <div class="row">    
            <div class="form-group col-md-2">
                <label for="name">CEP</label>
                <input type="text" id="campoCEP" class="form-control" name="usuario['cep']" value="<?php echo $usuario['cep']; ?>">
            </div>
        </div>
        <div class="row">
        	<div class="form-group col-md-4">
                <label for="name">Endereço</label>
                <input type="text" class="form-control" name="usuario['endereco']" value="<?php echo $usuario['endereco']; ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Cidade</label>
                <input type="text" class="form-control" name="usuario['cidade']" value="<?php echo $usuario['cidade']; ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="name">Estado</label>
<!--                <input type="text" class="form-control" name="usuario['estado']" value="--><?php //echo $usuario['estado']; ?><!--">-->
                <select class="form-control" name="usuario['estado']">
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AM">AM</option>
                    <option value="AP">AP</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MG">MG</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PE" selected="selected">PE</option>
                    <option value="PI">PI</option>
                    <option value="PR">PR</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SE">SE</option>
                    <option value="SP">SP</option>
                    <option value="TO">TO</option>
                </select>
            </div>            
        </div>
        <div class="row">
        	<div class="form-group col-md-4">
                <label for="name">Website</label>
                <input type="text" class="form-control" name="usuario['website']" value="<?php echo $usuario['website']; ?>">
            </div>
        </div>
        
        
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </form>
      <?php endforeach; ?>
      <?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>