<?php
    require_once 'model/Cupom.php';
    
    class CupomController {

        public function create(){
            if(isset($_POST['codigo_desconto'])){
                $codigo_desconto = $_POST['codigo_desconto'];
                $valor_desconto = $_POST['valor_desconto'];
                $validade = $_POST['validade'];
                $valor_minimo = $_POST['valor_minimo'];

                $cupom = new cupom();
                $cod_cupom = $cupom->create($codigo_desconto,$valor_desconto,$validade,$valor_minimo);

                $_REQUEST['cupom'] = $cupom->get($cod_cupom);
                require_once 'view/page/cupom.php';
            }
        }

        public function getAll(){
            $cupom = new cupom();

            $_REQUEST['allCupom'] = $cupom->getAll();

            require_once 'view/page/cupom.php';
        }

        public function get() {
            $cupom = new cupom();
            
            if (isset($_POST['cod_cupom'])) {
                $cod_cupom = $_POST['cod_cupom'];

                $_REQUEST['cupom'] =  $cupom->get($cod_cupom);

                require_once 'view/page/cupom.php';
            }     
        }

        public function update(){
            if(isset($_POST['codigo_desconto'])  && isset($_GET['cod_cupom'])){
                $cod_cupom = $_GET['cod_cupom'];
                $codigo_desconto = $_POST['codigo_desconto'];
                $valor_desconto = $_POST['valor_desconto'];
                $validade = $_POST['validade'];
                $valor_minimo = $_POST['valor_minimo'];

                $cupom = new cupom();
                $cupom->update($cod_cupom,$codigo_desconto,$valor_desconto,$validade,$valor_minimo);

                $_REQUEST['cupom'] = $cupom->get($cod_cupom);
                require_once 'view/page/cupom.php';
            }
        }

        public function validate(){
            $cupom = new cupom();
            
            if (isset($_POST['codigo_desconto'])) {
                $codigo_desconto = $_POST['codigo_desconto'];

                $cupom =  $cupom->getByCodigoDesconto($codigo_desconto);
                if (empty($cupom) || $cupom['validade']<date("Y-m-d H:i:s")) {
                    header("Location: index.php?class=Carrinho&action=list&codigo_desconto=".$codigo_desconto."&erro_cupom= Cupom Inválido.");
                }else {
                    header("Location: index.php?class=Carrinho&action=list&codigo_desconto=".$codigo_desconto);
                }
                
            }
        }

    }
?>