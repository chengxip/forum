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

}
