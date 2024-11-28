<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\prestamos;
use App\Models\libros;
use App\Models\User;
use App\Services\LoanService;
use Illuminate\Support\Facades\Http;

class prestamosControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $loanService;
    public function __construct()
    {
        parent::__construct();
        $this->loanService = \Mockery::mock(LoanService::class);
    }
    public function it_creates_a_new_loan()
    {
        $user = User::factory()->create();
        $libro = libros::factory()->create();

        $libro->shouldReceive('isAvailable')->once()->andReturn(true);

        $data = [
            'id_ususario' => $user->id,
            'id_libro' => $libro->id,
        ];

        $this->loanService
            ->shouldReceive('createLoan')
            ->once()
            ->with($user, $libro)
            ->andReturn(new prestamos());

        $response = $this->postJson(route('prestamos.createLoan'), $data);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Préstamo creado con éxito']);
    }
    public function it_returns_error_if_book_is_not_available_for_loan()
    {
        $user = User::factory()->create();
        $libro = libros::factory()->create();

        $libro->shouldReceive('isAvailable')->once()->andReturn(false);

        $data = [
            'id_ususario' => $user->id,
            'id_libro' => $libro->id,
        ];


        $response = $this->postJson(route('prestamos.createLoan'), $data);


        $response->assertStatus(400);
        $response->assertJson(['error' => 'El libro no está disponible']);
    }
    public function it_updates_a_loan()
    {
        // Crear un préstamo de prueba
        $prestamo = prestamos::factory()->create();

        // Datos de actualización
        $data = [
            'id_libro' => $prestamo->id_libro,
            'id_ususario' => $prestamo->id_ususario,
            'fecha_salida' => now(),
            'fecha_devolucion' => now()->addDays(7),
        ];

        // Enviar la solicitud de actualización del préstamo
        $response = $this->put(route('prestamos.update', $prestamo->id), $data);

        // Verificar la redirección
        $response->assertRedirect();
        $this->assertDatabaseHas('prestamos', [
            'id_libro' => $data['id_libro'],
            'id_ususario' => $data['id_ususario'],
        ]);
    }
    public function it_deletes_a_loan()
    {
        
        $prestamo = prestamos::factory()->create();

        
        $response = $this->delete(route('prestamos.destroy', $prestamo->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('prestamos', ['id' => $prestamo->id]);
    }
    public function it_shows_loans_per_month()
    {
        
        prestamos::factory()->count(3)->create();
        prestamos::factory()->count(2)->create(['borrowed_at' => now()->subMonth()]);

        
        $response = $this->get(route('prestamos.loansPerMonth'));

       
        $response->assertStatus(200);
        $response->assertSee('mes');
    }
    public function it_creates_a_loan_with_service()
    {
        
        $user = User::factory()->create();
        $libro = libros::factory()->create();

        
        $this->loanService->shouldReceive('createLoan')->once()->andReturn(new prestamos());

       
        $data = [
            'id_ususario' => $user->id,
            'id_libro' => $libro->id,
        ];

        
        $response = $this->postJson(route('prestamos.createLoan'), $data);

        
        $response->assertStatus(201);
        $response->assertJson(['message' => 'Préstamo creado con éxito']);
    }
    public function it_returns_loan_on_return()
    {
        
        $prestamo = prestamos::factory()->create(['returned_at' => null]);

        
        $response = $this->postJson(route('prestamos.returnLoan', $prestamo->id));

        
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Préstamo devuelto con éxito']);
    }
    public function it_returns_error_if_loan_already_returned()
    {
        
        $prestamo = prestamos::factory()->create(['returned_at' => now()]);


        $response = $this->postJson(route('prestamos.returnLoan', $prestamo->id));


        $response->assertStatus(400);
        $response->assertJson(['error' => 'El préstamo ya ha sido devuelto']);
    }
}
