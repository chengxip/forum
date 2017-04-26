<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread ;
    public function setUp(){
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_browser_threads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_browser_thread()
    {
        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_associated_with_a_thread(){
        $reply = factory('App\Reply')->create(['thread_id'=>$this->thread->id]);
        $this->get($this->thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_thread_can_add_a_reply(){

        $this->thread->addReply([
            'body'=>'Foo',
            'user_id'=> 1,
        ]);
        $this->assertCount(1,$this->thread->replies);

    }


    /** @test */
    public function authenticated_user_can_delete_thread(){
        $this->signIn();

        $thread = create('App\Thread',['user_id'=> auth()->id() ]);

        $reply = create('App\Reply',['thread_id'=> $thread->id]);

        $this->json('DELETE',$thread->path())
            ->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id ]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id ]);

    }

    /** @test */
    public function guests_can_not_delete_thread(){
        $this->withExceptionHandling();
        $thread = create('App\Thread');
        $response = $this->delete($thread->path());
        $response->assertRedirect('/login');
    }


    /** @test */
    public function unauthorized_user_may_not_delete_thread(){
        $this->withExceptionHandling();
        $this->signIn();
        $thread = create('App\Thread');
        $response = $this->delete($thread->path());
        $response->assertStatus(403);
    }

}
