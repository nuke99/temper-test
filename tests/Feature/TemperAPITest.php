<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemperAPITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    private $_token = '';
    public function testExample()
    {
        $this->assertTrue(true);
    }

    private function authenticate() {
        $response  = $this->postJson('/auth/login',[
            'email' => env('DEFAULT_ADMIN_EMAIL'),
            'password' => env('DEFAULT_ADMIN_PASSWORD')
        ]);

        if($response->status() === 200) {
            $this->_token = json_decode($response->content())->data;
        }
        return $response;
    }

    public function testPostRequest() {
        $response = $this->authenticate();
        $response->assertStatus(200);
    }
    public function testStatistic() {
        $this->authenticate();
        $this->withHeader('Authorization',$this->_token);

        $response = $this->getJson('/dashboard/weekly-cohorts');
        $response->assertStatus(200)
            ->assertJson([
                'status' => true
            ]);

    }
}
