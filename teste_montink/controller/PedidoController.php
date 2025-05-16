<?php
    require 'model/pedido.php';
    require 'model/itemPedido.php';
    require 'model/estoque.php';
    class PedidoController{
        
        public function create(){
            if(isset($_POST['cep'])){
                $cep = $_POST['cep'];
                $email = $_POST['email'];
                $response = file_get_contents('https://viacep.com.br/ws/'.$cep.'/json/');
                $response = json_decode($response);
                if (isset($response->cep)) {

                    $itens = array();
                    $preco_subtotal = 0;
                    session_start();
                    $quantidade_disponivel = true;
                    $estoque = new estoque();
                    foreach ($_SESSION['carrinho'] as $item) {
                        $variacao = $estoque->getVariacao($item['cod_variacao']);
                        $preco = $variacao['preco_variacao'];
                        $quantidade = $item['quantidade'];
                        if ($variacao['qtd_estoque']< $quantidade) {
                            $quantidade_disponivel = false;
                        }
                        $array = array('cod_variacao' => $item['cod_variacao'], 'quantidade' => $item['quantidade'], 'preco' => $preco);
                        $preco_subtotal += $preco * $quantidade;
                        array_push($itens,$array);
                    }

                    if ($quantidade_disponivel) {
                        if ($preco_subtotal>52&&$preco_subtotal<169.59) {
                        $frete = 15;
                        }else if($preco_subtotal>200){
                            $frete = 0;
                        }else {
                            $frete = 20;
                        }

                        if (isset($_POST['desconto'])) {
                            $desconto = $_POST['desconto'];
                        }else {
                            $desconto = 0;
                        }

                        $pedido = new pedido();
                        $cod_pedido = $pedido->create($preco_subtotal,$frete,$desconto,$email,$cep);
                        
                        $itemPedido = new ItemPedido;
                        foreach ($itens as $item) {
                            $itemPedido->create($cod_pedido,$item['cod_variacao'],$item['preco'],$item['quantidade']);
                            $estoque->reduceQtdEstoque($item['cod_variacao'],$item['quantidade']);
                        }

                        unset($_SESSION['carrinho']);

                        header("Location: index.php?class=Produto&action=getAll");
                    }else {
                        header("Location: index.php?class=Carrinho&action=list&cep=".$cep."&email=".$email."&erro=Um dos produtos em seu carrinho não possui mais essa quantidade em estoque.");
                    }
                    

                }else {
                    header("Location: index.php?class=Carrinho&action=list&cep=".$cep."&email=".$email."&erro=CEP Inválido.");
                }     
                
            }
        }

        public function getAll(){
            $pedido = new pedido();

            $_REQUEST['allPedidos'] = $pedido->getAll();
            require_once 'view/page/pedido.php';
        }

        public function getAllItemFromPedido(){
            require_once 'model/itemPedido.php';
            require_once 'model/produto.php';
            require_once 'model/estoque.php';

            $ItemPedido = new ItemPedido();

            if (isset($_GET['cod_pedido'])) {
                $cod_pedido = $_GET['cod_pedido']; 
                
                $itens = array();
                
                foreach ($ItemPedido->getAllItemByCodPedido($cod_pedido) as $item) {
                    $cod_variacao = $item['cod_variacao'];
                    $estoque = new estoque();
                    $variacao = $estoque->getVariacao($cod_variacao);
                    $produto = new produto;
                    $produto = $produto->get($variacao['cod_produto']);
                    $array = array('nome_item' => $produto['nome'] . " " . $variacao['nome_variacao'], 'quantidade' => $item['quantidade'], 'preco' => $item['preco']);
                    array_push($itens,$array);
                }


                
                $_REQUEST['allItem'] = $itens;

                $pedido = new Pedido;
                $_REQUEST['pedido'] = $pedido->get($cod_pedido);

                require_once 'view/page/pedido_detalhes.php';
            }
            
        }
    }
    
?>