<?php
session_start();
?>
<?php
require_once ('../config.php');
require_once(DBAPI);
require_once ("../inc/visibilidade-header.php");
?>
<?php
require_once('../controller/notificacaoController.php');
require_once('../controller/usuarioController.php');
require_once('../controller/negocioController.php');
require_once('../controller/atendimentosController.php');
pesquisaNotificacao('id_pai', $_SESSION['id_pai'], 'usuario_notificado', $_SESSION['id_usuario'], 'status', '1', 'ORDER BY id DESC');

?>              
<header>
<h2>Notificações</h2>
<div id="row">
	<div class="form-group col-md-1"></div>
	<div class="form-group col-md-2" align="left">Data</div>
	<div class="form-group col-md-2" align="left">Tipo</div>
	<div class="form-group col-md-3" align="left">Negócio</div>
	<div class="form-group col-md-3" align="left">Enviado por</div>
	<div class="form-group col-md-1" align="right">Visualizar</div>
</div>
<table id="tabela2" class="table table-hover">
	
	<?php
	if ($notificacoes) : 
		foreach ($notificacoes as $notificacao) :
			$tipoNotificacao =  $notificacao['tipo']; 
			if ($tipoNotificacao=='1') {
				$tipoNotificacao =  'Projeto novo no sistema'; 
			}
			elseif ($tipoNotificacao=='2') {
				$tipoNotificacao =  'Cotação nova no sistema'; 
			}
			$idUsuarioNotificador =  $notificacao['id_created']; 
			pesquisaUsuarioTres('id_pai', $_SESSION['id_pai'], 'id', $idUsuarioNotificador, 'deleted', '0');
			if ($usuarios) {
				foreach ($usuarios as $usuario) {
					$usuarioNotificador = $usuario['nome_usuario'];
				}
			}
			$idNegocio =  $notificacao['id_negocio']; 
			pesquisaNegocio('id_pai', $_SESSION['id_pai'], 'id', $idNegocio, 'deleted', '0');
			if ($negociacoes) {
				foreach ($negociacoes as $negociacao) {
					$nomeNegocio = $negociacao['nome'];
					$idAtendimento = $negociacao['id_atendimento'];
					$idEdicao = $negociacao['id_edicao'];
					$idEmpresa = $negociacao['id_empresa'];
				}
			}

			$idArquivo =  $notificacao['id_arquivo']; 
			$mensagem =  $notificacao['mensagem']; 

			$data_notificacao = $notificacao['created'];
			$date_arr= explode(" ", $data_notificacao);
			$date= $date_arr[0];						
			$explode = explode('-' ,$date);
			$data_notificacao = "".$explode[2]."/".$explode[1]."/".$explode[0];
			$time= $date_arr[1];
	?>
	<tr>
		<td>
			<div id="row">
				<div class="form-group col-md-1" align="left"><i class="fa fa-bell"></i></div>
				<div class="form-group col-md-2" align="left"><?php echo $data_notificacao." ".$time; ?></div>
				<div class="form-group col-md-2" align="left"><?php echo $tipoNotificacao; ?></div>
				<div class="form-group col-md-3" align="left"><?php echo $nomeNegocio; ?></div>
				<div class="form-group col-md-3" align="left"><?php echo $usuarioNotificador; ?></div>
				<div class="form-group col-md-1" align="right">
					<a href="<?php echo BASEURL; ?>negocio/index.php?id_negocio=<?php echo $idNegocio; ?>&id_atendimento=<?php echo $idAtendimento; ?>&id_empresa=<?php echo $idEmpresa; ?>&id_edicao=<?php echo $idEdicao; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
				</div>
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>

<?php include(FOOTER_TEMPLATE); ?>