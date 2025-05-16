<html>
    <?php
        require_once(__DIR__.'/../component/head.php');
        if (isset($_REQUEST['cupom'])) {
            $cupom = $_REQUEST['cupom'];
            $cupomAction = "update&cod_cupom=".$cupom["cod_cupom"];
        }else {
            $cupom = NULL;
            $cupomAction = "create";
            if (isset($_REQUEST['allCupom'])) {
                $allCupom = $_REQUEST['allCupom'];
            }
        }


    ?>
    <body>
        <?php require_once(__DIR__.'/../component/menu.php'); ?>
        <div class="container pt-3">
            <?php if(!isset($cupom)){ ?>
                <form method='post' action="index.php?class=Cupom&action=get" class="form-control">  
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12" >
                                <h3>Selecionar Cupom</h3>
                            </div>  
                            <div class="col-lg-4 col-md-6 col-sm-12" >
                                <div class="input-group">
                                    <select class="form-select" name="cod_cupom">
                                    <?php foreach ($allCupom as $item): ?>
                                        <option value="<?php echo $item['cod_cupom'] ?>><?php echo $item['codigo_desconto'] ?>"> </option>
                                    <?php endforeach ?>        
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12" >
                                <button class="btn btn-primary" type="submit">Selecionar</button>
                            </div>
                        </div>  
                             
                    </div>
                </form>
            <?php } ?>
            <form method='post' action="index.php?class=Cupom&action=<?php echo $cupomAction ?>" class="form-control">
                <div class="container">
                    <h3><?php if (!isset($cupom)) echo "Cadastrar Cupom"; else echo "Cupom Selecionado"; ?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <label>Código do Cupom:</label>
                            <input type="text" name="codigo_desconto" required placeholder="Digite o código de desconto do cupom" class="form-control"
                            value ="<?php if (isset($cupom)) echo $cupom['codigo_desconto']; ?>">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <label>Valor do Desconto(R$):</label>
                            <input type="number" name="valor_desconto" required placeholder="Digite o valor de desconto do cupom" class="form-control" step="00.01"
                            value="<?php if (isset($cupom)) echo $cupom['valor_desconto']; ?>">
                        </div>     
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <label>Validade:</label>
                            <input type="date" name="validade" required class="form-control"
                            value ="<?php if (isset($cupom)) echo $cupom['validade']; ?>">
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <label>Valor Mínimo da Compra (R$):</label>
                            <input type="number" name="valor_minimo" required placeholder="Digite o valor mínimo da compra do cupom" class="form-control" step="00.01"
                            value="<?php if (isset($cupom)) echo $cupom['valor_minimo']; ?>">
                        </div>          
                    </div>
                    <div class="text-end">
                        <?php if (isset($cupom)){ ?> 
                            <a class="btn btn-primary btn-lg" href="index.php?class=cupom&action=getAll">Limpar Cupom</a>
                        <?php } ?>
                        <button class="btn btn-success btn-lg" type="submit">
                            <?php if (!isset($cupom)) echo "Cadastrar Cupom"; else echo "Atualizar Cupom"; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>