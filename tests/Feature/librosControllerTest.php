<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\libros;
use App\Models\categoria;
use App\Models\prestamos;

class librosControllerTest extends TestCase
{
    use RefreshDatabase;
    public function it_displays_the_books_list()
    {
        // Crear libros de prueba
        $libros = libros::factory()->count(3)->create();

        // Solicitar la vista de index
        $response = $this->get(route('libros.index'));

        // Verificar que la vista y los datos son correctos
        $response->assertStatus(200);
        $response->assertViewIs('libros.libros');
        $response->assertViewHas('libros', $libros);
    }
    public function it_creates_a_new_book()
    {
       
        $categoria = categoria::factory()->create();

        
        $data = [
            'id_categoria' => $categoria->id,
            'titulo' => 'Nuevo libro',
            'sub_titulo' => 'Sub título',
            'pagina' => 200,
            'ISBN' => '123-456-789',
            'editorial' => 'Editorial XYZ',
            'autor' => 'Autor de prueba',
        ];

       
        $response = $this->post(route('libros.store'), $data);

       
        $response->assertRedirect();

       
        $this->assertDatabaseHas('libros', ['titulo' => 'Nuevo libro']);
    }
    public function it_updates_a_book()
    {
       
        $libro = libros::factory()->create();

        
        $data = [
            'titulo' => 'Título actualizado',
            'sub_titulo' => 'Sub título actualizado',
            'pagina' => 300,
            'ISBN' => '987-654-321',
            'editorial' => 'Editorial ABC',
            'autor' => 'Nuevo autor',
        ];

        
        $response = $this->put(route('libros.update', $libro->id), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('libros', ['titulo' => 'Título actualizado']);
        $this->assertDatabaseMissing('libros', ['titulo' => $libro->titulo]);
    }
    public function it_deletes_a_book()
    {
       
        $libro = libros::factory()->create();

        
        $response = $this->delete(route('libros.destroy', $libro->id));

        
        $response->assertRedirect();

        
        $this->assertDatabaseMissing('libros', ['id_libro' => $libro->id]);
    }
    public function it_displays_most_popular_books()
    {
        // Crear libros y asociarles préstamos
        $libros = libros::factory()->count(5)->create();
        foreach ($libros as $libro) {
            prestamos::factory()->create(['libro_id' => $libro->id]);
        }

        // Llamar al método para obtener los libros más populares
        $response = $this->get(route('libros.showMostPopularBooks'));

        // Verificar que la respuesta contiene la información correcta
        $response->assertStatus(200);
        foreach ($libros as $libro) {
            $response->assertSee($libro->titulo);
        }
    }
    public function it_displays_least_popular_books()
    {
        // Crear libros y asociarles préstamos
        $libros = libros::factory()->count(5)->create();
        foreach ($libros as $libro) {
            prestamos::factory()->create(['libro_id' => $libro->id]);
        }

        // Llamar al método para obtener los libros menos populares
        $response = $this->get(route('libros.leastPopularBooks'));

        // Verificar que la respuesta contiene la información correcta
        $response->assertStatus(200);
        foreach ($libros as $libro) {
            $response->assertSee($libro->titulo);
        }
    }

}
