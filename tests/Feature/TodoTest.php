<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use Tests\TestCase;

class TodoTest extends TestCase
{
    const SUCCESS_MESSAGE = 'successfully';
    const COMMENT = "Test comment";
    const COMMENT_EDIT = "Test comment Edit";

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
            'comment' => self::COMMENT
        ])->assertStatus(200);

        $this->assertStringContainsString(self::SUCCESS_MESSAGE, $response->getContent());
        $this->assertStringContainsString(self::COMMENT, $response->getContent());
    }

    /**
     * View edit todo
     *
     * @return void
     */
    /** @test  */
    public function a_user_can_view_a_edit_todo(){
        $response = $this->get('/edit/1')->assertStatus(200);

        $this->assertStringContainsString(self::COMMENT, $response->getContent());
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
            'name' => 'Test',
            'active' => 1,
            'deadline' => Carbon::now()->toDateString(),
            'level' => 3,
            'comment' => self::COMMENT_EDIT
        ])->assertStatus(200);

        $this->assertStringContainsString(self::SUCCESS_MESSAGE, $response->getContent());
        $this->assertStringContainsString(self::COMMENT_EDIT, $response->getContent());
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

        $this->assertStringContainsString(self::SUCCESS_MESSAGE, $response->getContent());
    }

    /**
     * delete check
     *
     * @return void
     */
    /** @test  */
    public function is_todo_deleted(){
        //check still exist?
        $response = $this->get('/edit/1')->assertStatus(404);
    }
}
