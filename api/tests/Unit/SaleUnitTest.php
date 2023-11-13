<?php

namespace Tests\Unit;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleUnitTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_sale()
    {
        $sale = Sale::make([
            'product_id' => '08e019cd-e39b-4db5-a7e1-59faaff37b05',
            'customer_id' => '8e5efb6d-c129-4181-9f86-7a3f46be1780',
            'count' => 5,
        ]);

        $sale->save();

        $this->assertDatabaseHas('sales', [
            'product_id' => '08e019cd-e39b-4db5-a7e1-59faaff37b05',
            'customer_id' => '8e5efb6d-c129-4181-9f86-7a3f46be1780',
            'count' => 5,
        ]);
    }
}
