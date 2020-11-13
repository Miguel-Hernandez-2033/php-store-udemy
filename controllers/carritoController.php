<?php

require_once('models/producto.php');
class carritoController{

    public function index(){
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
            
        }
        require_once('views/carrito/index.php');
    }

    public function add(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }else{
            Header('Location:'.base_url);
        }
        
        if(isset($_SESSION['carrito'])){
            $cont = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if($elemento['id_producto'] == $id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $cont++;
                }
            }

        }

        if(!isset($cont) || $cont == 0){

            $producto = new producto();
            $producto->setId($id);
            $prod = $producto->getOne();

            if(is_object($prod)){
                $_SESSION['carrito'][] = array(
                    "id_producto" => $prod->id,
                    "precio" => $prod->precio,
                    "unidades" => 1,
                    "producto" => $prod
                );
            }
        }

        header('Location:'.base_url.'carrito/index');
    }

    public function remove(){
        if(isset($_GET['index']) && isset($_SESSION['carrito'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function deleteAll(){
        unset($_SESSION['carrito']);
        header('Location:'.base_url.'carrito/index');        

    }

    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            
            if($_SESSION['carrito'][$index]['unidades'] == 0){
                unset($_SESSION['carrito'][$index]);
            }
            
        }
        header('Location:'.base_url.'carrito/index');
    }
}