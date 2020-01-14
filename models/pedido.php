<?php

class Pedido{
    
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad) {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }


    
    
//    
//    function getId() {
//        return $this->id;
//    }
//
//    function getCategoria_id() {
//        return $this->categoria_id;
//    }
//
//    function getNombre() {
//        return $this->nombre;
//    }
//
//    function getDescripcion() {
//        return $this->descripcion;
//    }
//
//    function getPrecio() {
//        return $this->precio;
//    }
//
//    function getStock() {
//        return $this->stock;
//    }
//
//    function getOferta() {
//        return $this->oferta;
//    }
//
//    function getFecha() {
//        return $this->fecha;
//    }
//
//    function getImagen() {
//        return $this->imagen;
//    }
//
//    function setId($id) {
//        $this->id = $id;
//    }
//
//    function setCategoria_id($categoria_id) {
//        $this->categoria_id = $categoria_id;
//    }
//
//    function setNombre($nombre) {
//        $this->nombre = $this->db->real_escape_string($nombre);
//    }
//
//    function setDescripcion($descripcion) {
//        $this->descripcion =$this->db->real_escape_string($descripcion);
//    }
//
//    function setPrecio($precio) {
//        $this->precio = $this->db->real_escape_string($precio);
//    }
//
//    function setStock($stock) {
//        $this->stock = $this->db->real_escape_string($stock);
//    }
//
//    function setOferta($oferta) {
//        $this->oferta = $this->db->real_escape_string($oferta);
//    }
//
//    function setFecha($fecha) {
//        $this->fecha = $fecha;
//    }
//
//    function setImagen($imagen) {
//        $this->imagen = $imagen;
//    }
    
    public function getAll(){
        
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
        return $productos;
    }
    
//    public function getAllCategory(){
//        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
//                . "INNER JOIN categorias c ON c.id = p.categoria_id "
//                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
//                . "ORDER BY id DESC;";
//        $productos = $this->db->query($sql);
//        return $productos;
//    }
//    
//    public function getRandom($limit){
//        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit;");
//        return $productos;
//    }

        public function getOne(){
        
        $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()};");
        return $producto->fetch_Object();
    }
    
    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()},'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql) ;
        
//        echo $sql;
//        echo '<br />';
//        
//        echo $this->db->error;
//        die();
        
        $result = false;
        if($save){
            $result = TRUE;
        }
        return $result;
    }
    
    
//    public function edit(){
//        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()}";
//        
//        if($this->getImagen() != NULL){
//            $sql .= ",imagen='{$this->getImagen()}'";
//        }
//        
//        $sql .= " WHERE id={$this->getId()};";
//        
//        $save = $this->db->query($sql) ;
//        
//        $result = false;
//        if($save){
//            $result = TRUE;
//        }
//        return $result;
//    }
//    
//    public function delete(){
//        $sql = "DELETE FROM productos WHERE id={$this->id};";
//        $delete = $this->db->query($sql);
//        
//        $result = false;
//        if($delete){
//            $result = TRUE;
//        }
//        return $result;
//    }


}//Fin clase Producto

