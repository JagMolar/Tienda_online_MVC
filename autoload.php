<?php

#autoload, nos permite con una sola llamada hacer todos los includes necesario
#function app_autoloader($class){
function controllers_autoload($classname){
   
    include 'controllers/'.$classname.'.php';
    
}

spl_autoload_register('controllers_autoload');