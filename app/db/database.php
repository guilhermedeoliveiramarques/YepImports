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
     * @param array $values [ filed => value]
     * @return int
     */
    public function insertUsuario($values){
        try{

            $query = "INSERT INTO ".$this->table." (cep,logradouro,bairro,localidade,uf) VALUES (:cep,:logradouro,:bairro,:localidade,:uf)"; 
                        
                                 
            $query = $this->connection->prepare($query);

            $query->bindParam(":cep", $values->cep);
            $query->bindParam(":logradouro", $values->logradouro);
            $query->bindParam(":bairro", $values->bairro);
            $query->bindParam(":localidade", $values->localidade);
            $query->bindParam(":uf", $values->uf);

            if($query->execute()){
                return true;
            }
 
         }catch(PDOException $e){
             die('ERROR: '.$e->getMessage());
         }

    }

    /**
     * Método responsável por selecionar campos no banco
     * @param string $cep
     * @return array $array
     */
    public function selectProduto($cep){
        try{
            $query = 'SELECT * FROM ' . $this->table . ' WHERE cep = :cep';

            $query = $this->connection->prepare($query);

            $query->bindValue("cep", $cep);

            $query->execute();

            $array = $query->fetch(PDO::FETCH_ASSOC);

            return $array;
            
         }catch(PDOException $e){
             die('ERROR: '.$e->getMessage());
         }
    }

}