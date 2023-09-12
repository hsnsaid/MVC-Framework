<?php
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
    public function show(string $table, array $attributes_array, array $clause_array) {
        $attributes = implode(",", $attributes_array);
        $placeholders = [];
        $values = [];
        foreach ($clause_array as $key => $value) {
            $placeholders[] = "$key = ?";
            $values[] = $value;
        }
        $whereClause = implode(" AND ", $placeholders);
        $stmt = $this->pdo->prepare("SELECT $attributes FROM $table WHERE $whereClause");
        if ($stmt) {
            $stmt->execute($values);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function insert(string $table, string $query,array $values):int|null {
        $t=str_repeat("?, ", sizeof($values)-1) . "?";
        $insert=$this->pdo->prepare("INSERT INTO $table ($query) VALUES ($t)");
        $insert->execute($values);
        return $this->pdo->lastInsertId() ?? null;    
    }
    public function delete(string $table, array $clause):bool {
        $whereClause="";
        $placeholders=[];
        $values = [];
        foreach($clause as $key=>$value){
            $placeholders[]="$key =?";
            $values[]=$value; 
        }
        $whereClause = implode(" AND ", $placeholders);
        $delete = $this->pdo->prepare("DELETE FROM $table WHERE $whereClause");
        if($delete->execute($values)){
            return true;
        }
        return false;
    }
    public function update(string $table, string $query, array $clause): bool {
        $whereClause = "";
        $placeholders = [];
        $values = [];
        foreach ($clause as $key => $value) {
            $placeholders[] = "$key = ?";
            $values[] = $value;
        }
        $whereClause = implode(" AND ", $placeholders);
        $update = $this->pdo->prepare("UPDATE $table SET $query WHERE $whereClause");
        if ($update->execute($values)) {
            return true;
        }
        return false;
    }
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    } 
}