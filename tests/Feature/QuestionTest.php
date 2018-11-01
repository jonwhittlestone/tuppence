<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/question/balance');
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'current_balance' => $response->original['current_balance']
        ]);

        $this->assertTrue(is_int($response->original['current_balance']));
    }
}
