<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_redirecting_to_register_page(){

        $response = $this->get('/register');
    
        $response->assertStatus(200);
    }
    public function test_user_giving_validation_on_already_exist_email()
    {
        $user = User::factory()->create(
            [
                'email' => 'ahmed007@mailinator.com' 
            ]
        );
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'ahmed007@mailinator.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        
        $response->assertSessionHasErrors('email');
      
    }

    public function test_user_giving_validation_on_already_exist_employeeno()
    {
        $user = User::factory()->create(
            [
                'employeeno' => '123' 
            ]
        );
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'ahmed007@mailinator.com',
            'employeeno' => '123',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        
        $response->assertSessionHasErrors('employeeno');
      
    }

    public function test_user_successfully_registered(){

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'employeeno' => '123',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
    
        $response->assertRedirect('/dashboard');
    }
}
