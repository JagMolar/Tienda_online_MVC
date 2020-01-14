<?php
require_once 'models/usuario.php';

class usuarioController{
    public function index(){
        echo "Controlador Usuarios, Acción index";
    }   
    
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    
    public function save(){
        if(isset($_POST)){
//            var_dump($_POST);
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
            $apellidos= isset($_POST['nombre']) ? $_POST['apellidos'] : FALSE;
            $email = isset($_POST['nombre']) ? $_POST['email'] : FALSE;
            $password = isset($_POST['nombre']) ? $_POST['password'] : FALSE;           
            
            if($nombre && $apellidos && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);      
            
                //var_dump($usuario);
                $save = $usuario->save();
                if($save){
                $_SESSION['register']="complete";            
                }else{
                    $_SESSION['register']="failed";
                }
            }else{
                $_SESSION['register']="failed";
            }      
        }else{
            $_SESSION['register']="failed";          
        }
        header("Location:".base_url.'usuario/registro');
    }
    
    public function login(){
        if(isset($_POST)){
            //Identificar al usuario mediante consulta a bd
            $usuario  = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            //Los datos recogidos del objeto los guardamos en el login
            $identity = $usuario->login();
            
//            var_dump($identity);
//            die();
            //Crear una sessión
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                
                //Si es el administrador
                if($identity->rol == 'admin'){
                     $_SESSION['admin'] = TRUE;
                 }
            }else{
                $_SESSION['error_login'] = 'Identificación fallida !!';
            }      
            
        }
        header('Location:'.base_url);
    }
    
    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        
        header("Location:".base_url);
    }
}//Fin clase

