<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;


class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_redirection()
    {
        $employee = User::factory()->create();
        
        $this->actingAs($employee, 'employee');

        $response = $this->get(route('post_index'));

        $response->assertStatus(200); 
    }

    public function test_a_login_user_can_create_post(){

        $employee = User::factory()->create();
        
        $this->actingAs($employee, 'employee');
        $post = Post::factory()->make();
        $response = $this->post(route('post_create'), [
            'title'   => $post->title,
            'body'    => $post->content,
            'user_id' => $post->user_id, 
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('post_index'));
    }

    public function test_post_data_is_showing_in_form_when_click_on_edit(){
        $employee = User::factory()->create();
        $this->actingAs($employee, 'employee');
        $post = Post::factory()->create([
            'user_id' => $employee->id,
        ]);
        $response = $this->get(route('post_edit', $post->id));
        $response->assertStatus(200);
        $response->assertViewIs('edit');
        $response->assertViewHas('post', $post);
    }

    public function test_post_update(){
        $employee = User::factory()->create();
        $this->actingAs($employee, 'employee');
        $post = Post::factory()->create([
            'user_id' => $employee->id,
        ]);
        $updatedPostData = [
            'title' => 'Updated Post Title',
            'body'  =>  'Updated Post Content',
        ];
        $response = $this->post(route('post_update', $post->id), $updatedPostData);
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Post Title',
            'body' => 'Updated Post Content',
        ]);
        $response->assertRedirect('dashboard');
    }

    public function test_post_delete(){

         $employee = User::factory()->create();
         $this->actingAs($employee, 'employee');
          $post = Post::factory()->create([
             'user_id' => $employee->id,
         ]);
          $response = $this->get(route('post_delete', $post->id));

         $this->assertDatabaseMissing('posts', [
             'id' => $post->id,
         ]);
          $response->assertRedirect('dashboard');
    }
}
