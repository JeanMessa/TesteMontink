<?php
    require_once 'model/Estoque.php';
    require_once 'model/Produto.php';
    
    class EstoqueController {

        public function createVariacao(){
            if(isset($_POST['nome_variacao'])){
                $nome_variacao = $_POST['nome_variacao'];
                $preco_variacao = floatval($_POST['preco_variacao']);
                $qtd_estoque = floatval($_POST['qtd_estoque']);
                $cod_produto = $_GET['cod_produto'];
                $estoque = new estoque();
                $cod_variacao = $estoque->createVariacao($nome_variacao,$preco_variacao,$qtd_estoque,$cod_produto);              
                $produto = new produto();
                $_REQUEST['produto'] = $produto->get($cod_produto);
                $_REQUEST['variacao'] = $estoque->getVariacao($cod_variacao);
                require_once 'view/page/main_page.php';
            }
        }

        public function getVariacao() {
            $estoque = new Estoque();
            
            if(isset($_POST['cod_variacao'])){
                $produto = new Produto();
                $cod_produto = $_GET['cod_produto'];
                $_REQUEST['produto'] = $produto->get($cod_produto);
                $cod_variacao = $_POST['cod_variacao'];
                $_REQUEST['variacao'] =  $estoque->getVariacao($cod_variacao);
                require_once 'view/page/main_page.php';
            }

        }

        public function update(){
            if(isset($_POST['nome_variacao']) && isset($_GET['cod_variacao'])){
                $cod_variacao = $_GET['cod_variacao'];
                $nome_variacao = $_POST['nome_variacao'];
                $preco_variacao = floatval($_POST['preco_variacao']);
                $qtd_estoque = floatval($_POST['qtd_estoque']);
                $cod_produto = $_GET['cod_produto'];
                
                $estoque = new estoque();
                $estoque->update($cod_variacao,$nome_variacao,$preco_variacao,$qtd_estoque);

                $produto = new produto();
                $_REQUEST['produto'] = $produto->get($cod_produto);
                $_REQUEST['variacao'] = $estoque->getVariacao($cod_variacao);
                require_once 'view/page/main_page.php';
            }
        }

        

    }
?>