<!-- MODAL NOVO NEG�CIO -->
<div class="modal fade" id="modalNovoContrato" tabindex="-1" role="dialog" aria-labelledby="modalNovoContratoLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalNovoContratoLabel">Curso</h4>
            </div>
            <div class="modal-body">
            <?php if (1== 0){ ?>

            <?php }  else{ ?>
            <form method="POST" action="" data-toggle="modal" data-target="#modalNovoContrato"  enctype="multipart/form-data">
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Nome negócio:</label>
                    <input name="negocio['nome']" type="text" class="form-control" value="" required>
                </div>
				<div class="form-group col-md-6">
                    <label for="recipient-name" class="control-label">Valor estimado:</label>
                    <input name="valor_estimado" type="text" class="form-control" id="valor" value="" placeholder="R$ 0,00" required>
                </div>
				<input name="negocio['id_empresa']" type="hidden" class="form-control" id="get-id" value="">
                <!--Footer-->
                <div class="modal-footer"   >
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </form>


            <?php } ?>



            </div>
            
        </div>
    </div>
</div>
                