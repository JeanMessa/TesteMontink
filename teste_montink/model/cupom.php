<?php
    if (!class_exists('model')) {
        require_once 'model.php';
    }
    
    class Cupom extends model{

        public function create($codigo_desconto,$valor_desconto,$validade,$valor_minimo){
            $sql = 'Insert into CUPOM (codigo_desconto,valor_desconto,validade,valor_minimo) values(:codigo_desconto,:valor_desconto,:validade,:valor_minimo)';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":codigo_desconto",$codigo_desconto);
            $sql->bindValue(":valor_desconto",$valor_desconto);
            $sql->bindValue(":validade",$validade);
            $sql->bindValue(":valor_minimo",$valor_minimo);
            $sql->execute();
            return $this->db->LastInsertId();
        }

        public function getAll(){
            

            $array = array();
            $sql = "SELECT * FROM CUPOM ORDER BY codigo_desconto asc";
            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function get($cod_cupom){
            $array = array();
            $sql = "SELECT * FROM CUPOM where cod_cupom = :cod_cupom";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cod_cupom",$cod_cupom);
            $sql->execute();
            if($sql->rowCount() > 0){
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function getByCodigoDesconto($codigo_desconto){
            $array = array();
            $sql = "SELECT * FROM CUPOM where codigo_desconto = :codigo_desconto";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":codigo_desconto",$codigo_desconto);
            $sql->execute();
            if($sql->rowCount() > 0){
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
            }
            return $array;
        }

        public function update($cod_cupom,$codigo_desconto,$valor_desconto,$validade,$valor_minimo){
            $sql = 'Update CUPOM Set codigo_desconto=:codigo_desconto, valor_desconto=:valor_desconto, validade=:validade, valor_minimo=:valor_minimo where cod_cupom = :cod_cupom';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":codigo_desconto",$codigo_desconto);
            $sql->bindValue(":valor_desconto",$valor_desconto);
            $sql->bindValue(":validade",$validade);
            $sql->bindValue(":valor_minimo",$valor_minimo);
            $sql->bindValue(":cod_cupom",$cod_cupom);
            $sql->execute();
        }

        

    }
?>