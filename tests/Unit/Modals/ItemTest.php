<?php declare(strict_types=1);

namespace Unit\Modals;

use App\Models\Card;
use App\Models\Type;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function getCards_returns_3_cards_with_lazy_loaded_types(): void
    {
        factory(Card::class, 4)->create();

        $cards = Card::getCards();

        $this->assertCount(3, $cards);
        $this->assertTrue(is_array($cards));
        $this->assertArrayHasKey('type', current($cards));
        $this->assertNotEmpty(current($cards)['type']);
    }

    /** @test */
    public function Card_has_relationships_with_Type(): void
    {
        $type = factory(Type::class)->create();
        $card = factory(Card::class)->create(['type_id' => $type->id]);

        $this->assertSame($type->name, $card->type->name);
    }

    /** @test */
    public function class_has_attributes(): void
    {
        array_map(function (string $attr): void {
            $this->assertClassHasAttribute($attr, Card::class);
        }, ['timestamps', 'guarded']);
    }
}
