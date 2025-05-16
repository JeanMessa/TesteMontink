<?php
    require_once 'database.php';
    if (isset($_GET['class']) && isset($_GET['action'])) {
        $classe = $_GET['class'];
        $metodo = $_GET['action'];
        
        $classe .= 'Controller';
        
        require_once 'controller/'.$classe.'.php';
        
        $obj = new $classe();
        $obj->$metodo();
    }else {
        header("Location: index.php?class=Produto&action=getAll");
    }
?>