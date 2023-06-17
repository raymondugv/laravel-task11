<?php

namespace Tests\Feature;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_websites()
    {
        $response = $this->getJson(route('websites.index'));

        $response->assertStatus(200);
    }

    public function test_can_create_website()
    {
        $data = [
            'name' => 'website name',
            'url' => 'https://website.com',
        ];

        $response = $this->postJson(route('websites.store'), $data);
        $response->assertStatus(201);

        $response = $this->getJson(route('websites.index'));
        $response->assertJsonFragment($data);
    }

    public function test_can_update_website()
    {
        $website = Website::factory()->create();

        $data = [
            'name' => 'website name',
            'url' => 'https://website.com',
        ];

        $response = $this->putJson(route('websites.update', $website->id), $data);
        $response->assertStatus(200);

        $response = $this->getJson(route('websites.index'));
        $response->assertJsonFragment($data);
    }

    public function test_can_delete_website()
    {
        $website = Website::factory()->create();

        $response = $this->deleteJson(route('websites.destroy', $website->id));
        $response->assertStatus(200);

        $response = $this->getJson(route('websites.index'));
        $response->assertJsonMissing(['id' => $website->id]);
    }

    public function test_can_get_website()
    {
        $website = Website::factory()->create();

        $response = $this->getJson(route('websites.show', $website->id));
        $response->assertStatus(200);
    }
}
