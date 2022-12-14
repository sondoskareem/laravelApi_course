<?php

namespace Tests\Feature;

Use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Author;
use App\User;
use Laravel\Passport\Passport;

class UserTest extends TestCase
{
    /**
* @test
* @watch
*/
public function
it_returns_all_users_as_a_collection_of_resource_objects()
    {
        $users = factory(User::class, 3)->create();
        $users = $users->sortBy(function ($item) {
        return $item->id;
        })->values();
        Passport::actingAs($users->first());
        $this->getJson("/api/v1/users", [
        'accept' => 'application/vnd.api+json',
        'content-type' => 'application/vnd.api+json',
        ]) ->assertStatus(200)
        ->assertJson([
        "data" => [
        [
        "id" => $users[0]->id,
        "type" => "users",
        "attributes" => [
        'name' => $users[0]->name,
        'email' => $users[0]->email,
        'role' => 'user',
        'created_at' => $users[0]->created_at->
        toJSON(),
        'updated_at' => $users[0]->updated_at->
        toJSON(),
        ]
        ],
        [
        "id" => $users[1]->id,
        "type" => "users",
        "attributes" => [
        'name' => $users[1]->name,
        'email' => $users[1]->email,
        'role' => 'user',
        'created_at' => $users[1]->created_at->
        toJSON(),
        'updated_at' => $users[1]->updated_at->
        toJSON(),
        ]
        ],
        [
        "id" => $users[2]->id,
        "type" => "users",
        "attributes" => [
        'name' => $users[2]->name,
        'email' => $users[2]->email,
        'role' => 'user',
        'created_at' => $users[2]->created_at->
        toJSON(),
        'updated_at' => $users[2]->updated_at->
        toJSON(),
        ]
        ],
        ]
        ]);
    }


    /**
* @test
*/
public function it_can_create_an_user_from_a_resource_object()
    {
        $user = factory(User::class)->create();
        Passport::actingAs($user);
        $response = $this->postJson('/api/v1/users', [
        'data' => [
        'type' => 'users',
        'attributes' => [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'secret',
        ]
        ]
        ], [
        'accept' => 'application/vnd.api+json',
        'content-type' => 'application/vnd.api+json',
        ])->assertStatus(201)
        ->assertJson([
        "data" => [
        "type" => "users",
        "attributes" => [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'role' => 'user',
        'created_at' => now()->setMilliseconds(0)->
        toJSON(),
        'updated_at' => now() ->setMilliseconds(0)->
        toJSON(),
        ]
        ]
        ]);
        $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'role' => 'user',
        ]);
        $this->assertTrue(Hash::check('secret', User::whereName('John
        Doe')->first()->password));
    }
    
}