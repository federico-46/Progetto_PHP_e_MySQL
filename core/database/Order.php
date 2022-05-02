<?php
class Order
{
    private $conn;

    private $table_name_orders = "orders";
    private $table_name_products = "products";

    public $Id_order;
    public $Date;
    public $Destination;
    public $Amount;
    public $Co2_Saved;
    public $Product;

    // public $Co2;

    // costruttore
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // READ ORDERS
    function read()
    {
        // select all
        $query = "SELECT
                      *
                    FROM
                     $this->table_name_orders  
                    ORDER BY
                    Date and Destination and Product 
                    ";

        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    //CREARE ORDERS
    function create()
    {
        $query =        "INSERT INTO  
                         $this->table_name_orders  
                        SET 
                        Date= :date,
                        Destination= :destination, 
                        Product= :product, 
                        Amount= :amount ";


        $stmt = $this->conn->prepare($query);

        $this->Date = htmlspecialchars(strip_tags($this->Date));
        $this->Destination = htmlspecialchars(strip_tags($this->Destination));
        $this->Product = htmlspecialchars(strip_tags($this->Product));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));



        //binding
        $stmt->bindParam(':date', $this->Date);     
        $stmt->bindParam(':destination', $this->Destination);
        $stmt->bindParam(':product', $this->Product);
        $stmt->bindParam(':amount', $this->Amount);


        //execute query
        if ($stmt->execute()) {  
            return true;
        }
        return false;
    }


    // UPDATE ORDERS
    function update()
    {
        $query =  "UPDATE 
                   $this->table_name_orders, $this->table_name_products
                SET
                    Date= :date, 
                    Destination= :destination, 
                    Product= :product, 
                    Amount= :amount,
                    Co2_Saved= ( $this->table_name_products.Co2  * :amount)
                WHERE 
                    Id_order= :id_order   and  $this->table_name_orders.Product = $this->table_name_products.Name ";




        $stmt = $this->conn->prepare($query);

        $this->Date = htmlspecialchars(strip_tags($this->Date));
        $this->Destination = htmlspecialchars(strip_tags($this->Destination));
        $this->Product = htmlspecialchars(strip_tags($this->Product));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));
        $this->Co2_Saved = htmlspecialchars(strip_tags($this->Co2_Saved));


        //binding
        $stmt->bindParam(':date', $this->Date);    
        $stmt->bindParam(':destination', $this->Destination);
        $stmt->bindParam(':product', $this->Product);
        $stmt->bindParam(':amount', $this->Amount);
        $stmt->bindParam(':id_order', $this->Id_order);




        //execute query
        if ($stmt->execute()) {   
            return true;
        }
        return false;
    }

    // DELETE ORDERS

    function delete()
    {
        $query = "DELETE FROM
                     $this->table_name_orders
                    WHERE 
                        Id_order = ?";

        $stmt = $this->conn->prepare($query);

        //binding

        $stmt->bindParam(1, $this->Id_order);

        //execute query
        if ($stmt->execute()) {   
            return true;
        }
        return false;
    }
}
