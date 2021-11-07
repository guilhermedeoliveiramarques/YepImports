<?php 

namespace App\Entity;

use \PDO;
use \PDOException;

class Usuario{

    /**
     * Método responsável por validar o login
     * @param string $retornoBanco
     * @param string $senha
     * @return boolean
    */
    public function verficarLogin($retornoBanco, $senha){

        if(isset($retornoBanco) && !empty($retornoBanco)){

            $dado = $retornoBanco;

            if(password_verify($senha, $dado['senha'])){

            // Criar uma sessão
            $_SESSION['id'] = $dado['id'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['email'] = $dado['email'];
            $_SESSION['senha'] = $dado['senha'];
            
            return true;
            
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

}