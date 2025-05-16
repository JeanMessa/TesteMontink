<html>
    <?php
        require_once(__DIR__.'/../component/head.php');
        if (isset($_REQUEST['produto'])) {
            $produto = $_REQUEST['produto'];
            $produtoAction = "update&cod_produto=".$produto["cod_produto"];
            if (isset($_REQUEST['variacao'])) {
                $variacao = $_REQUEST['variacao'];
                $variacaoAction = "update&cod_variacao=".$variacao["cod_variacao"];
            }else {
                $variacao = NULL;
                $variacaoAction = "createVariacao";
                if (isset($_REQUEST['allVariacao'])) {
                    $allVariacao = $_REQUEST['allVariacao'];
                }
            }
        }else {
            $produto = NULL;
            $produtoAction = "create";
            if (isset($_REQUEST['allProdutos'])) {
                $allProdutos = $_REQUEST['allProdutos'];
            }
        }

        //print_r($produto);
        //print_r($variacao);
        //print_r($allVariacao);
        //print_r($_SESSION);
    ?>
    <body>
        <?php require_once(__DIR__.'/../component/menu.php'); ?>
        <div class="container pt-3">
            <?php if(!isset($produto)){ ?>
                <form method='post' action="index.php?class=Produto&action=get" class="form-control">  
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12" >
                                <h3>Selecionar Produto</h3>
                            </div>  
                            <div class="col-lg-4 col-md-6 col-sm-12" >
                                <div class="input-group">
                                    <select class="form-select" name="cod_produto">
                                    <?php foreach ($allProdutos as $item): ?>
                                        <option value="<?php echo $item['cod_produto'] ?>"><?php echo $item['nome'] ?></option>
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
            <form method='post' action="index.php?class=Produto&action=<?php echo $produtoAction ?>" class="form-control">
                <div class="container">
                    <h3><?php if (!isset($produto)) echo "Cadastrar Produto"; else echo "Produto Selecionado"; ?></h3>
                    <label>Nome:</label>
                    <input type="text" name="nome" required placeholder="Digite o nome comercial do produto" class="form-control"
                    value ="<?php if (isset($produto)) echo $produto['nome']; ?>">
                    <div class="text-end mt-3">
                        <?php if (isset($produto)){ ?> 
                            <a class="btn btn-primary btn-lg" href="index.php">Limpar Produto</a>
                        <?php } ?>
                        <button class="btn btn-success btn-lg" type="submit">
                            <?php if (!isset($produto)) echo "Cadastrar Produto"; else echo "Atualizar Produto"; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <?php if(isset($produto)){ ?>
            <div class="container">
                <h3>Estoque e Variação</h3>
                <?php if(!isset($variacao)){ ?>
                    <?php if (isset($allVariacao) && !empty($allVariacao)) { ?>
                        <form method='post' action="index.php?class=Estoque&action=getVariacao&cod_produto=<?php echo $produto['cod_produto'] ?>"  class="form-control">  
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12" >
                                        <h3>Selecionar Variacao</h3>
                                    </div>  
                                    <div class="col-lg-4 col-md-6 col-sm-12" >
                                        <div class="input-group">
                                        <select class="form-select" name="cod_variacao">
                                        <?php foreach ($allVariacao as $item): ?>
                                            <option value="<?php echo $item['cod_variacao'] ?>"><?php echo $item['nome_variacao'] ?></option>
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
                <?php } ?>
                <form method='post' action="index.php?cod_produto=<?php echo $produto['cod_produto'] ?>&class=Estoque&action=<?php echo $variacaoAction ?>" class="form-control">
                    <div class = "container">
                        <h3><?php if (!isset($variacao)) echo "Cadastrar Variação"; else echo "Variação Selecionada"; ?></h3>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-6 col-sm-12" >
                                <label>Nome da Variação:</label>
                                <input type="text" name="nome_variacao" required placeholder="Digite o nome da variação do produto" class="form-control"
                                value ="<?php if (isset($variacao)) echo $variacao['nome_variacao']; ?>">
                            </div>    
                            <div class="col-lg-4 col-md-6 col-sm-12" >
                                <label>Quantidade em Estoque:</label>
                                <input type="number" name="qtd_estoque" required placeholder="Digite a quantidade da variação em estoque" class="form-control" step="1"
                                value ="<?php if (isset($variacao)) echo $variacao['qtd_estoque']; ?>">
                            </div> 
                            <div class="col-lg-4 col-md-6 col-sm-12" >
                                <label>Preço (R$):</label>
                                <input type="number" name="preco_variacao" required placeholder="Digite o preço da variação" class="form-control" step="00.01"
                                value="<?php if (isset($variacao)) echo $variacao['preco_variacao']; ?>">
                            </div>          
                        </div>
                        <div class="text-end">
                            <?php if (isset($variacao)){ ?> 
                                <a class="btn btn-primary btn-lg" href="index.php?class=Produto&action=get&cod_produto=<?php echo $produto['cod_produto'] ?>">Limpar Variação</a>
                            <?php } ?>
                            <button class="btn btn-success btn-lg" type="submit">
                                <?php if (!isset($variacao)) echo "Cadastrar Variação"; else echo "Atualizar Variação"; ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php if (isset($variacao)) { ?>
                <div class="container">
                <form method='post' action="index.php?class=Carrinho&action=addItem&cod_variacao=<?php echo $variacao['cod_variacao'] ?>" class="form-control">  
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12" >
                                    <h3>Adicionar ao Carrinho</h3>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-end" >
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 d-flex align-items-center justify-content-end" >
                                            <label>Quantidade:</label>
                                        </div>    
                                        <div class="col-lg-3 col-md-3 col-sm-3" >
                                            <input type="number" name="quantidade" required class="form-control" value='1' min='1' max=<?php echo $variacao['qtd_estoque']?>>
                                        </div>  
                                        <div class="col-lg-6 col-md-6 col-sm-6" >
                                            <button class="btn btn-primary" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                                                </svg>+
                                            </button>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </form>
                </div>    
            <?php } ?>                            

        <?php } ?>
    </body>
</html>