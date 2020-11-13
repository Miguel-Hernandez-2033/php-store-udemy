<?php

require_once('models/categoria.php');
require_once('models/producto.php');

class categoriaController{

    public function index(){
        utilities::isAdmin();
        $categoria = new categoria();
        $categorias = $categoria->getAll();

        require_once('views/categoria/index.php');
    }
    
    public function add(){
        require_once('views/categoria/add.php');
    }

    public function view(){
        
        if(isset($_GET) && isset($_GET['id'])){
            $id = $_GET['id'];
            $categoria = new categoria();
            $producto = new producto();

            $categoria->setId($id);
            $producto->setCategoria_id($id);

            $cat = $categoria->getOne();
            $productos = $producto->getAllCat();
            require_once('views/categoria/view.php');
        }
        
    }
    
    public function save(){
        utilities::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new categoria();
            $categoria->setNombre($_POST['nombre']);
            $save  = $categoria->save();
        }
        header('Location:'.base_url.'categoria/index');
    }
}