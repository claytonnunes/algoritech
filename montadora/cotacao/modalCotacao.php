<div class="modal fade" id="cotacaoModal<?php echo $cotacao['numero_cotacao']; ?>" tabindex="-1" role="dialog" aria-labelledby="cotacaoModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="cotacaoModalLabel"><?php echo "COTAÇÃO: ".$cotacao['numero_cotacao']; ?></h4>
            </div>
            <?php 
           // $_SESSION['numero_cotacao'] = $cotacao['numero_cotacao'];
            pesquisaCotacao('numero_cotacao', $cotacao['numero_cotacao'], 'id_grupo_produto', $_REQUEST['id_negocio'], 'deleted', '0', 'ORDER BY id_cotacao DESC');
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-8"><b>Produto</b></div>
                    <div class="form-group col-md-1"><b>Qtda</b></div>
                    <div class="form-group col-md-3"><b>Total</b></div>
                </div>
                    
                <div class="row">
                    <?php 
                        if ($cotacoes) : 
                            foreach ($cotacoes as $cotacao) :
                                $cotacaoFinalizada = $cotacao['cotacao_finalizada'];
                                $quantidade = $cotacao['quantidade'];
                                $valorUnidade = $cotacao['valor_unidade'];
                                $descontoUnidade = $cotacao['valor_desconto'];
                                $somaDescontoQuantidade = $descontoUnidade * $quantidade;
                                
                                $somaDescontoTotal += $somaDescontoQuantidade;

                                $subTotal = $valorUnidade * $quantidade;
                                
                                $valorUnidadeTotal = $subTotal - $somaDescontoQuantidade;

                                $somaTotal += $subTotal;
                                $somaTotalCobrado  = $somaTotal - $somaDescontoTotal;



                    ?>
                    <div class="form-group col-md-8"><?php echo $cotacao['nome_produto']; ?></div>
                    <div class="form-group col-md-1"><?php echo $cotacao['quantidade']; ?></div>
                    <div class="form-group col-md-3"><?php echo number_format($valorUnidadeTotal, 2, ',', '.'); ?></div>
                    <?php
                            endforeach; 
                        endif; 
                    ?>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-4">Valor total:</div>
                    <div class="form-group col-md-8">R$ <?php echo number_format($somaTotalCobrado, 2, ',', '.'); ?></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                    <?php   if ($cotacaoFinalizada == '1') :  ?>
                    <a class="btn btn-success" href="<?php echo "../cotacao/gerarPdfCotacao.php?acao=gerarPdf&numero_cotacao=".$cotacao['numero_cotacao']."&id_empresa=".$_REQUEST['id_empresa']."&id_atendimento=".$_REQUEST['id_atendimento']."&id_negocio=".$_REQUEST['id_negocio']."" ?>" target="_blank" class="card-link"><i class="fa fa-download"></i> Pdf</a>
                    <?php endif;  ?>
                </div>
            </div>
            
        </div>
        
    </div>
</div>