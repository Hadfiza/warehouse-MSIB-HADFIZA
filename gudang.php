<?php

class gudang {
    private $conn;
    private $table_name = "gudang";

    public $id;
    public $name;
    public $location;
    public $capacity;
    public $status;
    public $opening_hour;
    public $closing_hour;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO ". $this->table_name ." (name, location, capacity, status, opening_hour, closing_hour) VALUES (:name, :location, :capacity, :status, :opening_hour, :closing_hour)");

        // Perbaikan di sini: hapus tanda koma dalam argumen
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour); 
        $stmt->bindParam(":closing_hour", $this->closing_hour);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $stmt = $this->conn->prepare("SELECT id, name, location, capacity, status, opening_hour, closing_hour FROM ". $this->table_name);
        $stmt->execute();

        return $stmt;
    }

    public function show($id) {
        $stmt = $this->conn->prepare("SELECT id, name, location, capacity, status, opening_hour, closing_hour FROM ". $this->table_name ." WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $stmt = $this->conn->prepare("UPDATE ". $this->table_name ." SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour WHERE id=:id");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour); 
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM ". $this->table_name ." WHERE id=:id");
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }   

        return false;
    }

}
?>
