<?php 
    $unidadeMedida = $produto['unidade_medida']; 
        switch ($unidadeMedida){
            case '1':
                $unidadeMedida = "unidade"; break;
            case '2':
                $unidadeMedida = "metro quadrado"; break;
            case '3':
                $unidadeMedida = "metro linear"; break;
        }
    $valorLocacao = "R$ ".number_format( $produto['valor_locacao'], 2, ',', '.');
    $valorCompra = "R$ ".number_format( $produto['valor_compra'], 2, ',', '.');
    pesquisaCategoria('id_pai', $_SESSION['id_pai'],'deleted', '0','id', $produto['id_categoria']);
    if ($categorias):
        foreach($categorias as $categoria):
            $categoria = $categoria['nome_categoria']; 
        endforeach;
    endif;
?>
<div class="modal fade" id="myModal<?php echo $produto['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?php echo $produto['nome_produto']; ?></h4>
            </div>
            <div class="modal-body">
                <p>Id: <b><?php echo $produto['id']; ?></b></p>
                <p>Categoria: <b><?php echo $categoria; ?></b></p>
				<p>Nome: <b><?php echo $produto['nome_produto']; ?></b></p>
                <p>Descrição: <b><?php echo $produto['descricao']; ?></b></p>
                <p>Medida: <b><?php echo $produto['medida']; ?></b></p>
                <p>Unidade de medida: <b><?php echo $unidadeMedida; ?></b></p>
                <p>Estoque minimo: <b><?php echo $produto['estoque']; ?></b></p>
                <p>valor locação: <b><?php echo $valorLocacao; ?></b></p>
                <p>Valor compra: <b><?php echo $valorCompra; ?></b></p>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            
        </div>
        
    </div>
</div>