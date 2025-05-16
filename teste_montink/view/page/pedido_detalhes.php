<html>
    <?php require_once(__DIR__.'/../component/head.php');?>
    <body>
        <?php 
            require_once(__DIR__.'/../component/menu.php'); 
            if (isset($_REQUEST['allItem']) && !empty($_REQUEST['allItem'] && isset($_REQUEST['pedido']))) {
                $pedido = $_REQUEST['pedido'];
                $qtd_total = 0;
        ?>
            <table class="table table-secondary table-striped">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </tr>
                <?php foreach ($_REQUEST['allItem'] as $item): ?>
                    <tr>
                        <?php 
                            $qtd_total += $item['quantidade'];
                        ?>
                        <td><?php echo $item['nome_item'] ?></td>
                        <td><?php echo $item['quantidade'] ?></td>
                        <td><?php echo "R$ " . number_format($item['preco'],2,",","."); ?></td>
                    </tr>
                <?php endforeach ?>  
                <tr>
                    <th>Subtotal</th>
                    <th><?php echo $qtd_total ?></th>
                    <th><?php echo "R$ " . number_format($pedido['preco_subtotal'],2,",","."); ?></th>
                </tr>
                <tr>
                    <th>Frete</th>
                    <th></th>
                    <th><?php echo "R$ " . number_format($pedido['frete'],2,",","."); ?></th>
                </tr>                  
                    <th>Desconto</th>
                    <th></th>
                    <th><?php echo "- R$ " . number_format($pedido['desconto'],2,",","."); ?></th>
                
                <tr>
                    <?php 
                        $preco_total = $pedido['preco_subtotal'] + $pedido['frete'] - $pedido['desconto'];
                    ?>
                    <th>TOTAL</th>
                    <th></th>
                    <th><?php echo "R$ " . number_format($preco_total,2,",","."); ?></th>
                </tr>                                 
            </table>
        <?php 
            }
        ?>
    </body>
</html>