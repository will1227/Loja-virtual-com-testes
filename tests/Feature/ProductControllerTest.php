<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase; // Limpa o banco de dados antes de cada teste

    /**
     * Método auxiliar para autenticar um usuário antes dos testes
     */
    protected function authenticate()
    {
        $user = User::factory()->create(); // Cria um usuário de teste
        $this->actingAs($user); // Faz login no sistema com esse usuário
    }

    /**
     * Testa se podemos criar um produto
     */
    public function testCriaProduto()
    {
        $this->authenticate(); // Autentica antes do teste

        $type = Type::factory()->create(); // Cria um tipo de produto para associar

        // Envia requisição POST para criar o produto
        $response = $this->post('/products/new', [
            'name' => 'Produto Teste',
            'description' => 'Descrição do produto',
            'quantity' => 10,
            'price' => 100,
            'type_id' => $type->id
        ]);

        // Verifica se houve redirecionamento para a listagem de produtos
        $response->assertRedirect('/products');

        // Confirma que o produto foi salvo no banco de dados
        $this->assertDatabaseHas('products', ['name' => 'Produto Teste']);
    }

    /**
     * Testa se a listagem de produtos funciona
     */
    public function testListProduto()
    {
        $this->authenticate(); // Autentica antes do teste

        $product = Product::factory()->create(); // Cria um produto de teste

        // Acessa a página de listagem de produtos
        $response = $this->get('/products');

        // Verifica se a página retornou status 200 (OK)
        $response->assertStatus(200);

        // Verifica se o produto criado aparece na página
        $response->assertSee($product->name);
    }

    /**
     * Testa se é possível atualizar um produto
     */
    public function testUpdateProduto()
    {
        $this->authenticate(); // Autentica antes do teste

        $product = Product::factory()->create(); // Produto inicial
        $type = Type::factory()->create();       // Novo tipo para atualizar

        // Envia requisição POST para atualizar o produto
        $response = $this->post('/products/update', [
            'id' => $product->id,
            'name' => 'Produto Atualizado',
            'description' => 'Descrição atualizada',
            'quantity' => 20,
            'price' => 150,
            'type_id' => $type->id
        ]);

        // Verifica redirecionamento após update
        $response->assertRedirect('/products');

        // Confirma que o nome foi alterado no banco de dados
        $this->assertDatabaseHas('products', ['name' => 'Produto Atualizado']);
    }

    /**
     * Testa se é possível deletar um produto
     */
    public function testDelProduto()
    {
        $this->authenticate(); // Autentica antes do teste

        $product = Product::factory()->create(); // Produto a ser deletado

        // Envia requisição GET para deletar
        $response = $this->get('/products/delete/' . $product->id);

        // Verifica redirecionamento após delete
        $response->assertRedirect('/products');

        // Confirma que o produto foi removido do banco de dados
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
