<?php
    require_once 'model/Estoque.php';
    require_once 'model/Produto.php';

    class CarrinhoController{

        public function addItem(){
            session_start();
            $cod_variacao = $_GET['cod_variacao'];

            if(!isset($_SESSION['carrinho'])){
                $_SESSION['carrinho'] = array(); 
            }

            $item_ja_adicionado = -1;
            foreach ($_SESSION['carrinho'] as $key => $item) {
                if ($cod_variacao == $item['cod_variacao']) {
                    $item_ja_adicionado = $key;
                }
            }

            if ($item_ja_adicionado<0) {
                $array = array('cod_variacao' => $cod_variacao, 'quantidade' => $_POST['quantidade']);
                array_push($_SESSION['carrinho'],$array);
            }else {
                $_SESSION['carrinho'][$key]['quantidade'] += $_POST['quantidade'];
            }
           

            $estoque = new estoque();
            $estoque =  $estoque->getVariacao($cod_variacao);
            $_REQUEST['variacao'] =  $estoque;

            $cod_produto = $estoque['cod_produto'];
            $produto = new produto;
            $_REQUEST['produto'] =  $produto->get($cod_produto);

            require_once 'view/page/main_page.php';
        }
        
        public function list(){
            $_REQUEST['carrinho'] = array();
            if (!isset($_SESSION)){
                session_start();
            }
            if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                foreach ($_SESSION['carrinho'] as $key => $item) {
                    $cod_variacao = $item['cod_variacao'];
                    $estoque = new estoque();
                    $variacao = $estoque->getVariacao($cod_variacao);
                    $produto = new produto;
                    $produto = $produto->get($variacao['cod_produto']);
                    $array = array('cod_item'=>$key,'nome_item' => $produto['nome'] . " " . $variacao['nome_variacao'], 'quantidade' => $item['quantidade'], 'preco' => $variacao['preco_variacao']);
                    array_push($_REQUEST['carrinho'],$array);
                }
                if (isset($_GET['codigo_desconto']) && !isset($_GET['erro_cupom'])) {
                    require_once 'model/cupom.php';
                    $cupom = new cupom();
                    $_REQUEST['cupom'] = $cupom->getByCodigoDesconto($_GET['codigo_desconto']);
                }
            }
            require_once 'view/page/carrinho.php';
        }

        public function removeItem(){
            $codigo_item = $_GET['codigo_item'];
            if (!isset($_SESSION)){
                session_start();
            }

            if(isset($codigo_item)){
                unset($_SESSION['carrinho'][$codigo_item]);
            }
        }

        
    }
