<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_may_post_a_thread(){

        //$this->actingAs(create('App\User'));
        $this->signIn();
        $thread = make('App\Thread');

        $response = $this->post('/threads',$thread->toArray());


        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /** @test */
    public function unauthenticated_user_may_not_post_thread(){
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads',$thread->toArray());
    }

    /** @test */
    public function a_thread_need_a_title(){
        $this->publishThread(['title'=>null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_need_a_body(){
        $this->publishThread(['body'=>null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_need_a_valid_channel(){

        factory('App\Channel',2)->create();

        $this->publishThread(['channel_id'=>null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id'=>999])
            ->assertSessionHasErrors('channel_id');
    }



    public function publishThread($override=[]){
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread',$override);
        return $this->post('/threads',$thread->toArray());
    }
}
