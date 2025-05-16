<?php
    if (!class_exists('model')) {
        require_once 'model.php';
    }
    
    class Produto extends model{

        public function create($nome){
            $sql = 'Insert into produto (nome) values(:nome)';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":nome",$nome);
            $sql->execute();
            return $this->db->LastInsertId();
        }

        public function getAll(){
            $array = array();
            $sql = "SELECT * FROM PRODUTO ORDER BY nome asc";
            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function get($cod_produto){
            $array = array();
            $sql = "SELECT * FROM produto where cod_produto = :cod_produto";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_produto",$cod_produto);
            $sql->execute();
            if($sql->rowCount() > 0){
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function update($cod_produto,$nome){
                $sql = 'Update produto Set nome=:nome where cod_produto = :cod_produto';
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":nome",$nome);
                $sql->bindValue(":cod_produto",$cod_produto);
                $sql->execute();
        }


    }
?>