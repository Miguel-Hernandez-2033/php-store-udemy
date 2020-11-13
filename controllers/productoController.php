<?php

require_once('models/producto.php');

class productoController{
    
    public function index(){
        $producto = new producto();
        $productos = $producto->getRandom(6);
        require_once('views/producto/index.php');
    }

    public function gestion(){
        utilities::isAdmin();
        $producto = new producto();
        $productos = $producto->getAll();

        require_once('views/producto/gestion.php');
    }

    public function add(){
        utilities::isAdmin();
        require_once('views/producto/add.php');
    }

    public function save(){
        utilities::isAdmin();
        if(isset($_POST)){
           

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; 
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            //$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
            //$oferta = isset($_POST['ofeta']) ? $_POST['oferta'] : false;
            //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                //$producto->setFecha($fecha);
                //$producto->setImagen($imagen);
                //$producto->setOferta($oferta);


                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $file_name = $file['name'];
                    $mimetype = $file['type'];
                    
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                        if(!is_dir("uploads/images")){

                            mkdir("uploads/images", 0775, true);
                            
                        }

                        move_uploaded_file($file['tmp_name'],'uploads/images/'.$file_name);
                        $producto->setImagen($file_name);
                    }
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $result = $producto->update();
                }else{
                    $result = $producto->save();
                }

                

                if($result){
                    $_SESSION['producto'] = "Complete";
                }else{
                    $_SESSION['producto'] = "Failed";
                }
            }else{
                $_SESSION['producto'] = "Failed";
            }

        }else{
            $_SESSION['producto'] = "Failed";
        }
        header('Location:'.base_url.'producto/gestion');
    }


    public function edit(){
        utilities::isAdmin();
        if(isset($_GET['id'])){
            $edit = true;
            $id = $_GET['id'];

            $producto = new producto();
            $producto->setId($id);

            $prod = $producto->getOne();

            require_once('views/producto/add.php');
        }else{
            header('Location:'.base_url.'producto/gestion');
        }
    }

    public function view(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new producto();
            $producto->setId($id);
            $prod = $producto->getOne();
        }
        require_once('views/producto/view.php');
    }

    public function delete(){
        utilities::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new producto();
            $producto->setId($id);
            $delete = $producto->delete();

            if($delete == true){
                $_SESSION['delete'] = "Complete";
            }elseif($delete == false){
                $_SESSION['delete'] = "Failed";
            }
        }
        header('Location:'.base_url.'producto/gestion');
    }
}