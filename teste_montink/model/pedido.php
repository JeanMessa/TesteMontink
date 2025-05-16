<?php
    if (!class_exists('model')) {
        require_once 'model.php';
    }

    Class Pedido extends model{
        public function create($preco_subtotal,$frete,$desconto,$email,$cep){
            $sql = 'Insert into pedido(preco_subtotal,frete,desconto,email,cep) values(:preco_subtotal,:frete,:desconto,:email,:cep) ';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":preco_subtotal",$preco_subtotal);
            $sql->bindValue(":frete",$frete);
            $sql->bindValue(":desconto",$desconto);
            $sql->bindValue(":email",$email);
            $sql->bindValue(":cep",$cep);
            $sql->execute();
            return $this->db->LastInsertId();
        }

        public function getAll(){
            $array = array();
            $sql = "SELECT * FROM PEDIDO ORDER BY cod_pedido asc";
            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function get($cod_pedido){
            $array = array();
            $sql = "SELECT * FROM PEDIDO where cod_pedido = :cod_pedido";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_pedido",$cod_pedido);
            $sql->execute();
            if($sql->rowCount() > 0){
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
            }
            return $array;
        }
    }
?>