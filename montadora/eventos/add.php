<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php 
	if (!isset($_REQUEST['acao'])) : 
		echo "<br>ERRO- Volte na pagina anterior";
		else:
	endif;
?>
<?php
require_once('../controller/eventosController.php');

if ($_REQUEST['acao']=='salvar_evento') : 
	salvarEvento();
endif;
if ($_REQUEST['acao']=='salvar_edicao') : 
	salvarEdicao();
endif;
	pesquisaEvento();
require_once('../controller/contasController.php');
findConta();
?>
<script>
        jQuery(function($){  
		    $("#campoDATE1").mask("99/99/9999");
			$("#campoDATE2").mask("99/99/9999");
			$("#campoDATE3").mask("99/99/9999");
			$("#campoDATE4").mask("99/99/9999");
			$("#campoDATE5").mask("99/99/9999");
			$("#campoDATE6").mask("99/99/9999");
        });
    </script>
    
<h3>Novo Evento <br><br></h3>
    
 <?php if ($_REQUEST['acao']=='novo_cadastro') : ?>
        <!--SELEÇÃO DO TIPODE CADASTRO -->
        <h4>Para cadastrar um novo evento <a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php?acao=novo_evento"><i class="fa fa-plus"></i> Novo evento</a></h4>
		<h4>Para cadastrar uma nova edi&ccedil;&atilde;o de um evento existente <a class="btn btn-primary" href="<?php echo BASEURL; ?>eventos/add.php?acao=nova_edicao"><i class="fa fa-plus"></i> Nova edi&ccedil;&atilde;o</a></h4>
       
			
<?php else: ?>	
<?php 
	if ($_REQUEST['acao']=='nova_edicao') : 
		$link = "add.php?acao=salvar_edicao";
	endif;
	if ($_REQUEST['acao']=='novo_evento') : 
		$link = "add.php?acao=salvar_evento";
	endif;
?>
    <form id="formEvento" name="formEvento" action="<?php echo $link; ?>" method="post">
        <!-- area de campos do form -->
        <h4>DADOS OBRIGATÓRIOS</h4>
        <div class="row">
			<?php if ($_REQUEST['acao']=='nova_edicao') : ?>
			<div class="form-group col-md-3">   
				<label for="name">Evento</label>
            	<select class="form-control" name="id_evento" required >
                <option value="" selected="selected" >Selecione um evento</option>
					
					<?php 
					if ($eventos) : 
						foreach ($eventos as $evento) :
					?>

					
					 <option value="<?php echo $evento['id']; ?>"><?php echo $evento['nome_evento']; ?></option>
                    
                     <?php endforeach; ?>
                    <?php endif; ?>
                    
                   
                </select>
            </div>
			<?php else: ?>
            <div class="form-group col-md-3">
				<label for="name">*Nome Evento</label>
              <input type="text" class="form-control" name="evento['nome_evento']" required placeholder="Ex: ABAV">
            </div>
			<?php endif; ?>
			<div class="form-group col-md-3">
                <label for="name">*Nome edi&ccedil;&atilde;o</label>
              <input type="text" class="form-control" name="edicao['nome_edicao']" required placeholder="Ex: 9ª ABAV">
            </div>
			<div class="form-group col-md-3">
                <label for="name">*Local</label>
              <input type="text" class="form-control" name="edicao['local']" required placeholder="Ex: SÃO PAULO EXPO" >
            </div>
			<div class="form-group col-md-3">
                <label for="name">*Cidade</label>
              <input type="text" class="form-control" name="edicao['cidade']" required >
            </div>
			<div class="form-group col-md-2">
                <label for="name">*Estado</label>
                <!--                <input type="text" class="form-control" name="empresa['estado']">-->
              <select class="form-control" name="edicao['estado']" required >
					<option value="" selected="selected">Selecione</option>
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
                    <option value="PE">PE</option>
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
			<div class="form-group col-md-3">   
				<label for="name">*Conta</label>
           	  <select class="form-control" name="id_conta" required >
                <option value="" selected="selected" >Selecione uma Conta</option>
					<?php if ($contas) : ?>
                    <?php foreach ($contas as $conta) : ?>
                           
                     <option value="<?php echo $conta['id']; ?>"><?php echo $conta['nome_conta']; ?></option>
                    
                     <?php endforeach; ?>
                    <?php else : ?>
                    
                   <option value="">Nenhuma conta cadastrada</option>
                    
                    <?php endif; ?>
                    
                   
                </select>
            </div>
			<div class="form-group col-md-2">
                <label for="name">*Inicio evento</label>
              <input type="text" id="campoDATE1" class="form-control" name="inicio_evento" placeholder="00/00/0000" required >
            </div>
			<div class="form-group col-md-2">
                <label for="name">*Fim evento</label>
              <input type="text" id="campoDATE2" class="form-control" name="fim_evento"  placeholder="00/00/0000" required >
            </div>
	    </div>
	  <hr />
		<h4>DADOS N&Atilde;O OBRIGAT&Oacute;RIOS</h4>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Promotora</label>
              <input type="text" class="form-control" name="edicao['promotora']" >
            </div>
			<div class="form-group col-md-3">
                <label for="name">Montadora Oficial</label>
              <input type="text" class="form-control" name="edicao['montadora']" >
            </div>
		  <div class="form-group col-md-6">
                <label for="name">Segmento</label>
                <input type="text" class="form-control" name="edicao['segmento']" placeholder="Ex: ALIMENTOS E BEBIDAS" >
            </div>
			<div class="form-group col-md-2">
                <label for="name">Inicio montagem</label>
              <input type="text" id="campoDATE3" class="form-control" name="inicio_montagem"  placeholder="00/00/0000"  >
            </div>
		  <div class="form-group col-md-2">
                <label for="name">Fim montagem</label>
                <input type="text" id="campoDATE4" class="form-control" name="fim_montagem"  placeholder="00/00/0000"  >
            </div>
		  <div class="form-group col-md-2">
                <label for="name">Inicio desmontagem</label>
                <input type="text" id="campoDATE5" class="form-control" name="inicio_desmontagem"  placeholder="00/00/0000" >
            </div>
		  <div class="form-group col-md-2">
                <label for="name">Fim desmontagem</label>
                <input type="text" id="campoDATE6" class="form-control" name="fim_desmontagem"  placeholder="00/00/0000" >
            </div>
			
        </div>
        <div class="row">            
        </div>
        <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                <a href="eventos.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </form>
			<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>