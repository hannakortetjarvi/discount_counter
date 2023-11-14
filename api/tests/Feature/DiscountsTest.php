<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiscountsTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test if discounts page exists
     *
     * @return void
     */
    public function test_discounts()
    {
        $response = $this->get('/discounts');
        $response->assertStatus(200);
    }
}
