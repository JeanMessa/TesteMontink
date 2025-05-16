<?php
    if (!class_exists('model')) {
        require_once 'model.php';
    }

    Class ItemPedido extends model{
        public function create($cod_pedido,$cod_variacao,$preco,$quantidade){
            $sql = 'Insert into item_pedido(cod_pedido,cod_variacao,preco,quantidade) values(:cod_pedido,:cod_variacao,:preco,:quantidade)';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_pedido",$cod_pedido);
            $sql->bindValue(":cod_variacao",$cod_variacao);
            $sql->bindValue(":preco",$preco);
            $sql->bindValue(":quantidade",$quantidade);
            $sql->execute();
            return $this->db->LastInsertId();
        }

        public function getAllItemByCodPedido($cod_pedido){
            $array = array();
            $sql = "SELECT * FROM ITEM_PEDIDO WHERE cod_pedido = :cod_pedido ORDER BY cod_pedido asc";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_pedido",$cod_pedido);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $array;
        }
    }
?>