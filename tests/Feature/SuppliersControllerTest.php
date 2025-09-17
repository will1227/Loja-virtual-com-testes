<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuppliersControllerTest extends TestCase
{
    use RefreshDatabase; // Garante que o banco será limpo a cada teste

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria um usuário para autenticação em todas as rotas que exigem login
        $this->user = User::factory()->create();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_supplier(): void
    {
        $this->actingAs($this->user); // Simula um usuário logado

        // Envia uma requisição POST para criar um fornecedor
        $response = $this->post('/suppliers/new', [
            'tipo' => 'F', // 'F' = pessoa física, 'J' = pessoa jurídica
            'name' => 'Fornecedor Teste',
            'cpf_cnpj' => '12345678901',
            'telefone' => '11999999999'
        ]);

        // Verifica se houve redirecionamento correto após criar o fornecedor
        $response->assertRedirect('/suppliers');

        // Verifica se o fornecedor foi inserido no banco
        $this->assertDatabaseHas('suppliers', [
            'name' => 'Fornecedor Teste',
            'tipo' => 'F'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_list_suppliers(): void
    {
        $this->actingAs($this->user);

        // Cria um fornecedor diretamente no banco (para teste de listagem)
        $supplier = Suppliers::create([
            'tipo' => 'F',
            'name' => 'Fornecedor Listagem',
            'cpf_cnpj' => '12345678901',
            'telefone' => '11999999999'
        ]);

        // Acessa a rota que lista fornecedores
        $response = $this->get('/suppliers');

        // Verifica se a resposta HTTP é 200 (OK)
        $response->assertStatus(200);

        // Verifica se o nome do fornecedor aparece na página
        $response->assertSee($supplier->name);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_supplier(): void
    {
        $this->actingAs($this->user);

        // Cria um fornecedor para atualizar
        $supplier = Suppliers::create([
            'tipo' => 'F',
            'name' => 'Fornecedor Original',
            'cpf_cnpj' => '12345678901',
            'telefone' => '11999999999'
        ]);

        // Envia POST para atualizar o fornecedor (rota com o ID)
        $response = $this->post('/suppliers/update/' . $supplier->id, [
            'tipo' => 'F', // precisa ser 'F' ou 'J' conforme validação do controller
            'name' => 'Fornecedor Atualizado',
            'cpf_cnpj' => '12345678000199',
            'telefone' => '11988888888'
        ]);

        // Verifica se houve redirecionamento correto
        $response->assertRedirect('/suppliers');

        // Confirma se o fornecedor foi atualizado no banco
        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => 'Fornecedor Atualizado',
            'tipo' => 'F'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_supplier(): void
    {
        $this->actingAs($this->user);

        // Cria um fornecedor para deletar
        $supplier = Suppliers::create([
            'tipo' => 'F',
            'name' => 'Fornecedor Para Deletar',
            'cpf_cnpj' => '12345678901',
            'telefone' => '11999999999'
        ]);

        // Envia DELETE para a rota correta
        $response = $this->delete('/suppliers/delete/' . $supplier->id);

        // Verifica se houve redirecionamento após deletar
        $response->assertRedirect('/suppliers');

        // Confirma que o fornecedor foi removido do banco
        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    }
}
