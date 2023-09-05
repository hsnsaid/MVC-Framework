<?php
declare(strict_types=1);
namespace App_Core;
use PDO;
class DB{
    private PDO $pdo;
    public function __construct(array $config){
    try{
        $this->pdo = new PDO(
            $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
            $config['user'],
            $config['password'],
        );    
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
    }
    public function show(string $query){
        $select=$this->pdo->prepare($query);
        $select->execute();
        return$select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert(string $query):int {
        $insert=$this->pdo->prepare($query);
        $insert->execute();
        return $db->lastInsertId ?? null;
    }
    public function delete(string $query):bool {
        $delete=$this->pdo->prepare($query);
        if($delete->execute()){
            return true;
        }
        return false;
    }
    public function update(string $query): bool{
        $update=$this->pdo->prepare($query);
        if($select->execute()){
            return true;
        }
        return false;
    }
    
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    } 
}