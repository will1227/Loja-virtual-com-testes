<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTest extends TestCase
{
    public function testProdutoTipo()
    {
        // Cria um produto
        $product = new Product();

        // Pega a relação "type" do produto
        $relation = $product->type();

        // Verifica se a relação é do tipo BelongsTo (produto pertence a um tipo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }
}

