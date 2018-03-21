<?php

namespace Tests\Feature;

use App\Admins;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemperAPITest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    private $_token = '';


    private function _authenticate()
    {
        factory(Admins::class)->create();

        $response = $this->postJson('/auth/login', [
            'email' => env('DEFAULT_ADMIN_EMAIL'),
            'password' => env('DEFAULT_ADMIN_PASSWORD')
        ]);

        if ($response->status() === 200) {
            $this->_token = json_decode($response->content())->data;
        }
        return $response;
    }

    /**
     * Authentication Test
     */
    public function testJWTAuthRequest()
    {
        $response = $this->_authenticate();

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data'
            ])
            ->assertJson(['status' => true]);
    }

    /**
     * Weekly Cohorts Test
     */
    public function testWeeklyCohorts()
    {
        $this->_authenticate();
        $this->withHeader('Authorization', $this->_token);

        $this->getJson('/dashboard/weekly-cohorts')
            ->assertStatus(200)
            ->assertJson([
                'status' => true
            ])
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'name',
                        'data'
                    ]
                ]
            ]);
    }
}
