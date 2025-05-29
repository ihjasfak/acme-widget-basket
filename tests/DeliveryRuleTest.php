<?php

use PHPUnit\Framework\TestCase;
use Acme\Models\DeliveryRule;

class DeliveryRuleTest extends TestCase
{
    protected DeliveryRule $rule;

    protected function setUp(): void
    {
        $this->rule = new DeliveryRule();
    }

    public function testCanFetchAllDeliveryRules(): void
    {
        $rules = $this->rule->all();
        $this->assertIsArray($rules);
        $this->assertNotEmpty($rules);

        foreach ($rules as $rule) {
            $this->assertArrayHasKey('min_amount', $rule);
            $this->assertArrayHasKey('max_amount', $rule);
            $this->assertArrayHasKey('delivery_cost', $rule);
        }
    }
}
