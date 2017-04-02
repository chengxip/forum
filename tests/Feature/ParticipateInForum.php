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

        $reply = factory('App\Reply')->create();

        $this->post('/threads/'.$thread->id.'/reply',$reply->toArray());

        $this->get($thread->path())->
            assertSee($reply->body);
    }
    
}
