<?php

namespace Tests\Unit;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleUnitTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test adding Sale to database
     *
     * @return void
     */
    public function test_sale()
    {
        // Create sale
        $sale = Sale::make([
            'product_id' => '08e019cd-e39b-4db5-a7e1-59faaff37b05',
            'customer_id' => '8e5efb6d-c129-4181-9f86-7a3f46be1780',
            'count' => 5,
        ]);
        $sale->save();

        // Check that sale exists
        $this->assertDatabaseHas('sales', [
            'product_id' => '08e019cd-e39b-4db5-a7e1-59faaff37b05',
            'customer_id' => '8e5efb6d-c129-4181-9f86-7a3f46be1780',
            'count' => 5,
        ]);

        // Update the Sale
        $updatedSaleData = [
            'product_id' => '08e019cd-e39b-4db5-a7e1-000test12345',
            'count' => 123,
        ];
        $sale->update($updatedSaleData);
        
        // Check that the sale has been updated
        $this->assertDatabaseHas('sales', [
            'product_id' => '08e019cd-e39b-4db5-a7e1-000test12345',
            'count' => 123,
        ]);
        
        // Delete the Sale
        $sale->delete();
        
        // Check that sale has been deleted
        $this->assertDatabaseMissing('sales', [
            'product_id' => 'new-product-id',
            'count' => 10,
        ]);
    }
}
