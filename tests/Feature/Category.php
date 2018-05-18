<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Category extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCategoryCreate()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $payload = ['name' => $this->faker->name];
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('category.store'), $payload);
        $this->assertDatabaseHas('categories', ['name' => $payload['name']]);
    }

    public function testCategoryRead()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $categories = factory(\App\Category::class, 3)->create();

        $this->withoutMiddleware(VerifyCsrfToken::class);
        $response = $this->get(route('category.index'));
        $response->assertStatus(200);
        foreach ($categories as $category) {
            $this->assertContains($category->name, $response->getContent());
        }
    }
}
