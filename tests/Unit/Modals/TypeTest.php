<?php declare(strict_types=1);

namespace Unit\Modals;

use App\Models\Card;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function Type_has_relationships_with_Card(): void
    {
        $type = factory(Type::class)->create();
        $card = factory(Card::class)->create(['type_id' => $type->id]);

        $this->assertSame($card->id, $type->card->id);
    }

    /** @test */
    public function class_has_attributes(): void
    {
        array_map(function (string $attr): void {
            $this->assertClassHasAttribute($attr, Type::class);
        }, ['timestamps', 'guarded']);
    }
}
