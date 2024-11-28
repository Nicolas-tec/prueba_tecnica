<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
    public function it_redirects_guests_to_login()
    {
        
        $response = $this->get(route('home'));

        
        $response->assertRedirect(route('login'));
    }
    public function it_displays_home_view_for_authenticated_users()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }
}
