<?php

namespace Tests\Feature;

use App\Models\Story;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class StoryTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    //only logged in users can share story
    public function testLogged ()
    {
        $response = $this->post('story')
            ->assertRedirect('/login');
    }

    //authenticated users can get story
    public function testAuthenticated ()
    {
        $this->actingAs((User::factory())->create());

        $response = $this->get('/story')
            ->assertOk();
    }

    //user share story
    public function testStoreStory ()
    {
        $this->actingAs((User::factory())->create());

        $this->post('/story', $this->data());

        $this->assertCount(1,Story::all());
    }

    //test validation for image (required)
    public function testImageIsRequired()
    {
        $this->actingAs((User::factory())->create());

        $response = $this->post('/story', array_merge($this->data(),['storyImage' => 'test.png']));

        $response->assertSessionHasErrors('storyImage');

        $this->assertCount(0,Story::all());
    }

    //user delete story
    public function testDeleteStory()
    {
        $this->actingAs((User::factory())->create());
        Gate::define('delete-story', function () {
            return true;
        });

        $this->testStoreStory();
        $story = Story::first();
        $this->assertCount(1,Story::all());

        $response = $this->post('/story/delete/' . $story->id);
        $this->assertCount(0, Story::all());
    }

    private function data()
    {
        return  [
            'storyImage' => UploadedFile::fake()->image('test.png')
        ];
    }

}
