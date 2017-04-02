<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_has_creator()
    {
        $reply = factory('App\Thread')->create();
        $this->assertInstanceOf('App\User',$reply->creator);
    }

    /** @test */
    public function it_belongs_to_a_channel(){

        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel',$thread->channel);
        
    }

    /** @test */
    public function a_thread_have_a_string_url(){
        $thread = create('App\Thread');
        $this->assertEquals('/threads/'.$thread->channel->slug.'/'.$thread->id,$thread->path());
    }
}
