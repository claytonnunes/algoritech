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
pesquisaProduto('id_pai', $_SESSION['id_pai'], 'deleted', '0' )
?>              
<header>
<div class="container">
	<div class="col-xs-3">
		<h4>PRODUTO</h4>
	</div>
	<div class="col-xs-9 floa" align="right">
		<a class="btn btn-primary" href="<?php echo BASEURL; ?>produto/add.php"><i class="fa fa-plus"></i> Novo produto</a>
	</div>
</div>
<table id="tabela2" class="table table-hover">
	
	<?php
	if ($produtos) : 
		foreach ($produtos as $produto) :
	?>
	<tr>
		<td>
			<div id="row">
				<div class="form-group col-md-11" align="left"><i class="fa fa-comments fa-2x"></i>produto</div>
				<div class="form-group col-md-1" align="right">
					<a href="<?php echo BASEURL; ?>briefing/view.php?id_briefing=<?php echo $produto['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
				</div>
			</div>
		</td>
                      
	</tr>
	<?php endforeach; ?>          
	<?php endif; ?>
</table>

<?php include(FOOTER_TEMPLATE); ?>