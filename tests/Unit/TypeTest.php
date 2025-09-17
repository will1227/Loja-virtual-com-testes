<?php

namespace Tests\Unit;

use Tests\TestCase; 
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeTest extends TestCase
{
    public function testTipoMuitosProdutos()
    {
        // Cria um tipo
        $type = new Type();

        // Pega a relação "products" do tipo
        $relation = $type->products();

        // Verifica se a relação é do tipo HasMany (um tipo tem muitos produtos)
        $this->assertInstanceOf(HasMany::class, $relation);
    }
}
