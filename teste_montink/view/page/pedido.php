<html>
    <?php require_once(__DIR__.'/../component/head.php');?>
    <body>
        <?php 
            require_once(__DIR__.'/../component/menu.php'); 
            if (isset($_REQUEST['allPedidos']) && !empty($_REQUEST['allPedidos'])) {
                $allPedidos = $_REQUEST['allPedidos'];
        ?>
                <table class="table table-secondary table-striped">
                    <tr>
                        <th>Preço Total</th>
                        <th>Email</th>
                        <th>CEP</th>
                        <th>Detalhes</th>
                    </tr>
                    <?php foreach ($_REQUEST['allPedidos'] as $pedido): ?>
                        <tr>
                            <?php 
                                $preco_total = $pedido['preco_subtotal'] + $pedido['frete'] - $pedido['desconto'];
                            ?>
                            <td><?php echo "R$ " . number_format($preco_total,2,",",".") ?></td>
                            <td><?php echo $pedido['email'] ?></td>
                            <td><?php echo $pedido['cep'] ?></td>
                            <th><a href="index.php?class=pedido&action=getAllItemFromPedido&cod_pedido=<?php echo $pedido['cod_pedido']?>">Verificar Detalhes</a></th>
                        </tr>
                    <?php endforeach ?>                           
                </table>
        <?php 
            }else { 
        ?>
            <h2 class="text-center mt-3">Pedidos Vazio</h2>
        <?php } ?>
    </body>
</html>