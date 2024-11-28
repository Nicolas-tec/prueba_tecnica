<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\libros;
use App\Models\User;
use App\Models\prestamos;
use App\Models\categoria;
use Illuminate\Support\Facades\DB;

class StatsControllerTest extends TestCase
{
    use RefreshDatabase;
    public function it_returns_most_borrowed_books()
    {
        
        $libro1 = libros::factory()->create();
        $libro2 = libros::factory()->create();
        
        prestamos::factory()->create(['id_libro' => $libro1->id_libro]);
        prestamos::factory()->create(['id_libro' => $libro1->id_libro]);
        prestamos::factory()->create(['id_libro' => $libro2->id_libro]);

     
        $response = $this->getJson(route('stats.mostBorrowedBooks'));

        
        $response->assertStatus(200);

        
        $response->assertJsonStructure(['data' => [['id_libro', 'titulo', 'loans_count']]]);
        $response->assertJsonFragment([
            'id_libro' => $libro1->id_libro,
            'loans_count' => 2, 
        ]);
        $response->assertJsonFragment([
            'id_libro' => $libro2->id_libro,
            'loans_count' => 1, 
        ]);
    }
    public function it_returns_most_active_users()
    {
       
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        prestamos::factory()->create(['id_ususario' => $user1->id_ususario]);
        prestamos::factory()->create(['id_ususario' => $user1->id_ususario]);
        prestamos::factory()->create(['id_ususario' => $user2->id_ususario]);

        
        $response = $this->getJson(route('stats.mostActiveUsers'));

        
        $response->assertStatus(200);

        
        $response->assertJsonStructure(['data' => [['id_ususario', 'name', 'loans_count']]]);
        $response->assertJsonFragment([
            'id_ususario' => $user1->id_ususario,
            'loans_count' => 2, 
        ]);
        $response->assertJsonFragment([
            'id_ususario' => $user2->id_ususario,
            'loans_count' => 1, 
        ]);
    }
    public function it_returns_most_available_books()
    {
        
        $libro1 = libros::factory()->create(['quantity' => 5]);
        $libro2 = libros::factory()->create(['quantity' => 10]);

        
        $response = $this->getJson(route('stats.mostAvailableBooks'));

       
        $response->assertStatus(200);

        
        $response->assertJsonStructure(['data' => [['id_libro', 'titulo', 'quantity']]]);
        $response->assertJsonFragment([
            'id_libro' => $libro2->id_libro,
            'quantity' => 10,
        ]);
        $response->assertJsonFragment([
            'id_libro' => $libro1->id_libro,
            'quantity' => 5,
        ]);
    }
    public function it_returns_loans_per_month()
    {
        
        prestamos::factory()->create(['borrowed_at' => '2024-01-01']);
        prestamos::factory()->create(['borrowed_at' => '2024-01-01']);
        prestamos::factory()->create(['borrowed_at' => '2024-02-01']);

        
        $response = $this->getJson(route('stats.loansPerMonth'));

        
        $response->assertStatus(200);

       
        $response->assertJsonFragment(['month' => 1, 'total_loans' => 2]);
        $response->assertJsonFragment(['month' => 2, 'total_loans' => 1]);
    }
    public function it_returns_most_popular_categories()
    {
       
        $categoria1 = categoria::factory()->create();
        $categoria2 = categoria::factory()->create();

        libros::factory()->create(['id_categoria' => $categoria1->id_categoria]);
        libros::factory()->create(['id_categoria' => $categoria1->id_categoria]);
        libros::factory()->create(['id_categoria' => $categoria2->id_categoria]);

       
        $response = $this->getJson(route('stats.mostPopularCategories'));

      
        $response->assertStatus(200);

        
        $response->assertJsonFragment([
            'id_categoria' => $categoria1->id_categoria,
            'loans_count' => 2,
        ]);
        $response->assertJsonFragment([
            'id_categoria' => $categoria2->id_categoria,
            'loans_count' => 1,
        ]);
    }

}
