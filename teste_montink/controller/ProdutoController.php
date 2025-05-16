<?php
    require_once 'model/Produto.php';
    
    class ProdutoController {

        public function create(){
            if(isset($_POST['nome'])){
                $nome = $_POST['nome'];
                $produto = new Produto();
                $cod_produto = $produto->create($nome);

                $_REQUEST['produto'] = $produto->get($cod_produto);
                require_once 'view/page/main_page.php';
            }
        }

        public function getAll() {
            $produto = new produto();

            $_REQUEST['allProdutos'] = $produto->getAll();

            require_once 'view/page/main_page.php';
        }

        
        public function get() {
            $produto = new produto();
            
            if(isset($_GET['cod_produto'])){
                $cod_produto = $_GET['cod_produto'];
            }else if (isset($_POST['cod_produto'])) {
                $cod_produto = $_POST['cod_produto'];
            }

            
            $_REQUEST['produto'] =  $produto->get($cod_produto);
            require_once 'model/Estoque.php';
            $estoque = new Estoque();
            $_REQUEST['allVariacao'] = $estoque->getAllVariacaoOfProduto($cod_produto);

            require_once 'view/page/main_page.php';
            
        }

        public function update(){
            if(isset($_POST['nome']) && isset($_GET['cod_produto'])){
                $nome = $_POST['nome'];
                $cod_produto = $_GET['cod_produto'];
                $produto = new Produto();
                $produto->update($cod_produto,$nome);
                $_REQUEST['produto'] = $produto->get($cod_produto);
                require_once 'view/page/main_page.php';
            }
        }
        
    }

?>