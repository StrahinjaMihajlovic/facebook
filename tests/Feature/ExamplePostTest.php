<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use App\Traits\PostTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExamplePostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use PostTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_redirect_non_logged_user()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_non_logged_user_can_not_post()
    {
        $response = $this->post('/post');
        $response->assertRedirect('/login');
    }

    public function test_logged_user_can_store_post_without_image ()
    {
        $this->withoutExceptionHandling();
        $this->actingAs((User::factory())->create());
        $response = $this->post('/post',[
            'message' => $this->faker()->text(20),
            'public' => false
        ]);
        $response->assertStatus(200);
    }

    public function test_logged_user_can_store_post_with_image ()
    {
        $this->withoutExceptionHandling();
        $this->actingAs((User::factory())->create());
        $response = $this->post('/post',$this->data());
        $response->assertStatus(200);
    }

    public function test_message_is_required()
    {
        $this->actingAs((User::factory())->create());

        $response = $this->post('/post', array_merge($this->data(),['message' => '']));

        $response->assertSessionHasErrors('message');

        $this->assertCount(0,Post::all());
    }

    public function test_authorised_user_delete_post()
    {
        $this->withoutExceptionHandling();

        $this->actingAs((User::factory())->create());
        Gate::define('delete_post', function () {
            return true;
        });

        $this->test_logged_user_can_store_post_with_image();
        $post = Post::first();
        $this->assertCount(1,Post::all());

        $response = $this->delete('/post/' . $post->id);
        $this->assertCount(0, Post::all());
    }

    public function test_user_can_not_see_private_post_other_user()
    {
        $this->test_logged_user_can_store_post_with_image();
        $this->actingAs((User::factory())->create());

        $postService = new PostService();
        $this->assertCount(0, $this->postsAll());

    }

    public function test_user_can_see_own_private_post ()
    {
        $this->test_logged_user_can_store_post_with_image();

        $postService = new PostService();
        $this->assertCount(1, $this->postsAll());

    }

    private function data()
    {
        return [
            'message' => $this->faker()->text(20),
            'picture' => UploadedFile::fake()->image(uniqid() . '.jpg'),
            'public' => false
        ];
    }
}
