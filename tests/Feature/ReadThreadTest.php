<?php	
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function view_threads_in_channel (){

        $channel = create('App\Channel');

        $threadInChannel = create('App\Thread',['channel_id'=>$channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title);
        /*
        $this->get('/threads/'.$channel->slug)
            ->assertDontSee($threadNotInChannel->title);
         */
        
    }

    /** @test */
    public function view_threads_by_user(){
        
        $this->signIn(create('App\User',['name'=>'JohnDoe']));

        $threadByJohn = create('App\Thread',['user_id'=>auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
        
    }

    /** @test */
    public function view_threads_by_popularity(){
        $threadwith2replies = create('App\Thread');
        create('App\Reply',['thread_id'=>$threadwith2replies->id],2);
        $threadwith3replies = create('App\Thread');
        create('App\Reply',['thread_id'=>$threadwith3replies->id],3);
        $threadwith0replies = create('App\Thread');

        $response = $this->getJson('/threads?popular=1')->json();
        $this->assertEquals([3,2,0],array_column($response,'replies_count'));
    }

}
