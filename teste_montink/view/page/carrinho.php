<html>
    <?php require_once(__DIR__.'/../component/head.php');?>
    <body>
        <?php 
            require_once(__DIR__.'/../component/menu.php'); 
            if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        ?>
        
            <table class="table table-secondary table-striped">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th></th>
                </tr>
                <?php 
                    $qtd_total = 0;
                    $preco_subtotal = 0;
                    foreach ($_REQUEST['carrinho'] as $item): 
                ?>
                    <tr>
                        <?php 
                            $qtd_total += $item['quantidade'];
                            $preco_subtotal += $item['preco'] * $item['quantidade'];
                        ?>
                        <td><?php echo $item['nome_item'] ?></td>
                        <td><?php echo $item['quantidade'] ?></td>
                        <td><?php echo "R$ " . number_format($item['preco'],2,",","."); ?></td>
                        <td class="text-center"><a class="btn btn-danger"href="index.php?class=Carrinho&action=removeItem&codigo_item=<?php echo $item['cod_item']?>">Remover</a></td>
                    </tr>
                <?php endforeach ?>  
                <tr>
                    <th>Subtotal</th>
                    <th><?php echo $qtd_total ?></th>
                    <th><?php echo "R$ " . number_format($preco_subtotal,2,",","."); ?></th>
                    <td></td>
                </tr>
                <tr>
                    <?php 
                        if ($preco_subtotal>52&&$preco_subtotal<169.59) {
                            $frete = 15;
                        }else if($preco_subtotal>200){
                            $frete = 0;
                        }else {
                            $frete = 20;
                        }
                    ?>
                    <th>Frete</th>
                    <th></th>
                    <th><?php echo "R$ " . number_format($frete,2,",","."); ?></th>
                    <td></td>
                </tr>
                <?php 
                    $desconto = 0;
                    if(isset($_REQUEST['cupom']) && !empty($_REQUEST['cupom'])){ 
                    $desconto = $_REQUEST['cupom']['valor_desconto']
                ?>
                    
                        <th>Desconto</th>
                        <th></th>
                        <th><?php echo "- R$ " . number_format($desconto,2,",","."); ?></th>
                        <td></td>
                <?php 
                    }
                ?>
                <tr>
                    <?php 
                        $preco_total = $preco_subtotal + $frete - $desconto;
                    ?>
                    <th>TOTAL</th>
                    <th></th>
                    <th><?php echo "R$ " . number_format($preco_total,2,",","."); ?></th>
                    <td></td>
                </tr>                                 
            </table>
                <div class="container">
                    <?php if (isset($_GET['erro_cupom'])) { ?>
                        <div class="text-center"><h4 class="text-danger"><?php echo $_GET['erro_cupom'];?></h4></div>
                    <?php } ?>
                    <form method='post' action="index.php?class=Cupom&action=validate" class="form-control">
                        <div class="row">
                            <div class="col-lg-3 col-md-12 col-sm-12 d-flex align-items-center">
                                <h4>Utilizar Cupom</h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label>Código do Cupom:</label>
                                <input type="text" name="codigo_desconto" required placeholder="Digite o código de desconto do cupom" class="form-control"
                                value ="<?php if (isset($_GET['codigo_desconto'])) echo $_GET['codigo_desconto']; ?>"
                                <?php if(isset($_REQUEST['cupom']) && !empty($_REQUEST['cupom'])) echo "disabled"?>>
                            </div>                  
                            <div class="col-lg-3 col-md-12 col-sm-12 d-flex align-items-end mt-3 ">
                                <button class="btn btn-primary" type="submit" <?php if(isset($_REQUEST['cupom']) && !empty($_REQUEST['cupom'])) echo "disabled"?>>Inserir Cupom</button>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="container">
                <?php if (isset($_GET['erro'])) { ?>
                    <div class="text-center"><h4 class="text-danger"><?php echo $_GET['erro'];?></h4></div>
                <?php } ?>
                <form method='post' action="index.php?class=Pedido&action=create" class="form-control">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 d-flex align-items-center">
                            <h4>Compra</h4>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label>CEP:</label>
                            <input type="text" name="cep" required placeholder="Digite o seu CEP" class="form-control" maxlength="8"
                            value ="<?php if (isset($_GET['cep'])) echo $_GET['cep']; ?>">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label>Email:</label>
                            <input type="email" name="email" required placeholder="Digite o seu email" class="form-control"
                            value ="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>">
                        </div>
                        
                        <div class="col-lg-3 col-md-12 col-sm-12 d-flex align-items-end mt-3 ">
                            <button class="btn btn-success" type="submit">Finalizar Compra</button>
                        </div>
                    </div>
                    <?php if(isset($_REQUEST['cupom']) && !empty($_REQUEST['cupom'])){ ?>
                        <input name= 'desconto' class= "invisible d-none" value = "<?php echo $_REQUEST['cupom']['valor_desconto']?>";>
                    <?php } ?>
                    
                </form>
            </div>
        <?php }else { ?>
            <h2 class="text-center mt-3">Carrinho Vazio</h2>
        <?php } ?>

    </body>
</html>