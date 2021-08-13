<?php

namespace Tests\Feature;

use App\Http\Requests\CharacterRequest;
use Tests\TestCase;
use App\Models\Character;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetching_list_of_characters()
    {
        Character::factory()->count(10)->create();
        
        $response = $this->getJson('api/v1/characters');
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'status',
                'gender',
                'race',
                'description',
                'deleted_at',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_fetching_a_character()
    {
        $character = Character::factory()->create();
        
        $response = $this->getJson('api/v1/characters/'.$character->id);

        $response->assertJsonStructure([
            'id',
            'name',
            'status',
            'gender',
            'race',
            'description',
            'deleted_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function test_creating_a_character()
    {
        $character = Character::factory()->raw();
        
        $response = $this->postJson('api/v1/characters', $character);
        $this->assertDatabaseHas('characters', $character);
        $response->assertJson(["message" => "Персонаж сохранен"]);
    }

    public function test_updating_a_character()
    {
        $this->withoutExceptionHandling();
        $character = (Character::factory()->create())->toArray();
        $character['name'] = 'Barack Obama';
        
        $response = $this->putJson('api/v1/characters/'.$character['id'], $character);
        $this->assertDatabaseHas('characters', ['name' => 'Barack Obama']);
        $response->assertJson(['message' => 'Персонаж обновлен']);
    }

    public function test_deleting_a_character()
    {
        // given - We have a created character.
        $character = (Character::factory()->create())->toArray();
        // when - we delete that character by specific route
        $response = $this->deleteJson('api/v1/characters/'.$character['id']);
        //then - that character should not exist in database AND receive message = "Персонаж удален"
        $this->assertSoftDeleted('characters', $character);
        $response->assertJson(['message' => 'Персонаж удален']);
    }
}
