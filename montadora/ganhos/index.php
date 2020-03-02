<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/negocioController.php');
require_once('../controller/atendimentosController.php');
require_once('../controller/vendasController.php');
require_once('../controller/eventosController.php');
require_once('../controller/briefingController.php');
require_once('../controller/empresasController.php');
require_once('../controller/usuarioController.php');
require_once('../controller/cotacaoController.php');
require_once('../controller/equipeController.php');
findVendedores();

if (isset($_REQUEST['filtro'])){
	if (isset($_SESSION['id_vendedor']) or ($_REQUEST['filtro']=='filtroVendedor')) {
		if($_SESSION['tipo_acesso']==0):
			pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'id_usuario', $_REQUEST['id_vendedor'], 'ORDER BY nome ASC');
			pesquisaEdicao();
			$tipo_usuario = 'administrador'; 
		else:
			pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'id_usuario', $_SESSION['id_usuario'], 'ORDER BY nome ASC');
			pesquisaEdicaoCadastrado();
			$tipo_usuario = 'simples'; 
		endif;
	}
}

else if (isset($_REQUEST['filtroDois'])){
	if ($_REQUEST['filtroDois']=='filtroEdicao') {
		if($_SESSION['tipo_acesso']==0):
			pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'id_edicao', $_REQUEST['id_edicao'], 'ORDER BY nome ASC');
			pesquisaEdicao();
			$tipo_usuario = 'administrador'; 
		else:
			pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'id_edicao', $_SESSION['id_edicao'], 'ORDER BY nome ASC');
			pesquisaEdicaoCadastrado();
			$tipo_usuario = 'simples'; 
		endif;
	}
	
}
else if (isset($_REQUEST['pesquisa'])){
	if ($_REQUEST['pesquisa']!="") {
		if($_SESSION['tipo_acesso']==0):
			searchNegocio();
			pesquisaEdicao();
			$tipo_usuario = 'administrador'; 
		else:
			pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'id_usuario', $_SESSION['id_usuario'], 'ORDER BY nome ASC');
			pesquisaEdicaoCadastrado();
			$tipo_usuario = 'simples'; 
		endif;
	}
	
}
else {
	if($_SESSION['tipo_acesso']==0):
		pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'deleted', '0', 'ORDER BY nome ASC');
		pesquisaEdicao();
		$tipo_usuario = 'administrador'; 
	else:
		pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'status', '1', 'id_usuario', $_SESSION['id_usuario'], 'ORDER BY nome ASC');
		pesquisaEdicaoCadastrado();
		$tipo_usuario = 'simples'; 
	endif;
}

if ($negociacoes) {
	$somaEstagioTotal=0;
	$somaEstagioZero=0;
	$somaEstagioUm=0;
	$somaEstagioDois=0;
	$somaEstagioTres=0;
	foreach ($negociacoes as $negociacao) {
		$nomeNegocio = $negociacao["nome"];
		$somaEstagioTotal++;
		pesquisaUsuarioTres('id', $negociacao['id_usuario'], 'id_pai', $_SESSION['id_pai'], 'status', '0');
		if ($usuarios) {
			foreach ($usuarios as $usuario) {
				$idVendedor = $usuario['id'];
				$nomeVendedor = $usuario['nome_usuario'];
			}
		}
		pesquisaBriefingTres('id_grupo_produto', $negociacao['id'], 'id_pai', $_SESSION['id_pai'], 'status', '0');
		if ($briefings) {
			foreach ($briefings as $briefing) {
				$idBriefing = $briefing['id'];
				$idNegocioBriefing = $briefing['id_grupo_produto'];
				$somaEstagioUm++;
				$estimativaEstagioUm += $negociacao['valor_estimado'];
			}
		}
		if (($negociacao['estagio']=="0")and($negociacao['id']!=$idNegocioBriefing)) {
			$somaEstagioZero++;
			$estimativaEstagioZero += $negociacao['valor_estimado'];
		}
		else if (($negociacao['estagio']=="2") and($negociacao['id']!=$idNegocioBriefing)) {
			$somaEstagioDois++;
			$estimativaEstagioDois += $negociacao['valor_estimado'];
		}
		else if (($negociacao['estagio']=="3") and($negociacao['id']!=$idNegocioBriefing)) {
			$somaEstagioTres++;
			$estimativaEstagioTres += $negociacao['valor_estimado'];
		}
		else{

		}	
		$idEmpresa = $negociacao['id_empresa'];
		$idEdicao = $negociacao['id_edicao'];
		$posicao = $negociacao['estagio'];
		pesquisaEdicaoId($idEdicao);	
		if ($eventos) {
			foreach ($eventos as $evento) {
				$nomeEdicao = $evento['nome_edicao'];
				pesquisaEmpresaId('id', $idEmpresa, 'id_pai', $_SESSION['id_pai'], 'deleted', '0');
				if ($empresas) {
					foreach ($empresas as $empresa) {
					$nomeEmpresa = $empresa['nome_fantasia'];
					$estimativaEstagioTotal += $negociacao['valor_estimado'];
					$quantidadeNegocios++;
					$idAtendimento = $negociacao['id_atendimento'];
					$arrayNegocios[] = array(	
						'idAtendimento' => $negociacao['id_atendimento'],
						'idVendedor' => $idVendedor,
						'nomeVendedor' => $nomeVendedor,		
						'posicao' => $posicao,
						'idEdicao' => $idEdicao,
						'nomeEdicao' => $nomeEdicao,
						'idEmpresa' => $idEmpresa,
						'nomeEmpresa' => $nomeEmpresa,
						'idBriefing' => $idBriefing,
						'idNegocioBriefing' => $idNegocioBriefing,
						'id' => $negociacao['id'],
						'potencialVenda' => $negociacao['potencial_venda'],
						'valorEstimado' => $negociacao['valor_estimado'],
						'estagio' => $negociacao['estagio'],
						'status' => $negociacao['status'],
						'nome' => $nomeNegocio
						);		
						sort($row['id']);
					}
				}
			}
		}
	}
}

?>              
<header>
<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->
	<?php 
	if(isset($_REQUEST['filtro'])):
		if ($_REQUEST['filtro']=='filtroVendedor'):
		?>	
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<?php echo "VOCÊ ESTÁ VENDO OS NEGÓCIOS DE ".$_REQUEST['nome_vendedor']; ?>
		</div>
		<hr>
		<?php 
		endif;
	endif;	
	?>

	<!-- CODIGO PARA IMPRIMIR ALERTA NA TELA -->
	<?php 
	if(isset($_REQUEST['filtroDois'])):
		if ($_REQUEST['filtroDois']=='filtroEdicao'):
		?>	
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<?php echo "VOCÊ ESTÁ VENDO OS NEGÓCIOS DO EVENTO ".$_REQUEST['nome_edicao']; ?>
		</div>
		<hr>
		<?php 
		endif;
	endif;	
	?>
<!-- GRAFICO META DE VENDAS -->
<?php  if ($vendedores) : ?>
			
	<div class="container">
		<div class="row">
			<div class="col-sm-7 text-right">
			</div>
			<div class="col-sm-4 text-right">
			<?php
			if ($_SESSION['tipo_acesso']==0):
			?>	
			<div class="btn-group">
				<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-user"></i>	Vendedor <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php if ($vendedores) : ?>
					<?php foreach ($vendedores as $vendedor) : 
						
						$sexo = $vendedor['sexo'];
						if ($sexo=='0') {
							$iconeSexo = 'male';
						}
						else if ($sexo=='1') {
							$iconeSexo = 'female';
						}
						else {
							$iconeSexo = 'android';
						}
						?>
					<li><a href="<?php echo
					"index.php?pg=funil&filtro=filtroVendedor&nome_vendedor=".$vendedor['nome_usuario']."&id_vendedor=". $vendedor['id']; ?>"><i class="fa fa-<?php echo $iconeSexo; ?>"></i><?php echo " ".$vendedor['nome_usuario']; ?></a></li>
					<?php
					endforeach;
					endif;
					?>
					<li><a href="index.php?pg=funil"><i class="fa fa-group"></i> TODOS</a></li>
					<hr>
					<li><a href="../usuarios/add_novo_usuario.php"><i class="fa fa-plus"></i> NOVO USUÁRIO</a></li>
				</ul>
			</div>
			<?php endif;  endif;  //////// *********** FIM **********////////?>	
			<div class="btn-group">
				<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-filter"></i> Evento <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php pesquisaEdicao();
					if ($eventos) : ?>
					<?php foreach ($eventos as $evento) : ?>
					<li><a href="<?php echo
					"index.php?pg=funil&filtroDois=filtroEdicao&nome_edicao=".$evento['nome_edicao']."&id_edicao=". $evento['id']; ?>"><?php echo $evento['nome_edicao']; ?></a></li>
					<?php
					endforeach;
					endif;
					?>
					<hr>
					<li><a href="index.php?pg=funil">TODOS EVENTOS</a></li>
				</ul>
			</div>
			<div class="btn-group">
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus"></i> 
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="#index.php">Novo negócio</a></li>
					<li><a href="#index.php">Nova empresa</a></li>
					<li><a href="#index.php">Novo evento</a></li>
					<li><a href="#index.php">Novo usuário</a></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-1 text-right">
		</div>
		</div>
	</div>
<!-- INICIO PENDÊNCIA MATERIAL CLIENTE -->
    <div class="col-lg-3">
		<div class="panel panel-default panel-danger">
            <div class="panel-heading">
                <i class="fa fa-phone fa-fw"></i> <?php echo $somaEstagioZero." PENDÊNCIA CLIENTE"; ?>
            </div>
			<?php
			$i = 0;
			foreach ($arrayNegocios as $arrayNegocio){
				$i++;	
				if($arrayNegocio['status']=="1") {
			?>
			<div class="row">
				<a href="<?php echo BASEURL; ?>negocio/index.php?id_negocio=<?php echo $arrayNegocio['id']; ?>&id_edicao=<?php echo $arrayNegocio['idEdicao']; ?>&id_atendimento=<?php echo $arrayNegocio['idAtendimento']; ?>&id_empresa=<?php echo $arrayNegocio['idEmpresa']; ?>" class="list-group-item">
							<?php 
							$situacao = $arrayNegocio['posicao'];
							if($situacao==0){
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-lock'></i></button>";
								}
								else if ($situacao==1){ //Captação
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-phone'></i></button>";
								}
								else if ($situacao==2){ //Orçamento Enviado
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-file'></i></button>"; 
								}
								else if ($situacao==3){ //Alinhando Contrato
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-bell'></i></button>";
								}
								else if ($situacao==4){ //Contrato Assinado
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-trophy'></i></button>";
								}
								else if ($situacao==5){ //Negativado
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-thumbs-down'></i></button>";
								}
								else{
									$situacao = "<button type='button' class='btn btn-success btn-circle pull-right'><i class='fa fa-lock'></i></button>";
								}
							echo $situacao; ?>	

				<div class="col-lg-4">
				<i class='fa fa-heart'></i></div>
				<div class="col-lg-4"></div>
				<p><strong><?php echo $arrayNegocio['nome'];?></strong></p>
				<P><mark><?php echo $arrayNegocio['nomeEmpresa']; ?></mark></P>
				<P><?php echo $arrayNegocio['nomeEdicao']; ?></P>
				<P><?php echo $arrayNegocio['nomeVendedor']; ?> <?php echo " | R$ ".number_format($arrayNegocio['valorEstimado'], 2, ',', '.'); ?></P>
				<div class="col-lg-12">
				<?php
					if($arrayNegocio['potencialVenda']=="0"){
						$potencialVenda= "danger";
					}
					else if($arrayNegocio['potencialVenda']=="1"){
						$potencialVenda= "warning";
					}
					else if($arrayNegocio['potencialVenda']=="2"){
						$potencialVenda= "primary";
					}
					else{
					}
				?>
				<div class="panel panel-default panel-<?php echo $potencialVenda; ?>"></div></div>
				</a>
			</div>
			<?php
					
				}
			}
			?>
		</div>
    </div>  

	<!-- INICIO PENDÊNCIA GALPÃO -->
	<div class="col-lg-3">
		<div class="panel panel-default panel-warning">
            <div class="panel-heading">
                <i class="fa fa-phone fa-fw"></i> <?php echo $somaEstagioUm." PENDÊNCIA GALPÃO"; ?>
            </div>
			<?php
			$i = 0;
			foreach ($arrayNegocios as $arrayNegocio){
				$i++;	
				if($arrayNegocio['id']==$arrayNegocio['idNegocioBriefing']){
			?>
			<div class="row">
				<a href="<?php echo BASEURL; ?>negocio/index.php?id_negocio=<?php echo $arrayNegocio['id']; ?>&id_edicao=<?php echo $arrayNegocio['idEdicao']; ?>&id_atendimento=<?php echo $arrayNegocio['idAtendimento']; ?>&id_empresa=<?php echo $arrayNegocio['idEmpresa']; ?>" class="list-group-item">
				<p><strong><?php echo $arrayNegocio['nome'];?></strong></p>
				<P><mark><?php echo $arrayNegocio['nomeEmpresa']; ?></mark></P>
				<P><?php echo $arrayNegocio['nomeEdicao']; ?></P>
				<P><?php echo $arrayNegocio['nomeVendedor']; ?> <?php echo " | R$ ".number_format($arrayNegocio['valorEstimado'], 2, ',', '.'); ?></P>
				<div class="col-lg-12">
				<?php
					if($arrayNegocio['potencialVenda']=="0"){
						$potencialVenda= "danger";
					}
					else if($arrayNegocio['potencialVenda']=="1"){
						$potencialVenda= "warning";
					}
					else if($arrayNegocio['potencialVenda']=="2"){
						$potencialVenda= "primary";
					}
					else{
					}
				?>
				<div class="panel panel-default panel-<?php echo $potencialVenda; ?>"></div></div>
				</a>
			</div>
			<?php
					
				}
			}
			?>
			
		</div>
    </div>
	<!-- INICIO COMEÇOU MONTAGEM -->
	<div class="col-lg-3">
		<div class="panel panel-default panel-primary">
            <div class="panel-heading">
                <i class="fa fa-phone fa-fw"></i> <?php echo $somaEstagioDois." INICIOU MONTAGEM"; ?>
            </div>
			<?php
			$i = 0;
			foreach ($arrayNegocios as $arrayNegocio){
				$i++;	
				if(($arrayNegocio['estagio']=="2") and ($arrayNegocio['id']!=$arrayNegocio['idNegocioBriefing'])){
			?>
			<div class="row">
				<a href="<?php echo BASEURL; ?>negocio/index.php?id_negocio=<?php echo $arrayNegocio['id']; ?>&id_edicao=<?php echo $arrayNegocio['idEdicao']; ?>&id_atendimento=<?php echo $arrayNegocio['idAtendimento']; ?>&id_empresa=<?php echo $arrayNegocio['idEmpresa']; ?>" class="list-group-item">
				<p><strong><?php echo $arrayNegocio['nome'];?></strong></p>
				<P><mark><?php echo $arrayNegocio['nomeEmpresa']; ?></mark></P>
				<P><?php echo $arrayNegocio['nomeEdicao']; ?></P>
				<P><?php echo $arrayNegocio['nomeVendedor']; ?> <?php echo " | R$ ".number_format($arrayNegocio['valorEstimado'], 2, ',', '.'); ?></P>
				<div class="col-lg-12">
				<?php
					if($arrayNegocio['potencialVenda']=="0"){
						$potencialVenda= "danger";
					}
					else if($arrayNegocio['potencialVenda']=="1"){
						$potencialVenda= "warning";
					}
					else if($arrayNegocio['potencialVenda']=="2"){
						$potencialVenda= "primary";
					}
					else{
					}
				?>
				<div class="panel panel-default panel-<?php echo $potencialVenda; ?>"></div></div>
				</a>
			</div>
			<?php
					
				}
			}
			?>
			
		</div>
    </div>
	<!-- INICIO MONTAGEM FINALIZADA -->
	<div class="col-lg-3">
		<div class="panel panel-default panel-success">
            <div class="panel-heading">
                <i class="fa fa-phone fa-fw"></i> <?php echo $somaEstagioTres." MONTAGEM FINALIZADA"; ?>
            </div>
			<?php
			$i = 0;
			foreach ($arrayNegocios as $arrayNegocio){
				$i++;	
				if(($arrayNegocio['estagio']=="3") and ($arrayNegocio['id']!=$arrayNegocio['idNegocioBriefing'])){
			?>
			<div class="row">
				<a href="<?php echo BASEURL; ?>negocio/index.php?id_negocio=<?php echo $arrayNegocio['id']; ?>&id_edicao=<?php echo $arrayNegocio['idEdicao']; ?>&id_atendimento=<?php echo $arrayNegocio['idAtendimento']; ?>&id_empresa=<?php echo $arrayNegocio['idEmpresa']; ?>" class="list-group-item">
				<p><strong><?php echo $arrayNegocio['nome'];?></strong></p>
				<P><mark><?php echo $arrayNegocio['nomeEmpresa']; ?></mark></P>
				<P><?php echo $arrayNegocio['nomeEdicao']; ?></P>
				<P><?php echo $arrayNegocio['nomeVendedor']; ?> <?php echo " | R$ ".number_format($arrayNegocio['valorEstimado'], 2, ',', '.'); ?></P>
				<div class="col-lg-12">
				<?php
					if($arrayNegocio['potencialVenda']=="0"){
						$potencialVenda= "danger";
					}
					else if($arrayNegocio['potencialVenda']=="1"){
						$potencialVenda= "warning";
					}
					else if($arrayNegocio['potencialVenda']=="2"){
						$potencialVenda= "primary";
					}
					else{
					}
				?>
				<div class="panel panel-default panel-<?php echo $potencialVenda; ?>"></div></div>
				</a>
			</div>
			<?php
				}
			}
			?>
		</div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
    $("#PesquisaCliente").autocomplete("buscaCliente.php", {
            width:310,
            selectFirst: false
        });
    });

</script>
<?php 
	include('../modal/modal-exclusao.php');
?>
<?php include(FOOTER_TEMPLATE); ?>
