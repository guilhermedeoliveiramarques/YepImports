<?php

namespace App\db;

use \PDO;
use \PDOException;

class Database{

    const HOST = 'localhost';
    const NAME = 'bd_yep';
    const USER = 'root';
    const PASS = 'root';

    private $table;
    private $connection;

    /**
     * Define a tabela, instancia e conecta
     * @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o Banco
     */
    public function setConnection(){
        try{
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Método responsável por selecionar um usuario
     * @param string $email
     * @return array $array
    */
    public function selectUsuario($email){
        $sqlQuery = "SELECT * FROM " . $this->table . " WHERE email = :email";

        $sqlQuery = $this->connection->prepare($sqlQuery);

        $sqlQuery->bindValue("email", $email);

        $sqlQuery->execute();
       
        $array = $sqlQuery->fetch(PDO::FETCH_ASSOC);

        return $array;
    }

    /**
     * Método responsável por inserir usuario
     * @param array $values [ field => key]
     * @return boolean
     */
    public function insertUsuario($values){
        try{

            $sqlQuery = "INSERT INTO ".$this->table." (nome, email, senha, telefone) VALUES (:nome,:email,:senha,:telefone)"; 
                        
                                 
            $sqlQuery = $this->connection->prepare($sqlQuery);

            $sqlQuery->bindValue(":nome", $values[nome]);
            $sqlQuery->bindValue(":email", $values[email]);
            $sqlQuery->bindValue(":senha", $values[senha]);
            $sqlQuery->bindValue(":telefone", $values[telefone]);



            if($sqlQuery->execute()){
                
                return true;
            }
 
         }catch(PDOException $e){
             die('ERROR: '.$e->getMessage());
         }

    }

    /**
     * Método responsável por selecionar campos no banco
     * @return array $retornoBanco
     */
    public function selectProduto(){
        try{
            $query = 'SELECT * FROM ' . $this->table;

            $query = $this->connection->prepare($query);

            $query->execute();

            $retornoBanco = $query->fetchAll(PDO::FETCH_ASSOC);

            return $retornoBanco;
            
         }catch(PDOException $e){
             die('ERROR: '.$e->getMessage());
         }
    }

}