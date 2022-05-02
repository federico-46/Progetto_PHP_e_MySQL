<?php
class Product
{
    private $conn;
    private $table_name = "products";
  
    public $Name;
    public $Co2;
    public $Id_prod;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // READ PRODUCTS
    function read()
    {
        // select all
        $query = "SELECT
                        *
                    FROM
                    $this->table_name
                    ORDER BY Name DESC
                    ";


        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    //CREATE PRODUCTS
    function create()
    {
        $query =        "INSERT INTO  
                        " . $this->table_name . " 
                        SET 
                        Name= :name, Co2= :co2; ";

        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->Co2 = htmlspecialchars(strip_tags($this->Co2));

        //binding
        $stmt->bindParam(':name', $this->Name);       
        $stmt->bindParam(':co2', $this->Co2);

        //execute query
        if ($stmt->execute()) {     
            return true;
        }
        return false;
    }


    // UPDATE PRODUCTS
    function update()
    {
        $query =  "UPDATE 
                " . $this->table_name . "
                SET
                    Name= :name, 
                    Co2= :co2
                WHERE 
                    Id_prod= :id_prod ";

        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->Co2 = htmlspecialchars(strip_tags($this->Co2));

        //binding
        $stmt->bindParam(':name', $this->Name);        
        $stmt->bindParam(':co2', $this->Co2);
        $stmt->bindParam(':id_prod', $this->Id_prod);

        //execute query
        if ($stmt->execute()) {     
            return true;
        }
        return false;
    }

    // DELETE PRODUCTS

    function delete()
    {
        $query = "DELETE FROM
                    " . $this->table_name . "
                    WHERE 
                        Id_prod = ?";

        $stmt = $this->conn->prepare($query);

        //binding

        $stmt->bindParam(1, $this->Id_prod);

        //execute query
        if ($stmt->execute()) {   
            return true;
        }
        return false;
    }
}
