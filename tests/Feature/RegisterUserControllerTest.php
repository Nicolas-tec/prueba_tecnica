<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterUserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function it_shows_the_registration_form()
    {
        
        $response = $this->get(route('register'));

       
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }
    public function it_registers_a_new_user()
    {
       
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

       
        $response = $this->post(route('register'), $data);

       
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
        ]);

       
        $response->assertRedirect(route('dashboard'));
    }
    public function it_validates_user_registration_data()
    {
        
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        
        $response->assertSessionHasErrors(['email']);
    }
    public function it_validates_password_confirmation()
    {
       
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'wrongpassword',
        ]);

        
        $response->assertSessionHasErrors(['password']);
    }
    public function it_logs_error_if_registration_fails()
    {
        
        Log::shouldReceive('error')->once()->with('Error al registrar usuario: Database Error');

        
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        User::shouldReceive('create')->once()->andThrow(new \Exception('Database Error'));

        
        $response = $this->post(route('register'), $data);

        
        $response->assertSessionHasErrors(['error' => 'No se pudo registrar el usuario.']);
    }
    public function it_does_not_register_duplicate_email()
    {
       
        User::factory()->create([
            'email' => 'existinguser@example.com',
        ]);

       
        $response = $this->post(route('register'), [
            'name' => 'New User',
            'email' => 'existinguser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

      
        $response->assertSessionHasErrors(['email']);
    }

}
