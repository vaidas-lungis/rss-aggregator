<?php

namespace Tests\Feature;

use App\Feed;
use App\Http\Middleware\VerifyCsrfToken;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedCrud extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testFeedCreate()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $payload = ['url' => $this->faker->url];
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('feed.store'), $payload);
        $this->assertDatabaseHas('feeds', ['url' => $payload['url']]);
    }

    public function testFeedRead()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $feeds = factory(Feed::class, 3)->create();

        $this->withoutMiddleware(VerifyCsrfToken::class);
        $response = $this->get(route('feed.index'));
        foreach ($feeds as $feed){
            $this->assertContains($feed->url, $response->getContent());
        }
    }

    public function testFeedUpdate()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $feed = factory(Feed::class)->create();

        $payload = ['url' => $this->faker->url];
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->patch(route('feed.update', $feed), $payload);
        $this->assertDatabaseHas('feeds', ['id' => $feed->id, 'url' => $payload['url']]);
    }

    public function testFeedDelete()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $feed = factory(Feed::class)->create();

        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->delete(route('feed.destroy', $feed));
        $this->assertDatabaseMissing('feeds', ['id' => $feed->id]);
    }
}
