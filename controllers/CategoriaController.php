<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
    }//fin function index
    
    public function ver(){
        if(isset($_GET['id'])){
//           var_dump($_GET['id']);die();
           $id = $_GET['id'];
           
           //Conseguimos categoria
           $categoria = new Categoria();
           $categoria->setId($id);
           
           $categoria = $categoria->getOne();
           
           //Ahora, conseguimos el producto
           $producto = new Producto();
           $producto->setCategoria_id($id);
           $productos = $producto->getAllCategory();
        }
        
        require_once 'views/categoria/ver.php';
    }//Fin function ver

    

    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }//Fin function crear
    
    public function save(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
           //Guardamos la categoria en bd 
           $categoria = new Categoria();
           $categoria->setNombre($_POST['nombre']);
           $categoria->save();
        }       
        header("Location:".base_url."categoria/index");
    }//Fin save
    
}//Fin categoriaController

