<!-- Modal de Delete-->

<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="modalExcluirLabel">Excluir Empresa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" action=<?php echo "index.php?acao=excluirContatoEmpresa&id=".$_REQUEST['id']."&nome_fantasia=".$_REQUEST['nome_fantasia']."" ?> enctype="multipart/form-data">
                Deseja realmente excluir este registro?
            </div>
            <input name="id" type="hidden" class="form-control" id="get-id" value="">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">não</button>
                <button type="submit" class="btn btn-primary" name="excluirContatoEmpresa" >Sim</button>
                
	<!-- Mensagem para EXCLUIR 10/03/2020-->
                </form>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
