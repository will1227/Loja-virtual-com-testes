<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Type;
use App\Models\User;

class ProductFormTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[\PHPUnit\Framework\Attributes\Test]
    public function userPodeCriarProduto(): void
    {
        // Cria um usuário autenticado
        $user = User::factory()->create();

        // Cria um tipo de produto 
        $type = Type::factory()->create([
            'name' => 'Eletrônico'
        ]);

        $this->browse(function (Browser $browser) use ($user, $type) {
            $browser->loginAs($user)
                ->visit('/products/new')
                ->type('@name', 'Smartphone ')
                ->type('@description', 'Um smartphone')
                ->type('@quantity', '10')
                ->type('@price', '1999')
                ->select('@type_id', $type->id)
                // Campo de imagem deixado vazio
                ->press('@save-button')
                ->assertPathIs('/products'); // ajuste conforme redirecionamento
        });
    }

   
}
