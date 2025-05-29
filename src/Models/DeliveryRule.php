<?php

namespace Acme\Models;

use Acme\Database;
use PDO;

class DeliveryRule
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM delivery_rules ORDER BY min_amount");
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery_rules WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($min_amount, $max_amount, $delivery_cost)
    {
        $stmt = $this->pdo->prepare("INSERT INTO delivery_rules (min_amount, max_amount, delivery_cost) VALUES (?, ?, ?)");
        return $stmt->execute([$min_amount, $max_amount, $delivery_cost]);
    }

    public function update($id, $min_amount, $max_amount, $delivery_cost)
    {
        $stmt = $this->pdo->prepare("UPDATE delivery_rules SET min_amount = ?, max_amount = ?, delivery_cost = ? WHERE id = ?");
        return $stmt->execute([$min_amount, $max_amount, $delivery_cost, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM delivery_rules WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
// This class manages delivery rules in the application.
// It provides methods to retrieve all rules, get a specific rule by ID, create new rules, update existing rules, and delete rules.