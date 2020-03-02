<?php
require_once('../controller/empresasController.php');
require_once('../controller/atendimentosController.php');
require_once('../controller/eventosController.php');
findAtendimentoId();
findEvento();

visualizarEmpresa($_GET['id_empresa']);
// Se não tiver evento cadastrado redireciona
if ($eventos == 0 ) :
 header('location: ../eventos/add.php?msg=semevento');
  $_SESSION['message'] = 'Banco de dados sem evento cadastrado!! Cadastre um evento.';
        $_SESSION['type'] = 'danger';
endif;

if($_REQUEST['salvaratendimento']):
	if($_REQUEST['comentario']==""){		
		$mensagem = "Escreva um comentário";		
	}
	else if($_REQUEST['proxima_data']==""){
		$mensagem = "Selecione a proxima data";
	}	
	
	else if($_SESSION['sess_fair']==""){
		$mensagem = "Selecione o Evento";
	}
	else{
		$mensagem = "Comentário registrada com sucesso";
		salvarAtendimento();
	}
	 
	endif;	

?>

<?php
require_once ('../config.php');
require_once ("../inc/visibilidade-header.php");
?>

    <h2>Empresa <?php // echo $_REQUEST['id']; ?></h2>
    <hr>

	<?php if (!empty($_REQUEST['salvaratendimento'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $mensagem; 
		
		?></div>
    <?php endif; ?>

<?php if(0==1): ?>
	<?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php // echo $_SESSION['message']; 
		
		?></div>
    <?php endif; ?>
<?php endif; ?>

    <div class="row">
        <div class="form-group col-md-4">
            <dl class="dl-horizontal">
                <dt>Nome Fantasia:</dt>
                <dd><?php echo utf8_encode($empresa['nome_fantasia']); ?></dd>
                <dt>Nome / Razão Social:</dt>
                <dd><?php echo utf8_encode($empresa['razao_social']); ?></dd>
                <dt>Fone:</dt>
                <dd><?php echo $empresa['fone']; ?></dd>
                <dt>CNPJ:</dt>
                <dd><?php echo $empresa['cnpj']; ?></dd>
                <dt>CEP:</dt>
                <dd><?php echo $empresa['cep']; ?></dd>
                <dt>Criado:</dt>
                <dd><?php echo $empresa['created']; ?></dd>
            </dl>
            <a href="../empresas/edit.php?id=<?php echo $empresa['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
        </div>
        
        <div class="form-group col-md-4">
            <dl class="dl-horizontal">    
                <dt>Endereço:</dt>
                <dd><?php echo utf8_encode($empresa['endereco']); ?></dd>
                <dt>Bairro:</dt>
                <dd><?php echo utf8_encode($empresa['bairro']); ?></dd>
                <dt>Cidade:</dt>
                <dd><?php echo utf8_encode($empresa['cidade']); ?></dd>
                <dt>Estado:</dt>
                <dd><?php echo utf8_encode($empresa['estado']); ?></dd>
                <dt>Website:</dt>
                <dd><?php echo utf8_encode($empresa['website']); ?></dd>            
            </dl>
        </div>
    </div>          
    <h2>Contato </h2>
    <hr />
    <div class="row">
        <div class="form-group col-md-4">
            <dl class="dl-horizontal">
                <dt>Nome:</dt>
                <dd><?php echo utf8_encode($contato['nome']); ?></dd>
                <dt>Função:</dt>
                <dd><?php echo utf8_encode($contato['funcao']); ?></dd>
                <dt>E-mail:</dt>
                <dd><?php echo utf8_encode($contato['email']); ?></dd>
                <dt></dt>
                <dd><?php // echo $empresa['razao_social']; ?></dd>
                
             </dl> 
             <a href="../contatos/edit.php?id=<?php echo $contato['id']; ?>&id_company=<?php echo $empresa['id']; ?>"" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
             
             
             <?php if(0==1): ?>
             <a href="<?php echo BASEURL; ?>contatos/edit.php?id=<?php echo $contato['../empresas/id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>  
             <a class="btn btn-sm btn-primary" href="<?php echo BASEURL; ?>contatos/add.php?id_empresa=<?php  echo urlencode( $empresa['id']); ?>"><i class="fa fa-plus"></i> Novo Contato</a>
             <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
            <dl class="dl-horizontal">
                <dt>Fone:</dt>
                <dd><?php echo $contato['fone2']; ?></dd>
                <dt>Celular:</dt>
                <dd><?php echo $contato['celular']; ?></dd>        
            </dl>
        </div>
    </div>    
   <h2>Atendimento</h2>

    <form id="formEmpresa" name="formEmpresa" action="../empresas/view.php?salvaratendimento=1&id_empresa=<?php echo $_REQUEST['id_empresa'];?>&id_atendimento=<?php echo $_REQUEST['id_atendimento'];?>" method="post">
        <!-- area de campos do form -->
        <hr />
         
        <div class="row">
                <div class="form-group col-md-4">
                    <label for="exampleTextarea"></label>
                    <textarea class="form-control" id="exampleTextarea" rows="4" name="comentario" placeholder="Descreva o seu comentário..." required ></textarea>
                </div>
                
                <div class="form-group col-md-3">
                        <label class="control-label"> 
    </label>
                                <div class="input-group date">
                                <input type="text" class="form-control" id="exemplo" name="proxima_data" placeholder="Proxima data..." required >
    
                                    <div class="input-group-addon">
	                                    <span class="glyphicon glyphicon-th"></span>
                                    </div>
        						</div>
    			</div>
                
                <div class="btn-group">
  					<label for="name">Estado</label>
                <!--                <input type="text" class="form-control" name="empresa['estado']">-->
                <select name="posicao" class="form-control" id="posicao" required >
                    <option value="" selected="selected">Selecione a Posição</option>
                    <option value="1">Captação</option>
                    <option value="2">Orçamento Enviado</option>
                    <option value="3">Alinhando Contrato</option>
                    <option value="4">Contrato Assinado</option>
                    <option value="5">Negativado</option>
                    
                </select>         
				</div>
            <div id="actions" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                <a href="../empresas/index.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
        
        </br>
        <h2>Histórico </h2>
        <hr />
         <div id="divConteudo2">
        <table id="tabela2" class="table table-hover">
            <thead>
<!--            <tr>-->
<!--                <th>Filtro por Empresa:</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th><input type="text" class="form-control" id="txtColuna2"/></th>-->
<!--            </tr>-->
            <tr>
                <th width="10%">Data:</th>            
                <th width="30%">Comentário:</th>
                <th width="10%">Situação</th>
              <th width="10%">Proximo Contato</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($atendimentos) : ?>
                <?php foreach ($atendimentos as $atendimento) : ?>                    <tr>
                    	<td><?php 
						$data_comentario = $atendimento['created'];
						$date_arr= explode(" ", $data_comentario);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$data_comentario = "".$explode[2]."-".$explode[1]."-".$explode[0];
		
						
						$time= $date_arr[1];
						
						
						echo "$data_comentario $time"; ?></td>
                        <td><?php echo utf8_encode($atendimento['comentario']); ?></td>
                        <td><?php 
						$situacao = $atendimento['posicao'];
						if($situacao==0){
								$situacao = "captação";
							}
							else if ($situacao==1){
								$situacao = "Negociação";
							}
							else if ($situacao==2){
								$situacao = "Expositor";
							}
							else if ($situacao==3){
								$situacao = "Negativado";
							}
							else{
								$situacao = "Indefinido";
								}
						
						echo $situacao; ?></td>
                        <td><?php 						
						$proximo_data = $atendimento['proxima_data'];
						$date_arr= explode(" ", $proximo_data);
						$date= $date_arr[0];
						
						$explode = explode('-' ,$date);
						$proximo_data = "".$explode[2]."-".$explode[1]."-".$explode[0];
						$time= $date_arr[1];
						echo $proximo_data; ?></td>                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Nenhum atendimento cadastrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
        
            </form>
            <script type="text/javascript">
			$('#exemplo').datepicker({	
				format: "dd/mm/yyyy",	
				language: "pt-BR",
				startDate: '+0d',
			});
		</script>

<?php include(FOOTER_TEMPLATE); ?>