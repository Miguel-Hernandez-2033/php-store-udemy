<?php


class utilities{

    public static function deleteSessions($session_name){
        if(isset($_SESSION[$session_name])){
            $_SESSION[$session_name] = null;
            unset($_SESSION[$session_name]);
        }

        return $session_name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header('Location:'.base_url);
        }else{
            return true;
        }
    }

    public static function showCategorias(){
        require_once('models/categoria.php');
        $categoria = new categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function statsCarrito(){
        $stats = array(
            'products' => 0,
            'total' => 0
        );
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($value){

        $status = "Pendiente";
        switch($value){
            case 'confirmed':
                $status = "Pendiente";
            break;

            case 'preparation':
                $status = "En preparacion";
            break;

            case 'ready':
                $status = "Preparado";
            break;

            case 'sended':
                $status = "Enviado";
            break;
        }

        return $status;
    }


    /*
    //Intento de verificador automatico, mejorar con tipos de values
    / necesarios para el login.
    / verificador de string para nombre y apellidos / int para password (el bcrypt esta en el modelo) / email para el correo
    
    public static function verifyPOST($input_value){
        $result = isset($_POST[$input_value]) ? $_POST[$input_value] : false;
        return $result;
    }*/
}