<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * Teste de login funcional
     */
    public function testUserPodeLogar(): void
    {
        $this->browse(function (Browser $browser) {
            // Cria um usuário no banco de dados de teste
            $user = User::factory()->create([
                'email' => 'teste@example.com',
                'password' => bcrypt('password123'),
            ]);

            $browser->visit('/login')
                ->type('email', 'teste@example.com')
                ->type('password', 'password123')
                ->press('@login-button') // ajuste conforme o texto do botão
                ->assertPathIs('/dashboard'); // ajuste conforme a rota
        });
    }
}
