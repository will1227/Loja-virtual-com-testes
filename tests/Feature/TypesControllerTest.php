<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TypesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Autentica um usuário antes do teste
     */
    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /**
     * Testa se é possível criar um tipo
     */
    public function testCriaTipo()
    {
        $this->authenticate();

        $response = $this->post('/types/new', [
            'name' => 'Tipo Teste'
        ]);

        $response->assertRedirect('/'); // Redireciona para a home após criar
        $this->assertDatabaseHas('types', ['name' => 'Tipo Teste']);
    }

    /**
     * Testa se a listagem de tipos funciona
     */
    public function testListaTipo()
    {
        $this->authenticate();

        $type = Type::factory()->create();

        $response = $this->get('/types');

        $response->assertStatus(200);
        $response->assertSee($type->name);
    }

    /**
     * Testa se é possível atualizar um tipo
     */
    public function testUpdateTipo()
    {
        $this->authenticate();

        $type = Type::factory()->create();

        $response = $this->post('/types/update', [
            'id' => $type->id,
            'name' => 'Tipo Atualizado'
        ]);

        $response->assertRedirect('/types');
        $this->assertDatabaseHas('types', ['name' => 'Tipo Atualizado']);
    }

    /**
     * Testa se é possível deletar um tipo
     */
    public function testDelTipo()
    {
        $this->authenticate();

        $type = Type::factory()->create();

        $response = $this->get('/types/delete/' . $type->id);

        $response->assertRedirect('/types');
        $this->assertDatabaseMissing('types', ['id' => $type->id]);
    }
}
