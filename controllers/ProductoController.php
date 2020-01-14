<?php
require_once 'models/producto.php';

class productoController{
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);//Indicamos el número de artículos a mostrar aleatoriamente
//        var_dump($productos->fetch_object());die();
        //renderizamos vista
        require_once 'views/producto/destacados.php';
    }
    
    public function ver(){
        if(isset($_GET['id'])){
             $id = $_GET['id'];
             
             $producto = new Producto();
             $producto->setId($id);
             
             $product = $producto->getOne();
        }     
             require_once 'views/producto/ver.php';
    }//Fin ver


    public function gestion(){
        Utils::isAdmin();
        
        $producto = new Producto();
        $productos = $producto->getAll();
        
        require_once 'views/producto/gestion.php';
    }
    
    public function crear(){
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }//Fin function crear
    
    public function save(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
//            var_dump($_POST);
           //Guardamos los datos recibidos en bd 
           $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
           $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
           $precio= isset($_POST['precio']) ? $_POST['precio'] : false;
           $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
           $categoria= isset($_POST['categoria']) ? $_POST['categoria'] : false;
//           $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
           
           if($nombre && $descripcion && $precio && $stock && $categoria){
               $producto = new Producto();
               $producto->setNombre($nombre);
               $producto->setDescripcion($descripcion);
               $producto->setPrecio($precio);
               $producto->setStock($stock);
               $producto->setCategoria_id($categoria);
               
               //Guardamos tambíen la imagen
               if(isset($_FILES['imagen'])){
                   $file = $_FILES['imagen'];
               $filename = $file['name'];
               $mimetype = $file['type'];
               
//               die(var_dump($file));
               
                   if($mimetype == "image/jpg" || "image/jpeg" || "image/png" || "image/gif" ){
                       //               die(var_dump($file));
                       if(!is_dir('uploads/images')){
                           mkdir('uploads/images', 0777, TRUE);
                       }
                       $producto->setImagen($filename);
                       move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);                 
                   }
               }
               
               
               if(isset($_GET['id'])){
                   $id = $_GET['id'];
                   $producto->setId($id);
                   $save = $producto->edit();
               }else{
                   $save = $producto->save();
               }
               
               
               if($save){
                   $_SESSION['producto']= "complete";
               }else{
                   $_SESSION['producto']= "failed";
               }
           }else{
               $_SESSION['producto']= "failed";
           }
        }else{
            $_SESSION['producto']= "failed";
        }       
        header("Location:".base_url."producto/gestion");
    }//Fin save
    
    public function editar(){
//        var_dump($_GET);
        Utils::isAdmin();
         if(isset($_GET['id'])){
             $id = $_GET['id'];
             $edit = TRUE;
             
             $producto = new Producto();
             $producto->setId($id);
             $pro = $producto->getOne();
             
             require_once 'views/producto/crear.php';
         }else{
             header("Location:".base_url.'producto/gestion');
         }
    }
    
    public function eliminar(){
//        var_dump($_GET);
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            
            $delete = $producto->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
            
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url.'producto/gestion');
    }// Fin eliminar
    
    
}//Fin clase productoController

