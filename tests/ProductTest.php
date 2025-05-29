<?php

use PHPUnit\Framework\TestCase;
use Acme\Models\Product;

class ProductTest extends TestCase
{
    protected Product $product;

    protected function setUp(): void
    {
        $this->product = new Product();
    }

    public function testCanFetchAllProducts(): void
    {
        $products = $this->product->all();
        $this->assertIsArray($products);
        $this->assertNotEmpty($products);

        foreach ($products as $product) {
            $this->assertArrayHasKey('code', $product);
            $this->assertArrayHasKey('name', $product);
            $this->assertArrayHasKey('price', $product);
        }
    }
}
