<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/produtoController.php');
pesquisaGrupoProduto($_REQUEST['id_atendimento']);
if(isset($_REQUEST['acao'])):
	if ($_REQUEST['acao']=='salvarGrupo'):
		salvarGrupoProduto();
	endif;
endif;
unset($_SESSION['numero_cotacao']);
unset($_SESSION['metro_quadrado']);
?>
<header>		
	<div class="container">
		<div class="col-xs-3">
			<h4>NEGOCIAÇÕES</h4>
		</div>
		<div class="col-xs-9 floa" align="right">
		</div>
	</div>
	<div id="divConteudo2">
		<table id="tabela2" class="table table-hover">
			<thead>
				<tr>
					<td>
					<h5>
						<div id="row">
							<div class="form-group col-md-1" align="left">Edit</div>
							<div class="form-group col-md-5" align="left">Grupo</div>
							<div class="form-group col-md-1" align="left" >Briefing</div>
							<div class="form-group col-md-1" align="left" >Cotação</div>
							<div class="form-group col-md-1" align="left" >Contrato</div>
							<div class="form-group col-md-1" align="left" >Cobrança</div>
							<div class="form-group col-md-1" align="left" >OS</div>
							<div class="form-group col-md-1" align="left" ></div>
						</div>
					</h5>
					</td>
				</tr>
			</thead>
			<tbody>
				<?php	
				if ($grupo_produtos) : 
					foreach ($grupo_produtos as $grupo_produto):
				?>
					<tr>
						<td>
							<div id="row">
							<div class="form-group col-md-1" align="left">
							<a href="
							<?php echo "edit.php?acao=editar&id_negociacao=".$grupo_produto['id']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."";?>" class="btn btn-sm btn-warning">
							<i class="fa fa-pencil"></i> Editar</a>
							</div>
							<div class="form-group col-md-5" align="left"><?php echo $grupo_produto['nome'];?></div>
							<div class="form-group col-md-1" align="left" >
								<a class="btn btn-warning" href="#">
								<i class="fa fa-comment"></i></a>
							</div>
							<div class="form-group col-md-1" align="left" >
								<a class="btn btn-primary" href="<?php echo BASEURL."cotacao/carrinho.php?acao=novoCarrinho&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_grupo_produto=".$grupo_produto['id'].""; ?>">
								<i class="fa fa-shopping-cart"></i></a>
							</div>
							<div class="form-group col-md-1" align="left" >
								<a class="btn btn-success" href="#">
								<i class="fa fa-file"></i></a>
							</div>
							<div class="form-group col-md-1" align="left" >
								<a class="btn btn-danger" href="#">
								<i class="fa fa-usd"></i></a>
							</div>
							<div class="form-group col-md-1" align="left" >
								<a class="btn btn-primary" href="#">
								<i class="fa fa-wrench"></i></a>
							</div>
							<div class="form-group col-md-1" align="left" ></div>
							</div>
						</td>         
					</tr>
					<?php
					endforeach; else: 
					?>
			
					<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->	
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<i class='fa fa-asterisk' aria-hidden='true'></i> N&Atilde;O TEM GRUPO CADASTRADO PARA ESTE CLIENTE
						</div>
					<hr>
					<!-- FIM DO CODIGO PARA IMPRIMIR ALERTA NA TELA -->
				<?php 	endif; ?>
			</tbody>
		</table>
	</div>
	<form id="formBriefing" name="formBriefing" action="add.php?acao=salvarGrupo&id_empresa=<?php echo $_REQUEST['id_empresa']; ?>&id_atendimento=<?php echo $_REQUEST['id_atendimento'];?>" method="post">
		<div class="row">
			<div class="form-group col-md-12" align="left"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i> DESCREVA NO CAMPO ABAIXO UM NOME DE REFERENCIA DO PRODUTO.  
			</div>
			<div class="form-group col-md-6">
				<input type="text" class="form-control" name="grupo_produto['nome']" placeholder="Ex: STAND, QUIOSQUE, CENOGRAFIA, PDV..." required >
			</div> 
			<div class="form-group col-md-6">
				<button type="submit" class="btn btn-success" id="salvar">Salvar</button>
				<a href="javascript:history.back()" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Voltar</a>
			</div>
		</div> 
	</form>
	
<?php include(FOOTER_TEMPLATE); ?>