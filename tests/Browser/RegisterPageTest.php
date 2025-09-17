<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[\PHPUnit\Framework\Attributes\Test]
    public function userPodeRegistrar(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                        // Acessa a página de registro

                ->type('@name', 'William Teste')
                                // Preenche o campo nome

                ->type('@email', 'william@example.com')
                                // Preenche o campo email

                ->type('@password', 'senhaSegura123')
                                // Confirma a senha

                ->type('@password_confirmation', 'senhaSegura123')
                                // Clica no botão de registro

                ->press('@register-button')
                                // Verifica se foi redirecionado para o dashboard

                ->assertPathIs('/dashboard'); 
        });
    }

    
}
