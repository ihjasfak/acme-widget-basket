<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Acme\Models\Product;
use Acme\Models\DeliveryRule;
use Acme\Models\Offer;

header('Content-Type: application/json');

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'products':
        $product = new Product();
        echo json_encode($product->all());
        break;

    case 'delivery_rules':
        $rule = new DeliveryRule();
        echo json_encode($rule->all());
        break;

    case 'offers':
        $offer = new Offer();
        echo json_encode($offer->all());
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Invalid API action']);
        break;
}
