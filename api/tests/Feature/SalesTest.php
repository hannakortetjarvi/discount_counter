<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test if sales page exists
     *
     * @return void
     */
    public function test_sales()
    {
        $response = $this->get('/sales');
        $response->assertStatus(200);
    }
}
