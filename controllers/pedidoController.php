<?php

require_once('models/pedido.php');

class pedidoController{

    public function index(){

        require_once('views/pedido/index.php');
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $provincia = isset($_POST['provincia'])  ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad'])  ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion'])  ? $_POST['direccion'] : false;

            if($provincia && $localidad && $direccion){

                $usuario_id = $_SESSION['identity']->id;
                $stats = utilities::statsCarrito();
                $coste = $stats['total'];

                $pedido = new pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                $save_linea = $pedido->save_linea();

                if($save && $save_linea){
                    $_SESSION['pedido'] = "Complete"; 
                }else{
                    $_SESSION['pedido'] = "Failed";
                }

            }else{
                $_SESSION['pedido'] = "Failed";
            }

            header('Location:'.base_url.'pedido/confirmado');

            
        }else{
            header('Location:'.base_url);
        }
        
    }

    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new pedido();
            $pedido->setUsuario_id($identity->id);
            $ped = $pedido->getOneByUser();

            $pedido_producto = new pedido();
            $productos = $pedido_producto->getProductByPedido($ped->id);
        }
        require_once('views/pedido/confirmado.php');
    }

    public function misPedidos(){
        if(isset($_SESSION['identity'])){
            $id_usuario = $_SESSION['identity']->id;
            $pedido = new pedido();
            $pedido->setUsuario_id($id_usuario);
            $pedidos = $pedido->getAllByUser();

            require_once('views/pedido/misPedidos.php');
        }else{
            Header('Location:'.base_url);
        }
        
    }

    public function detalle(){
        if(isset($_SESSION['identity'])){
            if($_GET['id']){
                $id = $_GET['id'];
                $pedido = new pedido();
                $pedido->setId($id);
                $ped = $pedido->getOne();


                $pedido_producto = new pedido();
                $productos = $pedido_producto->getProductByPedido($pedido->getId());


                require_once('views/pedido/detalle.php');    
            }else{
                Header('Location:'.base_url.'pedido/misPedidos');
            }
            
        }else{
            Header('Location:'.base_url);
        }
    }

    public function gestion(){
        utilities::isAdmin();
        $gestion = true;
        
        $pedido = new pedido();
        $pedidos = $pedido->getAll();

        require_once('views/pedido/misPedidos.php');
    }

    public function estado(){
        utilities::isAdmin();
        if(isset($_POST['pedido_id']) && $_POST['estado']){
            $id_pedido = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            $pedido = new pedido();
            $pedido->setId($id_pedido);
            $pedido->setEstado($estado);

            $pedido->updateEstado();
            
            header('Location:'.base_url.'pedido/detalle&id='.$id_pedido);

        }else{
            header('Location:'.base_url);
        }
        
    }
}