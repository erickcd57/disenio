<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use BackendBundle\Entity\Almacen;
use BackendBundle\Entity\Producto;

class ProductoController extends Controller
{
    
    public function pruebasAction(Request $request)
    {
        echo "hola";
        die();
    }
    
    public function listarAction(Request $request){
        $helpers = $this->get("app.helpers");
        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository('BackendBundle:Producto')->findAll();
        $data = array("status" => "ACCESO", "code" => 400, "data" => $lista);
        return $helpers->jsonConverter($data);
    }
    
    public function detalleAction(Request $request, $id = null){
        $helpers = $this->get("app.helpers");
        $productoId = $id;
        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository('BackendBundle:Producto')->findOneBy(
                        array(
                            "idproducto" => $productoId
                ));
        $data = array(
            "status" => "SUCCESS",
            "code" => 200,
            "data" => $lista
        );
        return $helpers->jsonConverter($data);
    }
    
    public function eliminarAction(Request $request, $id = null){
        $helpers = $this->get("app.helpers");
        $idProducto = $id;
        if($idProducto != null){
            $em = $this->getDoctrine()->getManager();
            $producto = $em->getRepository("BackendBundle:Producto")->findOneBy(
                    array("idproducto" => $idProducto));
            if(is_object($producto)){
                $em->remove($producto);
                $em->flush();
                $data = array(
                    "status" => "SUCCESS",
                    "code" => 400,
                    "msg" => "producto eliminado!"
                    );
            }else{
               $data = array(
                    "status" => "error",
                    "code" => 401,
                    "msg" => "producto no eliminado!"
                ); 
            }
        }else{
            $data = array(
                "status" => "error",
                    "code" => 402,
                    "msg" => "idProducto de producto es nulo!"
            );
        }
        return $helpers->jsonConverter($data);
    }
    
    public function nuevoAction(Request $request){
       $helpers = $this->get("app.helpers");
       $json = $request->get("json", null);
       $params = json_decode($json);
       if($json != null){
           $idAlmacen = (isset($params->idAlmacen)) ? $params->idAlmacen: 0;
           $codigo = (isset($params->codigo)) ? $params->codigo : null ;
           $nombre = (isset($params->nombre)) ? $params->nombre : null;
           $descripcion = (isset($params->descripcion)) ? $params->descripcion : null;
           $stock = (isset($params->stock)) ? $params->stock : 0;
           $precioUnidad = (isset($params->precioUnidad)) ? $params->precioUnidad :0 ;
           $costoUnidad = (isset($params->costoUnidad)) ? $params->costoUnidad : 0;
           if($codigo != null){
               $em = $this->getDoctrine()->getManager();
               $almacen = $em->getRepository("BackendBundle:Almacen")->findOneBy(
                        array(
                         "idAlmacen" => $idAlmacen   
                ));
               $producto = new Producto();
               $producto->setIdAlmacen($almacen);
               $producto->setNombre($nombre);
               $producto->setCodigo($codigo);
               $producto->setDescripcion($descripcion);
               $producto->setPrecioUnidad($precioUnidad);
               $producto->setCostoUnidad($costoUnidad);
               $producto->setStock($stock);
               $em->persist($producto);
                $em->flush();
                $data = array("status" => "SUCCESS","code" => 402, "msg" => "Producto Guardado!!");
           }else{
                $data = array(
                    "status" => "error",
                    "code" => 401,
                    "msg" => "El codigo es nulo!"
                );
           }
       }else{
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "JSON no existe"
            );
        }
         return $helpers->jsonConverter($data);
    }
    
    public function editarAction(Request $request, $id = null){
        $helpers = $this->get("app.helpers");
        $json = $request->get("json", null);
        $idProducto = $id;
        $params = json_decode($json);
        if($json != null){
           $idAlmacen = (isset($params->idAlmacen)) ? $params->idAlmacen: 0;
           $codigo = (isset($params->codigo)) ? $params->codigo : null ;
           $nombre = (isset($params->nombre)) ? $params->nombre : null;
           $descripcion = (isset($params->descripcion)) ? $params->descripcion : null;
           $stock = (isset($params->stock)) ? $params->stock : 0;
           $precioUnidad = (isset($params->precioUnidad)) ? $params->precioUnidad :0 ;
           $costoUnidad = (isset($params->costoUnidad)) ? $params->costoUnidad : 0;
           if($idProducto != null){
               $em = $this->getDoctrine()->getManager();
                $producto = $em->getRepository("BackendBundle:Producto")->findOneBy(
                        array("idproducto" => $idProducto));
                $almacen = $em->getRepository("BackendBundle:Almacen")->findOneBy(
                        array(
                         "idAlmacen" => $idAlmacen   
                        ));
                if($producto){
                    $producto->setIdAlmacen($almacen);
                    $producto->setNombre($nombre);
                    $producto->setCodigo($codigo);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecioUnidad($precioUnidad);
                    $producto->setCostoUnidad($costoUnidad);
                    $producto->setStock($stock);
                    $em->persist($producto);
                    $em->flush();
                    $data = array("status" => "SUCCESS","code" => 402, "msg" => "Producto Atualizado!!");
                }else{
                    $data = array("status" => "error",
                        "code" => 401,
                        "msg" => "producto no existe!");
                }
           }else{
                $data = array(
                    "status" => "error",
                    "code" => 402,
                    "msg" => "Id es nulo, producto no editado!"
                );
            }
        }else{
            $data = array(
                    "status" => "error",
                    "code" => 403,
                    "msg" => "JSON es nulo, producto no editado!"
                );
        }
        return $helpers->jsonConverter($data);
    }
}
