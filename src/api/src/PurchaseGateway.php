<?php

class PurchaseGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM purchase
                ORDER BY id DESC";
                
        $stmt = $this->conn->query($sql);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$data) {
            $data = [];
        }

        return $data;
    }
    
    public function create(array $data): array
    {
        $sql = "INSERT INTO purchase (description, price, buyer, owner/*, date_create*/)
                VALUES (:description, :price, :buyer, :owner/*, :date_create*/)";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data["price"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":buyer", $data["buyer"], PDO::PARAM_INT);
        $stmt->bindValue(":owner", $data["owner"], PDO::PARAM_INT);
        //$stmt->bindValue(":date_create", $data["date_create"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $this->get($this->conn->lastInsertId());
    }
    
    public function get(string $id): array | false
    {
        $sql = "SELECT *
                FROM purchase
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE purchase
                SET description = :description, price = :price, buyer = :buyer, owner = :owner, date_create = :date_create
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":description", $new["description"] ?? $current["description"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $new["price"] ?? $current["price"], PDO::PARAM_INT);
        $stmt->bindValue(":buyer", $new["buyer"] ?? $current["buyer"], PDO::PARAM_INT);
        $stmt->bindValue(":owner", $new["owner"] ?? $current["owner"], PDO::PARAM_INT);
        $stmt->bindValue(":date_create", $new["date_create"] ?? $current["date_create"], PDO::PARAM_INT);
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public function delete(string $id): int
    {
        $sql = "DELETE FROM purchase
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}











