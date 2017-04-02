<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

   # public function setUp(){
   #     parent::setUp();
   #     $this->thread = factory('App\Thread')->create();
   # }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();


        $reply = factory('App\Reply')->make();

        $this->post($thread->path().'/reply',$reply->toArray());
        $this->assertCount(1,$thread->replies);
        /*

        $this->get($thread->path())->
            assertSee($reply->body);
         */
    }
    
    /** @test */
    public function a_reply_require_a_body(){
        $this->withExceptionHandling()->signIn();
        $thread = create('App\Thread');

        $reply = make('App\Reply',['body'=>null]);

        $this->post($thread->path().'/reply',$reply->toArray())
            ->assertSessionHasErrors('body');

    }
}
