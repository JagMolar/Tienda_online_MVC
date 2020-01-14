<?php

class Utils{
    
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = NULL;
            unset($_SESSION[$name]);
        }
        return $name;
    }//fin  function deleteSession
    
    //Usaremos la siguiente función siempre que queramos evitar el uso por GET de usuarios sin permisos admin
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return TRUE;
        }
    }//fin  function isAdmin
    
    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }//Fin function showCategorias
    
    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total'=> 0
        );
        
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            
            foreach ($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }
        
        return $stats;
        
    }//Fin function statsCarrito
    
    
}//Fin clase Utils

