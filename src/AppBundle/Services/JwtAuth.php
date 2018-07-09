<?php

namespace AppBundle\Services;

use Firebase\JWT\JWT;

class JwtAuth {
    //Propiedad
    public $manager;
    public $key;
    
    public function __construct($manager) {
        $this->manager = $manager;
        $this->key = "clave-secreta";
    }
    //Autenticacion del login
    public function signup($email, $password, $getHash = null){ 
        $key = $this->key; //clave secreta
        $usuario = $this->manager->getRepository('BackendBundle:Empleado')->findOneBy(
                    array(
                        "usuario" => $email,
                        "password" => $password
                    )                
                );
        
        $signup = false;
        if(is_object($usuario)){            
            $signup = true;            
        }
        //print_r($signup); exit();
        if($signup){          
            $token = array(
                "idEmpleado" => $usuario->getIdEmpleado(),
                "email" => $usuario->getUsuario(),
                "nombre" => $usuario->getNombre(),
                "apPaterno" => $usuario->getApPaterno(),
                "apMaterno" => $usuario->getApMaterno(),
                "dni" => $usuario->getDni(),
                "direccion" => $usuario->getDireccion(),
                "sueldo" => $usuario->getSueldo(),
                "telefono" => $usuario->getTelefono(),
                "password" => $usuario->getPassword(),
                "iat" => time(),
                "exp" => time() + (7*24*60*60)
            );
            
            //CODIFICA LOS DATOS EN HASH
            $jwt = JWT::encode($token, $key, 'HS256');
            
            $decode = JWT::decode($jwt, $key, array('HS256'));
            
            //Devolver los datos codificados
            if($getHash != null){
                return $jwt; //<-El hash
            }else{
                return $decode; //<-Datos decodificados, en limpio
            }
            //return array("status" => "success", "data" => "Acceso al Login");
        } else {
            return array("status" => "error", "data" => "Fallo el Login!!");
        }
    }
    //Chequea si el token es correcto jwt->es el hash 
    public function checkToken($jwt, $getIdentity = false){
        $key = $this->key;
        $auth = false;

        try{
            $decode = JWT::decode($jwt, $key, array('HS256'));

        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if(isset($decode->idUsuario)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity == true){
            return $decode;
        }else{
            return $auth;
        }
    }
}
