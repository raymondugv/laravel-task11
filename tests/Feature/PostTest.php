<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_posts(): void
    {
        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200);
    }

    public function test_a_post_can_be_created(): void
    {
        $website = Website::factory()->create();

        $data = [
            'title' => 'My first post',
            'body' => 'This is my first post',
            'website_id' => $website->id,
        ];

        $response = $this->postJson(route('posts.store'), $data);
        $response->assertStatus(201);

        $response = $this->getJson(route('posts.index'));
        $response->assertJsonFragment($data);
    }

    public function test_can_update_post(): void
    {
        $website = Website::factory()->create();
        $post = Post::factory()->create([
            'title' => 'My first post',
            'body' => 'This is my first post',
            'website_id' => $website->id,
        ]);

        $data = [
            'title' => 'My first post updated',
            'body' => 'This is my first post updated',
            'website_id' => $website->id,
        ];

        $response = $this->putJson(route('posts.update', $post->id), $data);
        $response->assertStatus(200);

        $response = $this->getJson(route('posts.index'));
        $response->assertJsonFragment($data);
    }

    public function test_can_get_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->getJson(route('posts.show', $post->id));
        $response->assertStatus(200);
    }

    public function test_can_delete_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson(route('posts.destroy', $post->id));
        $response->assertStatus(200);

        $response = $this->getJson(route('posts.index'));
        $response->assertJsonMissing(['id' => $post->id]);
    }
}
