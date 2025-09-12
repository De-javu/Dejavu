<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ListarVistasTest extends TestCase
{

         use RefreshDatabase;

public function test_archivos_archivo_se_cargan()
{
    // Se crea un usuario ficticio para simular la autenticación
    $user = User::factory()->create();

    // Se simula una solicitud GET a la ruta protegida
    $response = $this->actingAs($user)->get('/archivos/archivo');

    // Se verifica que la respuesta sea exitosa (código 200)
    $response->assertStatus(200);
}

public function test_archivos_video_se_cargan()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/archivos/video');
        $response->assertStatus(200);
    }

    public function test_archivos_audio_se_cargan()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/archivos/audio');
        $response->assertStatus(200);
    }

    public function test_archivos_imagen_se_cargan()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/archivos/imagen');
        $response->assertStatus(200);
    }
}
