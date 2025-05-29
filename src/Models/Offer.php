<?php

namespace Acme\Models;

use Acme\Database;
use PDO;

class Offer
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM offers");
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM offers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($product_id, $offer_type, $min_qty, $disc_val, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO offers (product_id, offer_type, min_quantity, discount_value, description) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$product_id, $offer_type, $min_qty, $disc_val, $description]);
    }

    public function update($id, $product_id, $offer_type, $min_qty, $disc_val, $description)
    {
        $stmt = $this->pdo->prepare("UPDATE offers SET product_id = ?, offer_type = ?, min_quantity = ?, discount_value = ?, description = ? WHERE id = ?");
        return $stmt->execute([$product_id, $offer_type, $min_qty, $disc_val, $description, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM offers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
// This class represents an offer in the application.
// It provides methods to retrieve all offers, get a specific offer by ID, create new offers, update existing offers, and delete offers.