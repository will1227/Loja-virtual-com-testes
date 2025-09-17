<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class SupplierFormTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[\PHPUnit\Framework\Attributes\Test]
    public function userPodeCriarFornecedor(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/suppliers/new')
                ->type('@name', 'Fornecedor XPTO')
                ->select('@tipo', 'J')
                ->type('@cpf_cnpj', '12.345.678/0001-99')
                ->type('@telefone', '(11) 91234-5678')
                ->press('@save-button')
                ->assertPathIs('/suppliers'); 
        });
    }

    
}
