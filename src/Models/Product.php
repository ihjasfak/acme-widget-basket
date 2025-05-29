<?php
namespace Acme\Models;

use Acme\Database;
use PDO;

class Product
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByCode(string $code): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE code = ?");
        $stmt->execute([$code]);
        return $stmt->fetch();
    }

    public function create($code, $name, $price)
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (code, name, price) VALUES (?, ?, ?)");
        return $stmt->execute([$code, $name, $price]);
    }

    public function update($id, $code, $name, $price)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET code = ?, name = ?, price = ? WHERE id = ?");
        return $stmt->execute([$code, $name, $price, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
// This class represents a product in the application.
// It provides methods to retrieve all products, get a specific product by ID, create new products, update existing products, and delete products.