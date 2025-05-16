<?php
    if (!class_exists('model')) {
        require_once 'model.php';
    }

    class Estoque extends model{

        public function createVariacao($nome_variacao,$preco_variacao,$qtd_estoque,$cod_produto){
            if(isset($_POST['nome_variacao'])){
                $sql = 'Insert into estoque (nome_variacao,preco_variacao,qtd_estoque,cod_produto) values(:nome_variacao,:preco_variacao,:qtd_estoque,:cod_produto)';
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":nome_variacao",$nome_variacao);
                $sql->bindValue(":preco_variacao",$preco_variacao);
                $sql->bindValue(":qtd_estoque",$qtd_estoque);
                $sql->bindValue(":cod_produto",$cod_produto);
                $sql->execute();
                return $this->db->LastInsertId();
            }
        }

        public function getAllVariacaoOfProduto($cod_produto){
            
            $array = array();
            $sql = "SELECT * FROM ESTOQUE WHERE cod_produto = :cod_produto ORDER BY nome_variacao asc";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_produto",$cod_produto);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function getVariacao($cod_variacao){
            $array = array();
            $sql = "SELECT * FROM ESTOQUE where cod_variacao = :cod_variacao";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_variacao",$cod_variacao);
            $sql->execute();
            if($sql->rowCount() > 0){
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function update($cod_variacao,$nome_variacao,$preco_variacao,$qtd_estoque){
                $sql = 'Update ESTOQUE Set nome_variacao=:nome_variacao, preco_variacao=:preco_variacao, qtd_estoque=:qtd_estoque where cod_variacao = :cod_variacao';
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":nome_variacao",$nome_variacao);
                $sql->bindValue(":preco_variacao",$preco_variacao);
                $sql->bindValue(":qtd_estoque",$qtd_estoque);
                $sql->bindValue(":cod_variacao",$cod_variacao);
                $sql->execute();
        }

        public function reduceQtdEstoque($cod_variacao,$quantidade){
                $sql = 'Update ESTOQUE Set qtd_estoque = qtd_estoque - :quantidade where cod_variacao = :cod_variacao';
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":quantidade",$quantidade);
                $sql->bindValue(":cod_variacao",$cod_variacao);
                $sql->execute();
        }

    }