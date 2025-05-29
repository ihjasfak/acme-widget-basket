<?php

use PHPUnit\Framework\TestCase;
use Acme\Models\Offer;

class OfferTest extends TestCase
{
    protected Offer $offer;

    protected function setUp(): void
    {
        $this->offer = new Offer();
    }

    public function testCanFetchAllOffers(): void
    {
        $offers = $this->offer->all();
        $this->assertIsArray($offers);
        $this->assertNotEmpty($offers);

        foreach ($offers as $offer) {
            $this->assertArrayHasKey('product_code', $offer);
            $this->assertArrayHasKey('description', $offer);
            $this->assertArrayHasKey('type', $offer);
        }
    }
}
