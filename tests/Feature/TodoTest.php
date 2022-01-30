<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * List todos
     *
     * @return void
     */
    /** @test  */
    public function a_user_can_get_todos()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Add todo
     *
     * @return void
     */
    /** @test  */
    public function a_user_can_store_a_todo(){
        $response = $this->followingRedirects()->post('/store', [
            'name' => 'Test',
            'active' => 1,
            'deadline' => Carbon::now()->toDateString(),
            'level' => 3,
            'comment' => "Test comment"
        ])->assertStatus(200);

        $this->assertStringContainsString('successfully', $response->getContent());
        $this->assertStringContainsString('Test comment', $response->getContent());
    }

    /**
     * View edit todo
     *
     * @return void
     */
    /** @test  */
    public function a_user_can_view_a_edit_todo(){
        $response = $this->get('/edit/1')->assertStatus(200);

        $this->assertStringContainsString('Test comment', $response->getContent());
    }

    /**
     * patch todo
     *
     * @return void
     */
    /** @test  */
    public function a_user_can_patch_a_todo(){
        $response = $this->followingRedirects()->post('/edit/1', [
            '_method' => 'PATCH',
            'name' => 'Test Edit',
            'active' => 1,
            'deadline' => Carbon::now()->toDateString(),
            'level' => 3,
            'comment' => "Test comment Edit"
        ])->assertStatus(200);

        $this->assertStringContainsString('successfully', $response->getContent());
        $this->assertStringContainsString('Test comment Edit', $response->getContent());
    }

    /**
     * delete todo
     *
     * @return void
     */
    /** @test  */
    public function a_user_can_delete_a_todo(){
        $response = $this->followingRedirects()->post('/delete/1', [
            '_method' => 'DELETE'
        ])->assertStatus(200);

        $this->assertStringContainsString('successfully', $response->getContent());

        //check still exist?
        $response = $this->get('/edit/1')->assertStatus(404);
    }
}
